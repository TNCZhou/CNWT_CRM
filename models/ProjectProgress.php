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

class ProjectProgress extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%project_progress}}';
    }

    public function rules()
    {
        return [
            [['progress', 'dateline', 'description'], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => null,
                ],
            ],
        ];
    }

    public function getProgressText()
    {
        return \Yii::$app->params['project_progress'][$this->progress];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'user_id'])->one();
    }
}