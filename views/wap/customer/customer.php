<?php
echo $this->render('../header',[
    'title' => '客户管理'
]);
?>
<link href="assets/css/mui_filter.css" rel="stylesheet"/>
<link href="assets/css/customer.css" rel="stylesheet"/>
<body>
<header class="mui-bar mui-bar-nav">
    <form class="search-form" name="search_form" method="post" action="">
        <span class="search-icon"></span>
        <input class="search-input" name="keyword" id="q" placeholder="请输入客户名称/简称进行搜索" type="search" value="" />
        <button type="button" onclick="location.href='<?= \yii\helpers\Url::to(['customer/index','type'=>$type]) ?>&keyword='+$('input[name=keyword]').val()" class="search-btn">搜索</button>
    </form>
</header>
<?php
echo $this->render('../menu');
?>
<ul class="mui-row bg-white filter-wrap mui-avg-xs-3">
    <li><a href="<?= \yii\helpers\Url::to(['customer/index']) ?>" class="mui-btn mui-block href-a <?php if(!$type):?>active<?php endif;?>">全部</a></li>
    <?php foreach($customerType as $k=>$v):?>
    <li><a href="<?= \yii\helpers\Url::to(['customer/index','type'=>$k]) ?>" class="mui-btn mui-block href-a <?php if($type==$k):?>active<?php endif;?>"><?=$v?></a></li>
    <?php endforeach;?>
</ul>

<div class="mui-content">
    <div class="card-list">
        <?php foreach ($list as $k=>$v): ?>
        <div class="mui-card">
            <a class="href-a" href="<?=\yii\helpers\Url::to(['customer/detail','id'=>$v->id])?>">
                <div class="mui-card-header">
                    <span class="name"><?=$v->name?></span>
                    <span class="type"><?=$v->typeText?></span>
                </div>
                <div class="mui-card-footer">
                    <a class="href-a" href="<?=\yii\helpers\Url::to(['project/index','customer_id' => $v->id, 'progress' => '1,2,3,4,5,6,7,10,11'])?>"><span class="mui-badge mui-badge-primary">进行：<?=$v->getProjectCount(1)?></span></a>
                    <a class="href-a" href="<?=\yii\helpers\Url::to(['project/index','customer_id' => $v->id, 'progress' => '8'])?>"><span class="mui-badge mui-badge-success">完成：<?=$v->getProjectCount(2)?></span></a>
            <a class="href-a" href="<?=\yii\helpers\Url::to(['project/index','customer_id' => $v->id, 'progress' => '9'])?>"><span class="mui-badge mui-badge-danger">丢单：<?=$v->getProjectCount(3)?></span></a>
                </div>
            </a>
        </div>
    <?php endforeach;?>
    </div>

    <div class="pagination mui-text-center">
        <?= \app\lib\Common::getDisplayPagination($pagination) ?>
    </div>
</div>
<a class="href-a add-btn" href="<?=\yii\helpers\Url::to(['customer/add'])?>"></a>
<script>
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