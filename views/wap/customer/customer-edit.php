<?php
echo $this->render('../header',[
    'title' => '编辑客户'
]);
?>
<link href="assets/css/customer.css" rel="stylesheet"/>
<script src="assets/validform/js/validform_min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/validform/css/validform.css">
<body>
<form method="post" class="validform" action="<?=\yii\helpers\Url::to(['customer/edit'])?>">
    <input type="hidden" name="id" value="<?=$customer->id?>" />
    <div class="mui-input-group input-group margin-vertical-sm">
        <div class="mui-input-row has-units">
            <label>类型</label>
            <div class="readonly-input"><?=$customer->typeText?></div>
        </div>
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
            <input type="text" value="<?=$customer->address?>" name="address" autocomplete="off" placeholder="请填写地址" value="" datatype="*" nullmsg="请填写地址" />
        </div>
        <div class="mui-input-row has-units">
            <label>星级</label>
            <div class="readonly-input select" id="star"><?=$customer->starText?></div>
            <span class="mui-input-units mui-icon mui-icon-arrowdown"></span>
            <input type="hidden" name="star" value="<?=$customer->star?>" datatype="*" nullmsg="请选择星级" />
        </div>
    </div>

    <div class="pagination">
        <button class="mui-btn mui-btn-primary btn-block" type="submit">提 交</button>
    </div>
</form>
<script type="text/javascript" src="assets/mui/js/mui.picker.min.js"></script>
<link href="assets/mui/css/mui.picker.min.css" rel="stylesheet"/>
<script>
    mui.ready(function () {

        <?php $p=[]?>
        <?php foreach ($customerStar as $k=>$v):
        $p[] = [
            'value' => $k,
            'text' => $v
        ];
    endforeach;?>
        var starPicker = new mui.PopPicker();
        starPicker.setData(<?=json_encode($p)?>);
        mui('body').on('tap','#star',function(){
            var _this = $(this);
            starPicker.show(function(res) {
                _this.html(res[0].text).addClass('fc_black');
                $('input[name=star]').val(res[0].value);
            })
        });

        $(".validform").Validform({
            tiptype:'wap',
        });
    })
</script>

</body>
</html>