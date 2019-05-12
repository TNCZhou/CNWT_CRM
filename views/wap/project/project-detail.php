<?php
echo $this->render('../header',[
    'title' => '项目详情'
]);
?>
    <link href="assets/css/project.css" rel="stylesheet"/>
    <script src="assets/validform/js/validform_min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/validform/css/validform.css">
<body>
<div class="title">项目基本信息</div>
<div class="mui-card detail-card">
    <div class="mui-input-group input-group list-group">
        <div class="mui-input-row">
            <label>项目名称</label>
            <div class="readonly-input"><?=$project->name?></div>
        </div>
        <div class="mui-input-row">
            <label>客户名称</label>
            <div class="readonly-input"><a href="<?=\yii\helpers\Url::to(['customer/detail','id'=>$project->customer->id])?>" class="href-a"><?=$project->customer->name?></a></div>
        </div>
        <div class="mui-input-row">
            <label>对接人</label>
            <div class="readonly-input"><?=$project->customer_incharge?></div>
        </div>
        <div class="mui-input-row">
            <label>预估案值</label>
            <div class="readonly-input"><?=$project->plan_price?>元</div>
        </div>
        <div class="mui-input-row">
            <label>预估周期</label>
            <div class="readonly-input"><?=$project->plan_start_date?> 至 <?=$project->plan_end_date?></div>
        </div>
        <div class="mui-input-row">
            <label>项目进度</label>
            <div class="readonly-input"><?=$project->progressText?></div>
        </div>
    </div>
</div>

<form method="post" class="validform" action="<?=\yii\helpers\Url::to(['project/edit','id' => $project->id])?>">
    <input type="hidden" name="id" value="<?=$project->id?>">
    <div class="mui-card detail-card">
        <div class="mui-input-group input-group">
            <div class="mui-input-row">
                <label>项目负责人</label>
                <select name="project_incharge">
                    <?php foreach($userList as $k=>$v):?>
                        <option value="<?=$v->id?>" <?php if($v->id == $project->project_incharge):?>selected<?php endif;?> ><?=$v->realname?></option>
                    <?php endforeach;?>
                </select>
                <span class="mui-icon mui-icon-arrowdown"></span>
            </div>
            <div class="mui-input-row">
                <label>项目参与人</label>
                <select name="project_participants[]" multiple>
                    <?php $pplist = explode(',', $project->project_participants);?>
                    <?php foreach($userList as $k=>$v):?>
                        <option value="<?=$v->id?>" <?php if(in_array($v->id,$pplist)):?>selected<?php endif?>><?=$v->realname?></option>
                    <?php endforeach;?>
                </select>
                <span class="mui-icon mui-icon-arrowdown"></span>
            </div>
            <div class="mui-input-row has-units">
                <label>实际产值</label>
                <input type="number" name="real_price" value="<?=$project->real_price?>" autocomplete="off" placeholder="请填写实际产值" datatype="*" nullmsg="请填写实际产值" />
                <span class="mui-input-units">元</span>
            </div>
            <div class="mui-input-row">
                <label>实际周期</label>
                <div class="readonly-input cycle-date">
                    <a class="date" id="start-date"><?=$project->real_start_date ? $project->real_start_date:"开始时间"?></a>
                    <span>至</span>
                    <a class="date mui-text-right" id="end-date"><?=$project->real_start_date ? $project->real_end_date:"结束时间"?></a>
                    <input type="hidden" name="real_start_date" value="<?=$project->real_start_date?>" datatype="*" nullmsg="请选择预估周期开始时间" />
                    <input type="hidden" name="real_end_date" value="<?=$project->real_end_date?>" datatype="*" nullmsg="请选择预估周期结束时间" />
                </div>
            </div>
            <div class="padding-vertical mui-text-center">
                <button type="submit" class="mui-btn mui-btn-primary btn-mini">更新</button>
            </div>
        </div>
    </div>
</form>

<div class="title">
    项目进度详情
    <a class="mui-btn mui-btn-primary" href="#add-progress">新增项目进度</a>
</div>
<div class="mui-card detail-card">
    <div class="progress-list">
        <?php foreach($project->progressList as $k=>$v):?>
        <div class="progress-item mui-row">
            <div class="mui-col-sm-3 mui-col-xs-4 mui-text-right progress-time"><?=$v->dateline?></div>
            <div class="mui-col-sm-9 mui-col-xs-8 progress-point">
                <div class="progress-title">
                    <?=$v->progressText?>
                </div>
                <div class="progress-info">
                    <div class="progress-info-text"><?=$v->description?></div>
                    <div class="progress-info-tip">负责人：<?=$v->user->realname?><br />记录时间：<?=date('Y-m-d', $v->created_at)?></div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>

<div class="mui-popover mui-popover-action mui-popover-middle" id="add-progress">
    <form method="post" class="validform-pop" action="<?=\yii\helpers\Url::to(['project/progress-add'])?>">
        <input type="hidden" name="project_id" value="<?=$project->id?>">
        <div class="popover-dialog">
            <div class="popover-hd">新增项目进度</div>
            <div class="mui-input-group input-group">
                <div class="mui-input-row has-units">
                    <label>项目阶段</label>
                    <select name="progress" datatype="*" nullmsg="请选择项目阶段">
                        <option value="">请选择项目阶段</option>
                        <?php foreach (\Yii::$app->params['project_progress'] as $k=>$v):?>
                            <option value="<?=$k?>"><?=$v?></option>
                        <?php endforeach;?>
                    </select>
                    <span class="mui-icon mui-icon-arrowdown"></span>
                </div>
                <div class="mui-input-row">
                    <label>跟进日期</label>
                    <div class="readonly-input" id="date">跟进日期</div>
                    <input type="hidden" name="dateline" value="" datatype="*" nullmsg="请选择跟进日期" />
                </div>
                <div class="mui-input-row">
                    <label>详情</label>
                    <textarea name="description" class="" rows="5" placeholder="添加详情"></textarea>
                </div>
            </div>
            <div class="mui-popup-buttons">
                <a class="mui-popup-button" href="#add-progress">取消</a>
                <button type="submit" class="mui-popup-button">确定</button>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript" src="assets/mui/js/mui.picker.min.js"></script>
<link href="assets/mui/css/mui.picker.min.css" rel="stylesheet"/>
<script>
    mui.ready(function () {
        var limit = '';
        mui('body').on('tap','#start-date',function(){
            var dtPicker = new mui.DtPicker({
                type: "date"
            });
            dtPicker.show(function (res) {
                limit = res.y.value+'/'+res.m.value+'/'+res.d.value;
                $('#start-date').html(res.value);
                $('input[name=real_start_date]').val(res.value);
                if($('input[name=real_end_date]').val()!=''){
                    $('#end-date').html(res.value);
                    $('input[name=real_end_date]').val(res.value);
                }
            })
        });
        mui('body').on('tap','#end-date',function(){
            if($('input[name=real_start_date]').val()==''){
                mui.toast('请先选择开始时间');
            }else{
                var dtPicker = new mui.DtPicker({
                    type: "date",
                    beginDate: new Date(limit)
                });
                dtPicker.show(function (res) {
                    $('#end-date').html(res.value);
                    $('input[name=real_end_date]').val(res.value);
                })
            }
        });
        mui('body').on('tap','#date',function(){
            var dtPicker = new mui.DtPicker({
                type: "date"
            });
            dtPicker.show(function (res) {
                $('#date').html(res.value);
                $('input[name=dateline]').val(res.value);
            })
        });

        $(".validform").Validform({
            tiptype:'wap',
            ajaxPost: true,
            callback:function(data){
                if(data.code == 200) {
                    location.reload()
                }else{
                    alert(data.msg)
                }
            }
        });

        $(".validform-pop").Validform({
            tiptype:'wap',
            ajaxPost: true,
            callback:function(data){
                if(data.code == 200) {
                    location.reload()
                }else{
                    alert(data.msg)
                }
            }
        });

    })
</script>
</body>
</html>