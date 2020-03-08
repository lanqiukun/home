<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">

    @include('admin._css')

    <title>个人信息</title>
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
                    <input type="text" class="input-text" autocomplete="off" value="{{ auth()->user()->truename }}" placeholder="" id="truename" name="truename">
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
                <div class="formControls col-xs-8 col-sm-6 skin-minimal">
                    <div class="radio-box">
                        <input name="sex" type="radio" value='先生' id="sex-1" <?php if (auth()->user()->sex == '先生') echo 'checked'; ?>>
                        <label for="sex-1">先生</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="sex-2" value='女士' name="sex" <?php if (auth()->user()->sex == '女士') echo 'checked'; ?>>
                        <label for="sex-2">女士</label>
                    </div>

                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ auth()->user()->phone }}" placeholder="" id="phone" name="phone">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="email" disabled class="input-text" autocomplete="off" placeholder="@" value="{{ auth()->user()->email }}" name="email" id="email">
                </div>
            </div>

            <div class="row cl">
                <div class="col-xs-8 col-sm-6 col-xs-offset-4 col-sm-offset-3">
                    <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </article>

</body>
@include('admin._js')

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


</html>