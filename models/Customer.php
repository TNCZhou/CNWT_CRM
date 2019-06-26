<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/24
 * Time: 20:14
 */

namespace app\models;


class Customer extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%customer}}';
    }

    public function rules()
    {
        return [
            [['type', 'description', 'name', 'address', 'star'], 'safe'],
        ];
    }

    public function getTypeText()
    {
        $results = \Yii::$app->params['customer_type'];
        return $results[$this->type] ? $results[$this->type] : '';
    }

    public function getStarText()
    {
        $results = \Yii::$app->params['customer_star'];
        return $results[$this->star] ? $results[$this->star] : '';
    }

    public function getOthers()
    {
        return $this->hasMany(CustomerOther::className(), ['customer_id' => 'id']);
    }

    public function getPersons()
    {
        return $this->hasMany(CustomerPerson::className(), ['customer_id' => 'id']);
    }

    public function getProjectCount($type = 0)
    {
        $query = $this->hasMany(Project::className(), ['customer_id' => 'id']);
        if ($type == 1) {
            $query->where(['in', 'progress', [1, 2, 3, 4, 5, 6, 7, 10]]);
        } elseif ($type == 2) {
            $query->where(['in', 'progress', [8, 11]]);
        } elseif ($type == 3) {
            $query->where(['progress' => 9]);
        }
        return $query->count();
    }
}