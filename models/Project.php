<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/24
 * Time: 20:14
 */

namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Project extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%project}}';
    }

    public function rules()
    {
        return [
            [['name', 'customer_id', 'customer_incharge', 'plan_price', 'plan_start_date', 'plan_end_date', 'project_incharge', 'project_participants', 'real_start_date', 'real_end_date', 'real_price'], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id'])->one();
    }

    public function getIncharge()
    {
        return $this->hasOne(User::className(), ['id' => 'project_incharge'])->one();
    }

    public function getProgressText()
    {
        return \Yii::$app->params['project_progress'][$this->progress];
    }

    public function getProgressList()
    {
        return $this->hasMany(ProjectProgress::className(), ['project_id' => 'id'])->orderBy('dateline desc')->all();
    }
}