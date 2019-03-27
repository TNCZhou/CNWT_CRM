<?php

namespace app\controllers;

use Yii;
use yii\web\Response;

class Controller extends \yii\web\Controller
{
    public function renderJson($data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
}
