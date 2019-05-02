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
use app\models\Customer;
use app\models\CustomerOther;
use app\models\CustomerPerson;
use app\models\CustomerPersonExperience;
use app\models\CustomerPersonInfo;
use app\models\Department;
use app\models\Project;
use app\models\User;
use app\models\Welcome;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\web\UrlManager;

class CustomerController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => LoginBehavior::className(),
            ],
//            'department' => [
//                'class' => DepartmentBehavior::className(),
//                'requirement' => 1
//            ]
        ];
    }

    public function actionIndex()
    {
        $type = \Yii::$app->request->get('type');
        $keyword = \Yii::$app->request->get('keyword');
        $query = Customer::find();
        if ($type)
            $query->where(['type' => $type]);
        if ($keyword)
            $query->andWhere([
                'or',
                ['like', 'name', $keyword],
                ['like', 'description', $keyword]
            ]);
        $total = $query->count();
        $pagination = new Pagination(['totalCount' => $total, 'defaultPageSize' => 20]);
        $query->orderBy('id desc');
        $list = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        $customerType = \Yii::$app->params['customer_type'];
        $customerStar = \Yii::$app->params['customer_star'];
        $typeCount = [];
        foreach ($customerType as $k => $v) {
            $typeCount[$k] = Customer::find()->where(['type' => $k])->count();
        }
        return $this->render('customer', [
            'list' => $list,
            'customerType' => $customerType,
            'customerStar' => $customerStar,
            'pagination' => $pagination,
            'type' => $type,
            'keyword' => $keyword,
            'total' => $total,
            'typeCount' => $typeCount
        ]);
    }

    public function actionAdd()
    {
        if (\Yii::$app->request->isPost) {
            $customer = new Customer();
            $customer->setAttributes(\Yii::$app->request->post());
            $customer->save();
            return $this->redirect(['customer/detail', 'id' => $customer->id]);
        }
        return $this->render('customer-add', [
            'customerType' => \Yii::$app->params['customer_type'],
            'customerStar' => \Yii::$app->params['customer_star']
        ]);
    }

    public function actionEdit()
    {
        if (\Yii::$app->request->isPost) {
            $id = \Yii::$app->request->post('id');
            $customer = Customer::findOne($id);
            if (!$customer)
                exit("此用户不存在");
            $customer->address = \Yii::$app->request->post('address');
            $customer->star = \Yii::$app->request->post('star');
            $customer->save();
            return $this->redirect(['customer/detail', 'id' => $customer->id]);
        }
        $id = \Yii::$app->request->get('id');
        $customer = Customer::findOne($id);
        return $this->render('customer-edit', [
            'customer' => $customer,
            'customerStar' => \Yii::$app->params['customer_star']
        ]);
    }

    public function actionDetail()
    {
        $id = \Yii::$app->request->get('id');
        $customer = Customer::findOne($id);
        $projectList = Project::find()->where(['customer_id' => $id])->all();
        return $this->render('customer-detail', [
            'customer' => $customer,
            'projectList' => $projectList,
            'levels' => \Yii::$app->params['level']
        ]);
    }

    public function actionOtherAdd()
    {
        $id = \Yii::$app->request->post('id');
        $customerOther = new CustomerOther();
        $customerOther->setAttributes(\Yii::$app->request->post());
        $customerOther->user_id = \Yii::$app->user->id;
        $customerOther->created_at = time();
        $customerOther->customer_id = $id;
        $customerOther->save();
        return $this->renderJson([
            'code' => 200,
            'msg' => '保存成功'
        ]);
    }

    public function actionOtherDelete()
    {
        $id = \Yii::$app->request->get('id');
        $co = CustomerOther::findOne(['id' => $id]);
        if ($co) {
            $co->delete();
        }
        return $this->renderJson([
            'code' => 200,
            'msg' => '删除成功'
        ]);
    }

    public function actionPersonAdd()
    {
        if (\Yii::$app->request->isPost) {
            $person = new CustomerPerson();
            $person->setAttributes(\Yii::$app->request->post());
            $person->save();
            return $this->redirect(['customer/person-detail', 'id' => $person->id]);
        }
        $customerId = \Yii::$app->request->get('customer_id');
        return $this->render('person-add', [
            'gender' => \Yii::$app->params['gender'],
            'customerId' => $customerId
        ]);
    }

    public function actionPersonEdit()
    {
        if (\Yii::$app->request->isPost) {
            $id = \Yii::$app->request->post('id');
            $person = CustomerPerson::findOne($id);
            if (!$person)
                exit("此人事不存在");
            $person->setAttributes(\Yii::$app->request->post());
            $person->save();
            return $this->redirect(['customer/person-detail', 'id' => $person->id]);
        }
        $id = \Yii::$app->request->get('id');
        $person = CustomerPerson::findOne($id);
        return $this->render('person-edit', [
            'person' => $person,
            'gender' => \Yii::$app->params['gender']
        ]);
    }

    public function actionPersonDetail()
    {
        $id = \Yii::$app->request->get('id');
        $person = CustomerPerson::findOne($id);
        return $this->render('person-detail', [
            'person' => $person,
            'gender' => \Yii::$app->params['gender']
        ]);
    }

    public function actionPersonExperienceAdd()
    {
        if (\Yii::$app->request->isPost) {
            $company = \Yii::$app->request->post('company');
            if (!Customer::findOne($company)) {
                return $this->renderJson([
                    'code' => 404,
                    'msg' => '请选择单位'
                ]);
            }
            $person = new CustomerPersonExperience();
            $person->setAttributes(\Yii::$app->request->post());
            $person->start_date = strtotime(\Yii::$app->request->post('start_date'));
            $person->end_date = strtotime(\Yii::$app->request->post('end_date')) >= strtotime('today') ? 0 : strtotime(\Yii::$app->request->post('end_date'));
            $t = \Yii::$app->db->beginTransaction();
            if ($person->end_date == 0) {
                $lastExperience = CustomerPersonExperience::findOne([
                    'end_date' => 0,
                    'person_id' => $person->person_id
                ]);
                $lastExperience->end_date = $person->start_date - 3600 * 24;
                if (!$lastExperience->save()) {
                    $t->rollBack();
                    return [
                        'code' => 500,
                        'msg' => $lastExperience->getErrorSummary(false)[0]
                    ];
                }
                $cp = CustomerPerson::findOne($person->person_id);
                $cp->customer_id = $person->company;
                if (!$cp->save()) {
                    $t->rollBack();
                    return [
                        'code' => 500,
                        'msg' => $cp->getErrorSummary(false)[0]
                    ];
                }
            }
            if (!$person->save()) {
                $t->rollBack();
                return [
                    'code' => 500,
                    'msg' => $person->getErrorSummary(false)[0]
                ];
            }
            $t->commit();
            return $this->renderJson([
                'code' => 200,
                'msg' => '保存成功'
            ]);
        }
    }

    public function actionPersonInfoAdd()
    {
        if (\Yii::$app->request->isPost) {
            $person = new CustomerPersonInfo();
            $person->setAttributes(\Yii::$app->request->post());
            $person->user_id = \Yii::$app->user->id;
            $person->created_at = time();
            $person->save();
            return $this->renderJson([
                'code' => 200,
                'msg' => '保存成功'
            ]);
        }
    }

    public function actionCompanyList()
    {
        $keyword = \Yii::$app->request->get('word');
        $query = Customer::find();
        if ($keyword) {
            $query->where(['like', 'name', $keyword]);
        }
        $list = $query->all();
        return $this->renderJson([
            'code' => 200,
            'data' => [
                'list' => $list
            ]
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
        if ($keyword)
            $query->where(['like', 'content', $keyword]);
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