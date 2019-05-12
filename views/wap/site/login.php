<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>CNWT客户管理系统</title>
    <link href="assets/mui/css/mui.min.css" rel="stylesheet"/>
    <link href="assets/mui/css/icons-extra.css" rel="stylesheet"/>
    <link href="assets/css/public.css" rel="stylesheet"/>
    <script type="text/javascript" src="assets/mui/js/mui.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script>
        mui.init();
        mui.ready(function () {
            mui('body').on('tap', 'a.href-a', function () {
                document.location.href = this.href;
            });
        });
    </script>
    <link href="assets/css/login.css" rel="stylesheet"/>
    <script src="assets/validform/js/validform_min.js"></script>
    <link rel="stylesheet" href="assets/validform/css/validform.css" />
</head>

<body>
<div class="content">
    <div class="title">CNWT客户管理系统</div>
    <form action="<?php echo \yii\helpers\Url::to(['site/login'])?>" method="post" class="form-wrap validform">
        <div class="form-group">
            <span class="mui-icon mui-icon-person"></span>
            <input name="username" type="text" class="form-input" placeholder="请输入用户名" autocomplete="off" datatype="*" nullmsg="请输入用户名" errormsg="请输入用户名" />
        </div>
        <div class="form-group">
            <span class="mui-icon mui-icon-locked"></span>
            <input name="password" type="password" class="form-input" placeholder="请输入密码" autocomplete="off" datatype="*" nullmsg="请输入密码" errormsg="请输入密码" />
        </div>
        <div class="form-btn">
            <button type="submit" class="login-btn mui-btn mui-btn-primary">登 录</button>
        </div>
        <div class="mui-text-right">
            <a class="href-a fc_white" href="<?=\yii\helpers\Url::to(['site/password'])?>">修改密码</a>
        </div>
    </form>
</div>
<script>
    $(".validform").Validform({
        tiptype:'wap',
        ajaxPost: true,
        callback:function(data){
            if(data.code == 0) {
                location.href="<?php echo \yii\helpers\Url::to([\Yii::$app->defaultRoute])?>";
            }else{
                alert(data.msg);
            }
        }
    });
</script>
</body>
</html>