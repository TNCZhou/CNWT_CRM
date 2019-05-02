<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/24
 * Time: 20:14
 */

namespace app\models;


class CustomerPerson extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%customer_person}}';
    }

    public function rules()
    {
        return [
            [['customer_id', 'name', 'gender', 'department', 'position', 'tel', 'qq', 'wechat'], 'safe'],
        ];
    }

    public function getGenderText()
    {
        $results = \Yii::$app->params['gender'];
        return $results[$this->gender] ? $results[$this->gender] : '';
    }

    public function getExperiences()
    {
        return $this->hasMany(CustomerPersonExperience::className(),['person_id' => 'id'])->orderBy('start_date desc');
    }

    public function getExperience()
    {
        return $this->hasMany(CustomerPersonExperience::className(),['person_id' => 'id'])->where(['end_date' => 0])->one();
    }

    public function getManyInfo()
    {
        return $this->hasMany(CustomerPersonInfo::className(),['person_id' => 'id'])->orderBy('id desc');
    }
}