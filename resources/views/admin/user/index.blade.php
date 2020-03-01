<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/pagination.css" />
    <script src="/axios.min.js"></script>
    <script src="/vue.js"></script>

    <style>
        [v-cloak]{
            display: none;
        }
    </style>
    <title>用户列表</title>
</head>

<body>

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理
        <span class="c-gray en">&gt;</span> 管理员列表
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div id="app" class="page-container">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
            <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a v-on:click.prevent="delete_all" class="btn btn-danger radius">
                    <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
                </a>
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a>
                <a href="{{ route('admin.user.trashed') }}" class="btn btn-secondary radius"><i class="Hui-iconfont">&#xe600;</i> 恢复管理员</a>

            </span>
            <span class="r">共有数据：<strong  v-cloak>@{{ total }}</strong> 条</span> </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                    <tr class="text-c">
                        <th width="50">
                            <div class="label label-secondary radius" style="cursor: pointer" v-on:click="toggle">全选</div>
                        </th>
                        <th width="30">ID</th>
                        <th width="70">用户名</th>
                        <th width="100">账号</th>
                        <th width="70">角色</th>
                        <th width="40">性别</th>
                        <th width="90">手机</th>
                        <th width="150">邮箱</th>
                        <th width="130">加入时间</th>
                        <th width="70">状态</th>
                        <th width="100">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user_data as $user)
                    <tr class="text-c" v-if="!removed_items.includes({{$user->id}})">
                        <td>
                            @if ( auth() -> user() -> id != $user-> id)
                            <input type="checkbox" value="{{ $user->id }}" name="targets[]" v-model="checked_items">
                            @endif
                        </td>

                        <td>{{ $user->id}}</td>
                        <td>{{ $user->truename }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->sex }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }} </td>
                        <td>{{ $user->created_at }}</td>
                        <td class="td-status">
                            @if ($user -> deleted_at)
                            <span class="label label-danger radius">已删除</span>
                            @else
                            <span class="label label-success radius">已启用</span>
                            @endif
                        </td>
                        <td class="td-manage">

                            @if ( auth() -> user() -> id != $user-> id)


                            <a class="label label-primary radius" href="{{ route('admin.user.role', $user) }}" >
                                修改角色
                            </a>

                            <a class="label label-danger radius" href="{{ route('admin.user.delete', ['target' => $user->id]) }}" v-on:click.prevent="delete_target">
                                删除
                            </a>
                            @else
                            <a class="label label-warning radius" href="{{ route('admin.user.profile') }}" >
                                编辑
                            </a>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="pagination">
            {{ $user_data -> links() }}
        </div>
    </div>
    <!--_footer 作为公共模版分离出去-->
    <script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
    <!--/_footer 作为公共模版分离出去-->

    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>



    <script>
        var app = new Vue({
            "el": "#app",
            data: {
                total: {{ $total }},
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
                },
                toggle: function(e) {
                    let items = document.querySelectorAll("input[name='targets[]']")

                    if (this.checked_items.length < items.length) {

                        for (let i of items)
                            if (!i.checked) 
                                i.click();

                    } else {

                        for (let i of items)
                            i.click();
                    }

                },
                delete_all(e) {
                    console.log(this.checked_items)
                    if (this.checked_items.length) {
                        let url = "{{ route('admin.user.delete_all') }}"
                        axios.delete(url, {
                            params: {
                                targets: this.checked_items
                            }
                        }).then((res) => {
                            
                            for (var i of this.checked_items)
                                this.removed_items.push(parseInt(i))

                            this.total -= this.checked_items.length

                            this.checked_items = []

                        }).catch((err) => {
                            console.log(err)
                        })
                        
                    }

                }


            },
            watch: {
                checked_items: function(n, o) {
                    
                }
            },

        })
    </script>

</body>

</html>