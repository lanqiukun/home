<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">

    @include('admin._css')

    <title>房东列表</title>
</head>

<body>

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 房东管理
        <span class="c-gray en">&gt;</span> 房东列表
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i></a></nav>
            @include('admin.common.validate')
    @include('admin.common.msg')
    <div id="app" class="page-container">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
            <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜房东</button>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="{{ route('admin.houseowner.excel') }}" class="btn btn-success radius"><i class="Hui-iconfont">&#xe600;</i> 导出Excel</a>
                <a href="{{ route('admin.houseowner.create') }}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加房东</a>
                <a href="{{ route('admin.houseowner.trashed') }}" class="btn btn-secondary radius"><i class="Hui-iconfont">&#xe600;</i> 恢复房东</a>

            </span>
            <span class="r">共有数据：<strong v-cloak>@{{ total }}</strong> 条</span> </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                    <tr class="text-c">

                        <th width="30">ID</th>
                        <th width="70">姓名</th>
                        <th width="50">性别</th>
                        <th width="40">年龄</th>
                        <th width="120">手机</th>
                        <th width="180">身份证号码</th>
                        <th width="200">地址</th>
                        <th width="150">身份证照片</th>
                        <th width="150">邮箱</th>
                        <th width="100">加入时间</th>
                        <th width="100">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    
                    <tr class="text-c" v-if="!removed_items.includes({{$item->id}})">


                        <td>{{ $item->id}}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->sex }}</td>
                        <td>{{ $item->age }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->card }}</td>
                        <td>{{ $item->address }} </td>
                        <td><img src="{{ $item->pic }}" alt="" width="40" style="cursor: pointer"> </td>
                        <td>{{ $item->email }} </td>
                        <td>{{ $item->created_at }}</td>

                        <td class="td-manage">


                            @if ( in_array('admin.houseowner.update', session('user_node')))
                            <a class="label label-primary radius" href="{{ route('admin.houseowner.update', $item) }}">
                                修改资料
                            </a>
                            @endif

                            @if ( in_array('admin.houseowner.delete', session('user_node')))

                            <a class="label label-danger radius"  href="{{ route('admin.houseowner.delete', $item) }}" v-on:click.prevent="delete_target">
                                删除
                            </a>
                            @endif
    

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="pagination">
        <el-pagination background layout="prev, pager, next" :total="total" @current-change="current_change" :current-page="current_page">
        </el-pagination>
        </div>
    </div>
</body>

@include('admin._js')


<script>
    var app = new Vue({
        "el": "#app",
        data: {
            total: {{ $total }},
            current_page: {{ $current_page }}, 
            removed_items: [],
            checked_items: []
        },
        methods: {
            current_change(e) {
                window.location.href="/admin/houseowner/index?page=" +e;
            },
            delete_target(e) {
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




        },

    })
</script>



</html>