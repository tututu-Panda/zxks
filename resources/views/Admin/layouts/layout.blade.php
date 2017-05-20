<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//at.alicdn.com/t/font_3hulypuyr7vcayvi.css" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('static/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{URL::asset('static/css/global.css')}}" media="all">
    @yield('css')
    <title>@yield('title')</title>
</head>
<body>
    <div class="admin-main">
        @yield('content')
    </div>
    <script src="{{URL::asset('static/layui/layui.js')}}"></script>
    @yield('js')
</body>
</html>
