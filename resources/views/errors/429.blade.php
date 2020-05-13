<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    当前服务器请求太多
    <script>
      setTimeout(function(){ window.location.href="{{session('_previous')['url'] }}"; }, 3000);
    </script>
</body>
</html>