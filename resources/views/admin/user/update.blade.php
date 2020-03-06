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

    <title>个人信息</title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>

<body>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 
    首页 <span class="c-gray en">&gt;</span> 
    管理员个人信息
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="{{ route('admin.index') }}" title="返回首页">
    返回首页
    </a>
    
    <a class="btn btn-warning radius r" style="line-height:1.6em;margin-top:3px; margin-right: 10px;" href="{{ route('admin.user.change_password') }}" title="修改密码">
        修改密码
    </a>

    <a class="btn btn-secondary radius r" style="line-height:1.6em;margin-top:3px; margin-right: 10px;" href="javascript: window.location.reload();" title="刷新">
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
    <article class="page-container">
        @include('admin.common.validate')
        @include('admin.common.msg')

        <form action="{{ route('admin.user.update') }}" method="post" class="form form-horizontal" id="form-member-add">
            @csrf
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" disabled class="input-text" autocomplete="off" value="{{ auth()->user()->username }}" placeholder="" id="username" name="username">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>真实姓名：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off"  value="{{ auth()->user()->truename }}" placeholder="" id="truename" name="truename">
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
                <div class="formControls col-xs-8 col-sm-6 skin-minimal">
                    <div class="radio-box">
                        <input name="sex" type="radio" value='先生' id="sex-1" <?php if(auth()->user()->sex == '先生') echo 'checked'; ?>>
                        <label for="sex-1">先生</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="sex-2" value='女士' name="sex" <?php if(auth()->user()->sex == '女士') echo 'checked'; ?>>
                        <label for="sex-2">女士</label>
                    </div>

                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off"  value="{{ auth()->user()->phone }}" placeholder="" id="phone" name="phone">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="email" disabled class="input-text" autocomplete="off"  placeholder="@" value="{{ auth()->user()->email }}" name="email" id="email">
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
        $(function() {
            $('.skin-minimal input').iCheck({
                checkboxClass: 'icheckbox-blue',
                radioClass: 'iradio-blue',
                increaseArea: '20%'
            });

            $("#form-member-add").validate({
                rules: {
                    truename: {
                        required: true,
                        minlength: 2,
                        maxlength: 16
                    },
                    sex: {
                        required: true,
                    },
                    phone: {
                        required: true,
                        isMobile: true,
                    },
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