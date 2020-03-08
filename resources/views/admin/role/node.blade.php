<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    
    @include('admin._css')

    <title>查看节点</title>
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

        <form action="{{ route('admin.role.node', $role) }}" method="post" class="form form-horizontal" id="form-member-add">
            @csrf
            
            @foreach ($all_node as $item)
                <div>
                    <input name='nodes[]' type="checkbox" id="node{{ $item['id'] }}" value="{{$item['id']}}"  style="cursor: pointer" @if(in_array($item['id'], $has_node)) checked @endif>
                    <label for="node{{ $item['id'] }}"  style="cursor: pointer">
                        {!! $item['html'] !!}{{$item['name']}}
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


</body>

@include('admin._js')

</html>