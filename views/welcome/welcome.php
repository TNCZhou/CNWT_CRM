<div class="tpl-content-wrapper">
    <div class="tpl-content-page-title">
        <input id='file' name='file' type="file" style="width:0;position:absolute;z-index:-1;">
        欢迎词库<a class="am-btn am-btn-primary am-fr am-radius" onClick="$('#file').trigger('click');"><i
                    class="am-icon-plus"></i> 导入欢迎词</a>
    </div>
    <div class="tpl-portlet-components">
        <div class="portlet-title tpl-index-tabs">
            <button type="button" class="delete-all am-btn am-btn-default am-btn-danger am-btn-xs am-margin-top-xs"><span
                        class="am-icon-trash-o"></span> 删除
            </button>
            <div class="tpl-portlet-input tpl-fz-ml">
                <div class="portlet-input input-inline">
                    <div class="am-input-group am-input-group-sm">
                        <input value="<?=$keyword?>" id='keyword' type="text" class="am-form-field" placeholder="请输入欢迎词内容进行搜索">
                        <span class="am-input-group-btn">
                                    <button class="am-btn  am-btn-default am-btn-primary am-icon-search" type="button" onclick="location.href='<?php echo \yii\helpers\Url::to(['welcome/index']) ?>&keyword='+$('#keyword').val()"></button>
                                </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="tpl-block">

            <div class="am-g am-g-collapse">
                <div class="am-u-sm-12">
                    <form class="am-form">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th class="table-check"><input type="checkbox" class="check-all tpl-table-fz-check">
                                </th>
                                <th class="">编号</th>
                                <th class="">欢迎词内容</th>
                                <th class="">导入时间</th>
                                <th class="">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list as $k=>$v):?>
                            <tr>
                                <td><input id="<?=$v['id']?>" type="checkbox"></td>
                                <td><?=$v['id']?></td>
                                <td><?=$v['content']?></td>
                                <td><?=date('Y-m-d H:i:s',$v['created_at'])?></td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="delete am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="am-cf">
                            <div class="am-fr">
                                <?=\app\lib\Common::getDisplayPagination($pagination)?>
                            </div>
                        </div>
                        <hr>
                    </form>
                </div>

            </div>
        </div>
        <div class="tpl-alert"></div>
    </div>


</div>
<script>
    $('#file').change(function () {
        var formData = new FormData();
        var file = this.files[0];
        console.log(file);
        formData.append('file', file);
        //var reader = new FileReader();
        //reader.readAsText(file, 'utf-8');
        //reader.onload = function (eve) {
        //    var fileString = eve.target.result;
            $.ajax({
                url: "<?=\yii\helpers\Url::to(['welcome/import'])?>",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    alert(data.msg);
                    location.reload();
                }
            })
        //}

    })
    $('.delete').click(function () {
        var id = $(this).parents('tr').find('input[type=checkbox]').attr('id');
        $.ajax({
            'url': "<?php echo \yii\helpers\Url::to(['welcome/delete'])?>",
            'data': 'id=' + id,
            'dataType': 'json',
            'success': function (data) {
                if (data.code == 0) {
                    alert('删除成功');
                    location.reload();
                } else {
                    alert(data.msg);
                }
            }
        })
    })
    $('.delete-all').click(function () {
        ids = [];
        $('input[type=checkbox]:checked').each(function (k, v) {
            if (v.id)
                ids.push(v.id)
        });
        idsStr = ids.join(',')
        $.ajax({
            'url': "<?php echo \yii\helpers\Url::to(['welcome/delete-all'])?>",
            'data': 'ids=' + idsStr,
            'dataType': 'json',
            'success': function (data) {
                if (data.code == 0) {
                    alert('删除成功');
                    location.reload();
                } else {
                    alert(data.msg);
                }
            }
        })
    });
    $('.check-all').click(function () {
        $('input:checkbox').not('.check-all').prop('checked', $('.check-all').prop('checked'));
    })
</script>