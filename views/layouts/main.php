<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CNWT客户管理系统</title>
    <meta name="description" content="CNWT客户管理系统">
    <meta name="keywords" content="CNWT客户管理系统">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="applicable-device" content="mobile">
    <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/validform/js/validform_min.js"></script>
    <link rel="stylesheet" href="assets/validform/css/validform.css" />
</head>

<body>
<header class="am-topbar am-topbar-inverse admin-header">
    <div class="am-topbar-brand">
        <div class="tpl-logo">CNWT客户管理系统</div>
    </div>
    <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right"></div>
    <div class="am-fl welcome"><?=\app\models\Welcome::getRandomContent()?></div>
    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
            data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span
                class="am-icon-bars"></span></button>
    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">
            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="tpl-header-list-user-nick am-icon-user"> <?=\Yii::$app->user->identity->username?></span>
                </a>
                <ul class="am-dropdown-content">
                    <li><a href="<?php echo \yii\helpers\Url::to(['site/password']) ?>"><span class="am-icon-cog"></span>
                            修改密码</a></li>
                    <li><a href="<?php echo \yii\helpers\Url::to(['site/logout']) ?>"><span class="am-icon-power-off"></span>
                            退出</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>


<div class="tpl-page-container tpl-page-header-fixed">

    <div class="tpl-left-nav tpl-left-nav-hover">
        <div class="tpl-left-nav-title">
            导航
        </div>
        <?php $menu = \app\logic\SiteForm::getMenu() ?>
        <div class="tpl-left-nav-list">
            <ul class="tpl-left-nav-menu">
                <?php foreach ($menu as $m): ?>
                    <li class="tpl-left-nav-item">
                        <a href="<?php echo $m['route'] ? \yii\helpers\Url::to([$m['route']]) : 'javascript:;' ?>"
                           class="nav-link tpl-left-nav-link-list <?php echo \Yii::$app->controller->id == $m['group'] ? 'active' : '' ?>">
                            <i class="<?php echo $m['icon'] ?> am-icon-fw"></i>
                            <span><?php echo $m['name'] ?></span>
                            <?php if ($m['sub']): ?>
                                <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                            <?php endif; ?>
                        </a>
                        <?php if ($m['sub']): ?>
                            <ul class="tpl-left-nav-sub-menu" <?php echo \Yii::$app->controller->id == $m['group'] ? "style=\"display: block;\"" : '' ?>>
                                <?php foreach ($m['sub'] as $s): ?>
                                    <li>
                                        <a href="<?php echo \yii\helpers\Url::to([$s['route']]) ?>">
                                            <i class="am-icon-angle-right"></i>
                                            <span><?php echo $s['name'] ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
                </li>
            </ul>
        </div>
    </div>

    <?= $content ?>
</div>

<script src="assets/js/app.js"></script>
</body>
</html>
