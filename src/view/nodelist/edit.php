<div class="col-6">
    <form role="form" method="post" data-form="1" action="{url nodelist edit _vendor=1}">
        <input type="hidden" class="form-control" value="{$id}" name="id">
        <div class="form-group">
            <label>节点名称：</label>
            <input type="text" class="form-control" name="name" value="" placeholder="请输入父节点名称" required>
        </div>
        <div class="form-group">
            <label>唯一标识：</label>
            <input type="text" class="form-control" name="slug" value="" placeholder="请输入唯一标识" required>
        </div>
        <label for="class">父节点：</label><br>
        <select class="selectpicker" id="class" name="pid">
            <option value="0">无</option>
            <?php foreach($list as $k=>$v){ ?>
            <option value="{$v['id']}"  <?php if($v['id']==$id){?>selected="selected"<?php } ?>>{$v['name']}</option>
            <?php }?>
        </select>
        <div class="form-group">
            <label>图标：</label>
            <input type="text" class="form-control" name="icon" required placeholder="如: fa fa-circle-o">
        </div>
        <div class="form-group">
            <label>链接地址：</label>
            <input type="text" class="form-control" name="url" value="" placeholder="格式:控制器@方法名,如:index@index,没有父级不填">
        </div>
        <div class="form-group">
            <label>备注：</label>
            <input type="text" class="form-control" name="remark" value="" placeholder="请输入备注信息">
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
        <div  class="form-group">
            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input"  name="is_open" value="1" id="is_open">
                <label class="custom-control-label" for="is_open">是否默认打开</label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </form>
</div>