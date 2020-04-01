
        <div class="tpl-content-wrapper">
            <div class="tpl-content-page-title">
                项目数据
            </div>
            <div class="tpl-portlet-components">
                <div class="portlet-title tpl-index-tabs">
                    <ul class="am-tabs-nav am-nav am-nav-tabs portlet-tab">
                        <?php foreach ($companies as $id => $company): ?>
                        <li <?php if($params['company'] == $id):?>class="am-active"<?php endif;?>><a href="<?=\yii\helpers\Url::to(['data/project','company'=>$id])?>"><span><?=$company?></span></a></li>
                        <?php endforeach;?>
                    </ul>
                    <div class="tpl-portlet-input tpl-fz-ml">
                        <div class="portlet-input input-inline" style="width:300px;">
                            <div class="am-input-group am-input-group-sm">
                                <input id="keyword" value="<?=$params['keyword']?>" type="text" class="am-form-field" placeholder="请输入项目名称进行搜索">
                                <span class="am-input-group-btn">
            <button onclick="location.href='<?=\yii\helpers\Url::to(['data/project', 'company' => $params['company']])?>&keyword='+$('#keyword').val()+'&progress='+$('#project-select').val()" class="am-btn am-btn-default am-btn-primary am-icon-search" type="button"></button>
          </span>
                            </div>
                        </div>
                    </div>
                    <div class="tpl-portlet-input tpl-fz-ml">
                        <div class="portlet-input input-inline" style="width: 150px;">
                            <select id="project-select" data-am-selected="{btnWidth: '100%',btnSize: 'sm',placeholder: '请选择项目状态'}">
                                <option value="0">所有状态</option>
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
                                        <th class="">项目所属</th>
                                        <th class="">目前状态</th>
                                        <th class="">项目负责人</th>
                                        <th class="">项目星级</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($list as $v):?>
                                    <tr>
                                        <td><a href="<?=\yii\helpers\Url::to(['data/project-detail','id'=>$v['id']])?>"><?=$v['name']?></a></td>
                                        <td><?=$v->customer->name?></td>
                                        <td><?=$v->belongTo?></td>
                                        <td><?=$v->progressText?></td>
                                        <td><?=$v->incharge->realname?></td>
                                        <td><?=$v->customer->starText?></td>
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