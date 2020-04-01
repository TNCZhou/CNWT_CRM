
        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                日志数据
            </div>
            <div class="tpl-portlet-components">
                <div class="portlet-title tpl-index-tabs">
                    <ul class="am-tabs-nav am-nav am-nav-tabs portlet-tab">
                        <li <?php if($params['no']):?>class="am-active"<?php endif;?>><a href="<?=\yii\helpers\Url::to(['data/index','no'=>1])?>" ><span>今日未填写日志 （<?=$userNotYet?>）</span></a></li>
                        <li <?php if(!$params['no']):?>class="am-active"<?php endif;?>><a href="<?=\yii\helpers\Url::to(['data/index'])?>"><span>今日已提交日志 （<?=$userDone?>）</span></a></li>
                    </ul>
                </div>
                <div class="tpl-block">

                    <div class="am-g am-g-collapse">
                        <div class="am-u-sm-12">
                            <form class="am-form">
                                <?php if(!$params['no']):?>
                                <!--今日已提交日志-->
                                <table class="am-table am-table-striped am-table-hover table-main">
                                    <thead>
                                    <tr>
                                        <th class="">记录人</th>
                                        <th class="">工作任务</th>
                                        <th class="">工作类型</th>
                                        <th class="">工作结果</th>
                                        <th class="">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($list as $k => $v): ?>
                                    <tr>
                                        <td><?=$v['realname']?></td>
                                        <td><?=$v['content']?></td>
                                        <td><?=$v['type']?></td>
                                        <td><?=$results[$v['result']]?></td>
                                        <td><div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <a href="<?=\yii\helpers\Url::to(['user-daily-detail','id'=>$v['tid']])?>" class="am-btn am-btn-default am-btn-xs am-text-primary"><span
                                                                class="am-icon-file-text-o"></span> 详情</a>
                                                </div>
                                            </div></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php else:?>
                                <!--今日未填写日志-->
                                <table class="am-table am-table-striped am-table-hover table-main">
                                    <thead>
                                    <tr>
                                        <th class="">员工姓名</th>
                                        <th class="">状态</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($list as $k => $v): ?>
                                    <tr>
                                        <td><?=$v['realname']?></td>
                                        <td>未提交日志</td>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <?php endif;?>
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