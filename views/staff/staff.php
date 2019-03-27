<div class="tpl-content-wrapper">
    <div class="tpl-content-page-title">
        员工管理<a class="am-btn am-btn-primary am-fr am-radius" href="<?php echo \yii\helpers\Url::to(['staff/add']) ?>"><i
                    class="am-icon-plus"></i> 创建员工</a>
    </div>
    <div class="tpl-portlet-components">
        <div class="portlet-title tpl-index-tabs">
            <button type="button" class="delete-all am-btn am-btn-default am-btn-danger am-btn-xs am-margin-top-xs">
                <span class="am-icon-trash-o"></span> 删除
            </button>
            <div class="tpl-portlet-input tpl-fz-ml">
                <div class="portlet-input input-inline">
                    <div class="am-input-group am-input-group-sm">
                        <input name="username" type="text" class="am-form-field" placeholder="请输入员工姓名进行搜索"
                               value="<?php echo $username ?>">
                        <span class="am-input-group-btn">
            <button class="am-btn am-btn-default am-btn-primary am-icon-search" type="button"
                    onclick="location.href='<?php echo \yii\helpers\Url::to(['staff/index']) ?>&username='+$('input[name=username]').val() + '&department='+$('#department').val()"></button>
          </span>
                    </div>
                </div>
            </div>
            <div class="tpl-portlet-input tpl-fz-ml">
                <div class="portlet-input input-inline">
                    <select id='department' name='department'
                            data-am-selected="{btnWidth: '100%',btnSize: 'sm',placeholder: '请选择部门'}">
                        <?php foreach ($departmentList as $k => $v): ?>
                            <option value="<?php echo $k ?>"
                                    <?php if ($department == $k): ?>selected<?php endif ?>><?php echo $v ?></option>
                        <?php endforeach; ?>
                    </select>
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
                                <th class="table-check"><input type="checkbox" class="tpl-table-fz-check check-all">
                                </th>
                                <th class="">编号<?=$params['by']?></th>
                                <th class=""><a
                                            href="<?php echo \yii\helpers\Url::to(array_merge(['staff/index'], $params, ['order' => 'username','by' => ($params['by'] == 'desc' ? 'asc' : 'desc')])) ?>">员工ID
                                        <span
                                                class="am-icon-long-arrow-<?=$params['by'] == 'asc' ? 'up' : 'down'?>"></span></a></th>
                                <th class="">员工姓名</th>
                                <th class="">所属部门</th>
                                <th class="">岗位</th>
                                <th class="">权限</th>
                                <th class="">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($list as $k => $v): ?>
                                <tr>
                                    <td><input id="<?= $v['id'] ?>" value="<?php echo $v['id'] ?>" type="checkbox"></td>
                                    <td><?= $v['id'] ?></td>
                                    <td><?= $v['username'] ?></td>
                                    <td><?= $v['realname'] ?></td>
                                    <td><?= $departmentList[$v['department']] ?></td>
                                    <td><?= $v['position'] ?></td>
                                    <td><?= $levels[$v['level']] ?></td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="<?php echo \yii\helpers\Url::to(['staff/detail', 'id' => $v['id']]) ?>"
                                                   class="am-btn am-btn-default am-btn-xs am-text-primary"><span
                                                            class="am-icon-file-text-o"></span> 查看详情</a>
                                                <a class="delete am-btn am-btn-default am-btn-xs am-text-danger"><span
                                                            class="am-icon-trash-o"></span> 删除</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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
    $('.delete').click(function () {
        var id = $(this).parents('tr').find('input[type=checkbox]').val();
        $.ajax({
            'url': "<?php echo \yii\helpers\Url::to(['staff/delete'])?>",
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
            'url': "<?php echo \yii\helpers\Url::to(['staff/delete-all'])?>",
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