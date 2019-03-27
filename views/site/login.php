<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登录</title>
    <meta name="description" content="登录">
    <meta name="keywords" content="登录">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes" />
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
<div class="am-g tpl-g">
    <div class="tpl-login">
        <div class="tpl-login-content">
            <div class="tpl-login-logo">
                CNWT客户管理系统
            </div>
            <form class="am-form tpl-form-line-form validform" action="<?php echo Url::to(['site/login'])?>" method="post">
                <div class="am-form-group am-form-icon">
                    <i class="am-icon-user"></i>
                    <input name="username" type="text" class="tpl-form-input" placeholder="请输入用户名" autocomplete="off" datatype="*" nullmsg="请输入用户名" errormsg="请输入用户名" />
                </div>
                <div class="am-form-group am-form-icon">
                    <i class="am-icon-unlock-alt"></i>
                    <input name="password" type="password" class="tpl-form-input" placeholder="请输入密码" autocomplete="off" datatype="*" nullmsg="请输入密码" errormsg="请输入密码" />
                </div>
                <div class="am-form-group tpl-login-remember-me">
                    <a class="" href="<?=Url::to(['site/password'])?>">修改密码</a>
                </div>
                <div class="am-form-group am-padding-top">
                    <button type="submit" class="am-btn am-btn-primary am-btn-block am-radius am-btn-lg">提交</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(".validform").Validform({
        tiptype:'wap',
        ajaxPost: true,
        callback:function(data){
            if(data.code == 0) {
                location.href="<?php echo Url::to([\Yii::$app->defaultRoute])?>";
            }else{
                alert(data.msg);
            }
        }
    });
</script>

</body>
</html>