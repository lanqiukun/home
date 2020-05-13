<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    @include('admin._css')


    <title>新增房源</title>

</head>

<body>
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i>
        首页 <span class="c-gray en">&gt;</span>
        房源管理 <span class="c-gray en">&gt;</span>
        新增房源
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
    <article class="page-container">

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"></label>
            <div class="formControls col-xs-8 col-sm-6">
                @include('admin.common.validate')
                @include('admin.common.msg')
            </div>
        </div>


        <form action="{{ route('admin.house.create') }}" method="post" class="form form-horizontal" id="form-member-add">
            @csrf

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>房源名称：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('name') }}" placeholder="" id="name" name="name">
                </div>
            </div>




            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>小区名称：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('area') }}" placeholder="" id="area" name="area">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">地区：</label>
                <div class="formControls col-xs-2 col-sm-2">
                    <template>
                        <el-select v-model="value0" placeholder="省/直辖市" @change="level0change" name="level0">
                            <el-option v-if="show0waiting" v-html="loading" value=null :disabled="true">
                            </el-option>
                            <el-option v-for="item in leveldata0" :key="item.value" :label="item.label" :value="item.value">
                            </el-option>
                        </el-select>
                    </template>
                </div>
                <div class="formControls col-xs-2 col-sm-2">
                    <template>
                        <el-select v-model="value1" placeholder="市" @change="level1change" name="level1" :disabled="disabledlevel1">
                            <el-option v-if="show1waiting" v-html="loading" value=null :disabled="true">
                            </el-option>
                            <el-option v-for="item in leveldata1" :key="item.value" :label="item.label" :value="item.value">
                            </el-option>
                        </el-select>
                    </template>
                </div>
                <div class="formControls col-xs-2 col-sm-2">
                    <template>
                        <el-select v-model="value2" placeholder="县/区" :disabled="disabledlevel2" name="level2">
                            <el-option v-if="show2waiting" v-html="loading" value=null :disabled="true">
                            </el-option>
                            <el-option v-for="item in leveldata2" :key="item.value" :label="item.label" :value="item.value">
                            </el-option>
                        </el-select>
                    </template>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>详细地址：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" class="input-text" autocomplete="off" value="{{ old('addr') }}" placeholder="" id="addr" name="addr">
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>房屋朝向：</label>
                <div class="formControls col-xs-8 col-sm-2">
                    <template>
                        <el-select v-model="toward" @focus="gethousetowarddata" placeholder="房屋朝向" name="toward">
                            <el-option label="无" value="21" v-if="showdefaulttoward">
                            </el-option>
                            <el-option v-for="item in towards" :key="item.value" :label="item.label" :value="item.value">
                            </el-option>
                        </el-select>
                    </template>
                </div>

                <label class="form-label col-xs-4 col-sm-1"><span class="c-red">*</span>房东：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <template>
                        <el-select v-model="owner" filterable remote reserve-keyword placeholder="房东 姓名/电话" :remote-method="getowner" :loading="searchownerloading">
                            <el-option v-if="waitingowner" v-html="waitingownertext" value=null :disabled="true">
                            </el-option>
                            <el-option v-for="item in owners" :key="item.id" :label="item.name" :value="item.id" :disabled="item.disabled">
                                <span style="float: left">@{{ item.name }}</span>
                                <span style="float: right; color: #8492a6; font-size: 13px">@{{ item.phone }}</span>
                            </el-option>
                        </el-select>
                    </template>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>建筑面积：</label>
                <div class="formControls col-xs-8 col-sm-2">
                    <template>
                        <el-input-number v-model="building_area" name="building_area" :min="1" :max="2000"></el-input-number>
                    </template>
                </div>

                <label class="form-label col-xs-4 col-sm-1"><span class="c-red">*</span>可用面积：</label>
                <div class="formControls col-xs-8 col-sm-1">
                    <template>
                        <el-input-number v-model="available_area" name="available_area" :min="1" :max="2000"></el-input-number>
                    </template>
                </div>
            </div>



            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">建筑时间：</label>
                <div class="formControls col-xs-8 col-sm-2">
                    <template>
                        <el-input-number v-model="built" name="built" :min="1800" :max="2500"></el-input-number>
                    </template>
                </div>

                <label class="form-label col-xs-4 col-sm-1"><span class="c-red">*</span>每月租金：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <template>
                        <el-input-number v-model="rpm" name="rpm" :min="0" :step="50" :max="200000"></el-input-number>
                    </template>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">押几：</label>
                <div class="formControls col-xs-8 col-sm-2">
                    <template>
                        <el-input-number v-model="mortgage" name="mortgage" :min="1" :step="1" :max="14"></el-input-number>
                    </template>
                </div>

                <label class="form-label col-xs-4 col-sm-1">付几：</label>
                <div class="formControls col-xs-8 col-sm-2">
                    <template>
                        <el-input-number v-model="pay" name="pay" :min="1" :step="1" :max="14"></el-input-number>
                    </template>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所处楼层：</label>
                <div class="formControls col-xs-8 col-sm-2">
                    <template>
                        <el-input-number v-model="floor" name="floor" :min="0" :max="2000"></el-input-number>
                    </template>
                </div>

                <label class="form-label col-xs-4 col-sm-1"><span class="c-red">*</span>房间数量：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <template>
                        <el-input-number v-model="bedroom" name="bedroom" :min="0" :max="2000"></el-input-number>
                    </template>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>客厅数量：</label>
                <div class="formControls col-xs-8 col-sm-2">
                    <template>
                        <el-input-number v-model="hall" name="hall" :min="0" :max="2000"></el-input-number>
                    </template>
                </div>

                <label class="form-label col-xs-4 col-sm-1"><span class="c-red">*</span>浴室数量：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <template>
                        <el-input-number v-model="bathroom" name="bathroom" :min="0" :max="2000"></el-input-number>
                    </template>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>配套设施：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <template>
                        <el-checkbox :indeterminate="isIndeterminateFacilities" v-model="checkAllFacilities" @change="handleCheckAllChangeFacilities">全选</el-checkbox>
                        <div style="margin: 15px 0;"></div>
                        <el-checkbox-group v-model="checkedFacilities" @change="handleCheckedFacilitiesChange">
                            <el-checkbox name="facility[]" v-for="item in facilities" :label="item.value" :key="item.label">@{{item.label}}</el-checkbox>
                        </el-checkbox-group>
                    </template>
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>租赁周期：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <template>
                        <div>
                            <el-radio-group v-model="cycle">
                                <el-radio-button v-for="cycle in allcycle" :label="cycle.value" :key="cycle.label">@{{cycle.label}}</el-radio-button>
                            </el-radio-group>
                            <input type="hidden" name="cycle" :value="cycle">
                        </div>
                    </template>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>租赁方式：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <template>
                        <el-checkbox  :checked="item.value == 5" required name="type[]" v-for="item in alltype" :label="item.value" :key="item.label" border>@{{item.label}}</el-checkbox>
                    </template>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>周边：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <template>
                        <el-checkbox :indeterminate="isIndeterminate" v-model="checkAll" @change="handleCheckAllChange">全选</el-checkbox>
                        <div style="margin: 15px 0;"></div>
                        <el-checkbox-group v-model="checkedCities" @change="handleCheckedCitiesChange">
                            <el-checkbox name="position[]" v-for="item in positions" :label="item.value" :key="item.label">@{{item.label}}</el-checkbox>
                        </el-checkbox-group>
                    </template>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>租赁状态：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <template>
                        <div>
                            <el-radio-group v-model="status">
                                <el-radio-button v-for="status in allstatus" :label="status.value" :key="status.label">@{{status.label}}</el-radio-button>
                            </el-radio-group>
                            <input type="hidden" name="status" :value="status">
                        </div>
                    </template>
                </div>
            </div>




            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>房屋图片：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <el-upload class="upload-demo" action="{{ route('admin.house.pic') }}" name="house_pic" :on-preview="handlePreview" :on-remove="handleRemove" :on-success="handleSuccess" :file-list="fileList" list-type="picture" :multiple=true :limit=10 :headers="headers" :before-upload="beforePicUpload" :on-exceed="handleExceed">
                        <el-button size="small" type="primary">点击上传</el-button>
                        <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过10M, 最多上传10张</div>
                    </el-upload>
                </div>
            </div>

            <div class="row cl" v-show=false>
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>房屋图片：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <template>
                        <el-checkbox-group v-model="checkList">
                            <el-checkbox name="pic[]" v-for="pic in fileList" :label="pic.name" :key="pic.name" :checked=true>@{{pic.name}}</el-checkbox>
                        </el-checkbox-group>
                    </template>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">描述：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <textarea name="" cols="" rows="" class="textarea" placeholder="说点什么..."></textarea>
                </div>
            </div>



            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">房屋小组：</label>
                <div class="formControls col-xs-8 col-sm-2">
                    <template>
                        <el-select v-model="group" @focus="getgroupdata" placeholder="请选择">
                            <el-option v-if="waitinggroup" v-html="loading" value=null :disabled="true">
                            </el-option>
                            <el-option v-for="item in groups" :key="item.value" :label="item.label" :value="item.value">
                            </el-option>
                        </el-select>
                    </template>
                </div>

                <label class="form-label col-xs-4 col-sm-1">是否推荐：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <el-switch style="display: block" v-model="recommend" active-color="#13ce66" inactive-color="#ff4949" active-text="推荐" inactive-text="不推荐">
                    </el-switch>
                </div>
            </div>




            <div class="row cl">
                <div class="col-xs-8 col-sm-6 col-xs-offset-4 col-sm-offset-3">
                    <button class="btn btn-primary radius" type="submit"> &nbsp;&nbsp;提交&nbsp;&nbsp; </button>
                </div>
            </div>
        </form>
    </article>

</body>
@include('admin._js')

<script type="text/javascript">
  
    

    var app = new Vue({
        el: "#form-member-add",

        data: {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },

            show0waiting: true,
            show1waiting: true,
            show2waiting: true,

            disabledlevel1: true,
            disabledlevel2: true,


            leveldata0: [],
            leveldata1: [],
            leveldata2: [],
            value0: '',
            value1: '',
            value2: '',

            showdefaulttoward: true,
            towards: [],
            toward: '21',

            building_area: 20,
            available_area: 16,
            built: 2010,
            rpm: 1000,
            floor: 10,
            bedroom: 1,
            hall: 1,
            bathroom: 1,

            positions: [],
            allpositions: [],
            checkAll: false,
            checkedCities: [],
            isIndeterminate: true,

            facilities: [],
            allfacilities: [],
            checkAllFacilities: false,
            checkedFacilities: [],

            isIndeterminateFacilities: true,


            status: 37,
            allstatus: [],

            cycle: 8,
            allcycle: [],

            alltype: [],



            fileList: [],

            owners: [],
            owner: '',
            searchownerloading: false,

            recommend: false,

            groups: [],
            group: '',

            mortgage: 2,
            pay: 1,

            multiple: true,
            limit: 10,
            checkList: [],
            waitingowner: true,
            waitingownertext: '正在查找<i class="el-icon-loading"></i>',

            waitinggroup: true,
            loading: '正在加载<i class="el-icon-loading"></i>'
        },

        methods: {
            getregiondata(level = 0, event = 0) {
                axios.get("{{ route('admin.regiondata') }}", {
                        params: {
                            level
                        }
                    })
                    .then(res => {

                        var leveldata = this.object2array(res.data)

                        if (event == 0) {
                            this.show0waiting = false
                            this.leveldata0 = leveldata
                        } else if (event == 1) {
                            this.show1waiting = false
                            this.leveldata1 = leveldata
                        } else if (event == 2) {
                            this.show2waiting = false
                            this.leveldata2 = leveldata
                        }


                    })
                    .catch(err => {
                        alert(err)
                    });
            },

            level0change(event) {
                this.disabledlevel1 = false;
                this.getregiondata(event, 1)

                this.value1 = ''
                this.value2 = ''
                this.leveldata1 = []
                this.leveldata2 = []
                this.show1waiting = true
                this.show2waiting = true
                // this.disabledlevel1 = true
                this.disabledlevel2 = true

            },


            level1change(event) {
                this.disabledlevel2 = false;
                this.getregiondata(event, 2)

                this.value2 = ''
                this.leveldata2 = []
                this.show2waiting = true

            },

            gethousetowarddata() {
                axios.get("{{ route('admin.houseattr.attrs', 20) }}")
                    .then(res => {
                        this.towards = this.object2array(res.data)
                        this.showdefaulttoward = false
                    })
                    .catch(err => {
                        alert(err)
                    })
            },

            handleCheckAllChange(val) {
                this.checkedCities = val ? this.allpositions : [];
                this.isIndeterminate = false;
            },

            handleCheckAllChangeFacilities(val) {

                this.checkedFacilities = val ? this.allfacilities : [];
                this.isIndeterminateFacilities = false;
            },


            handleCheckedCitiesChange(value) {
                let checkedCount = value.length;
                this.checkAll = checkedCount === this.positions.length;
                this.isIndeterminate = checkedCount > 0 && checkedCount < this.positions.length;
            },


            handleCheckedFacilitiesChange(value) {
                let checkedCount = value.length;
                this.checkAll = checkedCount === this.facilities.length;
                this.isIndeterminateFacilities = checkedCount > 0 && checkedCount < this.facilities.length;
            },


            beforePicUpload(file) {
                const isJPG = file.type === 'image/jpeg';
                const isPNG = file.type === 'image/png';
                const isLt10M = file.size / 1024 / 1024 < 10;

                if (!isJPG) {
                    this.$message.error('上传头像图片只能是 JPG或PNG 格式!');
                }
                if (!isLt10M) {
                    this.$message.error('上传头像图片大小不能超过 10MB!');
                }
                return (isJPG || isPNG) && isLt10M;
            },

            handleExceed(files, fileList) {
                alert("您一次最多上传10张图片")
            },

            handlePreview(file) {
                console.log(file);
            },

            handleRemove(file, fileList) {
                axios.delete(" {{ route('admin.house.pic') }}", {
                    params: {
                        deleted_pic: file.response
                    }
                }).then(res => {
                    console.log(res)
                }).catch(err => {
                    alert(err)
                })
                this.fileList = fileList
            },

            handleSuccess(response, file, fileList) {
                this.fileList = fileList
            },

            object2array(obj) {
                var arr = []

                for (let item in obj) {
                    let option = {}
                    option.value = item
                    option.label = obj[item]

                    arr.push(option)
                }
                return arr;
            },

            getpositiondata() {
                axios.get("{{ route('admin.houseattr.attrs', 32) }}")
                    .then(res => {
                        this.positions = this.object2array(res.data)
                        for (let item of this.positions)
                            this.allpositions.push(item.value)
                    })
                    .catch(err => {
                        alert(err)
                    })
            },

            getfacilitydata() {
                axios.get("{{ route('admin.houseattr.attrs', 12) }}")
                    .then(res => {
                        this.facilities = this.object2array(res.data)
                        for (let item of this.facilities)
                            this.allfacilities.push(item.value)
                    })
                    .catch(err => {
                        alert(err)
                    })
            },

            getcycledata() {
                axios.get("{{ route('admin.houseattr.attrs', 7) }}")
                    .then(res => {
                        this.allcycle = this.object2array(res.data)
                    })
                    .catch(err => {
                        alert(err)
                    })
            },

            getstatusdata() {
                axios.get("{{ route('admin.houseattr.attrs', 36) }}")
                    .then(res => {
                        this.allstatus = this.object2array(res.data)
                    })
                    .catch(err => {
                        alert(err)
                    })
            },

            getowner(kw = '') {

                this.owners = [];
                this.waitingowner = true

                axios.get("{{ route('admin.houseowner.search') }}", {
                        params: {
                            kw
                        }
                    })
                    .then(res => {
                        this.waitingowner = false
                        this.owners = res.data
                        if (this.owners.length == 0)
                            this.owners.push({
                                id: 0,
                                name: '没有数据',
                                phone: '',
                                disabled: true
                            })


                        if (this.owners.length >= 40)
                            this.owners.push({
                                id: 0,
                                name: '...',
                                phone: '',
                                disabled: true
                            })



                        this.searchownerloading = false
                    })
                    .catch(err => {
                        alert(err)
                    })
            },

            getgroupdata() {
                axios.get("{{ route('admin.houseattr.attrs', 1) }}")
                    .then(res => {
                        this.waitinggroup = false
                        this.groups = this.object2array(res.data)
                    })
                    .catch(err => {
                        alert(err)
                    })
            },

            get_type_data() {
                
                axios.get("{{ route('admin.houseattr.attrs', 4) }}")
                    .then(res => {
                        this.alltype = this.object2array(res.data)
                    })
                    .catch(err => {
                        alert(err)
                    })
            },

        },

        mounted: function() {
            this.getregiondata(0, 0)
            this.getpositiondata();
            this.getfacilitydata();
            this.getstatusdata();
            this.get_type_data();
            this.getcycledata();
            this.getowner();
        }

    })
</script>


</html>