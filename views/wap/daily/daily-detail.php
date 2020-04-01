<?php
echo $this->render('../header',[
    'title' => '日志详情'
]);
?>
<link href="assets/css/project.css" rel="stylesheet"/>
<script src="assets/validform/js/validform_min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/validform/css/validform.css">
<body>
<div class="mui-card detail-card">
    <div class="mui-input-group input-group list-group">
        <div class="mui-input-row">
            <label>工作任务</label>
            <div class="readonly-input"><?=$task['content']?></div>
        </div>
        <div class="mui-input-row">
            <label>工作类别</label>
            <div class="readonly-input"><?=$task['type']?></div>
        </div>
    </div>
</div>
<?php foreach($task->records as $k=>$v):?>
<div class="mui-card detail-card">
    <div class="mui-input-group input-group list-group">
        <div class="mui-input-row">
            <label>工作结果</label>
            <div class="readonly-input"><?=$v->resultText?></div>
        </div>
        <div class="mui-input-row">
            <label>时间段</label>
            <div class="readonly-input"><?=$v['start_time']?date('Y-m-d H:i:s',$v['start_time']):''?> - <?=$v['end_time']?date('Y-m-d H:i:s',$v['end_time']):''?></div>
        </div>
        <div class="mui-input-row">
            <label>情况说明</label>
            <div class="readonly-input"><?=$v['remark']?></div>
        </div>
    </div>
</div>
<?php endforeach;?>
<?php if($task->user_id == \Yii::$app->user->id):?>
<div class="margin mui-text-center">
    <a href="<?=\yii\helpers\Url::to(['daily/edit','id'=>$task['id']])?>" class="mui-btn mui-btn-primary btn-mini href-a">修改日志</a>
</div>
    <div class="margin mui-text-center">
    <a href="<?=\yii\helpers\Url::to(['daily/edit'])?>" class="mui-btn mui-btn-primary btn-mini href-a">新增日志</a>
    </div>
<?php endif;?>
</body>
</html>