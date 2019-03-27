<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/23
 * Time: 15:03
 */

namespace app\controllers;


use app\behaviors\LoginBehavior;

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
        return $this->render('project');
    }
}