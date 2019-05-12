<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/23
 * Time: 15:03
 */

namespace app\controllers;


use app\behaviors\LoginBehavior;
use app\logic\LoginForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => LoginBehavior::className(),
                'except' => ['login','password'],
            ]
        ];
    }

    /**
     * 登录
     */
    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect([\Yii::$app->defaultRoute]);
        }
        if(\Yii::$app->request->isPost) {
            $model = new LoginForm();
            $model->attributes = \Yii::$app->request->post();
            if ($model->login()) {
                return $this->renderJson([
                    'code' => 0,
                    'msg' => '登录成功'
                ]);
            }
            return $this->renderJson([
                'code' => 1,
                'msg' => $model->getErrorSummary(true)
            ]);
        }
        return $this->renderPartial('login');
    }

    public function actionPassword()
    {
        if(\Yii::$app->request->isPost) {
            $model = new LoginForm();
            $model->attributes = \Yii::$app->request->post();
            $model->newPassword = \Yii::$app->request->post('newPassword');
            if ($model->changePassword()) {
                return $this->renderJson([
                    'code' => 0,
                    'msg' => '修改成功'
                ]);
            }
            return $this->renderJson([
                'code' => 1,
                'msg' => $model->getErrorSummary(true)
            ]);
        }
        return $this->renderPartial('pwd');
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->redirect(['site/login']);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}