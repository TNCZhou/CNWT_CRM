<style>
    /*#partnerlist { position: absolute; width: 100%; left: 0; top: 38px; padding: 0 1.5rem; z-index: 100; }*/
    #partnerlist ul{ border:1px solid #ccc; box-shadow:1px 1px 3px #ededed; background-color: #fff;}
    #partnerlist li{ padding:5px; font-weight:normal; cursor:pointer; text-align: left;}
    #partnerlist li:hover{ background:#f0f0f0; color:#f60;}
</style>
        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                人事详情
            </div>
            <div class="tpl-portlet-components">

                <div class="tpl-block">
                    <div class="portlet-title">
                        <div class="caption bold">
                            个人信息
                        </div>
                        <div class="tpl-portlet-input tpl-fz-ml" style="float: none;">
                            <a href="<?=\yii\helpers\Url::to(['customer/person-edit','id'=>$person->id])?>" class="am-btn am-btn-primary am-btn-sm"><span class="am-icon-pencil-square-o"></span> 修改个人信息</a>
                        </div>
                    </div>

                    <div class="am-g tpl-amazeui-form">

                        <div class="am-u-sm-12 am-u-md-10 am-text-sm">
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">姓名：</div>
                                <div class="am-u-sm-9"><?=$person->name?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">性别：</div>
                                <div class="am-u-sm-9"><?=$person->genderText?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">科室：</div>
                                <div class="am-u-sm-9"><?=$person->department?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">职务：</div>
                                <div class="am-u-sm-9"><?=$person->position?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">电话：</div>
                                <div class="am-u-sm-9"><?=$person->tel?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">QQ：</div>
                                <div class="am-u-sm-9"><?=$person->qq?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">微信号：</div>
                                <div class="am-u-sm-9"><?=$person->wechat?></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="tpl-portlet-components">

                <div class="tpl-block">
                    <div class="portlet-title">
                        <div class="caption bold">
                            任职经历
                        </div>
                        <div class="tpl-portlet-input tpl-fz-ml" style="float: none;">
                            <button type="button" id="exp-add" class="am-btn am-btn-primary am-btn-sm"><span class="am-icon-plus"></span> 新增任职经历</button>
                        </div>
                    </div>
                    <?php foreach($person->experiences as $k=>$v):?>
                    <div class="am-g am-padding-vertical-sm">
                        <div class="am-u-sm-12 am-u-md-10 am-text-sm">
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">单位：</div>
                                <div class="am-u-sm-9"><?=$v->theCompany->name?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">部门：</div>
                                <div class="am-u-sm-9"><?=$v->department?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">职务：</div>
                                <div class="am-u-sm-9"><?=$v->position?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">入职时间：</div>
                                <div class="am-u-sm-9"><?=date('Y-m-d', $v->start_date)?> 至 <?=$v->end_date?date('Y-m-d',$v->end_date):'今'?></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php endforeach;?>
                </div>

            </div>

            <div class="tpl-portlet-components">

                <div class="tpl-block">
                    <div class="portlet-title">
                        <div class="caption bold">
                            个人信息
                        </div>
                        <div class="tpl-portlet-input tpl-fz-ml" style="float: none;">
                            <button type="button" id="info-add" class="am-btn am-btn-primary am-btn-sm"><span class="am-icon-plus"></span> 新增个人信息</button>
                        </div>
                    </div>

                    <div class="am-g">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th class="">序号</th>
                                <th class="">详情</th>
                                <th class="">记录人</th>
                                <th class="">时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($person->manyInfo as $k=>$v):?>
                            <tr>
                                <td><?=$v->id?></td>
                                <td><?=$v->info?></td>
                                <td><?=$v->user->realname?></td>
                                <td><?=date('Y-m-d', $v->created_at)?></td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="am-modal am-modal-no-btn" tabindex="-1" id="exp-prompt">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">新增任职经历</div>
            <div class="am-modal-bd">
                <form action="<?=\yii\helpers\Url::to(['customer/person-experience-add'])?>" class="am-form am-form-horizontal am-text-sm am-padding-top" id="edit-exp">
                    <input type="hidden" name="person_id" value="<?=$person->id?>" />
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">单位</label>
                        <div class="am-u-sm-9">
                            <input type="hidden" name="company" id="partnerid" value="" class="am-form-field" datatype="*" nullmsg="请选择单位" errormsg="请选择单位" />
                            <input type="text" name="partnername" id="partnername" value="" class="am-form-field" onKeyUp="ajaxShop(this);" autocomplete="off"/>
                            <b id="partnerlist">

                            </b>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">部门</label>
                        <div class="am-u-sm-9">
                            <input name="department" type="text" class="am-form-field am-radius" placeholder="部门" autocomplete="off" datatype="*" nullmsg="请填写部门" errormsg="请填写部门">
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">职务</label>
                        <div class="am-u-sm-9">
                            <input name="position" type="text" class="am-form-field am-radius" placeholder="职务" autocomplete="off" datatype="*" nullmsg="请填写职务" errormsg="请填写职务">
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">在职时间</label>
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
                    <div class="am-cf am-padding-vertical-sm">
                        <div class="am-u-sm-6">
                            <button type="button" class="am-btn am-btn-block" data-am-modal-close>取消</button>
                        </div>
                        <div class="am-u-sm-6">
                            <button type="submit" class="am-btn am-btn-danger am-btn-block">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-prompt" tabindex="-1" id="info-prompt">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">新增个人信息</div>
            <div class="am-modal-bd">
                <form action="<?=\yii\helpers\Url::to(['customer/person-info-add'])?>" class="am-form am-form-horizontal am-text-sm am-padding-top" id="info-form">
                    <input type="hidden" name="person_id" value="<?=$person->id?>" />
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">个人信息</label>
                        <div class="am-u-sm-9">
                            <textarea name='info' class="am-form-field am-radius" placeholder="请输入客户兴趣爱好，个人情况等信息" datatype="*" nullmsg="请填写个人信息" errormsg="请填写个人信息" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="am-cf am-padding-vertical-sm">
                        <div class="am-u-sm-6">
                            <button type="button" class="am-btn am-btn-block" data-am-modal-close>取消</button>
                        </div>
                        <div class="am-u-sm-6">
                            <button type="submit" class="am-btn am-btn-danger am-btn-block">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--datetimepicker-->
    <link rel="stylesheet" href="assets/datetimepicker/css/amazeui.datetimepicker.css" />
    <script src="assets/datetimepicker/js/amazeui.datetimepicker.min.js" type="text/javascript"></script>
    <script src="assets/datetimepicker/js/amazeui.datetimepicker.zh-CN.js" type="text/javascript" charset="UTF-8"></script>
    <script>
        function ajaxShop(obj) {
            var words = $(obj).val();
            $.ajax({
                type: 'GET',
                url: "<?=\yii\helpers\Url::to(['customer/company-list'])?>&word=" + words + "&rand=" + Math.random(),
                dataType: 'json',
                success: function (result) {
                    if(result.code == 200) {
                        let str = '<ul>';
                        result.data.list.map(function (v) {
                            str += '<li onclick="$(\'#partnerid\').val(\''+v.id+'\');$(\'#partnername\').val(\''+v.name+'\');$(this).parent().hide();">'+v.name+'</li>';
                        });
                        str += '</ul>';
                        $('#partnerlist').html(str);
                    }
                }
            });
        }

        $(function(){
            $('#info-add').on('click', function() {
                $('#info-prompt').modal();
            });
            $("#edit-exp").Validform({
                tiptype:'wap',
                ajaxPost: true,
                callback:function(data){
                    if(data.code == 200) {
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                }
            });

            $('#exp-add').on('click', function() {
                $('#exp-prompt').modal();
            });
            $("#info-form").Validform({
                tiptype:'wap',
                ajaxPost: true,
                callback:function(data){
                    if(data.code == 200) {
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                }
            });

            $('#start-date').datetimepicker({
                language: 'zh-CN',
                format: 'yyyy-mm-dd',
                autoclose: true,
                minView: 2,
                endDate: new Date(),
            }).on('changeDate', function(ev){
                $('#end-date').datetimepicker('setStartDate', ev.date);
            });
            $('#end-date').datetimepicker({
                language: 'zh-CN',
                format: 'yyyy-mm-dd',
                autoclose: true,
                minView: 2,
                endDate: new Date(),
            }).on('changeDate', function(ev){
                $('#start-date').datetimepicker('setEndDate', ev.date);
            });
        });
    </script>