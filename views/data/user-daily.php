<div class="tpl-content-wrapper">
    <div class="tpl-content-page-title">
        工作日志
    </div>
    <div class="tpl-portlet-components">
        <div class="portlet-title tpl-index-tabs">
            <?php if($params['department']):?>
            <div class="tpl-portlet-input tpl-fz-ml">
                <div class="portlet-input input-inline">
                    <div class="am-input-group am-input-group-sm">
                        <input name="username" value="<?= $params['username'] ?>" type="text" class="am-form-field"
                               placeholder="请输入员工姓名进行搜索">
                        <span class="am-input-group-btn">
                                    <button onclick="location.href='<?= \yii\helpers\Url::to(['daily/index', 'department' => $params['department']]) ?>&username='+$('input[name=username]').val()+'&content='+$('input[name=content]').val()"
                                            class="am-btn  am-btn-default am-btn-primary am-icon-search"
                                            type="button"></button>
                                </span>
                    </div>
                </div>
            </div>
            <div class="tpl-portlet-input tpl-fz-ml">
                <div class="portlet-input input-inline">
                    <input name="content" value="<?= $params['content'] ?>" type="text" class="am-form-field"
                           placeholder="请输入工作任务进行搜索">
                                                <select id="project-select" data-am-selected="{btnWidth: '100%',btnSize: 'sm',placeholder: '请选择工作完成情况'}">
                                                    <option value="option1">完成</option>
                                                   <option value="option2">延后</option>
												   <option value="option3">取消</option>
                                               </select>
                </div>
            </div>
            <?php endif;?>
        </div>
        <div class="tpl-block">

            <div class="am-g am-g-collapse">
                <div class="am-u-sm-12">
                    <form class="am-form">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th class="">耗时</th>
                                <th class="">工作任务</th>
                                <th class="">工作类别</th>
                                <th class="">工作结果</th>
                                <th class="">记录人</th>
                                <th class="">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($list as $k => $v): ?>
                                <tr>
                                    <td>
                                        <?php foreach ($v['records'] as $rk => $rv): ?>
                                            <div><?=date('Y-m-d H:i:s', $rv['start_time'])?> -- <?=date('Y-m-d H:i:s', $rv['end_time'])?></div>
                                        <?php endforeach; ?>
                                    </td>
                                    <td><?=$v['content']?></td>
                                    <td><?=$v['type']?></td>
                                    <td><?=$results[$v['result']]?></td>
                                    <td><?=$v['realname']?></td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="<?=\yii\helpers\Url::to(['data/user-daily-detail','id'=>$v['id']])?>" class="am-btn am-btn-default am-btn-xs am-text-primary"><span
                                                            class="am-icon-file-text-o"></span> 详情</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="am-cf">
                            <div class="am-fr">
                                <?= \app\lib\Common::getDisplayPagination($pagination) ?>
                            </div>
                        </div>
                        <hr>
                    </form>
                </div>

            </div>
        </div>
        <div class="tpl-alert"></div>
    </div>
<script>
    $('.delete-task').click(function(){
        var id = $(this).attr('id');
        $.ajax({
            url:'<?=\yii\helpers\Url::to(['daily/delete','id'=>''])?>' + id,
            dataType:'json',
            success:function(data) {
                alert(data.msg);
                if(data.code == 200) {
                    location.reload()
                }
            }
        })
    })
</script>

</div>
