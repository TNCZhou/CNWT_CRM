<?php
echo $this->render('../header',[
    'title' => '项目管理'
]);
?>
<link href="assets/css/customer.css" rel="stylesheet"/>
<script src="assets/validform/js/validform_min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/validform/css/validform.css">
<body>
<form method="post" class="validform" action="<?=\yii\helpers\Url::to(['customer/person-edit'])?>">
    <input type="hidden" name="customer_id" value="<?=$person->customer_id?>" />
    <input type="hidden" name="id" value="<?=$person->id?>" />
    <div class="mui-input-group input-group margin-vertical-sm">
        <div class="mui-input-row">
            <label>姓名</label>
            <input type="text" name="name" autocomplete="off" placeholder="请填写姓名" value="<?=$person->name?>" datatype="*" nullmsg="请填写姓名" />
        </div>
        <div class="mui-input-row">
            <label>性别</label>
            <div class="input-cont">
                <?php foreach($gender as $k=>$v):?>
                    <div class="mui-radio mui-left">
                        <label><?=$v?></label>
                        <input <?php if($person->gender == $k):?> checked <?php endif?> value="<?=$k?>" name="gender" type="radio" datatype="*" nullmsg="请选择性别" />
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <div class="mui-input-row">
            <label>科室</label>
            <input type="text" name="department" value="<?=$person->department?>" autocomplete="off" placeholder="请填写科室" />
        </div>
        <div class="mui-input-row">
            <label>职务</label>
            <input type="text" name="position" autocomplete="off" placeholder="请填写职务" value="<?=$person->position?>" />
        </div>
<!--        <div class="mui-input-row">-->
<!--            <label>生日</label>-->
<!--            <div class="readonly-input select" id="birthday">请选择生日</div>-->
<!--            <input type="hidden" name="birthday" value="" />-->
<!--        </div>-->
<!--        <div class="mui-input-row">-->
<!--            <label>家庭住址</label>-->
<!--            <input type="text" name="" autocomplete="off" placeholder="请填写家庭住址" value="" />-->
<!--        </div>-->
        <div class="mui-input-row">
            <label>电话</label>
            <input type="tel" name="tel" autocomplete="off" placeholder="请填写电话" value="<?=$person->tel?>" />
        </div>
        <div class="mui-input-row">
            <label>QQ</label>
            <input type="tel" name="qq" autocomplete="off" placeholder="请填写QQ" value="<?=$person->qq?>" />
        </div>
        <div class="mui-input-row">
            <label>微信</label>
            <input type="text" name="wechat" autocomplete="off" placeholder="请填写微信" value="<?=$person->wechat?>" />
        </div>
<!--        <div class="mui-input-row">-->
<!--            <label>个人信息</label>-->
<!--            <textarea name="" rows="5" placeholder="请输入客户兴趣爱好，个人情况等信息"></textarea>-->
<!--        </div>-->
    </div>

    <div class="pagination">
        <button class="mui-btn mui-btn-primary btn-block" type="submit">提 交</button>
    </div>
</form>
<script type="text/javascript" src="assets/mui/js/mui.picker.min.js"></script>
<link href="assets/mui/css/mui.picker.min.css" rel="stylesheet"/>
<script>
    mui.ready(function () {
        mui('body').on('tap','#birthday',function(){
            var dtPicker = new mui.DtPicker({
                type: "date"
            });
            dtPicker.show(function (res) {
                $('#birthday').html(res.value).addClass('fc_black');
                $('input[name=birthday]').val(res.value);
            })
        });

        $(".validform").Validform({
            tiptype:'wap',
        });
    })
</script>

</body>
</html>