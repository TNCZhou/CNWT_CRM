<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/24
 * Time: 20:14
 */

namespace app\models;


class CustomerOther extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%customer_other}}';
    }

    public function rules()
    {
        return [
            [['content'], 'safe'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'user_id']);
    }

    public function getDateText()
    {
        return date('Y-m-d', $this->created_at);
    }
}