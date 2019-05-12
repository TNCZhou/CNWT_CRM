<?php

namespace app\controllers;

use Yii;
use yii\web\Response;

class Controller extends \yii\web\Controller
{
    public function init()
    {
        if(\Yii::getAlias('@device') == 'mobile') {
            \Yii::$app->defaultRoute = 'site/index';
            $this->layout = 'wap';
            $this->setViewPath(\Yii::$app->viewPath . DIRECTORY_SEPARATOR . 'wap' . substr($this->viewPath, strlen(\Yii::$app->viewPath)));
        }
        parent::init();
    }

    public function renderJson($data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
}
