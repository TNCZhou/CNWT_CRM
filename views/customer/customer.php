        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                客户管理<a class="am-btn am-btn-primary am-fr am-radius" href="<?=\yii\helpers\Url::to(['customer/add'])?>"><i class="am-icon-plus"></i> 创建客户</a>
            </div>
            <div class="tpl-portlet-components">
                <div class="portlet-title tpl-index-tabs">
                    <ul class="am-tabs-nav am-nav am-nav-tabs portlet-tab">
                        <li <?php if(!$customerType[$type]):?>class="am-active"<?php endif;?>><a href="<?php echo \yii\helpers\Url::to(['customer/index'])?>"><span>全部 (<?=$total?>)</span></a></li>
                        <?php foreach ($customerType as $k=>$v):?>
                        <li <?php if($type == $k):?>class="am-active"<?php endif;?>><a href="<?php echo \yii\helpers\Url::to(['customer/index','type'=>$k])?>"><span><?=$v?> (<?=$typeCount[$k]?>)</span></a></li>
                        <?php endforeach;?>
                    </ul>
                    <div class="tpl-portlet-input tpl-fz-ml">
                        <div class="portlet-input input-inline">
                            <div class="am-input-group am-input-group-sm">
                                <input name="keyword" value="<?=$keyword?>" type="text" class="am-form-field" placeholder="请输入客户名称、简称进行搜索">
                                <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-primary am-icon-search" type="button" onclick="location.href='<?= \yii\helpers\Url::to(['customer/index']) ?>&type='+$('#project-select').val()+'&keyword='+$('input[name=keyword]').val()"></button>
          </span>
                            </div>
                        </div>
                    </div>
                    <div class="tpl-portlet-input tpl-fz-ml">
                        <div class="portlet-input input-inline">
                            <select id="project-select" data-am-selected="{btnWidth: '100%',btnSize: 'sm',placeholder: '请选择类型'}">
                                <?php foreach($customerType as $k=>$v):?>
                                <option value="<?=$k?>"><?=$v?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="tpl-block">

                    <div class="am-g am-g-collapse">
                        <div class="am-u-sm-12">
                            <form class="am-form">
                                <table class="am-table am-table-striped am-table-hover table-main">
                                    <thead>
                                    <tr>
                                        <th class="">类型</th>
                                        <th class="">单位名称</th>
                                        <th class="">简称</th>
                                        <th class="">关联项目</th>
                                        <th class="">星级</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($list as $k=>$v): ?>
                                    <tr>
                                        <td><?=$v->typeText?></td>
                                        <td><a href="<?=\yii\helpers\Url::to(['customer/detail','id'=>$v->id])?>"><?=$v->name?></a></td>
                                        <td><?=$v->description?></td>
                                        <td>
                                            <a href="<?=\yii\helpers\Url::to(['project/index','customer_id' => $v->id, 'progress' => '1,2,3,4,5,6,7,10,11'])?>"><span class="am-text-secondary">进行</span></a>
                                            /
                                            <a href="<?=\yii\helpers\Url::to(['project/index','customer_id' => $v->id, 'progress' => '8'])?>"><span class="am-text-success">完成</span></a>
                                            /
                                            <a href="<?=\yii\helpers\Url::to(['project/index','customer_id' => $v->id, 'progress' => '9'])?>"><span class="am-text-danger">丢单</span></a>
                                            ：
                                            <a href="<?=\yii\helpers\Url::to(['project/index','customer_id' => $v->id, 'progress' => '1,2,3,4,5,6,7,10,11'])?>"><span class="am-badge am-badge-secondary am-round"><?=$v->getProjectCount(1)?></span></a>
                                            /
                                                <a href="<?=\yii\helpers\Url::to(['project/index','customer_id' => $v->id, 'progress' => '8'])?>"><span class="am-badge am-badge-success am-round"><?=$v->getProjectCount(2)?></span></a>
                                            /
                                                    <a href="<?=\yii\helpers\Url::to(['project/index','customer_id' => $v->id, 'progress' => '9'])?>"><span class="am-badge am-badge-danger am-round"><?=$v->getProjectCount(3)?></span></a>

                                        </td>
                                        <td><?=$v->starText?></td>
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
