<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/24
 * Time: 20:14
 */

namespace app\models;


class CustomerPersonExperience extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%customer_person_experience}}';
    }

    public function rules()
    {
        return [
            [['person_id', 'company', 'department', 'position'], 'safe'],
        ];
    }

    public function getTheCompany()
    {
        return $this->hasMany(Customer::className(),['id' => 'company'])->one();
    }
}