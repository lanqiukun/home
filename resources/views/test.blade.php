<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.4/lib/index.css">
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <script src="axios.min.js"></script>


</head>

<body>

    <div id="app" >

        <button @click="request">request</button>

    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://unpkg.com/element-ui/lib/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vant@2.4/lib/vant.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/v-charts/lib/index.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/v-charts/lib/style.min.css">

<script>

    var app = new Vue({
        el: "#app",
        methods: {
            request() {
                axios.get('http://127.0.0.1:9000/api/doubi')
                .then( res => {
                    console.log(res)
                })
                .catch( err => {
                    if (err.response.status == 429)
                        alert("请稍后重试")
                })

            }
        }
    })

</script>

</html>