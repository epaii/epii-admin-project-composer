<div class="col-6">
    <form role="form" method="post" data-form="1" action="{url nodelist add _vendor=1}">

        <div class="form-group">
            <label>节点名称：</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label>唯一标识：</label>
            <input type="text" class="form-control" name="slug" required>
        </div>
        <label for="class">父节点：</label><br>
        <select class="selectpicker" id="class" name="pid">
            <option value="0">无</option>
            <?php foreach($list as $k=>$v){?>
            <option value="{$v['id']}">{$v['name']}</option>
            <?php }?>
        </select>
        <div class="form-group">
            <label>图标：</label>
            <input type="text" class="form-control" name="icon" required placeholder="如: fa fa-circle-o">
        </div>
        <div class="form-group">
            <label>链接地址：</label>
            <input type="text" class="form-control" name="url" placeholder="如: nodelist/index/showhtml,没有父级不填">
        </div>
        <div class="form-group">
            <label>备注：</label>
            <input type="text" class="form-control" name="remark">
        </div>
        <div class="form-group">
            <label>状态：</label>
            <select class="selectpicker"  name="status" required>
                <option value="0">未启用</option>
                <option value="1">启用</option>
            </select>
        </div>
        <div class="form-group">
            <label>排序：</label>
            <input type="text" class="form-control" name="sort" placeholder="释: 数字越大越靠后">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </form>
</div>