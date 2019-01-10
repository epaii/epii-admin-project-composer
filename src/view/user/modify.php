<section class="content col-md-8" style="padding: 10px">
    <form role="form"
          data-form="1"
          method="post"
          data-ajax="1"
          action="{url user modify _vendor=1}"
          data-before-submit="confirm"
          data-msg="你确定修改吗?">
    <table class="table">
        <tr>
            <th colspan="2">资料修改</th>
            <th></th>
        </tr>
        <tr>
            <td>用户名</td>
            <td>{$user.username}</td>
        </tr>
        <tr>
            <td>用户昵称</td>
            <td><input type="text" class="form-control" name="group_name" value="{$user.group_name}"
                       required maxlength="50">
            </td>
        </tr>

        <tr>
            <td>用户手机号</td>
            <td><input type="text" class="form-control" name="phone" id="phone" maxlength="11"
                       value="{$user.phone}" ></td>
        </tr>
        <tr>
            <td>用户邮箱</td>
            <td><input type="text" class="form-control" name="email" id="email" maxlength="50"
                       value="{$user.email}" ></td>
        </tr>

        <tr>
            <td>注册时间</td>
            <td>{$user.addtime}</td>

        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-sm btn-outline-success"><i class="fa fa-check"></i>修改</button>
                <button type="reset" class="btn btn-sm btn-outline-warning"><i class="fa fa-reply-all"></i>重置
                </button>
            </td>
            <td></td>
        </tr>
    </table>

        </form>


        <script>

            function getObjectURL(file) {
                var url = null;
                if (window.createObjectURL != undefined) { // basic
                    url = window.createObjectURL(file);
                } else if (window.URL != undefined) { // mozilla(firefox)
                    url = window.URL.createObjectURL(file);
                } else if (window.webkitURL != undefined) { // webkit or chrome
                    url = window.webkitURL.createObjectURL(file);
                }
                return url;
            }

            function upload_show() {
                $('#msg').text('');
                var eImg = $('#img');
                var e = document.getElementById('pic');
                eImg.attr('src', getObjectURL(e.files[0]));
                $(e).after(eImg);
            }

            function removeImg() {
                $('#img').remove();
                $('#pic').val('');
            }

            function upload() {
                var fm = new FormData();
                var file = document.getElementById('pic').files;
                fm.append('file',file[0]);
                $.ajax({
                    'url': '{url user updatePhoto _vendor=1}',
                    'type': 'post',
                    'data': fm,
                    'contentType': false,
                    'processData': false,
                    success: function (res) {
                      /*  if (res.code == 200) {
                            $('#path').attr('value', res.path);
                            $('#submit').click();
                        } else {
                            $('#msg').text(res.msg);
                        }*/
                    }
                })
            }



        </script>

</section>