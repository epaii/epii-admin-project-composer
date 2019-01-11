<section class="content" style="padding: 10px">

    <div class="content">
        <div class="card-body table-responsive" style="padding-top: 0px">
            <a class="btn btn-info  btn-outline-info btn-table-tool btn-dialog" href="{url config add _vendor=1}" data-area="70%,70%" title="新增配置">新增配置</a>
        </div>
        <div class="card-body table-responsive" style="padding-top: 0px">
            <table data-table="1" data-url="{url config ajaxdata _vendor=1}" id="table1" class="table table-hover">
                <thead>
                <tr>

                    <th data-field="id" data-formatter="epiiFormatter">ID</th>
                    <th data-field="name" data-formatter="epiiFormatter">属性</th>
                    <th data-field="value" data-formatter="epiiFormatter">值</th>
<!--                    <th data-field="addtime" data-formatter="epiiFormatter">添加时间</th>-->
                    <th data-field="type" data-formatter="epiiFormatter">类型</th>
                    <th data-field="tip" data-formatter="epiiFormatter">提示</th>
                    <th data-formatter="epiiFormatter.btns" data-btns="edit,del"
                        data-edit-url="{url config edit _vendor=1}&id={id}" data-edit-title="编辑：{name}"
                        data-del-url="{url config del _vendor=1}&id={id}" data-del-title="删除：{name}"
                    >操作
                    </th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

</section>