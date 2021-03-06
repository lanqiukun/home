<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">


    @include('admin._css')


    <title>房源属性列表</title>
</head>

<body>

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span> 房源属性管理
        <span class="c-gray en">&gt;</span> 房源属性列表
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>

    @include('admin.common.validate')
    @include('admin.common.msg')
    <div id="app" class="page-container">

        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="{{ route('admin.houseattr.create') }}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加房源属性</a>
            </span>
            <span class="r">共有数据：<strong v-cloak>@{{ total }}</strong> 条</span> </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                    <tr class="text-c">

                        <th width="80">#</th>
                        <th width="130">属性名称</th>
                        <th width="120">数据库字段</th>
                        <th width="110">图标</th>
                        <th width="120">创建时间</th>
                        <th width="120">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($houseattr as $key => $item)
                 
                    <tr class="text-c" v-if="!removed_items.includes({{ $item['id'] }})">
                        <td>{{ $key + 1 }}</td>
                        <td class="text-l">
                            {!! $item['html'] !!}
                            {{ $item['name'] }}
                        </td>
                        <td>{{ $item['field_name'] }}</td>

                        <td><img src="{{ $item['icon'] }}" width="50"></td>

                        <td>{{ $item['created_at']}}</td>
                        <td class="td-manage">
                            <a class="label label-primary radius" href="{{ route('admin.houseattr.update', ['houseattr' => $item['id']]) }}">
                                编辑
                            </a>

                            <a class="label label-danger radius" href="{{ route('admin.houseattr.delete', ['houseattr' => $item['id']]) }}"  v-on:click.prevent="delete_target">
                                删除
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

</body>
@include('admin._js')


<script>
    var app = new Vue({
        el: "#app",
        data: {
            total: '{{ $total }}',
            removed_items: [],
            checked_items: []
        },
        methods: {
            delete_target: function(e) {
                let url = e.target.href;
                // let url = "http://home.com/post"

                axios.delete(url, {

                }).then((res) => {

                    let code = res.data.code;
                    let target = res.data.target;
                    if (code == 0) {
                        
                        this.removed_items.push(target)
                    } else {
                        alert(res.data.msg)
                    }

                }).catch(function(err) {
                    console.log(err)
                })
            }
        },
        watch: {
            checked_items: function(n, o) {

            }
        },

    })
</script>


</html>