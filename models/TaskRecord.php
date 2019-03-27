<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/24
 * Time: 20:14
 */

namespace app\models;


class TaskRecord extends \yii\db\ActiveRecord
{
    public function getResultText()
    {
        $results = \Yii::$app->params['result'];
        return $results[$this->result] ? $results[$this->result] : '';
    }
}