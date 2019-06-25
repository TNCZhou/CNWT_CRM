<?php
echo $this->render('../header',[
    'title' => '日志管理'
]);
?>
<link href="assets/css/mui_filter.css" rel="stylesheet"/>
<link href="assets/css/daily.css" rel="stylesheet"/>
<body>
<header class="mui-bar mui-bar-nav">
    <form class="search-form" name="search_form" method="post" action="">
        <span class="search-icon"></span>
        <input class="search-input" name="username" id="q" placeholder="请输入员工姓名进行搜索" type="search" value="<?= $params['username'] ?>" />
        <button type="button" onclick="location.href='<?= \yii\helpers\Url::to(['daily/index', 'department' => $params['department']]) ?>&username='+$('input[name=username]').val()+'&content='+$('input[name=content]').val()" class="search-btn">搜索</button>
    </form>
</header>
<?php
echo $this->render('../menu');
?>
<ul class="mui-row bg-white filter-wrap mui-avg-xs-4">
    <li><a href="<?= \yii\helpers\Url::to(['daily/index', 'department' => '']) ?>" class="mui-btn mui-block href-a <?php if (!$params['department']): ?>active<?php endif; ?>">我的日志</a></li>
    <?php foreach ($departmentList as $k => $v): ?>
        <li><a href="<?= \yii\helpers\Url::to(['daily/index', 'department' => $k]) ?>" class="mui-btn mui-block href-a <?php if ($params['department'] == $k): ?>active<?php endif; ?>"><?= $v ?>日志</a></li>
    <?php endforeach; ?>
    <li><a href="#filter-type" id="filter-type-btn" class="mui-btn mui-block"><span class="mui-icon mui-icon-extra mui-icon-extra-filter"></span> 筛选</a></li>
</ul>
<div id="filter-type" class="mui-popover filter-popover">
    <div class="mui-row">
        <ul class="mui-table-view">
            <li class="mui-table-view-cell"><a class="href-a active" href="#">全部</a></li>
            <li class="mui-table-view-cell"><a class="href-a" href="#">完成</a></li>
            <li class="mui-table-view-cell"><a class="href-a" href="#">延后</a></li>
			<li class="mui-table-view-cell"><a class="href-a" href="#">取消</a></li>
        </ul>
    </div>
</div>
<div class="mui-scroll-wrapper mui-content">
    <div class="mui-scroll">
        <div class="card-list">
            <?php foreach ($list as $k => $v): ?>
            <div class="mui-card">
                <div class="mui-card-header">
                    <span class="name"><?=$v['content']?></span>
                    <span class="type"><?=$v['type']?></span>
                </div>
                <div class="mui-card-content">
                    <ul class="mui-table-view">
                        <?php foreach ($v['records'] as $rk => $rv): ?>
                        <li class="mui-table-view-cell">
                            <div class="time"><?= ($rv['start_time'] ? date('Y-m-d H:i', $rv['start_time']) : '') . '-' . ($rv['end_time'] ? date('Y-m-d H:i', $rv['end_time']) : '') ?></div>
                            <div class=""><?=$rv->resultText?></div><!--mui-text-danger取消 mui-text-success完成 mui-text-warning延后-->
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="mui-card-footer">
                    <a class="mui-card-link href-a" href="<?=\yii\helpers\Url::to(['daily/detail','id'=>$v['id']])?>">查看详情 <span class="mui-icon mui-icon-arrowright"></span></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination mui-text-center">
            <?= \app\lib\Common::getDisplayPagination($pagination) ?>
        </div>
    </div>
</div>
<a class="href-a add-btn" href="<?=\yii\helpers\Url::to(['daily/edit'])?>"></a>
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