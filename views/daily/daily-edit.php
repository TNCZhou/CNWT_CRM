
<style>
.part { position: relative;}
.part:last-child:before { content: ''; display: block; width: 15px; height: 100%; position: absolute; right: -15px; top: 0; border: 1px solid #eee; border-left: none; z-index: 1;}
.part:last-child .del-btn { display: block; position: absolute; right: -26px; top: 50%; z-index: 2; font-size: 30px; line-height: 1; margin-top: -15px; background-color: #fff; color: #dd514c;}
.part:last-child .del-btn:before { content: "\f014"; font-family: "FontAwesome"; display: inline-block;}
.part:first-child:before, .part:first-child .del-btn { display: none;}
</style>
        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                填写工作日志
            </div>
            <div class="tpl-portlet-components">

                <div class="tpl-block">

                    <div class="am-g tpl-amazeui-form">

                        <div class="am-u-sm-12 am-u-md-10">
                            <form class="am-form am-form-horizontal validform" action="<?=\yii\helpers\Url::to(['daily/edit'])?>" method="post">
                                <?php if($task):?>
                                <input type="hidden" name="id" value="<?=$task['id']?>" />
                                <?php endif;?>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">工作任务</label>
                                    <div class="am-u-sm-9">
                                        <textarea name="content" class="am-form-field am-radius" placeholder="工作任务" autocomplete="off" datatype="*" nullmsg="请填写工作任务" errormsg="请填写工作任务" rows="5"><?=$task['content']?></textarea>
                                        <small class="Validform_checktip"></small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">工作类别</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" value="<?=$task['type']?>" name="type" class="am-form-field am-radius" datatype="*" nullmsg="请填写工作类别" errormsg="请填写工作类别" />
                                        <small class="Validform_checktip"></small>
                                    </div>
                                </div>

                                <div id="item-wrap">
                                    <?php if($task->records): ?>
                                    <?php foreach(array_values($task->records) as $k=>$v): ?>
                                        <div class="part">
                                    <input type="hidden" name="records[<?=$k?>][id]" value="<?=$v['id']?>" />
                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">工作结果</label>
                                        <div class="am-u-sm-9">
                                            <select class="am-form-field am-radius" name="records[<?=$k?>][result]" datatype="*" nullmsg="请选择工作结果" errormsg="请选择工作结果">
                                                <option value="">请选择工作结果</option>
                                                <?php foreach($results as $rk=>$rv):?>
                                                    <option value="<?=$rk?>" <?php if($rk==$v['result']):?>selected<?php endif;?>><?=$rv?></option>
                                                <?php endforeach;?>
                                            </select>
                                            <small class="Validform_checktip"></small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">时间段</label>
                                        <div class="am-u-sm-9 am-g-collapse">
                                            <div class="am-u-sm-5">
                                                <input type="text" name="records[<?=$k?>][start_time]" class="am-form-field am-radius" id="start-date<?=$k?>" placeholder="预估开始时间" readonly="readonly" autocomplete="off" value="<?=date('Y-m-d H:i',$v['start_time'])?>">
                                            </div>
                                            <div class="am-u-sm-2 am-text-center am-text-sm am-padding-top-xs">至</div>
                                            <div class="am-u-sm-5">
                                                <input type="text" name="records[<?=$k?>][end_time]" class="am-form-field am-radius" id="end-date<?=$k?>" placeholder="预估结束时间" readonly="readonly" autocomplete="off" value="<?=date('Y-m-d H:i',$v['end_time'])?>">
                                            </div>
                                            <small class="Validform_checktip am-text-danger" id="date-alert<?=$k?>"></small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">情况说明</label>
                                        <div class="am-u-sm-9">
                                            <textarea class="am-form-field am-radius" name="records[<?=$k?>][remark]" placeholder="情况说明" autocomplete="off" rows="5"><?=$v['remark']?></textarea>
                                            <small class="Validform_checktip"></small>
                                        </div>
                                    </div>
                                            <a href="javascript:void(0);" class="del-btn"></a>
                                        </div>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </div>

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="button" class="am-btn am-btn-secondary am-btn-sm" id="add-progress"><span class="am-icon-plus"></span> 新增进度</button>
                                        <a href="<?=\yii\helpers\Url::to(['daily/edit'])?>" target="_blank" class="am-btn am-btn-primary am-btn-sm am-margin-left" id="add-mission"><span class="am-icon-sitemap"></span> 新增任务</a>
                                    </div>
                                </div>

                                <hr>
                                <div class="am-form-group am-margin-top-xl">
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
        <div id="progress-more" style="display: none;">
			<div class="part">
                <div class="am-form-group">
                    <label class="am-u-sm-3 am-form-label">工作结果</label>
                    <div class="am-u-sm-9">
                        <select class="am-form-field am-radius" name="records[{{id}}][result]" datatype="*" nullmsg="请选择工作结果" errormsg="请选择工作结果">
                            <option value="">请选择工作结果</option>
                            <?php foreach($results as $k=>$v):?>
                            <option value="<?=$k?>"><?=$v?></option>
                            <?php endforeach;?>
                        </select>
                        <small class="Validform_checktip"></small>
                    </div>
                </div>

                <div class="am-form-group">
                    <label class="am-u-sm-3 am-form-label">时间段</label>
                    <div class="am-u-sm-9 am-g-collapse">
                        <div class="am-u-sm-5">
                            <input type="text" name="records[{{id}}][start_time]" class="am-form-field am-radius" id="start-date{{id}}" placeholder="预估开始时间" readonly="readonly" autocomplete="off">
                        </div>
                        <div class="am-u-sm-2 am-text-center am-text-sm am-padding-top-xs">至</div>
                        <div class="am-u-sm-5">
                            <input type="text" name="records[{{id}}][end_time]" class="am-form-field am-radius" id="end-date{{id}}" placeholder="预估结束时间" readonly="readonly" autocomplete="off">
                        </div>
                        <small class="Validform_checktip am-text-danger" id="date-alert{{id}}"></small>
                    </div>
                </div>

                <div class="am-form-group">
                    <label class="am-u-sm-3 am-form-label">情况说明</label>
                    <div class="am-u-sm-9">
                        <textarea class="am-form-field am-radius" name="records[{{id}}][remark]" placeholder="情况说明" autocomplete="off" rows="5"></textarea>
                        <small class="Validform_checktip"></small>
                    </div>
                </div>
                <a href="javascript:void(0);" class="del-btn"></a>
			</div>
        </div>
        <!--datetimepicker-->
        <link rel="stylesheet" href="assets/datetimepicker/css/amazeui.datetimepicker.css" />
        <script src="assets/datetimepicker/js/amazeui.datetimepicker.min.js" type="text/javascript"></script>
        <script src="assets/datetimepicker/js/amazeui.datetimepicker.zh-CN.js" type="text/javascript" charset="UTF-8"></script>
        <script>
            var appendPanel = function(row) {
                var wrapper = $('#item-wrap');
                var panel = $('#progress-more').html();
                var reg = new RegExp("{{id}}","g");
                panel = panel.replace(reg,row);
                wrapper.append(panel);
            }

            function datepicker(n){
                $('#start-date'+n).datetimepicker({
                    language: 'zh-CN',
                    format: 'yyyy-mm-dd hh:ii',
                    autoclose: true
                }).on('changeDate', function(ev){
                    $('#end-date'+n).datetimepicker('setStartDate', ev.date);
                });
                $('#end-date'+n).datetimepicker({
                    language: 'zh-CN',
                    format: 'yyyy-mm-dd hh:ii',
                    autoclose: true
                }).on('changeDate', function(ev){
                    $('#start-date'+n).datetimepicker('setEndDate', ev.date);
                });
            }

            $(function(){
                <?php if(!$task):?>
                var i = 0;
                appendPanel(i);
                <?php else:?>
                var i = <?=count($task->records)?>;
                <?php endif;?>
                for(j=0;j<=i;j++){
                    datepicker(j);
                }
                $('#add-progress').on('click',function(){
                    i++;
                    appendPanel(i);
                    datepicker(i);
                });

                $(".validform").Validform({
                    tiptype: function (msg, o, cssctl) {
                        if (!o.obj.is("form")) {
                            var objtip = o.obj.parents(".am-form-group").find(".Validform_checktip");
                            cssctl(objtip, o.type);
                            objtip.text(msg);
                        }
                    },
//                showAllError: true,
                });

                $('body').on('click','.del-btn',function(){
                    $(this).parent('.part').remove();
                    i--;
                })
            });
        </script>