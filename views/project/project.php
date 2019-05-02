
        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                项目管理<a class="am-btn am-btn-primary am-fr am-radius" href="<?=\yii\helpers\Url::to(['project/add'])?>"><i class="am-icon-plus"></i> 创建项目</a>
            </div>
            <div class="tpl-portlet-components">
                <div class="portlet-title tpl-index-tabs">
                    <ul class="am-tabs-nav am-nav am-nav-tabs portlet-tab">
                        <li <?php if(!$params['type']):?>class="am-active"<?php endif?>><a href="<?=\yii\helpers\Url::to(['project/index', 'progress' => $params['progress'], 'keyword' => $params['keyword']])?>"><span>全部 (<?=$total?>)</span></a></li>
                        <li <?php if($params['type'] == 'incharge'):?>class="am-active"<?php endif?>><a href="<?=\yii\helpers\Url::to(['project/index','type' => 'incharge', 'progress' => $params['progress'], 'keyword' => $params['keyword']])?>"><span>我主导的 (<?=$myIncharge?>)</span></a></li>
                        <li <?php if($params['type'] == 'participate'):?>class="am-active"<?php endif?>><a href="<?=\yii\helpers\Url::to(['project/index','type' => 'participate', 'progress' => $params['progress'], 'keyword' => $params['keyword']])?>"><span>我参与的 (<?=$myJoin?>)</span></a></li>
                    </ul>
                    <div class="tpl-portlet-input tpl-fz-ml">
                        <div class="portlet-input input-inline">
                            <div class="am-input-group am-input-group-sm">
                                <input id="keyword" value="<?=$params['keyword']?>" type="text" class="am-form-field" placeholder="请输入项目名称/客户名称名进行搜索">
                                <span class="am-input-group-btn">
            <button onclick="location.href='<?=\yii\helpers\Url::to(['project/index', 'type' => $params['type']])?>&keyword='+$('#keyword').val()+'&progress='+$('#progress').val()" class="am-btn am-btn-default am-btn-primary am-icon-search" type="button"></button>
          </span>
                            </div>
                        </div>
                    </div>
                    <div class="tpl-portlet-input tpl-fz-ml">
                        <div class="portlet-input input-inline">
                            <select id="progress" data-am-selected="{btnWidth: '100%',btnSize: 'sm',placeholder: '请选择项目状态'}">
                                <option value="">所有状态</option>
                                <?php foreach($progress as $k=>$v):?>
                                <option value="<?=$k?>" <?php if($k==$params['progress']):?>selected<?php endif?>><?=$v?></option>
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
                                        <th class="">项目名称</th>
                                        <th class="">客户名称</th>
                                        <th class="">目前状态</th>
                                        <th class="">项目负责人</th>
                                        <th class="">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($list as $k=>$v):?>
                                    <tr>
                                        <td><?=$v['name']?></td>
                                        <td><?=$v->customer->name?></td>
                                        <td><?=$v->progressText?></td>
                                        <td><?=$v->incharge->realname?></td>
                                        <td><a href="<?=\yii\helpers\Url::to(['project/detail','id'=>$v->id])?>">进度跟进</a></td>
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