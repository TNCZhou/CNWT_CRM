<?php
echo $this->render('../header',[
'title' => 'CNWT客户管理系统'
]);
?>
<link href="assets/css/index.css" rel="stylesheet"/>
<body>
<header class="mui-bar mui-bar-nav">
    <h1 class="mui-title">欢迎 <?php echo \Yii::$app->user->identity->realname ?></h1>
    <a class="mui-action-menu mui-icon mui-icon-contact mui-pull-right" href="#topPopover"></a>
</header>
<div id="topPopover" class="mui-popover top-popover">
    <ul class="mui-table-view">
        <li class="mui-table-view-cell"><a href="<?=\yii\helpers\Url::to(['site/password'])?>" class="href-a">修改密码</a></li>
        <li class="mui-table-view-cell"><a href="<?=\yii\helpers\Url::to(['site/logout'])?>" class="href-a">退出登录</a></li>
    </ul>
</div>
<div class="mui-content">
    <div class="welcome"><?=\app\models\Welcome::getRandomContent()?></div>
    <div class="btn-list">
        <a href="<?=\yii\helpers\Url::to(['project/index'])?>" class="big-btn href-a mui-btn-primary">
            <img src="assets/images/project.png" />
            <p>项目管理</p>
        </a>
        <a href="<?=\yii\helpers\Url::to(['daily/index'])?>" class="big-btn href-a mui-btn-primary">
            <img src="assets/images/daily.png" />
            <p>日志管理</p>
        </a>
        <a href="<?=\yii\helpers\Url::to(['customer/index'])?>" class="big-btn href-a mui-btn-primary">
            <img src="assets/images/customer.png" />
            <p>客户管理</p>
        </a>
    </div>
</div>
</body>
</html>