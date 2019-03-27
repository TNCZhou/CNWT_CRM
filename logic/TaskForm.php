<?php

namespace app\logic;

use app\models\Task;
use app\models\TaskRecord;
use Yii;
use yii\base\Model;

/**
 * SiteForm is the model behind the contact form.
 */
class TaskForm extends Model
{
    public $id;
    public $user_id;
    public $content;
    public $result;
    public $type;
    public $records;

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['content', 'type'], 'string'],
            [['id', 'user_id'], 'integer'],
        ];
    }

    public function save()
    {
        if (!$this->validate())
            return [
                'code' => 1,
                'msg' => $this->getErrorSummary(true)
            ];
        if ($this->id)
            $task = Task::findOne([
                'id' => $this->id,
                'user_id' => $this->user_id
            ]);
        else
            $task = new Task();
        $task->content = $this->content;
        $task->type = $this->type;
        $task->user_id = $this->user_id;
        if($task->isNewRecord)
            $task->created_at = time();
        if($task->save()) {
            $this->id = $task->id;
            foreach ($this->records as $record) {
                if($record['id']) {
                    $r = TaskRecord::findOne([
                        'task_id' => $this->id,
                        'user_id' => $this->user_id,
                        'id' => $record['id']
                    ]);
                } else {
                    $r = new TaskRecord();
                    $r->task_id = $this->id;
                    $r->user_id = $this->user_id;
                    $r->created_at = time();
                }
                $r->start_time = strtotime($record['start_time']);
                $r->end_time = strtotime($record['end_time']);
                $r->result = $record['result'];
                $r->remark = $record['remark'];
                if($r->save())
                    $task->result = $r->result;
            }
            $task->save();
            return [
                'code' => 0,
                'msg' => '保存成功'
            ];
        }
        return [
            'code' => 1,
            'msg' => $this->getErrorSummary(true)
        ];
    }
}
