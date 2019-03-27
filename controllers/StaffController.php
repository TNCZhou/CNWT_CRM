<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/23
 * Time: 15:03
 */

namespace app\controllers;


use app\behaviors\DepartmentBehavior;
use app\behaviors\LoginBehavior;
use app\models\Department;
use app\models\User;
use app\models\Welcome;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\web\UrlManager;

class StaffController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => LoginBehavior::className(),
            ],
            'department' => [
                'class' => DepartmentBehavior::className(),
                'requirement' => 1
            ]
        ];
    }

    public function actionIndex()
    {
        $department = \Yii::$app->request->get('department');
        $username = \Yii::$app->request->get('username');
        $order = \Yii::$app->request->get('order') == 'username' ? 'username' : 'id';
        $by = \Yii::$app->request->get('by') == 'asc' ? 'asc' : 'desc';
        $where = [];
        if ($department)
            $where['department'] = $department;
        if ($username)
            $where['username'] = $username;
        $query = User::find()->where($where);
        $pagination = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 20]);
        $query->orderBy($order . ' ' . $by);
        $list = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        $levels = \Yii::$app->params['level'];
        $params = \Yii::$app->request->getQueryParams();
        return $this->render('staff', [
            'list' => $list,
            'departmentList' => Department::getList(),
            'department' => $department,
            'username' => $username,
            'levels' => $levels,
            'pagination' => $pagination,
            'params' => $params
        ]);
    }

    public function actionAdd()
    {
        if (\Yii::$app->request->isPost) {
            $user = new User(\Yii::$app->request->post());
            $user->password = $user->encodePassword(\Yii::$app->request->post('password'));
            if ($user->level == -1)
                $user->dismission_time = time();
            $user->save();
            return $this->redirect(['staff/detail', 'id' => $user->id]);
        }
        $levels = \Yii::$app->params['level'];
        return $this->render('staff-add', [
            'departmentList' => Department::getList(),
            'levels' => $levels
        ]);
    }

    public function actionEdit()
    {
        if (\Yii::$app->request->isPost) {
            $id = \Yii::$app->request->post('id');
            $user = User::findOne($id);
            $password = \Yii::$app->request->post('password');
            if ($password)
                $user->password = $user->encodePassword($password);
            $level = \Yii::$app->request->post('level');
            if ($level == -1 && $user->level != -1)
                $user->dismission_time = time();
            if ($user->username != 'admin')
                $user->level = $level;
            $user->department = \Yii::$app->request->post('department');
            $user->position = \Yii::$app->request->post('position');
            $user->save();
            return $this->redirect(['staff/detail', 'id' => $user->id]);
        }
        $id = \Yii::$app->request->get('id');
        $user = User::findOne($id);
        $levels = \Yii::$app->params['level'];
        return $this->render('staff-edit', [
            'user' => $user,
            'departmentList' => Department::getList(),
            'levels' => $levels
        ]);
    }

    public function actionDetail()
    {
        $id = \Yii::$app->request->get('id');
        $user = User::findOne($id);
        return $this->render('staff-detail', [
            'user' => $user,
            'departmentList' => Department::getList(),
            'levels' => \Yii::$app->params['level']
        ]);
    }

    public function actionDelete()
    {
        $id = \Yii::$app->request->get('id');
        $user = User::findOne($id);
        if ($user->username == 'admin')
            return $this->renderJson([
                'code' => 1,
                'msg' => "admin不能删除"
            ]);
        $user->delete();
        return $this->renderJson([
            'code' => 0,
            'msg' => "删除成功"
        ]);
    }

    public function actionDeleteAll()
    {
        $ids = \Yii::$app->request->get('ids');
        $idsArray = explode(',', $ids);
        foreach ($idsArray as $id) {
            $user = User::findOne($id);
            if ($user->username == 'admin')
                continue;
            $user->delete();
        }
        return $this->renderJson([
            'code' => 0,
            'msg' => "删除成功"
        ]);
    }

    public function actionWelcome()
    {
        $query = Welcome::find();
        $keyword = \Yii::$app->request->get('keyword');
        if($keyword)
            $query->where(['like','content', $keyword]);
        $pagination = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 20]);
        $query->orderBy('id desc');
        $list = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('welcome', [
            'list' => $list,
            'pagination' => $pagination,
            'keyword' => $keyword
        ]);
    }

    public function actionWelcomeImport()
    {
        $input = \Yii::$app->request->post('data');
        $words = explode("\n", $input);
        foreach ($words as $w) {
            if ($w) {
                $welcome = new Welcome();
                $welcome->content = $w;
                $welcome->created_at = time();
                $welcome->save();
            }
        }
        return $this->renderJson([
            'code' => 0,
            'msg' => '导入成功'
        ]);
    }

    public function actionWelcomeDelete()
    {
        $id = \Yii::$app->request->get('id');
        Welcome::findOne($id)->delete();
        return $this->renderJson([
            'code' => 0,
            'msg' => "删除成功"
        ]);
    }

    public function actionWelcomeDeleteAll()
    {
        $ids = \Yii::$app->request->get('ids');
        $idsArray = explode(',', $ids);
        foreach ($idsArray as $id) {
            Welcome::findOne($id)->delete();
        }
        return $this->renderJson([
            'code' => 0,
            'msg' => "删除成功"
        ]);
    }
}