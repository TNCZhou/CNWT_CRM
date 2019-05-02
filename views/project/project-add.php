    <style>
        .am-selected-status { font-size: 1.4rem;}
        .tpl-portlet-components { overflow: visible;}
        .am-selected-search input.am-form-field { padding: 0.5em; border: 1px solid #ccc;}
        .am-selected-list { font-size: 1.4rem;}
    </style>
    <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            创建项目
        </div>
        <div class="tpl-portlet-components">

            <div class="tpl-block">

                <div class="am-g tpl-amazeui-form">

                    <div class="am-u-sm-12 am-u-md-10">
                        <form action="<?=\yii\helpers\Url::to(['project/add'])?>" class="am-form am-form-horizontal validform" method="post">
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">项目名称</label>
                                <div class="am-u-sm-9">
                                    <input name="name" type="text" class="am-form-field am-radius" placeholder="项目名称" autocomplete="off" datatype="*" nullmsg="请填写项目名称" errormsg="请填写项目名称">
                                    <small class="Validform_checktip"></small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">客户名称</label>
                                <div class="am-u-sm-9">
                                    <select name="customer_id" data-am-selected="{searchBox: 1,btnWidth: '100%'}">
                                        <?php foreach($customerList as $k=>$v):?>
                                        <option value="<?=$v->id?>"><?=$v->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <small class="Validform_checktip"></small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">对接人</label>
                                <div class="am-u-sm-9">
                                    <input name="customer_incharge"type="text" class="am-form-field am-radius" placeholder="对接人" autocomplete="off" datatype="*" nullmsg="请填写对接人" errormsg="请填写对接人">
                                    <small class="Validform_checktip"></small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">预估案值</label>
                                <div class="am-u-sm-9">
                                    <div class="am-input-group">
                                        <input name="plan_price" type="number" class="am-form-field" placeholder="预估案值" autocomplete="off" datatype="n" nullmsg="请填写预估案值" errormsg="请填写预估案值">
                                        <span class="am-input-group-label">元</span>
                                    </div>
                                    <small class="Validform_checktip"></small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">预估周期</label>
                                <div class="am-u-sm-9 am-g-collapse">
                                    <div class="am-u-sm-5">
                                        <input name="start_date" type="text" class="am-form-field am-radius" id="start-date" placeholder="预估开始时间" readonly="readonly" autocomplete="off">
                                    </div>
                                    <div class="am-u-sm-2 am-text-center am-text-sm am-padding-top-xs">至</div>
                                    <div class="am-u-sm-5">
                                        <input name="end_date" type="text" class="am-form-field am-radius" id="end-date" placeholder="预估结束时间" readonly="readonly" autocomplete="off">
                                    </div>
                                    <small class="Validform_checktip am-text-danger" id="date-alert"></small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">项目负责人</label>
                                <div class="am-u-sm-9">
                                    <select name="project_incharge" data-am-selected="{searchBox: 1,btnWidth: '100%'}">
                                        <?php foreach($userList as $k=>$v):?>
                                            <option value="<?=$v->id?>" <?php if($v->id == \Yii::$app->user->id):?>selected<?php endif;?> ><?=$v->realname?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <small class="Validform_checktip"></small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">项目参与人</label>
                                <div class="am-u-sm-9">
                                    <select name="project_participants[]" multiple data-am-selected="{searchBox: 1,btnWidth: '100%'}">
                                        <?php foreach($userList as $k=>$v):?>
                                            <option value="<?=$v->id?>"><?=$v->realname?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <small class="Validform_checktip"></small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>


    </div>
<!--datetimepicker-->
<link rel="stylesheet" href="assets/datetimepicker/css/amazeui.datetimepicker.css" />
<script src="assets/datetimepicker/js/amazeui.datetimepicker.min.js" type="text/javascript"></script>
<script src="assets/datetimepicker/js/amazeui.datetimepicker.zh-CN.js" type="text/javascript" charset="UTF-8"></script>
<script>
    $(function(){
        $('#start-date').datetimepicker({
            language: 'zh-CN',
            format: 'yyyy-mm-dd',
            autoclose: true,
            minView: 2
        }).on('changeDate', function(ev){
            $('#end-date').datetimepicker('setStartDate', ev.date);
        });
        $('#end-date').datetimepicker({
            language: 'zh-CN',
            format: 'yyyy-mm-dd',
            autoclose: true,
            minView: 2
        }).on('changeDate', function(ev){
            $('#start-date').datetimepicker('setEndDate', ev.date);
        });

        $(".validform").Validform({
            tiptype: function (msg, o, cssctl) {
                if (!o.obj.is("form")) {
                    var objtip = o.obj.parents(".am-form-group").find(".Validform_checktip");
                    cssctl(objtip, o.type);
                    objtip.text(msg);
                }
            },
            showAllError: true,
        });
    });
</script>