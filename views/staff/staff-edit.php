<div class="tpl-content-wrapper">
    <div class="tpl-content-page-title">
        修改员工基本信息
    </div>
    <div class="tpl-portlet-components">

        <div class="tpl-block">

            <div class="am-g tpl-amazeui-form">

                <div class="am-u-sm-12 am-u-md-10">
                    <form class="am-form am-form-horizontal validform"
                          action="<?= \yii\helpers\Url::to(['staff/edit']) ?>" method="post">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">员工姓名</label>
                            <div class="am-u-sm-9 am-form-text"><?= $user['realname'] ?></div>
                        </div>

                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">员工ID</label>
                            <div class="am-u-sm-9 am-form-text"><?= $user['username'] ?></div>
                        </div>

                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">首次登录密码</label>
                            <div class="am-u-sm-9">
                                <input name="password" type="text" class="am-form-field am-radius" placeholder="首次登录密码"
                                       autocomplete="off" datatype="*" nullmsg="请填写首次登录密码" errormsg="请填写首次登录密码">
                                <small class="Validform_checktip"></small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">所属部门</label>
                            <div class="am-u-sm-9">
                                <select name="department" class="am-form-field am-radius" datatype="*" nullmsg="请选择所属部门"
                                        errormsg="请选择所属部门">
                                    <option>请选择所属部门</option>
                                    <?php foreach ($departmentList as $k => $v): ?>
                                        <option value="<?= $k ?>"
                                                <?php if ($k == $user['department']): ?>selected <?php endif; ?>><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="Validform_checktip"></small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">岗位</label>
                            <div class="am-u-sm-9">
                                <input name="position" value="<?= $user['position'] ?>" type="text"
                                       class="am-form-field am-radius" placeholder="岗位" autocomplete="off" datatype="*"
                                       nullmsg="请填写岗位" errormsg="请填写岗位">
                                <small class="Validform_checktip"></small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">权限</label>
                            <?php if ($user['username'] == 'admin'): ?>
                            <div class="am-u-sm-9 am-form-text">
                                <?= $levels[$user['level']] ?>
                                <?php else: ?>
                                <div class="am-u-sm-9 ">
                                    <select name="level" class="am-form-field am-radius" datatype="*" nullmsg="请选择权限星级"
                                            errormsg="请选择权限星级">
                                        <option>请选择权限星级</option>
                                        <?php foreach ($levels as $k => $v): ?>
                                            <option value="<?= $k ?>"
                                                    <?php if ($k == $user['level']): ?>selected <?php endif; ?>><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="Validform_checktip"></small>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary">保存</button>
                                    <button type="reset" class="am-btn">重置</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>

        </div>

    </div>


</div>
