        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                编辑客户
            </div>
            <div class="tpl-portlet-components">

                <div class="tpl-block">

                    <div class="am-g tpl-amazeui-form">

                        <div class="am-u-sm-12 am-u-md-10">
                            <form action="<?=\yii\helpers\Url::to(['customer/edit'])?>" method="post" class="am-form am-form-horizontal validform">
                                <input type="hidden" name="id" value="<?=$customer->id?>" />
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">类型</label>
                                    <div class="am-u-sm-9 am-form-text">
                                        <?=$customer->typeText?>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">单位名称</label>
                                    <div class="am-u-sm-9 am-form-text">
                                        <?=$customer->name?>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">简称</label>
                                    <div class="am-u-sm-9 am-form-text">
                                        <?=$customer->description?>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">地址</label>
                                    <div class="am-u-sm-9">
                                        <input name="address" value="<?=$customer->address?>" type="text" class="am-form-field am-radius" placeholder="地址" autocomplete="off" datatype="*" nullmsg="请填写地址" errormsg="请填写地址">
                                        <small class="Validform_checktip"></small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">星级</label>
                                    <div class="am-u-sm-9">
                                        <select name="star" class="am-form-field am-radius" datatype="*" nullmsg="请选择星级" errormsg="请选择星级">
                                            <option>请选择星级</option>
                                            <?php foreach ($customerStar as $k=>$v):?>
                                            <option value="<?=$k?>" <?php if($k == $customer->star):?>selected<?php endif?>><?=$v?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <small class="Validform_checktip"></small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="submit" class="am-btn am-btn-primary">保存</button>
                                        <button type="reset" class="am-btn">重置</button>
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