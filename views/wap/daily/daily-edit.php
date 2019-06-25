<?php
echo $this->render('../header',[
    'title' => '编辑日志'
]);
?>
<link href="assets/css/daily.css" rel="stylesheet"/>
<script src="assets/validform/js/validform_min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/validform/css/validform.css">
<body>
<form method="post" class="validform" action="<?=\yii\helpers\Url::to(['daily/edit'])?>">
    <?php if($task):?>
        <input type="hidden" name="id" value="<?=$task['id']?>" />
    <?php endif;?>
    <div class="mui-input-group input-group margin-vertical-sm">
        <div class="mui-input-row">
            <label>工作任务</label>
            <input type="text" name="content" autocomplete="off" placeholder="请输入工作任务" value="<?=$task['content']?>" datatype="*" nullmsg="请输入工作任务" />
        </div>
        <div class="mui-input-row has-units">
            <label>工作类别</label>
            <input type="text" name="type" autocomplete="off" placeholder="请输入工作类别" value="<?=$task['type']?>" datatype="*" nullmsg="请输入工作类别" />
        </div>
    </div>

    <div id="item-wrap">
        <?php if($task->records): ?>
            <?php foreach(array_values($task->records) as $k=>$v): ?>
                <div class="mui-input-group input-group margin-vertical-sm">
                    <input type="hidden" name="records[<?=$k?>][id]" value="<?=$v['id']?>" />
                    <div class="mui-input-row has-units">
                        <label>工作结果</label>
                        <div class="readonly-input select select-result"><?=$results[$v['result']]?></div>
                        <span class="mui-input-units mui-icon mui-icon-arrowdown"></span>
                        <input type="hidden" name="records[<?=$k?>][result]" value="<?=$v['result']?>" datatype="*" nullmsg="请选择工作结果" />
                    </div>
                    <div class="mui-input-row">
                        <label>时间段</label>
                        <div class="readonly-input cycle-date">
                            <a class="date" id="start-date<?=$k?>"><?=date('Y-m-d H:i',$v['start_time'])?></a>
                            <span>至</span>
                            <a class="date mui-text-right" id="end-date<?=$k?>"><?=date('Y-m-d H:i',$v['end_time'])?></a>
                            <input type="hidden" name="records[<?=$k?>][start_time]" value="<?=date('Y-m-d H:i',$v['start_time'])?>" datatype="*" nullmsg="请选择预估开始时间" />
                            <input type="hidden" name="records[<?=$k?>][end_time]" value="<?=date('Y-m-d H:i',$v['end_time'])?>" datatype="*" nullmsg="请选择预估结束时间" />
                        </div>
                    </div>
                    <div class="mui-input-row">
                        <label>情况说明</label>
                        <textarea class="" rows="4" name="records[<?=$k?>][remark]" placeholder="情况说明"><?=$v['remark']?></textarea>
                    </div>
                    <div class="mui-input-row padding-vertical-sm padding-horizontal mui-text-right del-btn-wrap">
                        <a class="del-btn"><span class="mui-icon mui-icon-trash mui-text-danger"></span></a>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
    <div class="mui-text-center padding-horizontal padding-bottom">
        <a id="add-progress" class="add-more-btn"><span class="mui-icon mui-icon-plusempty"></span> 新增进度</a>
    </div>

    <div class="pagination">
        <button class="mui-btn mui-btn-primary btn-block" type="submit">提 交</button>
    </div>
</form>

<div id="progress-more" style="display: none;">
    <div class="mui-input-group input-group margin-vertical-sm">
        <div class="mui-input-row has-units">
            <label>工作结果</label>
            <div class="readonly-input select select-result">请选择工作结果</div>
            <span class="mui-input-units mui-icon mui-icon-arrowdown"></span>
            <input type="hidden" name="records[{{id}}][result]" value="" datatype="*" nullmsg="请选择工作结果" />
        </div>
        <div class="mui-input-row">
            <label>时间段</label>
            <div class="readonly-input cycle-date">
                <a class="date" id="start-date{{id}}">预估开始时间</a>
                <span>至</span>
                <a class="date mui-text-right" id="end-date{{id}}">预估结束时间</a>
                <input type="hidden" name="records[{{id}}][start_time]" value="" datatype="*" nullmsg="请选择预估开始时间" />
                <input type="hidden" name="records[{{id}}][end_time]" value="" datatype="*" nullmsg="请选择预估结束时间" />
            </div>
        </div>
        <div class="mui-input-row">
            <label>情况说明</label>
            <textarea class="" rows="4" name="records[{{id}}][remark]" placeholder="情况说明"></textarea>
        </div>
        <div class="mui-input-row padding-vertical-sm padding-horizontal mui-text-right del-btn-wrap">
            <a class="del-btn"><span class="mui-icon mui-icon-trash mui-text-danger"></span></a>
        </div>
    </div>
</div>

<script type="text/javascript" src="assets/mui/js/mui.picker.min.js"></script>
<link href="assets/mui/css/mui.picker.min.css" rel="stylesheet"/>
<script>
    var appendPanel = function(row) {
        var wrapper = $('#item-wrap');
        var panel = $('#progress-more').html();
        var reg = new RegExp("{{id}}","g");
        panel = panel.replace(reg,row);
        wrapper.append(panel);
    }

    function datepicker(n){
        var limit = '';
        mui('body').on('tap','#start-date'+n,function(){
            var dtPicker = new mui.DtPicker({
                type: "datetime"
            });
            dtPicker.show(function (res) {
                limit = res.y.value+'/'+res.m.value+'/'+res.d.value;
                $('#start-date'+n).html(res.value);
                $('input[name=\'records['+n+'][start_time]\']').val(res.value);
                if($('input[name=\'records['+n+'][end_time]\']').val()!=''){
                    $('#end-date'+n).html(res.value);
                    $('input[name=\'records['+n+'][end_time]\']').val(res.value);
                }
            })
        });
        mui('body').on('tap','#end-date'+n,function(){
            if($('input[name=\'records['+n+'][start_time]\']').val()==''){
                mui.toast('请先选择开始时间');
            }else{
                var dtPicker = new mui.DtPicker({
                    type: "datetime",
                    beginDate: new Date(limit)
                });
                dtPicker.show(function (res) {
                    $('#end-date'+n).html(res.value);
                    $('input[name=\'records['+n+'][end_time]\']').val(res.value);
                })
            }
        });
    }

    mui.ready(function () {
        <?php if(!$task):?>
        var i = 0;
        appendPanel(i);
        <?php else:?>
        var i = <?=count($task->records)?>;
        <?php endif;?>
        for(j=0;j<=i;j++){
            datepicker(j);
        }
        mui('body').on('tap','#add-progress',function(){
            i++;
            appendPanel(i);
            datepicker(i);
        });
        <?php $p=[];?>
        <?php foreach($results as $rk=>$rv):?>
        <?php $p[] = [
        'value' => $rk,
        'text' => $rv
    ];?>
        <?php endforeach;?>
        var resultPicker = new mui.PopPicker();
        resultPicker.setData(<?=json_encode($p)?>);
        mui('body').on('tap','.select-result',function(){
            var _this = $(this);
            resultPicker.show(function(res) {
                _this.html(res[0].text).addClass('fc_black');
                _this.nextAll('input').val(res[0].value);
            })
        });

        $(".validform").Validform({
            tiptype:'wap',
        });

        mui('body').on('tap','.del-btn',function(){
            $(this).parents('.mui-input-group').remove();
            i--;
        });
    })
</script>

</body>
</html>