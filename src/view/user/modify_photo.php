<section class="col-md-12 	col-sm-12 col-xl-12 col-sm-12" style="padding: 10px">
    <div>
        <form action="{url user modify_photo _vendor=1}" method="post" id="form" data-form="1">
            <input type="hidden" id="path" value="" name="path">
            <div style="display: none">
                <input type="submit" id="submit">
            </div>
        </form>
        <div>
            <small style="color: #c69500">文件格式为.jpg .png .gif,大小限制2M</small>
        </div>
        <div style="color: red" id="msg"></div>
        <input type="file" id="pic" onchange="upload_show()"><br><br>
        <div>
            <img src="" id="img" style="width: 150px;">
        </div>
        <button type="submit"
                onclick="upload()"
                class="btn btn-sm btn-outline-success">
            <i class="fa fa-check" aria-hidden="true"></i>
            上传
        </button>
        <button type="reset"
                onclick="removeImg()"
                class="btn btn-sm btn-outline-warning">
            <i class="fa fa-reply-all" aria-hidden="true"></i>
            重选
        </button>
    </div>


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
                'url': '?app=user@modify_photo&_vendor=1',
                'type': 'post',
                'data': fm,
                'contentType': false,
                'processData': false,
                success: function (res) {
                    if (res.code == 200) {
                        $('#path').attr('value', res.path);
                        $('#submit').click();
                    } else {
                        $('#msg').text(res.msg);
                    }
                }
            })
        }
    </script>
</section>