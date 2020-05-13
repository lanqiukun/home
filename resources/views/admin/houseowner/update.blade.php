<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    @include('admin._css')

    <title>更新房东信息</title>

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
        房东管理 <span class="c-gray en">&gt;</span>
        更新房东信息
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    <article class="page-container">
        @include('admin.common.validate')
        @include('admin.common.msg')
        <form action="{{ route('admin.houseowner.update', $houseowner) }}" method="post" class="form form-horizontal" id="form-member-add">
            @csrf


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ $houseowner->name }}" placeholder="" id="name" name="name">
                </div>
            </div>



            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">性别：</label>
                <div class="formControls col-xs-8 col-sm-6 skin-minimal">
                    <div class="radio-box">
                        <input name="sex" type="radio" value=1 id="sex-1" @if ($houseowner->sex == '先生') checked @endif>
                        <label for="sex-1">先生</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="sex-2" value=0 name="sex" @if ($houseowner->sex == '女士') checked @endif>
                        <label for="sex-2">女士</label>
                    </div>

                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">年龄：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="number" class="input-text" autocomplete="off" value="{{ $houseowner->age }}" placeholder="" id="age" name="age">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="on" value="{{ $houseowner->phone }}" placeholder="" id="phone" name="phone">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">身份证号：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ $houseowner->card }}" placeholder="" id="card" name="card">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>地址：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ $houseowner->address }}" placeholder="" id="address" name="address">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>身份证正面照片：</label>
                <div class="formControls col-xs-8 col-sm-6" id="app">
                    <el-upload class="avatar-uploader" action="{{ route('admin.houseowner.houseowner_pic') }}" 
                    name="houseowner_pic" 
                    :show-file-list="false" 
                    :on-success="handleAvatarSuccess" 
                    :headers="headers" :before-upload="beforeAvatarUpload">
                        <img v-if="imageUrl" :src="imageUrl" class="avatar">
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                    <input type="hidden" name="pic" :value="pic_url">

                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">邮箱：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="email" class="input-text" autocomplete="off" placeholder="@" value="{{ $houseowner->email }}" name="email" id="email">
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
    var app = new Vue({
        el: '#app',
        data: {
            imageUrl: '{{ $houseowner->pic }}',
            pic_url: '{{ $houseowner->pic }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },

        methods: {
            handleAvatarSuccess(res, file) {
                this.imageUrl = URL.createObjectURL(file.raw);
                this.pic_url = res;
                console.log(res)
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