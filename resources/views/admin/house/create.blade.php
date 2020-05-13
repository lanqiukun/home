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
        <el-form class="form form-horizontal" ref="form" :rules="rules" :model="form" label-width="100px">


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-8">
                    <el-form-item label="房源名称：" prop="name">
                        <el-input v-model="form.name"></el-input>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-8">
                    <el-form-item label="小区名称：">
                        <el-input v-model="form.area"></el-input>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-8">
                    <el-form-item label="地区：" prop="location">
                        <template>
                            <el-select v-model="form.value0" placeholder="省/直辖市" @change="level0change" name="level0">
                                <el-option v-if="show0waiting" v-html="loading" value=null :disabled="true">
                                </el-option>
                                <el-option v-for="item in leveldata0" :key="item.value" :label="item.label" :value="item.value">
                                </el-option>
                            </el-select>
                        </template>

                        <template>
                            <el-select v-model="form.value1" placeholder="市" @change="level1change" name="level1" :disabled="disabledlevel1">
                                <el-option v-if="show1waiting" v-html="loading" value=null :disabled="true">
                                </el-option>
                                <el-option v-for="item in leveldata1" :key="item.value" :label="item.label" :value="item.value">
                                </el-option>
                            </el-select>
                        </template>
                        <template>
                            <el-select v-model="form.value2" placeholder="县/区" :disabled="disabledlevel2" name="level2">
                                <el-option v-if="show2waiting" v-html="loading" value=null :disabled="true">
                                </el-option>
                                <el-option v-for="item in leveldata2" :key="item.value" :label="item.label" :value="item.value">
                                </el-option>
                            </el-select>
                        </template>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-8">
                    <el-form-item label="详细地址：" prop="addr">
                        <el-input v-model="form.addr"></el-input>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="房屋朝向：">
                        <template>
                            <el-select v-model="form.towards" @focus="gethousetowarddata" placeholder="房屋朝向" name="toward">
                                <el-option label="无" value="21" v-if="showdefaulttoward">
                                </el-option>
                                <el-option v-for="item in towards" :key="item.value" :label="item.label" :value="item.value">
                                </el-option>
                            </el-select>
                        </template>
                    </el-form-item>
                </div>

                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="房东：" prop="houseowner">
                        <template>
                            <el-select v-model="form.owner" filterable remote reserve-keyword placeholder="房东 姓名/电话" :remote-method="getowner" :loading="searchownerloading">
                                <el-option v-if="waitingowner" v-html="waitingownertext" value=null :disabled="true">
                                </el-option>
                                <el-option v-for="item in owners" :key="item.id" :label="item.name" :value="item.id" :disabled="item.disabled">
                                    <span style="float: left">@{{ item.name }}</span>
                                    <span style="float: right; color: #8492a6; font-size: 13px">@{{ item.phone }}</span>
                                </el-option>
                            </el-select>
                        </template>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="建筑面积：" prop="building_area">
                        <el-input-number v-model="form.building_area" name="building_area" :min="1" :max="2000"></el-input-number>
                    </el-form-item>
                </div>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="可用面积：" prop="available_area">
                        <el-input-number v-model="form.available_area" name="available_area" :min="1" :max="2000"></el-input-number>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="建筑时间：" prop="built">
                        <el-input-number v-model="form.built" name="built" :min="1800" :max="2500"></el-input-number>
                    </el-form-item>
                </div>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="每月租金：" prop="rpm">
                        <el-input-number v-model="form.rpm" name="rpm" :min="0" :step="50" :max="20000000"></el-input-number>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="押几：" prop="mortgage">
                        <el-input-number v-model="form.mortgage" name="mortgage" :min="1" :step="1" :max="14"></el-input-number>
                    </el-form-item>
                </div>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="付几：" prop="pay">
                        <el-input-number v-model="form.pay" name="pay" :min="1" :step="1" :max="14"></el-input-number>
                    </el-form-item>
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="所处楼层：" prop="floor">
                        <el-input-number v-model="form.floor" name="floor" :min="0" :max="2000"></el-input-number>
                    </el-form-item>
                </div>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="房间数量：" prop="bedroom">
                        <el-input-number v-model="form.bedroom" name="bedroom" :min="0" :max="2000"></el-input-number>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="客厅数量：" prop="hall">
                        <el-input-number v-model="form.hall" name="hall" :min="0" :max="2000"></el-input-number>
                    </el-form-item>
                </div>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="卫生间数量：" prop="bathroom">
                        <el-input-number v-model="form.bathroom" name="bathroom" :min="0" :max="2000"></el-input-number>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-8">
                    <el-form-item label="配套设施：">
                        <template>
                            <el-checkbox :indeterminate="isIndeterminateFacilities" v-model="checkAllFacilities" @change="handleCheckAllChangeFacilities">全选</el-checkbox>
                            <div style="margin: 15px 0;"></div>
                            <el-checkbox-group v-model="form.checkedFacilities" @change="handleCheckedFacilitiesChange">
                                <el-checkbox name="facility[]" v-for="item in facilities" :label="item.value" :key="item.label">@{{item.label}}</el-checkbox>
                            </el-checkbox-group>
                        </template>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-4">
                    <el-form-item label="租赁周期：">
                        <template>
                            <div>
                                <el-radio-group v-model="form.cycle">
                                    <el-radio-button v-for="cycle in allcycle" :label="cycle.value" :key="cycle.label">@{{cycle.label}}</el-radio-button>
                                </el-radio-group>
                                <input type="hidden" name="cycle" :value="cycle">
                            </div>
                        </template>
                    </el-form-item>
                </div>
                <div class="formControls col-xs-8 col-sm-4">
                    <el-form-item label="租赁方式：" v-model="form.type">
                        <template>
                            <el-checkbox :checked="item.value == 5" required name="type[]" v-for="item in alltype" :label="item.value" :key="item.label" border>@{{item.label}}</el-checkbox>
                        </template>
                    </el-form-item>
                </div>
            </div>



            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-4">
                    <el-form-item label="周边：" prop="position">
                        <template>
                            <el-checkbox-group v-model="form.checkedCities">
                                <el-checkbox name="position[]" v-for="item in positions" :label="item.value" :key="item.label">@{{item.label}}</el-checkbox>
                            </el-checkbox-group>
                        </template>
                    </el-form-item>
                </div>
                <div class="formControls col-xs-8 col-sm-4">
                    <el-form-item label="租赁状态：" prop="status">
                        <template>
                            <div>
                                <el-radio-group v-model="form.status">
                                    <el-radio-button v-for="status in allstatus" :label="status.value" :key="status.label">@{{status.label}}</el-radio-button>
                                </el-radio-group>
                                <input type="hidden" name="status" :value="status">
                            </div>
                        </template>
                    </el-form-item>
                </div>
            </div>



            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-8">
                    <el-form-item label="房屋图片：" v-model="form.pic">
                        <template>
                            <el-upload class="upload-demo" action="{{ route('admin.house.pic') }}" name="house_pic" :on-preview="handlePreview" :on-remove="handleRemove" :on-success="handleSuccess" :file-list="fileList" list-type="picture" :multiple=true :limit=10 :headers="headers" :before-upload="beforePicUpload" :on-exceed="handleExceed">
                                <el-button size="small" type="primary">点击上传</el-button>
                                <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过10M, 最多上传10张</div>
                            </el-upload>
                        </template>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-8">
                    <el-form-item label="描述：" prop="desc">
                        <template>
                            <el-input type="textarea" placeholder="说点什么..." :rows="5" v-model="form.desc"></el-input>
                        </template>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="房屋小组：" >
                        <template>
                            <el-select v-model="form.group" @focus="getgroupdata" placeholder="请选择">
                                <el-option v-if="waitinggroup" v-html="loading" value=null :disabled="true">
                                </el-option>
                                <el-option v-for="item in groups" :key="item.value" :label="item.label" :value="item.value">
                                </el-option>
                            </el-select>
                        </template>
                    </el-form-item>
                </div>
                <div class="formControls col-xs-8 col-sm-3">
                    <el-form-item label="推荐房源：" prop="recommend">
                        <el-switch v-model="form.recommend"></el-switch>
                    </el-form-item>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"></label>
                <div class="formControls col-xs-8 col-sm-8">
                    <el-form-item>
                        <el-button type="primary" @click="submitForm('form')">立即创建</el-button>

                    </el-form-item>
                </div>
            </div>

        </el-form>

    </article>

</body>
@include('admin._js')

<script type="text/javascript">
    var app = new Vue({
        el: ".page-container",

        data: {
            form: {
                name: '',
                area: '',
                value0: null,
                value1: null,
                value2: null,
                addr: null,
                towards: 
                region: '',
                date1: '',
                date2: '',
                delivery: false,
                type: [],
                resource: '',
                desc: ''
            },
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
            checkedCities: [],

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
            loading: '正在加载<i class="el-icon-loading"></i>',

            rules: {
                name: [{
                        required: true,
                        message: "请输入房源名称",
                        trigger: 'blur'
                    },
                    {
                        min: 3,
                        max: 50,
                        message: '长度在 3 到 50 个字符',
                        trigger: 'blur'
                    }
                ],
                addr: [{
                        require: true,
                        message: "请输入详细地址",
                        trigger: 'blur'
                    },
                    {
                        min: 3,
                        max: 50,
                        message: '长度在 3 到 50 个字符',
                        trigger: 'blur'
                    }
                ],
                towards: [{
                    required: true,
                    message: '请选择房屋朝向',
                    trigger: 'change'
                }]
            }
        },

        methods: {

            submitForm(form) {
                this.$refs[form].validate((valid) => {
                    if (valid) {
                        alert('submit!');
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },

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



            handleCheckAllChangeFacilities(val) {

                this.checkedFacilities = val ? this.allfacilities : [];
                this.isIndeterminateFacilities = false;
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