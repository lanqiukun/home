<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">

    @include('admin._css')

    <title>编辑管理员角色</title>
</head>

<body>
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i>
        首页 <span class="c-gray en">&gt;</span>
        管理员管理 <span class="c-gray en">&gt;</span>
        编辑管理员角色
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    <article class="page-container">
        @include('admin.common.validate')
        @include('admin.common.msg')

        <form method="post" action="{{ route('admin.user.role', $user) }}" class="form form-horizontal" id="form-member-add">
            @csrf

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>角色：</label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    @foreach ($all_role as $item)
                    <div class="radio-box">
                        <input name="role_id" type="radio" value="{{$item->id}}" id="role{{$item->id}}" @if ($item->id == $user->role_id) checked @endif>
                        <label for="role{{$item->id}}">{{ $item->name }}</label>
                    </div>

                    @endforeach
                </div>
            </div>



            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
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
                role: {
                    required: true,
                },
            },
            messages: {
                role: {
                    required: "必须选择角色",
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