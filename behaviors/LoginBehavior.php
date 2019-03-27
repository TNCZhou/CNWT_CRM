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

class LoginBehavior extends Behavior
{
    public $except = [];

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }

    public function beforeAction($e)
    {
        if(in_array($e->action->id,$this->except))
            return false;
        if (!\Yii::$app->user->id) {
            if (\Yii::$app->request->isAjax) {
                $e->action->controller->renderJson([
                    'code' => -99,
                    'msg' => '请先登录',
                ]);
            } else {
                $e->action->controller->redirect(['site/login']);
            }
        }
    }
}