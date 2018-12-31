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
	<span class="logo"><!-- <img src="/shmk/Public/Admin/images/logo.png"> --></span>
        <!-- 主导航 -->
 
        <ul class="main-nav">
			 <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (get_nav_url($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
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
                <?php if(!empty($_extra_menu)): ?>
                    <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
                <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
                    <?php if(!empty($sub_menu)): if(!empty($key)): ?><h3><i class="icon icon-unfold"></i><?php echo ($key); ?></h3><?php endif; ?>
                        <ul class="side-sub-menu">
                            <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                                    <a class="item" href="<?php echo (U($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul><?php endif; ?>
                    <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        
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
    <div class="main-title">
        <h2>用户账单</h2>
    </div>
    <div class="cf">
        <div class="fl">
            <input type="button" name="excel" value="导出为Excel" style="margin-right:5px;padding:6px 16px;font-size:14px;line-height:18px;text-align:center;vertical-align:middle;border:0 none;color:#edffd1;background-color:#4bbd00;cursor:pointer" onclick="location.href='/shmk/admin.php/Log/expLog'">
        </div>
        <!-- 高级搜索 -->
        <div class="search-form fr cf">
            <div class="sleft">
            <div class="drop-down" id="status-drop-down">
                <span id="sch-sort-txt" class="sort-txt" style="width:auto" data="<?php echo ($type); ?>"> 
                    <?php switch($type): case "0": ?>充值<?php break;?>
						<?php case "1": ?>提现<?php break;?>
                        <?php case "2": ?>支付<?php break;?>
                        <?php default: ?>全部类型<?php endswitch;?>
                </span> <i class="arrow arrow-down"></i>
                <ul id="sub-sch-menu" class="nav-list hidden">
                    <li><a href="javascript:;" value="" onclick="select('');">全部类型</a></li>
                    <li><a href="javascript:;" value="0" onclick="select('0');">充值</a></li>
                    <li><a href="javascript:;" value="1" onclick="select('1');">提现</a></li>
                    <li><a href="javascript:;" value="2" onclick="select('2');">支付</a></li>
                </ul>
            </div>
            <div class="drop-down" id="type-drop-down">
                    <span id="sch-sort-txt1" class="sort-txt" style="width:auto" data="<?php echo ($status); ?>"> <?php if($status == ''): ?>全部状态<?php endif; ?> <?php if($status == '0'): ?>处理中<?php endif; ?>
                        <?php if($status == '1'): ?>已完成<?php endif; if($status == '-1'): ?>已取消<?php endif; ?>
                    </span> <i class="arrow arrow-down"></i>
                    <ul id="sub-sch-menu1" class="nav-list hidden">
                        <li><a href="javascript:;" value="" onclick="select('');">全部状态</a></li>
                        <li><a href="javascript:;" value="0" onclick="select('0');">处理中</a></li>
                        <li><a href="javascript:;" value="1" onclick="select('1');">已完成</a></li>
                        <li><a href="javascript:;" value="-1" onclick="select('-1');">已取消</a></li>
                    </ul>
                </div>
                <input type="text" name="selvalue" class="search-input" value="<?php echo I('selvalue');?>" placeholder="输入用户姓名/市民卡号">
                <a class="sch-btn" href="javascript:;" id="search" url="<?php echo U('cashflow');?>"><i class="btn-search"></i></a>
            </div>
            <div class="btn-group-click adv-sch-pannel fl">
                <button class="btn">高 级<i class="btn-arrowdown"></i></button>
                <div class="dropdown cf">
                    <div class="row">
                        <label>时间：</label>
                        <input type="text" id="time-start" name="time-start" class="text input-2x" value="" placeholder="起始时间" /> -
                        <input type="text" id="time-end" name="time-end" class="text input-2x" value="" placeholder="结束时间" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 数据列表 -->
    <div class="data-table table-striped">
    <table class="">
    <thead>
        <tr>
		<th class="" style="text-align:center">卡号</th>
        <th class="" style="text-align:center">用户</th>
        <th class="" style="text-align:center">信息</th>
        <th class="" style="text-align:center">金额</th>
		<th class="" style="text-align:center">余额</th>
        <th class="" style="text-align:center">时间</th>
        <th class="" style="text-align:center">类型</th>
        <th class="" style="text-align:center">状态</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($_list)): if(is_array($_list)): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td style="text-align:center"><?php echo ($vo["account_id"]); ?></td>
            <td style="text-align:center"><?php echo ($vo["account_name"]); ?></td>
            <td style="text-align:center;"><?php echo ($vo["info"]); ?></td>
            <td style="text-align:center"><?php echo ($vo["charge"]); ?></td>
			<td style="text-align:center"><?php echo ($vo["money"]); ?></td>
            <td style="text-align:center"><?php echo ($vo["time"]); ?></td>			
            <td style="text-align:center"><?php switch($vo["type"]): case "0": ?>充值<?php break; case "1": ?>提现<?php break; case "2": ?>支付<?php break; default: ?>未知<?php endswitch;?></td>
            <td style="text-align:center">
                <?php if($vo["status"] == 1): ?>已完成
                <?php elseif($vo["status"] == 0): ?>
                    处理中
                <?php elseif($vo["status"] == -1): ?>
                    已取消<?php endif; ?>
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php else: ?>
        <td colspan="14" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
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
    


    
<link href="/shmk/Public/static/datetimepicker/css/datetimepicker.css" rel="stylesheet" status="text/css">
<?php if(C('COLOR_STYLE')=='blue_color') echo '<link href="/shmk/Public/static/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" status="text/css">'; ?>
<link href="/shmk/Public/static/datetimepicker/css/dropdown.css" rel="stylesheet" status="text/css">
<script status="text/javascript" src="/shmk/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script status="text/javascript" src="/shmk/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript">

    //搜索功能
    $("#search").click(function(){
        var url = $(this).attr('url');
        var type = $("#sch-sort-txt").attr("data");
        var status = $("#sch-sort-txt1").attr('data');
        var query  = $('.search-form').find('input').serialize();
        query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
        query = query.replace(/^&/g,'');
        if(type != ''){
            query = 'type=' + type + "&" + query;
        }
        if(status != ''){
            query = 'status=' + status + "&" + query;
        }
        if( url.indexOf('?')>0 ){
            url += '&' + query;
        }else{
            url += '?' + query;
        }
        window.location.href = url;
    });
    //回车搜索
    $(".search-input").keyup(function(e){
        if(e.keyCode === 13){
            $("#search").click();
            return false;
        }
    });
    /* 状态搜索子菜单 */
    $("#status-drop-down").hover(function(){
        $("#sub-sch-menu").removeClass("hidden");
    },function(){
        $("#sub-sch-menu").addClass("hidden");
    });
    $("#sub-sch-menu li").find("a").each(function(){
        $(this).click(function(){
            var text = $(this).text();
            $("#sch-sort-txt").text(text).attr("data",$(this).attr("value"));
            $("#sub-sch-menu").addClass("hidden");
        })
    });

    $("#type-drop-down").hover(function(){
        $("#sub-sch-menu1").removeClass("hidden");
    },function(){
        $("#sub-sch-menu1").addClass("hidden");
    });
    $("#sub-sch-menu1 li").find("a").each(function(){
        $(this).click(function(){
            var text = $(this).text();
            $("#sch-sort-txt1").text(text).attr("data",$(this).attr("value"));
            $("#sub-sch-menu1").addClass("hidden");
        })
    });

    $('#time-start').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });

    $('#time-end').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });

    //导航高亮
    highlight_subnav('<?php echo U('Log/cashflow');?>');
    </script>

</body>
</html>