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
    <title>文章列表</title>
</head>

<body>

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 文章管理
        <span class="c-gray en">&gt;</span> 文章列表
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div id="app" class="page-container">

        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a v-on:click.prevent="delete_all" class="btn btn-danger radius">
                    <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
                </a>
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a>
                <a href="{{ route('admin.user.trashed') }}" class="btn btn-secondary radius"><i class="Hui-iconfont">&#xe600;</i> 恢复用户</a>

            </span>
            <span class="r">共有数据：<strong  v-cloak></strong> 条</span> </div>
        <div class="mt-20">

            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                    <tr class="text-c">
                        <th width="50">
                            <div class="label label-secondary radius" style="cursor: pointer" v-on:click="toggle">全选</div>
                        </th>
                        <th width="30">ID</th>
                        <th width="170">文章标题</th>
                        <th width="60">状态</th>
                        <th width="130">创建时间</th>
                        <th width="100">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr class="text-c">
                        <td>
                            <input type="checkbox" value="{{ $item->id }}" name="targets[]" v-model="checked_items">    
                        </td>

                        <td>{{ $item->id}}</td>
                        <td>{{ $item->title }}</td>
                        <td>{!! $item->status !!}</td>
                        <td>{{ $item->created_at }}</td>

                        <td class="td-manage">



                            <a class="label label-danger radius" href="{{ route('admin.article.delete', ['target' => $item->id]) }}" v-on:click.prevent="delete_target">
                                删除
                            </a>
       
                            <a class="label label-secondary  radius" href="{{ route('admin.article.update') }}" >
                                编辑
                            </a>


                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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

        $(document).ready(function () {
            $('table.table').DataTable({
                columnDefs: [
                    {
                        targets: [5],
                        orderable: false
                    }
                ]
            });
        })

        var app = new Vue({
            "el": "#app",
            data: {

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


                            this.checked_items = []

                        }).catch((err) => {
                            console.log(err)
                        })
                        
                    }

                }
            }

        })
    </script>

</body>

</html>