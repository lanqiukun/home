<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    @include('admin._css')


    <title>新增文章</title>

</head>

<body>
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i>
        首页 <span class="c-gray en">&gt;</span>
        文章管理 <span class="c-gray en">&gt;</span>
        新增文章
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    <article class="page-container">

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"></label>
            <div class="formControls col-xs-8 col-sm-6">
                @include('admin.common.validate')
                @include('admin.common.msg')
            </div>
        </div>


        <form action="{{ route('admin.article.create') }}" method="post" class="form form-horizontal" id="form-member-add">
            @csrf

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>标题：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('username') }}" placeholder="" id="title" name="title">
                </div>
            </div>




            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>描述：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('truename') }}" placeholder="" id="desc" name="desc">
                </div>
            </div>

            <!-- <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">默认封面：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <img src="/upload/article_cover/default.jpg" alt="..." class="radius">
                </div>
            </div> -->

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">封面：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <img src="{{ config('article_upload.article_default_cover') }}" id="default_cover" class="radius" alt="响应式图片" style="max-width: 300px">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"></label>
                <div class="formControls col-xs-8 col-sm-6">
                    <div id="picker">更换文章封面</div>

                    <input type="hidden" value="{{ config('article_upload.article_default_cover') }}" id="cover" name="cover">

                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">内容：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <textarea name="content" id="editor" cols="30" rows="10"></textarea>
                </div>
            </div>



            <div class="row cl">
                <div class="col-xs-8 col-sm-6 col-xs-offset-4 col-sm-offset-3">
                    <input class="btn btn-primary radius" type="submit" onclick="submit_form(event)" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </article>

</body>
@include('admin.js')

<script type="text/javascript">
    function submit_form() {
        event.preventDefault();

        document.querySelector('form').submit();

    }

    $(document).ready(function() {
        var editor = new Simditor({
            textarea: $('#editor'),
            toolbar: [
                'title',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                'fontScale',
                'color',
                'ol',
                'ul',
                'blockquote',
                'code',
                'table',
                'link',
                'image',
                'hr',
                'indent',
                'outdent',
                'alignment',
            ],

            upload: {
                // 图片上传接口路径
                url: "{{ route('admin.article.article_img') }}",
                // 上传时的附加参数
                params: null,
                // 图片提交key
                fileKey: 'articlt_img',
                // 本地最大同时上传数
                connectionCount: 3,
                // 上传时退出的提示信息
                leaveConfirm: '正在上传中，你确定要退出吗？'
            }

        });

        var uploader = WebUploader.create({
            auto: true,
            swf: '/webuploader/Uploader.swf',
            server: '{{ route("admin.article.article_cover") }}',
            formData: {
                _token: '{{ csrf_token() }}'
            },
            pick: {
                id: '#picker',
                multiple: false,
            },
            fileVal: 'cover',

            resize: true
        });

        uploader.on('uploadSuccess', function(file, res) {
            document.getElementById('cover').value = res._raw;
            document.getElementById('default_cover').src = res._raw;
        });

        uploader.on('uploadError', function(file) {
            alert("上传失败，请重试。");
        });
    })



    $(function() {
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-member-add").validate({
            rules: {
                title: {
                    required: true,
                },
                desc: {
                    required: true,
                },
                cover: {

                },

            },
            messages: {
                title: {
                    required: "请输入文章标题",
                },
                desc: {
                    required: "请输入文章描述",
                }

            },
            onkeyup: false,
            focusCleanup: true,
            success: "valid",
            submitHandler: function(form) {


                form.submit();
            }
        });
    });
</script>


</html>