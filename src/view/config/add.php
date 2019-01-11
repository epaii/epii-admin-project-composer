<div class="col-12">
    <div class="card card-default">

        <div class="card-body" style="width: 50%;">
            <form role="form"
                  method="post"
                  data-form="1"
                  action="{url config add _vendor=1}" >

                    <div class="form-group">
                        <label>属性</label>
                        <input type="text" class="form-control" name="name"  >
                    </div>
                    <div class="form-group">
                        <label>值</label>
                        <input type="text" class="form-control" name="value"  >
                    </div>


                <div class="form-group">
                    <label>提示</label>
                    <input type="text" class="form-control" name="tip"  >

                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">提交</button>
                    <button type="reset" class="btn btn-default">重置</button>
                </div>
            </form>
        </div>
    </div>
</div>