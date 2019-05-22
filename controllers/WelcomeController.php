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

class WelcomeController extends Controller
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

    public function actionImport()
    {
        $file = UploadedFile::getInstanceByName('file');
        $input = file_get_contents($file->tempName);
        $encode = mb_detect_encoding($input, array('ASCII', 'GB2312', 'GBK','UTF-8'));
        if($encode != 'UTF-8') {
            $input = iconv($encode, 'utf-8', $input);
        }
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

    public function actionDelete()
    {
        $id = \Yii::$app->request->get('id');
        Welcome::findOne($id)->delete();
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
            Welcome::findOne($id)->delete();
        }
        return $this->renderJson([
            'code' => 0,
            'msg' => "删除成功"
        ]);
    }
}