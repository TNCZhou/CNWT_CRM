
        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                项目信息
            </div>
            <div class="tpl-portlet-components">

                <div class="tpl-block">

                    <div class="am-g tpl-amazeui-form">

                        <div class="am-u-sm-12 am-u-md-10 am-text-sm">
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">项目名称：</div>
                                <div class="am-u-sm-9"><?=$project->name?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">客户名称：</div>
                                <div class="am-u-sm-9"><a href="<?=\yii\helpers\Url::to(['customer/detail','id'=>$project->customer->id])?>"><?=$project->customer->name?></a></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">项目所属：</div>
                                <div class="am-u-sm-9"><?=$project->belongTo?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">对&ensp;接&ensp;人：</div>
                                <div class="am-u-sm-9"><?=$project->customer_incharge?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">预估案值：</div>
                                <div class="am-u-sm-9"><?=$project->plan_price?>万元</div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">预估周期：</div>
                                <div class="am-u-sm-9"><?=$project->plan_start_date?> 至 <?=$project->plan_end_date?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">项目进度：</div>
                                <div class="am-u-sm-9"><?=$project->progressText?></div>
                            </div>
                            <hr>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">实际产值：</div>
                                <div class="am-u-sm-9"><?=$project->real_price?>万元</div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">实际周期：</div>
                                <div class="am-u-sm-9"><?=$project->real_start_date?> 至 <?=$project->real_end_date?></div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <div class="tpl-portlet-components">

                <div class="tpl-block">
                    <div class="portlet-title">
                        <div class="caption bold">
                            项目进度详情
                        </div>

                    </div>

                    <div class="am-g tpl-amazeui-form">
                        <div class="am-u-sm-12 progress-list">
                            <?php foreach($project->progressList as $k=>$v):?>
                            <div class="am-cf progress-item">
                                <div class="am-u-sm-2 am-text-right am-text-sm progress-time"><?=$v->dateline?></div>
                                <div class="am-u-sm-10 progress-point">
                                    <div class="progress-title">
                                        <?=$v->progressText?>
                                    </div>
                                    <div class="progress-info">
                                        <div class="progress-info-text"><?=$v->description?></div>
                                        <div class="progress-info-tip"><span>负责人：<?=$v->user->realname?></span> <span>记录时间：<?=date('Y-m-d', $v->created_at)?></span></div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>

            </div>


        </div>


    <div class="am-modal am-modal-no-btn" tabindex="-1" id="my-prompt">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">修改项目信息</div>
            <div class="am-modal-bd">
                <form action="<?=\yii\helpers\Url::to(['project/edit','id' => $project->id])?>"  method="post" class="am-form am-form-horizontal am-text-sm am-padding-top" id="edit-prompt">
                    <input type="hidden" name="id" value="<?=$project->id?>">
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">项目负责人</label>
                        <div class="am-u-sm-9">
                            <select name="project_incharge" data-am-selected="{searchBox: 1,btnWidth: '100%'}">
                                <?php foreach($userList as $k=>$v):?>
                                    <option value="<?=$v->id?>" <?php if($v->id == $project->project_incharge):?>selected<?php endif;?> ><?=$v->realname?></option>
                                <?php endforeach;?>
                            </select>
                            <small class="Validform_checktip"></small>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">项目参与人</label>
                        <div class="am-u-sm-9">
                            <select name="project_participants[]" multiple data-am-selected="{searchBox: 1,btnWidth: '100%'}">
                                <?php $pplist = explode(',', $project->project_participants);?>
                                <?php foreach($userList as $k=>$v):?>
                                    <option value="<?=$v->id?>" <?php if(in_array($v->id,$pplist)):?>selected<?php endif?>><?=$v->realname?></option>
                                <?php endforeach;?>
                            </select>
                            <small class="Validform_checktip"></small>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">实际产值</label>
                        <div class="am-u-sm-9">
                            <div class="am-input-group">
                                <input name="real_price" value="<?=$project->real_price?>" type="number" class="am-form-field" placeholder="实际产值" autocomplete="off" datatype="*" nullmsg="请输入实际产值" errormsg="请输入实际产值">
                                <span class="am-input-group-label">万元</span>
                            </div>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">实际周期</label>
                        <div class="am-u-sm-9 am-g-collapse">
                            <div class="am-u-sm-5">
                                <input name="real_start_date" value="<?=$project->real_start_date?>" type="text" class="am-form-field am-radius" id="start-date" placeholder="预估开始时间" readonly="readonly" autocomplete="off">
                            </div>
                            <div class="am-u-sm-2 am-text-center am-text-sm am-padding-top-xs">至</div>
                            <div class="am-u-sm-5">
                                <input name="real_end_date" type="text" value="<?=$project->real_end_date?>" class="am-form-field am-radius" id="end-date" placeholder="预估结束时间" readonly="readonly" autocomplete="off">
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

    <div class="am-modal am-modal-prompt" tabindex="-1" id="progress-prompt">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">项目进度跟进</div>
            <div class="am-modal-bd">
                <form action="<?=\yii\helpers\Url::to(['project/progress-add'])?>" class="am-form am-form-horizontal am-text-sm am-padding-top" id="project-progress">
                    <input type="hidden" name="project_id" value="<?=$project->id?>">
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">项目阶段</label>
                        <div class="am-u-sm-9">
                            <select name="progress" class="am-form-field am-radius" datatype="*" nullmsg="请选择项目阶段" errormsg="请选择项目阶段">
                                <option value="">请选择项目阶段</option>
                                <?php foreach (\Yii::$app->params['project_progress'] as $k=>$v):?>
                                    <option value="<?=$k?>"><?=$v?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">跟进日期</label>
                        <div class="am-u-sm-9">
                            <input type="text" name="dateline" class="am-form-field am-radius" placeholder="请选择日期" readonly="readonly" data-am-datepicker autocomplete="off" datatype="*" nullmsg="请选择跟进日期">
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">详情</label>
                        <div class="am-u-sm-9">
                            <textarea name="description" class="am-form-field am-radius" rows="5"></textarea>
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
        $(function(){
            $('#project-edit').on('click', function() {
                $('#my-prompt').modal();
            });
            $("#edit-prompt").Validform({
                tiptype:'wap',
                ajaxPost: true,
                callback:function(data){
                    if(data.code == 200) {
                        location.reload();
                    }else {
                        alert(data.msg)
                    }
                }
            });


            $('#add-progress').on('click', function() {
                $('#progress-prompt').modal();
            });
            $("#project-progress").Validform({
                tiptype:'wap',
                ajaxPost: true,
                callback:function(data){
                    if(data.code == 200) {
                        location.reload()
                    }else {
                        alert(data.msg)
                    }
                }
            });

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
        });
    </script>