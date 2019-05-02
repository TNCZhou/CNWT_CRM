<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/24
 * Time: 20:14
 */

namespace app\models;


class CustomerPersonInfo extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%customer_person_info}}';
    }

    public function rules()
    {
        return [
            [['person_id', 'info'], 'safe'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'user_id'])->one();
    }

}