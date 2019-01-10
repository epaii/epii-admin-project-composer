<div class="col-6">
    <form role="form" method="post" data-form="1" action="{url rolelist add _vendor=1}">

        <div class="form-group">
            <label>角色名称：</label>
            <input type="text" class="form-control" name="name" required placeholder="请输入角色名称">
        </div>
        <div class="form-group">
            <label>唯一标志：</label>
            <input type="test" class="form-control" name="slug" required placeholder="请输入唯一标志">
        </div>
        <div class="form-group">
            <label>用戶昵称：</label>
            <input type="text" class="form-control" name="group_name" required placeholder="请输入用戶昵称">
        </div>
        <div class="form-group">
            <label for="class">节点集合：</label><br>
          {foreach $nodes $k=>$v}
            <input type="checkbox" name="nodes[]" value="{$v.id}">
            {$v.name} <br>
            {/foreach}
        </div>
        <div class="form-group">
            <label for="class">状态：</label><br>
            <select class="selectpicker" id="class" name="status">
                <option value="">111</option>
                <option value="">222</option>
            </select>
        </div>

        <div class="form-group">
            <label>备注：</label>
            <input type="text" class="form-control" name="remark" required placeholder="请输入用戶昵称">
        </div>
        <div class="form-group">
            <label>排序：</label>
            <input type="number" class="form-control" name="sort" required placeholder="请输入用戶昵称">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </form>
</div>