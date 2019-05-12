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
    基础信息
    <a class="mui-btn mui-btn-primary href-a" href="<?=\yii\helpers\Url::to(['customer/person-edit','id'=>$person->id])?>">修改</a>
</div>
<div class="mui-card detail-card">
    <div class="mui-input-group input-group list-group">
        <div class="mui-input-row">
            <label>姓名</label>
            <div class="readonly-input"><?=$person->name?></div>
        </div>
        <div class="mui-input-row">
            <label>性别</label>
            <div class="readonly-input"><?=$person->genderText?></div>
        </div>
        <div class="mui-input-row">
            <label>科室</label>
            <div class="readonly-input"><?=$person->department?></div>
        </div>
        <div class="mui-input-row">
            <label>职务</label>
            <div class="readonly-input"><?=$person->position?></div>
        </div>
        <div class="mui-input-row">
            <label>电话</label>
            <div class="readonly-input"><?=$person->tel?></div>
        </div>
        <div class="mui-input-row">
            <label>QQ</label>
            <div class="readonly-input"><?=$person->qq?></div>
        </div>
        <div class="mui-input-row">
            <label>微信</label>
            <div class="readonly-input"><?=$person->wechat?></div>
        </div>
    </div>
</div>

<div class="title">
    任职经历
    <a class="mui-btn mui-btn-primary" href="#add-exp">新增</a>
</div>
<div class="mui-card detail-card">
    <div class="exp-list">
        <?php foreach($person->experiences as $k=>$v):?>
        <div class="exp-item">
            <div class="exp-company">
                <?=$v->theCompany->name?>
<!--                <a class="del">删除</a>-->
            </div>
            <div class="exp-info">
                <div class="mui-row">
                    <div class="mui-col-xs-4 mui-col-sm-3">部&emsp;&emsp;门</div>
                    <div class="mui-col-xs-8 mui-col-sm-9 fc_grey"><?=$v->department?></div>
                </div>
                <div class="mui-row">
                    <div class="mui-col-xs-4 mui-col-sm-3">职&emsp;&emsp;务</div>
                    <div class="mui-col-xs-8 mui-col-sm-9 fc_grey"><?=$v->position?></div>
                </div>
                <div class="mui-row">
                    <div class="mui-col-xs-4 mui-col-sm-3">任职时间</div>
                    <div class="mui-col-xs-8 mui-col-sm-9 fc_grey"><?=date('Y-m-d', $v->start_date)?> 至 <?=$v->end_date?date('Y-m-d',$v->end_date):'今'?></div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>

<div class="title">
    个人信息
    <a class="mui-btn mui-btn-primary" href="#add-info">新增</a>
</div>
<div class="mui-card detail-card">
    <table class="table">
        <thead>
        <tr>
            <th class="">详情</th>
            <th class="">录入人</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($person->manyInfo as $k=>$v):?>
        <tr>
            <td><?=$v->info?></td>
            <td><?=$v->user->realname?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

<div class="mui-popover mui-popover-action mui-popover-middle" id="add-exp">
    <form method="post" class="validform-exp" action="<?=\yii\helpers\Url::to(['customer/person-experience-add'])?>">
        <div class="popover-dialog">
            <div class="popover-hd">任职经历</div>
            <input type="hidden" name="person_id" value="<?=$person->id?>" />
            <div class="mui-input-group input-group">
                <div class="mui-input-row visible-row">
                    <div class="mui-row">
                    <label>单位</label>
                    <input type="hidden" name="company" value="">
                    <input type="text" name="" id="companyname" placeholder="请填写单位" datatype="*" nullmsg="请搜索选择任职单位" onKeyUp="ajaxShop(this);" autocomplete="off" />
                    <div id="companylist">

                    </div>
                    </div>
                </div>
                <div class="mui-input-row">
                    <label>部门</label>
                    <input type="text" name="department" placeholder="请填写部门" value="" datatype="*" nullmsg="请填写部门" />
                </div>
                <div class="mui-input-row">
                    <label>职务</label>
                    <input type="text" name="position" placeholder="请填写职务" value="" datatype="*" nullmsg="请填写职务" />
                </div>
                <div class="mui-input-row">
                    <label>任职时间</label>
                    <div class="readonly-input cycle-date">
                        <a class="date" id="start-date">开始时间</a>
                        <span>至</span>
                        <a class="date mui-text-right" id="end-date">结束时间</a>
                        <input type="hidden" name="start_date" value="" datatype="*" nullmsg="请选择开始时间" />
                        <input type="hidden" name="end_date" value="" datatype="*" nullmsg="请选择结束时间" />
                    </div>
                </div>
            </div>
            <div class="mui-popup-buttons">
                <a class="mui-popup-button" href="#add-exp">取消</a>
                <button type="submit" class="mui-popup-button">确定</button>
            </div>
        </div>
    </form>
</div>

<div class="mui-popover mui-popover-action mui-popover-middle" id="add-info">
    <form method="post" class="validform-info" action="<?=\yii\helpers\Url::to(['customer/person-info-add'])?>">
        <div class="popover-dialog">
            <input type="hidden" name="person_id" value="<?=$person->id?>" />
            <div class="popover-hd">新增个人信息</div>
            <div class="mui-input-group input-group">
                <div class="mui-input-row">
                    <label>个人信息</label>
                    <textarea name="info" class="" placeholder="请输入客户兴趣爱好，个人情况等信息" rows="5"></textarea>
                </div>
            </div>
            <div class="mui-popup-buttons">
                <a class="mui-popup-button" href="#add-info">取消</a>
                <button type="submit" class="mui-popup-button">确定</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="assets/mui/js/mui.picker.min.js"></script>
<link href="assets/mui/css/mui.picker.min.css" rel="stylesheet"/>
<script>
    function ajaxShop(obj) {
        var words = $(obj).val();
        $.ajax({
            type: 'GET',
            url: "<?=\yii\helpers\Url::to(['customer/company-list'])?>&word=" + words + "&rand=" + Math.random(),
            dataType: 'json',
            success: function (result) {
                if (result.code == 200) {
                    let str = '';
                    result.data.list.map(function (v) {
                        str += '<div class="company-item" id="'+v.id+'" data-name="'+v.name+'">'+v.name+'</div>';
                    });
                    str += '';
                    $('#companylist').html(str);
                    $('#companylist').show();
                }
            }
        })
    }

    mui.ready(function () {
        var limit = '';
        mui('body').on('tap','#start-date',function(){
            var dtPicker = new mui.DtPicker({
                type: "date",
                endDate: new Date()
            });
            dtPicker.show(function (res) {
                limit = res.y.value+'/'+res.m.value+'/'+res.d.value;
                $('#start-date').html(res.value);
                $('input[name=start_date]').val(res.value);
                if($('input[name=end_date]').val()!=''){
                    $('#end-date').html(res.value);
                    $('input[name=end_date]').val(res.value);
                }
            })
        });
        mui('body').on('tap','#end-date',function(){
            if($('input[name=start_date]').val()==''){
                mui.toast('请先选择开始时间');
            }else{
                var dtPicker = new mui.DtPicker({
                    type: "date",
                    beginDate: new Date(limit),
                    endDate: new Date()
                });
                dtPicker.show(function (res) {
                    $('#end-date').html(res.value);
                    $('input[name=end_date]').val(res.value);
                })
            }
        });

        mui("body").on("tap",".company-item",function(){
            var id = $(this).attr("id");
            var val = $(this).attr("data-name");
            $("#companyname").val(val);
            $("input[name=company]").val(id);
            $('#companylist').hide();
        });

        $(".validform-exp").Validform({
            tiptype:'wap',
            ajaxPost: true,
            callback:function(data){
                if(data.code == 200) {
                    location.reload()
                } else {
                    alert(data.msg)
                }
            }
        });

        $(".validform-info").Validform({
            tiptype:'wap',
            ajaxPost: true,
            callback:function(data){
                if(data.code == 200) {
                    location.reload()
                } else {
                    alert(data.msg)
                }
            }
        });
    })
</script>
</body>
</html>