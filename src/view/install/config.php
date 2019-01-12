<form class="form-horizontal " data-form="1" style="margin-top: -20px">
    <div class="card-body">
        <div class="form-group row">
            <label for="hostname" class="col-sm-2 control-label">数据库Ip:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="hostname" placeholder="hostname" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="username" class="col-sm-2 control-label">数据库用户:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" placeholder="username" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 control-label">数据库密码:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" placeholder="password" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="database" class="col-sm-2 control-label">数据库名称:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="database" placeholder="database" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="prefix" class="col-sm-2 control-label">表前缀:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="prefix" placeholder="prefix" value="epii_" required>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div style="text-align: center;">
        <div style="width: 40%;margin: auto"><button type="submit" class="btn btn-block  btn-outline-primary btn-lg"   data-area="50%,70%" data-title="配置">下一步</button></div>


    </div>
    <!-- /.card-footer -->
</form>