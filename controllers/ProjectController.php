<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/23
 * Time: 15:03
 */

namespace app\controllers;


use app\behaviors\LoginBehavior;
use app\models\Customer;
use app\models\CustomerPerson;
use app\models\Project;
use app\models\ProjectProgress;
use app\models\User;
use yii\data\Pagination;
use yii\db\Expression;

class ProjectController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => LoginBehavior::className(),
            ]
        ];
    }

    public function actionIndex()
    {
        $type = \Yii::$app->request->get('type');
        $query = $this->getQuery();
        $total = $query->count();
        if ($type == 'incharge') {
            $query->andWhere(['project_incharge' => \Yii::$app->user->id]);
        } elseif ($type == 'participate') {
            $query->andWhere(new Expression('FIND_IN_SET(' . \Yii::$app->user->id . ', project_participants)'));
        }
        $pagination = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 20]);
        $query->orderBy('p.id desc')->select('p.*');
        $list = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        $params = \Yii::$app->request->getQueryParams();

        $myJoin = (int)($this->getQuery()->andWhere(new Expression('FIND_IN_SET(' . \Yii::$app->user->id . ', project_participants)'))->count());
        $myIncharge = (int)($this->getQuery()->andWhere(['project_incharge' => \Yii::$app->user->id])->count());
        return $this->render('project', [
            'progress' => \Yii::$app->params['project_progress'],
            'list' => $list,
            'pagination' => $pagination,
            'params' => $params,
            'myIncharge' => $myIncharge,
            'myJoin' => $myJoin,
            'total' => $total
        ]);
    }

    public function getQuery()
    {
        $keyword = \Yii::$app->request->get('keyword');
        $customer_id = \Yii::$app->request->get('customer_id');
        $progress = \Yii::$app->request->get('progress');
        $query = Project::find()->alias('p')->leftJoin(['c' => Customer::tableName()], 'p.customer_id = c.id');
        if ($keyword) {
            $query->andWhere([
                'or', [
                    'like', 'p.name', $keyword
                ], [
                    'like', 'c.name', $keyword
                ]
            ]);
        }
        if ($customer_id) {
            $query->andWhere(['customer_id' => $customer_id]);
        }
        if ($progress) {
            $progress = explode(',', $progress);
            if (!is_array($progress)) {
                $progress = [$progress];
            }
            $query->andWhere(['in', 'progress', $progress]);
        }
        return $query;
    }

    public function actionDetail()
    {
        $id = \Yii::$app->request->get('id');
        $customerList = Customer::find()->orderBy(' CONVERT(name USING gbk) asc')->all();
        $project = Project::findOne([
            'id' => $id
        ]);
        $userList = User::find()->where(['>', 'level', 0])->orderBy(' CONVERT(realname USING gbk) asc')->all();
        $participants = explode(',', $project->project_participants);
        $InProject = in_array(\Yii::$app->user->id, $participants) || $project->project_incharge == \Yii::$app->user->id;
        return $this->render('project-detail', [
            'customerList' => $customerList,
            'project' => $project,
            'userList' => $userList,
            'inProject' => $InProject
        ]);
    }

    public function actionAdd()
    {
        if (\Yii::$app->request->isPost) {
            $form = new Project();
            $form->setAttributes(\Yii::$app->request->post());
            $name = \Yii::$app->request->post('name');
            if (Project::find()->where(['name' => $name])->count()) {
                return $this->renderJson([
                    'code' => -1,
                    'msg' => '项目已存在'
                ]);
            }
            $p = \Yii::$app->request->post('project_participants');
            if ($p) {
                $p = implode(',', $p);
            }
            $form->project_participants = $p;
            $form->save();
            return $this->renderJson([
                'code' => 200,
                'id' => $form->id
            ]);
        } else {
            $customerList = Customer::find()->orderBy(' CONVERT(name USING gbk) asc')->all();
            $userList = User::find()->where(['>', 'level', 0])->orderBy(' CONVERT(realname USING gbk) asc')->all();
            return $this->render('project-add', [
                'customerList' => $customerList,
                'userList' => $userList
            ]);
        }
    }

    public function actionEdit()
    {
        if (\Yii::$app->request->isPost) {
            $id = \Yii::$app->request->post('id');
            $form = Project::findOne([
                'id' => $id
            ]);
            if (!$form) {
                return $this->renderJson([
                    'code' => 404,
                    'msg' => '项目不存在'
                ]);
            }
            $form->setAttributes(\Yii::$app->request->post());
            $p = \Yii::$app->request->post('project_participants');
            if ($p) {
                $p = implode(',', $p);
            }
            $form->project_participants = $p;
            $form->save();
            return $this->renderJson([
                'code' => 200,
                'msg' => '修改成功'
            ]);
        } else {
            $customerList = Customer::find()->orderBy(' CONVERT(name USING gbk) asc')->all();
            $userList = User::find()->where(['>', 'level', 0])->orderBy(' CONVERT(realname USING gbk) asc')->all();
            return $this->render('project-add', [
                'customerList' => $customerList,
                'userList' => $userList
            ]);
        }
    }

    public function actionProgressAdd()
    {
        if (\Yii::$app->request->isPost) {
            $project_id = \Yii::$app->request->post('project_id');
            $project = Project::findOne($project_id);
            if (!$project) {
                return $this->renderJson([
                    'code' => -1,
                    'msg' => '项目不存在'
                ]);
            }
            $participants = explode(',', $project->project_participants);
            if ($project->project_incharge != \Yii::$app->user->id && !in_array(\Yii::$app->user->id, $participants)) {
                return $this->renderJson([
                    'code' => -2,
                    'msg' => '没有权限'
                ]);
            }
            $progress = new ProjectProgress();
            $progress->setAttributes(\Yii::$app->request->post());
            $progress->user_id = \Yii::$app->user->id;
            $progress->project_id = $project_id;
            if ($progress->save()) {
                $project = Project::findOne([
                    'id' => $project_id
                ]);
                $project->progress = $progress->progress;
                $project->save();
            }
            return $this->renderJson([
                'code' => 200,
                'msg' => '提交成功'
            ]);
        }
    }

    public function actionCustomerPersonList()
    {
        $customer_id = \Yii::$app->request->get('customer_id');
        $person_list = CustomerPerson::find()->where([
            'customer_id' => $customer_id
        ])->asArray()->all();
        $return = [];
        foreach ($person_list as $row) {
            $return[] = [
                'value' => $row['name'],
                'text' => $row['name']
            ];
        }
        return $this->renderJson([
            'code' => 200,
            'data' => [
                'list' => $return
            ]
        ]);
    }
}