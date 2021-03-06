<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>欢迎您登录市民卡管理系统</title>
    <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/login.css" media="all">
    <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
    <!--[if lt IE 9]>
        <script type="text/javascript" src="/shmk/Public/static/jquery-1.10.2.min.js"></script>
        <![endif]-->
    <!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/shmk/Public/static/jquery-2.0.3.min.js"></script>
    <!--<![endif]-->
    <link rel="stylesheet" href="/shmk/Public/Admin/css/login-style.css" type="text/css">
    <script type="text/javascript" src="/shmk/Public/Admin/js/cloud.js" charset="utf-8"></script>
    <script type="text/javascript">
    $(function() {
        $("#user_code").keydown(function() {
            if (event.keyCode == "13") { //keyCode=13是回车键
                $('#password').focus();
            }
        });

        $("#password").keydown(function() {
            if (event.keyCode == "13") { //keyCode=13是回车键
                $('#BtnLogin').click();
            }
        });

    });
    </script>
</head>

<body style="background-color: #1c77ac; background-image: url(/shmk/Public/Admin/images/light.png); background-repeat: no-repeat; background-position: center top; overflow: hidden;">
    <div id="mainBody">
        <div id="cloud1" class="cloud"></div>
        <div id="cloud2" class="cloud"></div>
    </div>
    <form autocomplete="off" method="post" action="<?php echo U('login');?>">
        <div class="loginbody">
            <span class="systemlogo" style="margin-top: 5%; font-size: 32px; color: #fff; height: 61px; font-weight: bold;">市民卡管理平台</span>
            <div class="loginbox" style="margin:0 auto 0 auto;padding-top:10px;">
                <ul>
                    <li>
                        <input type="text" name="username" class="loginuser" placeholder="请填写用户名" autocomplete="off" />
                    </li>
                    <li>
                        <input type="password" name="password" class="loginpwd" placeholder="请填写密码" autocomplete="off" />
                    </li>
                    <li>
                        <button class="login-btn" type="submit">
                            <span class="loginbtn">登 录</span>
                        </button>
                        <div class="check-tips"></div>
                    </li>
                </ul>
            </div>
        </div>
    </form>
    <script type="text/javascript">
    /* 登陆表单获取焦点变色 */
    $(".login-form").on("focus", "input", function() {
        $(this).closest('.item').addClass('focus');
    }).on("blur", "input", function() {
        $(this).closest('.item').removeClass('focus');
    });

    //表单提交
    $(document)
        .ajaxStart(function() {
            $("button:submit").addClass("log-in").attr("disabled", true);
        })
        .ajaxStop(function() {
            $("button:submit").removeClass("log-in").attr("disabled", false);
        });

    $("form").submit(function() {
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;

        function success(data) {
            if (data.status) {
                window.location.href = data.url;
            } else {
                self.find(".check-tips").text(data.info);
                //刷新验证码
                $(".reloadverify").click();
            }
        }
    });

    $(function() {
        //初始化选中用户名输入框
        $("#itemBox").find("input[name=username]").focus();
        //刷新验证码
        var verifyimg = $(".verifyimg").attr("src");
        $(".reloadverify").click(function() {
            if (verifyimg.indexOf('?') > 0) {
                $(".verifyimg").attr("src", verifyimg + '&random=' + Math.random());
            } else {
                $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
            }
        });

        //placeholder兼容性
        //如果支持 
        function isPlaceholer() {
            var input = document.createElement('input');
            return "placeholder" in input;
        }
        //如果不支持
        if (!isPlaceholer()) {
            $(".placeholder_copy").css({
                display: 'block'
            })
            $("#itemBox input").keydown(function() {
                $(this).parents(".item").next(".placeholder_copy").css({
                    display: 'none'
                })
            })
            $("#itemBox input").blur(function() {
                if ($(this).val() == "") {
                    $(this).parents(".item").next(".placeholder_copy").css({
                        display: 'block'
                    })
                }
            })


        }
    });
    </script>
</body>

</html>