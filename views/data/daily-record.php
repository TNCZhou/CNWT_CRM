        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                日志记录
            </div>
            <div class="tpl-portlet-components">
                <div class="tpl-block">

                    <div class="am-g am-g-collapse">
                        <div class="am-u-sm-12">
                            <form class="am-form">
                                <table class="am-table am-table-striped am-table-hover table-main">
                                    <thead>
                                    <tr>
                                        <th class="">员工姓名</th>
                                        <th class="">所属部门</th>
                                        <th class="">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($users as $user):?>
                                    <tr>
                                        <td><?=$user->realname?></td>
                                        <td><?=$user->departments->name?></td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <a href="<?=\yii\helpers\Url::to(['data/user-daily','id'=>$user->id])?>" class="am-btn am-btn-default am-btn-xs am-text-primary"><span class="am-icon-file-text-o"></span> 查看日志</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                                <div class="am-cf">
                                    <div class="am-fr">
                                        <?= \app\lib\Common::getDisplayPagination($pagination) ?>
                                    </div>
                                </div>
                                <hr>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="tpl-alert"></div>
            </div>


        </div>