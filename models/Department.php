<?php

namespace app\models;

class Department extends \yii\db\ActiveRecord
{
    public static function getList()
    {
        $list = self::find()->all();
        $return = [];
        foreach ($list as $k => $v) {
            $return[$v->id] = $v->name;
        }
        return $return;
    }

    public static function getVisibleDepartment()
    {
        if (\Yii::$app->user->identity->level == 4) {
            $departmentList = Department::getList();
        } elseif (\Yii::$app->user->identity->level == 3) {
            $d = Department::findOne(\Yii::$app->user->identity->department);
            $departmentList = [\Yii::$app->user->identity->department => $d->name];
        } else {
            $departmentList = [];
        }
        return $departmentList;
    }
}
