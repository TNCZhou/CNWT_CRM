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
    <link href="assets/css/pwd.css" rel="stylesheet"/>
    <script src="assets/validform/js/validform_min.js"></script>
    <link rel="stylesheet" href="assets/validform/css/validform.css" />
</head>
<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">修改密码</h1>
</header>
<div class="mui-content">
    <form class="margin-top validform">
        <div class="mui-input-group input-group ">
            <div class="mui-input-row">
                <label>用&ensp;户&ensp;名</label>
                <input name="username" type="text" class="" value="<?php echo \Yii::$app->user->identity->username ?>" placeholder="用户名" <?=\Yii::$app->user->identity->username?'readonly':''?>" autocomplete="off" datatype="*" nullmsg="请输入用户名" errormsg="请输入用户名" />
            </div>
            <div class="mui-input-row">
                <label>旧&ensp;密&ensp;码</label>
                <input name="password" type="password" class="" placeholder="旧的密码" autocomplete="off" datatype="*" nullmsg="请输入旧的密码" errormsg="请输入旧的密码" />
            </div>
            <div class="mui-input-row">
                <label>新&ensp;密&ensp;码</label>
                <input type="password" class="" name="newPassword" placeholder="新的密码" autocomplete="off" datatype="*" nullmsg="请输入新的密码" errormsg="请输入新的密码" />
            </div>
            <div class="mui-input-row">
                <label>确认密码</label>
                <input type="password" class="" name="password2" placeholder="再次输入新的密码" autocomplete="off" datatype="*" recheck="newPassword" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！">
            </div>
        </div>
        <div class="padding">
            <button type="submit" class="mui-btn btn-block mui-btn-primary">确认修改</button>
        </div>
    </form>
</div>
<script>
    $(".validform").Validform({
        tiptype:'wap',
        ajaxPost: true,
        callback:function(data){
            alert(data.msg)
            if(data.code == 0) {
                location.href = '<?=\yii\helpers\Url::to(['site/login'])?>';
            }
        }
    });
</script>
</body>
</html>