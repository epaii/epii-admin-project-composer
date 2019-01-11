<div class="col-6">
    <form role="form" method="post" data-form="1" action="{url rolelist edit _vendor=1}">

        <div class="form-group">
            <label>角色名称：</label>
            <input type="text" class="form-control" name="name" value="{$role.name}" required placeholder="请输入角色名称">
        </div>
        <div class="form-group">
            <label>唯一标志：</label>
            <input type="test" class="form-control" name="slug" value="{$role.slug}" required placeholder="请输入唯一标志">
        </div>
        <div class="form-group">
            <label for="class">状态：</label><br>
            <select class="selectpicker" id="class" name="status">
                <option value="0"  <?php if ($role['status']==0){?>selected="selected" <?php }?>>未启用</option>
                <option value="1"  <?php if ($role['status']==1){?>selected="selected"<?php }?>>启用</option>
            </select>
        </div>

        <div class="form-group">
            <input type="hidden" name="id" value="{$id}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </form>
</div>