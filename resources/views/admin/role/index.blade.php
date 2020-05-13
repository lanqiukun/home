<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">

    @include('admin._css')

    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <title>角色列表</title>
</head>

<body>

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理
        <span class="c-gray en">&gt;</span> 角色管理
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div id="app" class="page-container">
        <form method="get" action="{{ route('admin.role.index') }}" class="text-c"> 输入角色
            <input type="text" name="rolename" value="{{ $rolename }}" id="role" class="input-text" autofocus autocomplete="off" style="width:120px;">
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索角色</button>
        </form>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="{{ route('admin.role.create') }}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a>
            </span>
            <span class="r">共有数据：<strong v-cloak>@{{ total }}</strong> 条</span> </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                    <tr class="text-c">

                        <th width="80">ID</th>
                        <th width="100">角色</th>
                        <th width="130">查看节点</th>
                        <th width="120">创建时间</th>
                        <th width="120">修改时间</th>
                        <th width="100">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($role_data as $key => $role)
                    <tr class="text-c" v-if="!removed_items.includes({{$role->id}})">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a class="label label-secondary radius" href="{{ route('admin.role.node', ['role' => $role->id]) }}">
                                查看节点
                            </a>
                        </td>
                        <td>{{ $role->created_at }}</td>

                        <td>{{ $role->updated_at }}</td>

                        <td class="td-manage">
                            <a class="label label-success  radius" href="{{ route('admin.role.update', ['role' => $role->id]) }}">
                                编辑
                            </a>

                            <!-- <a class="label label-danger radius" href="{{ route('admin.role.delete', ['role' => $role->id]) }}"  v-on:click.prevent="delete_target">
                                删除
                            </a> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="pagination">
            {{ $role_data -> links() }}
        </div>
    </div>

</body>
@include('admin._js')

<script>
    var app = new Vue({
        "el": "#app",
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
                        this.total -= 1
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