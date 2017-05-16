<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('static/SemanticUI/semantic.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('static/css/home_index.css') }}">
    @yield('title')
</head>
<body>
    <div class="header">
        <div class="ui secondary large menu">
            <span class="index_menu">Online exam 在线考试系统</span>
            <div class="right menu">
                {{--<div class="ui dropdown item"><div class="text">--}}
                        {{--<img class="ui avatar image" src="{{ URL::asset('static/img/default1.jpg') }}"> 测试用户名 </div>--}}
                    {{--<i class="dropdown icon"></i> <div class="menu">--}}
                        {{--<a class="item" href="{{ URL::asset('/home/login') }}"><i class="user icon"></i>个人资料</a>--}}
                        {{--<a class="item"><i class="setting icon"></i>设置</a>--}}
                        {{--<a class="item"><i class="power icon"></i>退出</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="item">
                    <div class="ui icon input">
                        <input type="text" placeholder="Search..." class="prompt">
                        <i class="search link icon"></i>
                    </div>
                </div>
                <div class="item">
                    <div class="ui teal button logout"><i class="power icon"></i>退出系统</div>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    <div class="footer">
            <div class="copyright">
                <p>2017@成都信息工程大学</p>
            </div>
        </div>
    </div>

    <div class="ui basic modal">
        <div class="ui icon header">
            <i class="help circle outline icon"></i>
            你确定要退出吗？
        </div>
        <div class="actions">
            <div class="ui red basic cancel inverted button">
                <i class="remove icon"></i>
                否
            </div>
            <div class="ui green ok inverted button">
                <i class="checkmark icon"></i>
                是
            </div>
        </div>
    </div>




<script type="text/javascript" src="{{ URL::asset('static/js/jquery-3.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('static/SemanticUI/semantic.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //$('.ui.tiny.menu').dropdown();
            $('.ui.dropdown').dropdown({
                action:'hide'       //下拉不改变文本
            });
            $('.logout').click(function() {
                $('.ui.basic.modal').modal({
                    onApprove : function() {
                        window.location.href = "logout";
                    }
                }).modal('show');
            });

//            $('.header').visibility({
//                type:'fixed',
//                offset:15
//            });
//            $('.sactive').click(function() {
//                $(this).removeClass();
//                $(this).addClass("active item sactive");
//            });

        });

    </script>
@yield('script')
</body>
</html>
