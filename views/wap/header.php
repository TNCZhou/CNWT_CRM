<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title><?=$title?></title>
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
            mui('.am-pagination').on('tap', 'a', function () {
                document.location.href = this.href;
            });
        });
    </script>
</head>