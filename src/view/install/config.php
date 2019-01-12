<form class="form-horizontal " data-form="1" style="margin-top: -20px" method="post"  action="?app=install@config">
    <div class="card-body">
        <div class="form-group row">
            <label for="hostname" class="col-sm-2 control-label">数据库Ip:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="hostname" name="hostname" placeholder="hostname" required value="192.168.16.6">
            </div>
        </div>
        <div class="form-group row">
            <label for="hostport" class="col-sm-2 control-label">端口号:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="hostport" name="hostport" placeholder="hostport" value="3306" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="username" class="col-sm-2 control-label">数据库用户:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="username" required value="epii_db_user">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 control-label">数据库密码:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="password"  name="password" placeholder="password" required value="Pg6oWIbyfRuT5Qmw">
            </div>
        </div>
        <div class="form-group row">
            <label for="database" class="col-sm-2 control-label">数据库名称:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="database" name="database" placeholder="database" required value="epii1">
            </div>
        </div>
        <div class="form-group row">
            <label for="prefix" class="col-sm-2 control-label">表前缀:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="prefix" name="prefix" placeholder="prefix" value="epii_" required>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div style="text-align: center;">
        <div style="width: 40%;margin: auto"><button type="submit" class="btn btn-block  btn-outline-primary btn-lg"   data-area="50%,70%" data-title="配置">下一步</button></div>


    </div>
    <!-- /.card-footer -->
</form>