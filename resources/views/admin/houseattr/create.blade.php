<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    @include('admin._css')

    <title>新增房源属性</title>


    <style>
        .avatar-uploader .el-upload {
            border: 1px dashed #d9d9d9;
            border-radius: 6px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .avatar-uploader .el-upload:hover {
            border-color: #409EFF;
        }

        .avatar-uploader-icon {
            font-size: 28px;
            color: #8c939d;
            width: 178px;
            height: 178px;
            line-height: 178px;
            text-align: center;
        }

        .avatar {
            width: 178px;
            height: 178px;
            display: block;
        }
    </style>


</head>

<body>
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i>
        首页 <span class="c-gray en">&gt;</span>
        房源属性管理 <span class="c-gray en">&gt;</span>
        新增房源属性
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    <article class="page-container">
        @include('admin.common.validate')
        @include('admin.common.msg')

        <form action="{{ route('admin.houseattr.create') }}" method="post" class="form form-horizontal" id="form-member-add">
            @csrf
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>层级：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <span class="select-box">
                        <select name="pid" class="select">
                            <option value="0">顶级</option>
                            @foreach ($data as $item)
  
                            <option value="{{ $item['id'] }}" @if ($item['id']  == session('operating_pid')) selected @endif>{!! $item['html'] !!}{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>属性名称: </label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('name') }}" placeholder="" id="name" name="name">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">数据库字段: </label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('field_name') }}" placeholder="" id="field_name" name="field_name">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">属性图标: </label>
                <div  id="app" class="formControls col-xs-8 col-sm-6 skin-minimal">

                    <el-upload class="avatar-uploader" 
                                action="{{ route('admin.houseattr.houseattr_icon') }}" 
                                name="attr_icon"
                                :show-file-list="false" 
                                :on-success="handleAvatarSuccess" 
                                :headers="headers"
                                :before-upload="beforeAvatarUpload">
                        <img v-if="imageUrl" :src="imageUrl" class="avatar">
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                    <input type="hidden" name="icon" :value="icon_url">

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

                name: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "请输入属性名称",
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

    var app = new Vue({
        el: '#app',
        data: {
            imageUrl: '',
            icon_url: "{{ config('admin_upload.houseattr_default_icon') }}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },

        methods: {
            handleAvatarSuccess(res, file) {
                this.imageUrl = URL.createObjectURL(file.raw);
                this.icon_url = res;
            },
            beforeAvatarUpload(file) {
                const isJPG = file.type === 'image/jpeg';
                const isPNG = file.type === "image/png";
                const isLt1M = file.size / 1024 / 1024 < 1;

                if (!(isJPG || isPNG)) {
                    this.$message.error('上传图标只能是 JPG 或 PNG格式!');
                }
                if (!isLt1M) {
                    this.$message.error('上传图标大小不能超过 1MB!');
                }

                

                return (isJPG || isPNG) && isLt1M;
            }
        }
    })
</script>

</html>