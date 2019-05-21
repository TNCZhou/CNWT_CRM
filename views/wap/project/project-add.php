<?php
echo $this->render('../header',[
'title' => '添加项目'
]);
?>
<script src="assets/validform/js/validform_min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/validform/css/validform.css">
<body>
<form method="post" class="validform" action="<?=\yii\helpers\Url::to(['project/add'])?>">
    <div class="mui-input-group input-group margin-vertical-sm">
        <div class="mui-input-row">
            <label>项目名称</label>
            <input type="text" name="name" autocomplete="off" placeholder="请输入项目名称" value="" datatype="*" nullmsg="请输入项目名称" />
        </div>
        <div class="mui-input-row has-units">
            <label>客户名称</label>
            <div class="readonly-input select" id="customers">请选择客户</div>
            <span class="mui-input-units mui-icon mui-icon-arrowdown"></span>
            <input type="hidden" name="customer_id" value="" datatype="*" nullmsg="请选择客户" />
        </div>
        <div class="mui-input-row">
            <label>对接人</label>
            <input type="text" name="customer_incharge" autocomplete="off" placeholder="请填写对接人" value="" datatype="*" nullmsg="请填写对接人" />
        </div>
        <div class="mui-input-row has-units">
            <label>预估案值</label>
            <input type="number" name="plan_price" autocomplete="off" placeholder="请填写预估案值" value="" datatype="*" nullmsg="请填写预估案值" />
            <span class="mui-input-units">元</span>
        </div>
        <div class="mui-input-row">
            <label>预估周期</label>
            <div class="readonly-input cycle-date">
                <a class="date" id="start-date">开始时间</a>
                <span>至</span>
                <a class="date mui-text-right" id="end-date">结束时间</a>
                <input type="hidden" name="plan_start_date" value="" datatype="*" nullmsg="请选择预估周期开始时间" />
                <input type="hidden" name="plan_end_date" value="" datatype="*" nullmsg="请选择预估周期结束时间" />
            </div>
        </div>
        <div class="mui-input-row">
            <label>项目负责人</label>
            <select name="project_incharge">
                <?php foreach($userList as $k=>$v):?>
                    <option value="<?=$v->id?>" <?php if($v->id == \Yii::$app->user->id):?>selected<?php endif;?> ><?=$v->realname?></option>
                <?php endforeach;?>
            </select>
            <span class="mui-icon mui-icon-arrowdown"></span>
        </div>
        <div class="mui-input-row">
            <label>项目参与人</label>
            <select name="project_participants[]" multiple>
                <?php foreach($userList as $k=>$v):?>
                    <option value="<?=$v->id?>"><?=$v->realname?></option>
                <?php endforeach;?>
            </select>
            <span class="mui-icon mui-icon-arrowdown"></span>
        </div>
    </div>

    <div class="pagination">
        <button class="mui-btn mui-btn-primary btn-block" type="submit">提 交</button>
    </div>
</form>
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
                $('input[name=plan_start_date]').val(res.value);
                if($('input[name=plan_end_date]').val()!=''){
                    $('#end-date').html(res.value);
                    $('input[name=plan_end_date]').val(res.value);
                }
            })
        });
        mui('body').on('tap','#end-date',function(){
            if($('input[name=plan_start_date]').val()==''){
                mui.toast('请先选择开始时间');
            }else{
                var dtPicker = new mui.DtPicker({
                    type: "date",
                    beginDate: new Date(limit)
                });
                dtPicker.show(function (res) {
                    $('#end-date').html(res.value);
                    $('input[name=plan_end_date]').val(res.value);
                })
            }
        });

        var picker = new mui.PopPicker();
        <?php $ccc=[];?>
        <?php foreach ($customerList as $k=>$v):?>
        <?php $ccc[] = [
                'value' => $v->id,
                'text' => $v->name
            ];?>
        <?php endforeach;?>
        picker.setData(<?=json_encode($ccc)?>);
        mui('body').on('tap','#customers',function(){
            var _this = $(this);
            picker.show(function(res) {
                _this.html(res[0].text).addClass('fc_black');
                $('input[name=customer_id]').val(res[0].value);
            })
        });

        $(".validform").Validform({
            tiptype:'wap',
        });
    })
</script>

</body>
</html>