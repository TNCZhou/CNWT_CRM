
        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                员工详情
            </div>
            <div class="tpl-portlet-components">

                <div class="tpl-block">

                    <div class="am-g tpl-amazeui-form">

                        <div class="am-u-sm-12 am-u-md-10 am-text-sm">
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">员工姓名：</div>
                                <div class="am-u-sm-9"><?=$user['realname']?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">员工ID：</div>
                                <div class="am-u-sm-9"><?=$user['username']?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">所属部门：</div>
                                <div class="am-u-sm-9"><?=$departmentList[$user['department']]?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">岗位：</div>
                                <div class="am-u-sm-9"><?=$user['position']?></div>
                            </div>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">权限：</div>
                                <div class="am-u-sm-9"><?=$levels[$user['level']]?></div>
                            </div>
                            <?php if($user['level'] == -1):?>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-3 am-text-right">离职时间：</div>
                                <div class="am-u-sm-9"><?php echo date('Y-m-d H:i:s',$user['dismission_time'])?></div>
                            </div>
                            <?php endif;?>
                            <hr>
                            <div class="am-cf am-margin-vertical-sm">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <a href="<?=\yii\helpers\Url::to(['staff/edit','id'=>$user['id']])?>" class="am-btn am-btn-primary am-btn-sm"><span class="am-icon-pencil-square-o"></span> 修改信息</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>