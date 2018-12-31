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
                    <h3><i class="icon icon-unfold"></i>权限管理</h3>                        <ul class="side-sub-menu">
                            <li style="background-color: #FFFFFF;">
                                    <a  style="color: black;" class="item" href="./user.html">用户管理</a>
                                </li>                        </ul>                    <!-- /子导航 --><!-- 子导航 -->
                    <h3><i class="icon icon-unfold"></i>账单管理</h3>                        <ul class="side-sub-menu">
                            <li>
                                    <a class="item" href="./count.html">用户账单</a>
                                </li>                        </ul>                    <!-- /子导航 --><!-- 子导航 -->
                    <h3><i class="icon icon-unfold"></i>数据备份</h3>                        <ul class="side-sub-menu">
                            <li>
                                    <a class="item" href="/shmk/index.php?s=/Admin/Database/index/type/export.html">备份数据库</a>
                                </li><li>
                                    <a class="item" href="/shmk/index.php?s=/Admin/Database/index/type/import.html">还原数据库</a>
                                </li>                        </ul>                    <!-- /子导航 -->            </div>
        
        <!-- /子导航 -->
    </div>
  
 
    
 <?php if(isset($cate_rows)): ?></div><?php endif; ?> 
    <!-- 内容区 -->
    <div id="main-content">
        
        <div id="main" class="main">
          

            
	<!-- 标题栏 -->
	<div class="main-title">
		<h2>权限管理</h2>
	</div>

    <div class="tools auth-botton">
        <a id="add-group" class="btn" href="<?php echo U('createGroup');?>">新 增</a>
        <a url="<?php echo U('changestatus?method=resumeGroup');?>" class="btn ajax-post" target-form="ids" >启 用</a>
        <a url="<?php echo U('changestatus?method=forbidGroup');?>" class="btn ajax-post" target-form="ids" >禁 用</a>
        <a url="<?php echo U('changestatus?method=deleteGroup');?>" class="btn ajax-post confirm" target-form="ids" >删 除</a>
    </div>
	<!-- 数据列表 -->
	<div class="data-table table-striped">
	<table class="">
    <thead>
        <tr>
		<th class="row-selected row-selected"><input class="check-all" type="checkbox"/></th>
		<th class="">用户组</th>
		<th class="">描述</th>

		<th class="">授权</th>
		<th class="">状态</th>
		<th class="">操作</th>
		</tr>
    </thead>
    <tbody>
		<?php if(!empty($_list)): if(is_array($_list)): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><input class="ids" type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" /></td>
			<td><a href="<?php echo U('AuthManager/editgroup?id='.$vo['id']);?>"><?php echo ($vo["title"]); ?></a> </td>
			<td><span><?php echo mb_strimwidth($vo['description'],0,60,"...","utf-8");?></span></td>


			<td><a href="<?php echo U('AuthManager/access?group_name='.$vo['title'].'&group_id='.$vo['id']);?>" >访问授权</a>
			</td>
			<td><?php echo ($vo["status_text"]); ?></td>
			<td><?php if(($vo["status"]) == "1"): ?><a href="<?php echo U('AuthManager/changeStatus?method=forbidGroup&id='.$vo['id']);?>" class="ajax-get">禁用</a>
				<?php else: ?>
				<a href="<?php echo U('AuthManager/changeStatus?method=resumeGroup&id='.$vo['id']);?>" class="ajax-get">启用</a><?php endif; ?>
				<a href="<?php echo U('AuthManager/changeStatus?method=deleteGroup&id='.$vo['id']);?>" class="confirm ajax-get">删除</a>
                </td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<?php else: ?>
		<td colspan="6" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
	</tbody>
    </table>

	</div>
    <div class="page">
        <?php echo ($_page); ?>
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
    
<script type="text/javascript" charset="utf-8">
    //导航高亮
    highlight_subnav('/shmk/index.php?s=/Admin/Member/index.html');
</script>

    
<script type="text/javascript" charset="utf-8">
    //导航高亮
    highlight_subnav('<?php echo U('AuthManager/user');?>');
</script>

</body>
</html>