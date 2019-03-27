<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/24
 * Time: 20:14
 */

namespace app\models;


class Welcome extends \yii\db\ActiveRecord
{
    public static function getRandomContent()
    {
        $ids = self::find()->select('id,content')->asArray()->all();
        $rand = mt_rand(0,count($ids)-1);
        return $ids[$rand]['content'];
    }
}