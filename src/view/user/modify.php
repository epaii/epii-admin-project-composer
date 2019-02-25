<section class="content col-md-8" style="padding: 10px">
    <h3>个人资料</h3>
    <table class="table table-bordered">
        <tr>
            <td>用户头像</td>
            <td> <img src="<?php use think\Db;
                use wangshouwei\session\Session;
                $photo = Db::name('admin')->where('id',Session::get('user_id'))->value('photo');
                echo $photo ?:'/default/admin.jpg'; ?>"

                      style="width: 100px;height: 100px;border-radius: 50%"
                ></td>
            <td><a class="btn btn-default btn-dialog"
                   href="{url user modify_photo _vendor=1}&id={$user.id}"
                   data-area="50%,50%"
                   data-title="修改头像"
                >更换头像</a></td>
        </tr>
        <tr>
            <td>用户名</td>
            <td>{$user.username}</td>
            <td rowspan="5">
                <a class="btn btn-default btn-dialog"
                   href="{url user modify_info _vendor=1}&id={$user.id}"
                   data-area="50%,50%"
                   data-title="更改资料"

                >更改资料</a>
                <a class="btn btn-default btn-dialog"
                   href="{url user modify_pwd _vendor=1}&id={$user.id}"
                   data-area="50%,50%"
                   data-title="更改密码"
                >更改密码</a>
            </td>
        </tr>
        <tr>
            <td>用户昵称</td>
            <td>{$user.group_name}
            </td>
        </tr>

        <tr>
            <td>用户手机号</td>
            <td>{$user.phone}</td>
        </tr>
        <tr>
            <td>用户邮箱</td>
            <td>{$user.email}</td>
        </tr>

        <tr>
            <td>注册时间</td>
            <td>{$user.addtime}</td>

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