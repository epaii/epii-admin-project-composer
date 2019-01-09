
<section class="content" style="padding: 10px">
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">搜索</h3>
                </div>
                <div class="card-body">
                    <form role="form" data-form="1" data-search-table-id="1" data-title="自定义标题" >
                        <div class="form-inline">
                            <div class="form-group">
                                <label>角色名称：</label>
                                <input type="text" class="form-control" name="name" placeholder="支持模糊搜索">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">提交</button>
                                <button type="reset" class="btn btn-default">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="content">


    <div class="card-body table-responsive" style="padding-top: 0px">
        <a class="btn btn-info  btn-outline-info btn-table-tool btn-dialog" href="{:url('user/Rolelist/add')}" data-area="70%,70%" title="新增角色">新增</a>
    </div>
    <div class="card-body table-responsive" style="padding-top: 0px">
        <table data-table="1" data-url="{:url('user/Rolelist/ajaxdata')}" id="table1" class="table table-hover">
            <thead>
            <tr>
                <th data-checkbox="true"></th>
                <th data-field="id" data-formatter="epiiFormatter">ID</th>
                <th data-field="name" data-formatter="epiiFormatter">角色名称</th>
                <th data-field="slug" data-formatter="epiiFormatter">唯一标志</th>
                <th data-field="nodes" data-formatter="epiiFormatter">节点集合</th>
                <th data-field="status" data-formatter="epiiFormatter">状态</th>
                <th data-field="remark" data-formatter="epiiFormatter">备注</th>
                <th data-field="sort" data-formatter="epiiFormatter">排序</th>
                <th data-formatter="epiiFormatter.btns" data-btns="edit,del"
                    data-edit-url="{:url('user/Nodelist/edit')}?id={id}" data-edit-title="编辑：{name}"
                    data-del-url="{:url('user/Nodelist/del')}?id={id}" data-del-title="删除：{name}"
                >操作
                </th>
            </tr>
            </thead>
        </table>
    </div>
</div>