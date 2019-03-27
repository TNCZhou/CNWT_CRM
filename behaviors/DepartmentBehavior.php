<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/27
 * Time: 1:05
 */

namespace app\behaviors;


use yii\base\Behavior;
use yii\web\Controller;

class DepartmentBehavior extends Behavior
{
    public $requirement = '';

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }

    public function beforeAction($e)
    {
        if ($this->requirement && \Yii::$app->user->identity->department != $this->requirement && \Yii::$app->user->identity->username != 'admin') {
            if (\Yii::$app->request->isAjax) {
                $e->action->controller->renderJson([
                    'code' => -98,
                    'msg' => '没有权限',
                ]);
            } else {
                $e->action->controller->redirect(['site/login']);
            }
        }
    }
}