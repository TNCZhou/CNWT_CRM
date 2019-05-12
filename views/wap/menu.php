<nav class="mui-bar mui-bar-tab">
    <a class="mui-tab-item <?php echo \Yii::$app->controller->id == 'site' ? "mui-active" : 'href-a' ?>" href="<?=\yii\helpers\Url::to(['site/index'])?>">
        <span class="icon index-icon"></span>
        <span class="mui-tab-label">首页</span>
    </a>
    <a class="mui-tab-item <?php echo \Yii::$app->controller->id == 'project' ? "mui-active" : 'href-a' ?>" href="<?=\yii\helpers\Url::to(['project/index'])?>">
        <span class="icon project-icon"></span>
        <span class="mui-tab-label">项目管理</span>
    </a>
    <a class="mui-tab-item <?php echo \Yii::$app->controller->id == 'daily' ? "mui-active" : 'href-a' ?>" href="<?=\yii\helpers\Url::to(['daily/index'])?>">
        <span class="icon daily-icon"></span>
        <span class="mui-tab-label">日志管理</span>
    </a>
    <a class="mui-tab-item <?php echo \Yii::$app->controller->id == 'customer' ? "mui-active" : 'href-a' ?>" href="<?=\yii\helpers\Url::to(['customer/index'])?>">
        <span class="icon customer-icon"></span>
        <span class="mui-tab-label">客户管理</span>
    </a>
</nav>