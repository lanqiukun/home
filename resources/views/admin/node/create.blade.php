<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />

    <title>新增节点</title>
    <script src="/axios.min.js"></script>
    <script src="/vue.js"></script>
</head>

<body>
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i>
        首页 <span class="c-gray en">&gt;</span>
        管理员管理 <span class="c-gray en">&gt;</span>
        节点管理 <span class="c-gray en">&gt;</span>
        新增节点
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    <article class="page-container">
        @include('admin.common.validate')
        @include('admin.common.msg')

        <form action="{{ route('admin.node.store') }}" method="post" class="form form-horizontal" id="form-member-add">
            @csrf
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>层级：</label>
                <div class="formControls col-xs-8 col-sm-9"> 
                    <span class="select-box">
                        <select name="pid" class="select">
                            <option value="0">顶级</option>
                            @foreach ($data as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </span> 
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>节点名称: </label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('name') }}" placeholder="" id="name" name="name">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">路由别名: </label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('route') }}" placeholder="" id="route" name="route">
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否为菜单: </label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    <div class="radio-box">
                        <input  name="is_menu" type="radio" value="1" id="is_menu-1">
                        <label for="is_menu-1">是</label>
                    </div>
                    <div class="radio-box">
                        <input  name="is_menu" type="radio" value="0" id="is_menu-2" checked>
                        <label for="is_menu-2">否</label>
                    </div>

                </div>
            </div>


            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
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
                    name: {
                        required: true,
                    },
                },
                messages: {
                    rolename: {
                        required: "请输入节点名称",
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