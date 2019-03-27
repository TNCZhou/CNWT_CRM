
        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                工作日志详情
            </div>
            <div class="tpl-portlet-components">

                <div class="tpl-block">

                    <div class="am-g tpl-amazeui-form">

                        <div class="am-u-sm-12 am-u-md-10 am-text-sm">
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">工作任务：</div>
                                <div class="am-u-sm-9"><?=$task['content']?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">工作类别：</div>
                                <div class="am-u-sm-9"><?=$task['type']?></div>
                            </div>
                            <?php foreach($task->records as $k=>$v):?>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">工作结果：</div>
                                <div class="am-u-sm-9"><?=$v->resultText?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">时间段：</div>
                                <div class="am-u-sm-9"><?=$v['start_time']?date('Y-m-d H:i:s',$v['start_time']):''?> - <?=$v['end_time']?date('Y-m-d H:i:s',$v['end_time']):''?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm am-margin-bottom-lg">
                                <div class="am-u-sm-3 am-text-right">情况说明：</div>
                                <div class="am-u-sm-9"><?=$v['remark']?> </div>
                            </div>
                            <?php endforeach;?>
                            <hr>
                            <?php if($task->user_id == \Yii::$app->user->id):?>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <a href="<?=\yii\helpers\Url::to(['daily/edit','id'=>$task['id']])?>" class="am-btn am-btn-primary am-btn-sm"><span class="am-icon-pencil-square-o"></span> 修改日志</a>
                                </div>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>

                </div>

            </div>

        </div>