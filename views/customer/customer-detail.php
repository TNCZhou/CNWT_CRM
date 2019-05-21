
        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                客户详情
            </div>
            <div class="tpl-portlet-components">

                <div class="tpl-block">
                    <div class="portlet-title">
                        <div class="caption bold">
                            客户信息
                        </div>
                        <div class="tpl-portlet-input tpl-fz-ml" style="float: none;">
                            <a href="<?=\yii\helpers\Url::to(['customer/edit','id' => $customer->id])?>" class="am-btn am-btn-primary am-btn-sm"><span class="am-icon-pencil-square-o"></span> 修改单位信息</a>
                        </div>
                    </div>

                    <div class="am-g tpl-amazeui-form">

                        <div class="am-u-sm-12 am-u-md-10 am-text-sm">
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">单位名称：</div>
                                <div class="am-u-sm-9"><?=$customer->name?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">简称：</div>
                                <div class="am-u-sm-9"><?=$customer->description?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">地址：</div>
                                <div class="am-u-sm-9"><?=$customer->address?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">星级：</div>
                                <div class="am-u-sm-9"><?=$customer->starText?></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="tpl-portlet-components">

                <div class="tpl-block">
                    <div class="portlet-title">
                        <div class="caption bold">
                            人事信息
                        </div>
                        <div class="tpl-portlet-input tpl-fz-ml" style="float: none;">
                            <a href="<?=\yii\helpers\Url::to(['customer/person-add','customer_id' => $customer->id])?>" class="am-btn am-btn-primary am-btn-sm"><span class="am-icon-plus"></span> 新增人事信息</a>
                        </div>
						<div class="portlet-input input-inline" style="float: right;">
                            <div class="am-input-group am-input-group-sm">
                                <input name="keyword" value="<?=$keyword?>" type="text" class="am-form-field" autocomplete="off" placeholder="请输入名字进行搜索">
                                <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-primary am-icon-search" type="button" onclick="location.href='<?= \yii\helpers\Url::to(['customer/index']) ?>&type='+$('#project-select').val()+'&keyword='+$('input[name=keyword]').val()"></button>
          </span>
                            </div>
                        </div>
                    </div>

                    <div class="am-g">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th class="">姓名</th>
                                <th class="">科室</th>
                                <th class="">职务</th>
                                <th class="">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($customer->persons as $k=>$v):?>
                            <tr>
                                <td><?=$v->name?></td>
                                <td><?=$v->department?></td>
                                <td><?=$v->position?></td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a href="<?=\yii\helpers\Url::to(['customer/person-detail','id' => $v->id])?>" class="am-btn am-btn-default am-btn-xs am-text-primary" target="_blank"><span class="am-icon-file-text-o"></span> 详情</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="tpl-portlet-components">

                <div class="tpl-block">
                    <div class="portlet-title">
                        <div class="caption bold">
                            其他信息
                        </div>
                        <div class="tpl-portlet-input tpl-fz-ml" style="float: none;">
                            <button type="button" id="add-other" class="am-btn am-btn-primary am-btn-sm"><span class="am-icon-plus"></span> 新增信息</button>
                        </div>
                    </div>

                    <div class="am-g">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th class="">部门信息</th>
                                <th class="">录入人</th>
                                <th class="">时间</th>
                                <th class="">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($customer->others as $k=>$v):?>
                            <tr>
                                <td><?=$v->content?></td>
                                <td><?=$v->user->realname?></td>
                                <td><?=$v->dateText?></td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a other-id="<?=$v->id?>" class="am-btn am-btn-default am-btn-xs delete-other"><span class="am-icon-file-text-o"></span> 隐藏</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="tpl-portlet-components">

                <div class="tpl-block">
                    <div class="portlet-title">
                        <div class="caption bold">
                            项目信息
                        </div>
                    </div>

                    <div class="am-g">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th class="">项目名称</th>
                                <th class="">负责人</th>
                                <th class="">项目阶段</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($projectList as $k=>$v):?>
                            <tr>
                                <td><a href="<?=\yii\helpers\Url::to(['project/detail','id'=>$v->id])?>"><?=$v->name?></a></td>
                                <td><?=$v->incharge->realname?></td>
                                <td><?=$v->progressText?></td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    <div class="am-modal am-modal-prompt" tabindex="-1" id="other-prompt">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">新增部门信息</div>
            <div class="am-modal-bd">
                <form action="<?=\yii\helpers\Url::to(['customer/other-add'])?>" class="am-form am-form-horizontal am-text-sm am-padding-top validform" method="post">
                    <input type="hidden" name="id" value="<?=$customer->id?>" />
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">部门信息</label>
                        <div class="am-u-sm-9">
                            <textarea name="content" class="am-form-field am-radius" rows="5"></textarea>
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
            $('#add-other').on('click', function() {
                $('#other-prompt').modal();
            });
            $(".validform").Validform({
                tiptype:'wap',
                ajaxPost: true,
                callback:function(data){
                    if(data.code == 200) {
                        location.reload();
                    }
                }
            });
            $('.delete-other').click(function(){
                let obj = $(this);
                let id = $(this).attr('other-id');
                $.ajax({
                    url: '<?=\yii\helpers\Url::to(['customer/other-delete'])?>&id=' + id,
                    dataType: 'json',
                    success:function(data) {
                        if(data.code == 200) {
                            obj.parents('tr').hide();
                        }else {
                            alert(data.msg)
                        }
                    }
                })
            })
        });
    </script>