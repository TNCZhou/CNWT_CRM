<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登录</title>
    <meta name="description" content="登录">
    <meta name="keywords" content="登录">
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
<div class="am-g tpl-g">
    <div class="tpl-login">
        <div class="tpl-login-content">
            <div class="tpl-login-logo">
                CNWT客户管理系统
            </div>
            <div class="tpl-login-title">修改密码</div>
            <form class="am-form tpl-form-line-form validform">
                <div class="am-form-group">
                    <input name="username" type="text" class="tpl-form-input" placeholder="用户名" autocomplete="off" datatype="*" nullmsg="请输入用户名" errormsg="请输入用户名" />
                </div>
                <div class="am-form-group">
                    <input name="password" type="password" class="tpl-form-input" placeholder="旧的密码" autocomplete="off" datatype="*" nullmsg="请输入旧的密码" errormsg="请输入旧的密码" />
                </div>
                <div class="am-form-group">
                    <input name="newPassword" type="password" class="tpl-form-input" placeholder="新的密码" autocomplete="off" datatype="*" nullmsg="请输入新的密码" errormsg="请输入新的密码" />
                </div>
                <div class="am-form-group">
                    <input type="password" class="tpl-form-input" name="password2" placeholder="再次输入新的密码" autocomplete="off" datatype="*" recheck="newPassword" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！">
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
            alert(data.msg)
            if(data.code == 0) {
                location.href = '<?=\yii\helpers\Url::to(['site/login'])?>';
            }
        }
    });
</script>

</body>
</html>