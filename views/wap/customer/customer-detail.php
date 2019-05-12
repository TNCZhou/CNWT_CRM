<?php
echo $this->render('../header',[
    'title' => '客户详情'
]);
?>
<link href="assets/css/customer.css" rel="stylesheet"/>
<script src="assets/validform/js/validform_min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/validform/css/validform.css">
<body>
<div class="title">
    客户信息
    <a class="mui-btn mui-btn-primary href-a" href="<?=\yii\helpers\Url::to(['customer/edit','id' => $customer->id])?>">修改</a>
</div>
<div class="mui-card detail-card">
    <div class="mui-input-group input-group list-group">
        <div class="mui-input-row">
            <label>单位名称</label>
            <div class="readonly-input"><?=$customer->name?></div>
        </div>
        <div class="mui-input-row">
            <label>简称</label>
            <div class="readonly-input"><?=$customer->description?></div>
        </div>
        <div class="mui-input-row">
            <label>地址</label>
            <div class="readonly-input"><?=$customer->address?></div>
        </div>
        <div class="mui-input-row">
            <label>星级</label>
            <div class="readonly-input"><?=$customer->starText?></div>
        </div>
    </div>
</div>

<div class="title">
    人事信息
    <a class="mui-btn mui-btn-primary href-a" href="<?=\yii\helpers\Url::to(['customer/person-add','customer_id' => $customer->id])?>">新增</a>
</div>
<div class="mui-card detail-card">
    <table class="table">
        <thead>
        <tr>
            <th class="">姓名</th>
            <th class="">科室</th>
            <th class="">职务</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($customer->persons as $k=>$v):?>
        <tr>
            <td><a href="<?=\yii\helpers\Url::to(['customer/person-detail','id' => $v->id])?>" class="href-a"><?=$v->name?></a></td>
            <td><?=$v->department?></td>
            <td><?=$v->position?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

<div class="title">
    部门信息
    <a class="mui-btn mui-btn-primary" href="#add-department">新增</a>
</div>
<div class="mui-card detail-card">
    <table class="table">
        <thead>
        <tr>
            <th class="">部门信息</th>
            <th class="">录入人</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($customer->others as $k=>$v):?>
        <tr>
            <td><?=$v->content?></td>
            <td><?=$v->user->realname?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

<div class="title">项目信息</div>
<div class="mui-card detail-card">
    <table class="table">
        <thead>
        <tr>
            <th class="">项目名称</th>
            <th nowrap="nowrap">负责人</th>
            <th nowrap="nowrap">项目阶段</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($projectList as $k=>$v):?>
        <tr>
            <td><a href="<?=\yii\helpers\Url::to(['project/detail','id'=>$v->id])?>" class="href-a"><?=$v->name?></a></td>
            <td nowrap="nowrap"><?=$v->incharge->realname?></td>
            <td nowrap="nowrap"><?=$v->progressText?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

<div class="mui-popover mui-popover-action mui-popover-middle" id="add-department">
    <form method="post" class="validform" action="<?=\yii\helpers\Url::to(['customer/other-add'])?>">
        <div class="popover-dialog">
            <div class="popover-hd">新增部门</div>
            <input type="hidden" name="id" value="<?=$customer->id?>" />
            <div class="mui-input-group input-group">
                <div class="mui-input-row">
                    <label>部门名称</label>
                    <input type="text" name="content" placeholder="请填写部门名称" value="" datatype="*" nullmsg="请填写部门名称" />
                </div>
            </div>
            <div class="mui-popup-buttons">
                <a class="mui-popup-button" href="#add-department">取消</a>
                <button type="submit" class="mui-popup-button">确定</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(function () {
        $(".validform").Validform({
            tiptype:'wap',
            ajaxPost: true,
            callback:function(data){
                if(data.code == 200) {
                    location.reload()
                }else {
                    alert(data.msg)
                }
            }
        });
    })
</script>
</body>
</html>