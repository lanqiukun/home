<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">

    @include('admin._css')

    <title>新增用户</title>
</head>

<body>
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i>
        首页 <span class="c-gray en">&gt;</span>
        用户管理 <span class="c-gray en">&gt;</span>
        新增用户
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    <article class="page-container">
        @include('admin.common.validate')
        @include('admin.common.msg')

        <form action="{{ route('admin.user.create') }}" method="post" class="form form-horizontal" id="form-member-add">
            @csrf

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('username') }}" placeholder="" id="username" name="username">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>真实姓名：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('truename') }}" placeholder="" id="truename" name="truename">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>密码：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="password" class="input-text" autocomplete="off" value="{{ old('password') }}" placeholder="" id="password" name="password">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="password" class="input-text" autocomplete="off" value="{{ old('password_confirmation') }}" placeholder="" id="password_confirmation" name="password_confirmation">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
                <div class="formControls col-xs-8 col-sm-6 skin-minimal">
                    <div class="radio-box">
                        <input name="sex" type="radio" value="先生" id="sex-1" checked>
                        <label for="sex-1">先生</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="sex-2" value="女士" name="sex">
                        <label for="sex-2">女士</label>
                    </div>

                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('phone') }}" placeholder="" id="phone" name="phone">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="email" class="input-text" autocomplete="off" placeholder="@" value="{{ old('email') }}" name="email" id="email">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色：</label>
                <div class="formControls col-xs-8 col-sm-6 skin-minimal">
                    @foreach ($all_role as $item)
                    <div class="radio-box">
                        <input name="role_id" type="radio" value="{{$item->id}}" id="role{{$item->id}}" checked>
                        <label for="role{{$item->id}}">{{ $item->name }}</label>
                    </div>
                    @endforeach
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
                username: {
                    required: true,
                    minlength: 2,
                    maxlength: 16
                },
                truename: {
                    required: true,
                    minlength: 2,
                    maxlength: 16
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 16
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    maxlength: 16,
                    equalTo: "#password"
                },
                sex: {
                    required: true,
                },
                phone: {
                    required: true,
                    isMobile: true,
                },
                email: {
                    required: true,
                    email: true,
                },
            },
            messages: {
                password: {
                    minlength: "你太短了，至少要8位",
                },
                password_confirmation: {
                    equalTo: "两次输入的密码不一致"
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