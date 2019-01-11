
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
        <a class="btn btn-info  btn-outline-info btn-table-tool btn-dialog" href="{url rolelist add _vendor=1}" data-area="70%,70%" title="新增角色">新增</a>
    </div>
    <div class="card-body table-responsive" style="padding-top: 0px">
        <table data-table="1" data-url="{url rolelist ajaxdata _vendor=1}" id="table1" class="table table-hover">
            <thead>
            <tr>
                <th data-field="id" data-formatter="epiiFormatter">ID</th>
                <th data-field="name" data-formatter="epiiFormatter">角色名称</th>
                <th data-field="slug" data-formatter="epiiFormatter">唯一标志</th>
                <th data-field="status" data-formatter="epiiFormatter">状态</th>
                <th data-formatter="epiiFormatter.btns" data-btns="edit,del,btn1"
                    data-edit-url="{url rolelist edit _vendor=1}&id={id}" data-edit-title="编辑：{name}"
                    data-del-url="{url rolelist del _vendor=1}&id={id}" data-del-title="删除：{name}"

                >操作
                </th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    function btn1(field_value, row, index,field_name) {

        return "<a class='btn btn-outline-success btn-sm btn-dialog'   data-area='60%,60%' href='?app=rolelist@power&_vendor=1&id="+row.id+"+'><i class='fa fa-pencil-square-o' ></i>权限</a>";
    }
</script>