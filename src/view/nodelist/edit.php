<div class="col-6">
    <form role="form" method="post" data-form="1" action="{url nodelist edit _vendor=1}">
        <input type="hidden"  value="{$id}" name="id">
        <div class="form-group">
            <label>节点名称：</label>
            <input type="text" class="form-control" name="name" value="{$nodeinfo.name}" placeholder="请输入父节点名称" required>
        </div>
        <label for="class">父节点：</label><br>
        <select class="selectpicker" id="class" name="pid">

            <?php foreach($list as $k=>$v){ ?>
                <option value="0" <?php if($nodeinfo['pid'] ==0){?>selected="selected"<?php } ?>>无</option>
            <option value="{$v['id']}"  <?php if($v['id']==$nodeinfo['pid']){?>selected="selected"<?php } ?>>{$v['name']}</option>
            <?php }?>
        </select>
        <div class="form-group">
            <label>图标：</label>
            <input type="text" class="form-control" name="icon" value="{$nodeinfo.icon}" required placeholder="如: fa fa-circle-o">
        </div>
        <div class="form-group">
            <label>链接地址：</label>
            <input type="text" class="form-control" name="url" value="{$nodeinfo.url}" placeholder="格式:控制器@方法名,如:index@index,没有父级不填">
        </div>
        <div class="form-group">
            <label>备注：</label>
            <input type="text" class="form-control" name="remark" value="{$nodeinfo.remark}" placeholder="请输入备注信息">
        </div>
        <div class="form-group">

            <label>状态：</label>
            <select class="selectpicker"  name="status" required>
                <option value="0"  <?php if ($nodeinfo['status']==0){?>selected="selected" <?php }?>>未启用</option>
                <option value="1"  <?php if ($nodeinfo['status']==1){?>selected="selected"<?php }?>>启用</option>
            </select>
        </div>
        <div class="form-group">
            <label>排序：</label>
            <input type="number" class="form-control" name="sort" value="{$nodeinfo.sort}" placeholder="释: 数字越大越靠后">
        </div>
        <div  class="form-group">
            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox"
                       class="custom-control-input"
                       <?php if($nodeinfo['is_open']){?>
                       checked="checked"
                       <?php }?>
                       name="is_open"
                       value="1"
                       id="is_open">
                <label class="custom-control-label" for="is_open">是否默认打开</label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </form>
</div>