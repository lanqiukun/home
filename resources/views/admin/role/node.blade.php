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

    <title>查看节点</title>
    <script src="/axios.min.js"></script>
    <script src="/vue.js"></script>
</head>

<body>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 
    首页 <span class="c-gray en">&gt;</span> 
    管理员管理 <span class="c-gray en">&gt;</span> 
    角色管理 <span class="c-gray en">&gt;</span> 
    查看节点 
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
    <i class="Hui-iconfont">&#xe68f;</i>
</a>
</nav>
    <article  class="page-container">
        @include('admin.common.validate')
        @include('admin.common.msg')

        <form action="{{ route('admin.role.change_node', $role) }}" method="post" class="form form-horizontal" id="form-member-add">
            @method('PATCH')
            @csrf
            
            @foreach ($all_node as $item)
                <div>
                    <input name='nodes[]' type="checkbox" id="node{{ $item['id'] }}" value="{{$item['id']}}"  style="cursor: pointer" @if(in_array($item['id'], $has_node)) checked @endif>
                    <label for="node{{ $item['id'] }}"  style="cursor: pointer">
                        {{$item['html']}}{{$item['name']}}
                    </label>
                </div>

            @endforeach
 

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
    
    <!--/请在上方写此页面业务相关的脚本-->
</body>

</html>