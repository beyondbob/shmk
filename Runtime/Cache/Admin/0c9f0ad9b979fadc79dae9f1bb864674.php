<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|市民卡管理平台</title>
    <!-- <link href="/shmk/Public/favicon.ico" type="image/x-icon" rel="shortcut icon"> -->
    <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/module.css">
   <?php if(isset($cate_rows)): ?><link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/style.css" media="all"><?php else: ?> <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/style-default.css" media="all"><?php endif; ?>  
	<link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="/shmk/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/shmk/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/shmk/Public/Admin/js/jquery.mousewheel.js"></script>
 <script type="text/javascript" src="/shmk/Public/Admin/js/highcharts.js"></script>
<script type="text/javascript" src="/shmk/Public/Admin/js/exporting.js"></script>
<script type="text/javascript" src="/shmk/Public/Admin/js/data.js"></script>
    <!--<![endif]-->
    <!-- easyui start-->
    <script type="text/javascript" src="/shmk/Public/Admin/js/easyui/jquery.easyui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/js/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/js/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/details.css">
    <!-- easyui end -->
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <!-- /Logo -->

        <!-- 主导航 -->
 
        <ul class="main-nav">
			<span class="logo"><!-- <img src="/shmk/Public/Admin/images/logo.png"> --></span>
            <li class="current"><a href="/shmk/index.php?s=/Admin/AuthManager/index.html">系统</a></li><li class=""><a href="/shmk/index.php?s=/Admin/Member/index.html">用户</a></li>
			<!-- <li><a href="<?php echo get_index_url();?>" target="_blank">前台</a></li> -->
        </ul>
        <!-- /主导航 -->
		      <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('user_auth.username');?>"><?php echo session('user_auth.username');?></em></li>
                <li><a href="<?php echo U('AuthManager/updatePassword');?>">修改密码</a></li>
                <!-- <li><a href="<?php echo U('User/updateNickname');?>">修改昵称</a></li> -->
                <li><a href="<?php echo U('Public/logout');?>">退出</a></li>
            </ul>
        </div>
	</div>
 <div class="sidebar">
        <!-- 子导航 -->
        
            <div id="subnav" class="subnav">
                                <!-- 子导航 -->
                    <h3><i class="icon icon-unfold"></i>管理员</h3>                        <ul class="side-sub-menu">
                            <li>
                                    <a class="item" href="/shmk/index.php?s=/Admin/AuthManager/index.html" >权限管理</a>
                                </li><li>
                                    <a class="item" href="/shmk/index.php?s=/Admin/AuthManager/manager.html">管理员</a>
                                </li>                        </ul>                    <!-- /子导航 --><!-- 子导航 -->
                    <h3><i class="icon icon-unfold"></i>系统设置</h3>  
                      <ul class="side-sub-menu">
							<li>
                                    <a class="item" href="/shmk/index.php?s=/Admin/parameter/shop.html">广告位管理</a>
                            </li>  
                            <li>
                                    <a class="item" href="/shmk/index.php?s=/Admin/Menu/index.html">菜单管理</a>
                            </li>                        </ul>                    <!-- /子导航 --><!-- 子导航 -->
                              <!-- /子导航 -->            </div>
        
        <!-- /子导航 -->
    </div>
  
 
    
 <?php if(isset($cate_rows)): ?></div><?php endif; ?> 
    <!-- 内容区 -->
    <div id="main-content">
    <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
    </div>
        
               <div id="main" class="main">
            
            <!-- nav -->
            <?php if(!empty($_show_nav)): ?><div class="breadcrumb">
                <span>您的位置:</span>
                <?php $i = '1'; ?>
                <?php if(is_array($_nav)): foreach($_nav as $k=>$v): if($i == count($_nav)): ?><span><?php echo ($v); ?></span>
                    <?php else: ?>
                    <span><a href="<?php echo ($k); ?>"><?php echo ($v); ?></a>&gt;</span><?php endif; ?>
                    <?php $i = $i+1; endforeach; endif; ?>
            </div><?php endif; ?>
            <!-- nav -->
            

            
	<!-- 标题栏 -->

		<div class="tab-wrap">
		<ul class="tab-nav nav">
		<!-- <li ><a href="<?php echo U('updatenickname');?>">修改昵称</a></li> -->
		<li class="current"><a href="<?php echo U('updatepassword');?>">修改密码</a></li>
		</ul>
		<div class="tab-content">
	<!-- 修改密码表单 -->
	<form action="<?php echo U('AuthManager/submitPassword');?>" method="post" class="form-horizontal">
		<div class="form-item">
			<label class="item-label">原密码：</label>
			<div class="controls">
				<input type="password" name="old" class="text " autocomplete="off" />
			</div>
		</div>
		<div class="form-item">
			<label class="item-label">新密码：</label>
			<div class="controls">
				<input type="password" name="password" class="text " autocomplete="off" />
			</div>
		</div>
		<div class="form-item">
			<label class="item-label">确认密码：</label>
			<div class="controls">
				<input type="password" name="repassword" class="text " autocomplete="off" />
			</div>
		</div>
		<div class="form-item">
			<button type="submit" class="btn submit-btn ajax-post" target-form="form-horizontal">确 认</button>
			<button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
		</div>
	</form>
			</div>
	</div>

        </div>
        <!-- <?php if(!isset($cate_rows)): ?><div class="cont-ft">
            <div class="copyright">
                <div class="fl"></div>
                <div class="fr">V<?php echo (ONETHINK_VERSION); ?></div>
            </div>
        </div>
    </div><?php endif; ?> -->
    <!-- /内容区 -->
    
    <script type="text/javascript" src="/shmk/Public/static/think.js"></script>

    <script type="text/javascript" src="/shmk/Public/Admin/js/common.js"></script>
    <script>
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
			
            $subnav.find("a[href='" + url + "']").parent().addClass("current") ;

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){e.stopPropagation()});

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });

            // 导航栏超出窗口高度后的模拟滚动条
            var sHeight = $(".sidebar").height();
            var subHeight  = $(".subnav").height();
            var diff = subHeight - sHeight; //250
            var sub = $(".subnav");
            if(diff > 0){
                $(window).mousewheel(function(event, delta){
                    if(delta>0){
                        if(parseInt(sub.css('marginTop'))>-10){
                            sub.css('marginTop','0px');
                        }else{
                            sub.css('marginTop','+='+10);
                        }
                    }else{
                        if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                            sub.css('marginTop','-'+(diff-10));
                        }else{
                            sub.css('marginTop','-='+10);
                        }
                    }
                });
            }
        }();
    </script>
    


    
	<script src="/shmk/Public/static/thinkbox/jquery.thinkbox.js"></script>

</body>
</html>