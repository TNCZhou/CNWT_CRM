<?php
echo $this->render('../header',[
    'title' => '项目管理'
]);
?>
<link href="assets/css/mui_filter.css" rel="stylesheet"/>
<body>
<header class="mui-bar mui-bar-nav">
    <form class="search-form" name="search_form" method="post" action="">
        <span class="search-icon"></span>
        <input class="search-input" name="keyword" id="keyword" placeholder="请输入项目名称/客户名称名进行搜索" type="search" value="<?=$params['keyword']?>" />
        <button type="button" onclick="location.href='<?=\yii\helpers\Url::to(['project/index', 'type' => $params['type']])?>&keyword='+$('#keyword').val()+'&progress='+$('#progress').val()" class="search-btn">搜索</button>
    </form>
</header>
<?php echo $this->render('../menu');?>
<ul class="mui-row bg-white filter-wrap mui-avg-xs-4">
    <li><a href="<?=\yii\helpers\Url::to(['project/index', 'progress' => $params['progress'], 'keyword' => $params['keyword']])?>" class="mui-btn mui-block href-a <?php if(!$params['type']):?>active<?php endif?>">全部</a></li>
    <li><a href="<?=\yii\helpers\Url::to(['project/index','type' => 'incharge', 'progress' => $params['progress'], 'keyword' => $params['keyword']])?>" class="mui-btn mui-block href-a <?php if($params['type'] == 'incharge'):?>active<?php endif?>">主导的</a></li>
    <li><a href="<?=\yii\helpers\Url::to(['project/index','type' => 'participate', 'progress' => $params['progress'], 'keyword' => $params['keyword']])?>" class="mui-btn mui-block href-a <?php if($params['type'] == 'participate'):?>active<?php endif?>">参与的</a></li>
    <li><a href="#filter-type" id="filter-type-btn" class="mui-btn mui-block"><span class="mui-icon mui-icon-extra mui-icon-extra-filter"></span> 筛选</a></li>
</ul>
<div id="filter-type" class="mui-popover filter-popover">
    <div class="mui-row">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <ul class="mui-table-view">
                    <li class="mui-table-view-cell"><a class="href-a <?php if(!$params['progress']):?>active<?php endif?>" href="<?=\yii\helpers\Url::to(array_merge(['project/index'],$params,['progress' => '']))?>">所有状态</a></li>
                    <?php foreach($progress as $k=>$v):?>
                        <li class="mui-table-view-cell"><a class="href-a <?php if($k==$params['progress']):?>active<?php endif?>" href="<?=\yii\helpers\Url::to(array_merge(['project/index'],$params,['progress' => $k]))?>"><?=$v?></a></li></option>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="mui-scroll-wrapper mui-content">
    <div class="mui-scroll">
        <ul class="mui-table-view margin-top">
            <?php foreach($list as $k=>$v):?>
            <li class="mui-table-view-cell">
                <a class="mui-navigate-right href-a" href="<?=\yii\helpers\Url::to(['project/detail','id'=>$v->id])?>">
                    <span class="mui-pull-right fc_grey margin-left-sm"><?=$v->progressText?></span>
                    <?=$v['name']?>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
        <div class="pagination mui-text-center">
            <?= \app\lib\Common::getDisplayPagination($pagination) ?>
        </div>
    </div>
</div>
<a class="href-a add-btn" href="<?=\yii\helpers\Url::to(['project/add'])?>"></a>
<script>
    mui('.mui-scroll-wrapper').scroll();

    mui(".filter-wrap").on('tap','#filter-type-btn',function(){
        $(this).addClass('active');
    });
    document.getElementById("filter-type").addEventListener('hidden', function(event) {
        $('#filter-type-btn').removeClass('active');
    });
    mui('#filter-type .mui-scroll-wrapper').scroll();
</script>
</body>
</html>