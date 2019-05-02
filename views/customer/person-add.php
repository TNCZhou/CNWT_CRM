
        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                新增人事信息
            </div>
            <div class="tpl-portlet-components">

                <div class="tpl-block">

                    <div class="am-g tpl-amazeui-form">

                        <div class="am-u-sm-12 am-u-md-10">
                            <form action="<?=\yii\helpers\Url::to(['customer/person-add'])?>" class="am-form am-form-horizontal validform" method="post">
                                <input type="hidden" name="customer_id" value="<?=$customerId?>" />
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">姓名</label>
                                    <div class="am-u-sm-9">
                                        <input name="name" type="text" class="am-form-field am-radius" placeholder="姓名" autocomplete="off" datatype="*" nullmsg="请填写姓名" errormsg="请填写姓名">
                                        <small class="Validform_checktip"></small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">性别</label>
                                    <div class="am-u-sm-9">
                                        <div class="am-cf">
                                            <?php foreach($gender as $k=>$v):?>
                                            <label class="am-radio-inline">
                                                <input value="<?=$k?>" name="gender" type="radio" datatype="*" nullmsg="请选择性别" errormsg="请选择性别"> <?=$v?></label>
                                            <?php endforeach;?>
                                        </div>
                                        <small class="Validform_checktip"></small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">科室</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="department" class="am-form-field am-radius" placeholder="科室" autocomplete="off" datatype="*" nullmsg="请填写科室" errormsg="请填写科室">
                                        <small class="Validform_checktip"></small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">职务</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="position" class="am-form-field am-radius" placeholder="职务" autocomplete="off" datatype="*" nullmsg="请填写职务" errormsg="请填写职务">
                                        <small class="Validform_checktip"></small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">电话</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="tel" class="am-form-field am-radius" placeholder="电话" autocomplete="off" datatype="m | tel" nullmsg="请填写电话" errormsg="请填写电话">
                                        <small class="Validform_checktip"></small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">QQ</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="qq" class="am-form-field am-radius" placeholder="QQ" autocomplete="off" datatype="qq" nullmsg="请填写QQ" errormsg="请填写QQ">
                                        <small class="Validform_checktip"></small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">微信</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="wechat" class="am-form-field am-radius" placeholder="微信" autocomplete="off" datatype="*" nullmsg="请填写微信" errormsg="请填写微信">
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
    <script>
        $(function(){

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