<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
    <!--/meta 作为公共模版分离出去-->

    <title>新增文章</title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">

    <link rel="stylesheet" type="text/css" href="/simditor/site/assets/styles/simditor.css" />

    <script type="text/javascript" src="/simditor/site/assets/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="/simditor/site/assets/scripts/module.js"></script>
    <script type="text/javascript" src="/simditor/site/assets/scripts/hotkeys.js"></script>
    <script type="text/javascript" src="/simditor/site/assets/scripts/uploader.js"></script>
    <script type="text/javascript" src="/simditor/site/assets/scripts/simditor.js"></script>
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


        <form action="{{ route('admin.article.create') }}" enctype="multipart/form-data" method="post" class="form form-horizontal" id="form-member-add">
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
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('truename') }}" placeholder="" id="description" name="description">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">默认封面：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <img src="/upload/article_cover/default.jpg" alt="..." class="radius">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"></label>
                <div class="formControls col-xs-8 col-sm-6">
                    <span class="btn-upload">  
                        <a href="javascript:void();" class="btn btn-primary radius btn-upload"><i class="Hui-iconfont">&#xe642;</i> 更换封面</a>
                        <input type="file" multiple class="input-file" id="cover" name="cover">
                    </span>
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
                    <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </article>

    <!--_footer 作为公共模版分离出去-->
    <script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
    <!--/_footer 作为公共模版分离出去-->

    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
    <script type="text/javascript">
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
                    description: {
                        required: true,
                    },
                    cover: {
                        
                    },

                },
                messages: {
                    title: {
                        required: "请输入文章标题",
                    },
                    description: {
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
    <!--/请在上方写此页面业务相关的脚本-->
</body>

</html>