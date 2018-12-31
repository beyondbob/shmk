<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|市民卡管理平台</title>
    <!-- <link href="/shmk/Public/favicon.ico" type="image/x-icon" rel="shortcut icon"> -->
    <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/module.css">
    <link rel="stylesheet" href="/shmk/Public/static/datetimepicker/css/dropdown.css">
    <link rel="stylesheet" href="/shmk/Public/static/datetimepicker/css/datetimepicker_blue.css">
    <?php if(isset($cate_rows)): ?><link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/style.css" media="all"><?php else: ?> <link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/style-default.css" media="all"><?php endif; ?>
	<link rel="stylesheet" type="text/css" href="/shmk/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="/shmk/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/shmk/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/shmk/Public/static/datetimepicker/js/bootstrap-datetimepicker.js"></script>
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
        <span class="logo"><!-- <img src="/shmk/Public/Admin/images/logo.png"> --></span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (get_nav_url($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
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
    <!-- /头部 -->
 <?php if(isset($cate_rows)): ?><div class="goods-content"><?php endif; ?> 
    <!-- 边栏 -->
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
    <!-- /边栏 -->
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
            

            
    <div class="main-title">
        <h2>[月度] 分红确认</h2>
    </div>

    <div class="cf">
        <!-- 高级搜索 -->
        <div class="search-form fr cf">
            <div class="sleft">
               <!--  <div class="drop-down">
                    <span id="sch-sort-txt" class="sort-txt" data="<?php echo ($year); ?>">

                        <?php if($year == ''): ?>全部
                            <?php else: ?>
                                <?php echo ($year); endif; ?>
                    </span> <i class="arrow arrow-down"></i>
                    <ul id="sub-sch-menu" class="nav-list hidden">
                        <li><a href="javascript:;" value="" onclick="select('');">全部</a></li>
                        <?php if(is_array($_years)): foreach($_years as $key=>$vo): ?><li><a href="javascript:;" value="<?php echo ($vo["year"]); ?>" onclick="select('<?php echo ($vo["year"]); ?>');"><?php echo ($vo["year"]); ?></a></li><?php endforeach; endif; ?>
                    </ul>
                </div> -->
                <input type="text" name="selvalue" class="search-input" value="<?php echo I('selvalue');?>" placeholder="输入姓名或昵称">
                <a class="sch-btn" href="javascript:;" id="search" url="<?php echo U('bonusList');?>"><i class="btn-search"></i></a>
                <div class="btn-group-click adv-sch-pannel fl">
                    <button class="btn">高 级<i class="btn-arrowdown"></i></button>
                    <div class="dropdown cf">
                        <div class="row">
                            <label >时间</label>
                            <input type="text" name="year"  id="time-start" class="text input-2x" value="<?php echo I('year');?>" placeholder="年" /> -
                            <input type="text" name="month" id="time-end" class="text input-2x" value="<?php echo I('month');?>" placeholder="月" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="data-table table-striped">
        <form class="ids">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>姓名</th>
                        <th>昵称</th>
                        <th>头像</th>
                        <th>年</th>
                        <th>月</th>
                        <th>自身积分</th>
                        <th>一阶积分</th>
                        <th>月度一阶分红积分</th>
                        <th>额外一阶分红积分</th>
                        <th>二阶积分</th>
                        <th>额外二阶分红积分</th>
                        <th>总结算积分</th>
                        <th>分红金额</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
				<?php if(!empty($_list)): if(is_array($_list)): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo ($item["name"]); ?></td>
                        <td><?php echo ($item["nick"]); ?></td>
                        <td><img style="width: 40px;height: 40px;" src="<?php echo ($item["avatar"]); ?>"></td>
                        <td><?php echo ($item["year"]); ?></td>
                        <td><?php echo ($item["month"]); ?></td>
                        <td><?php echo ($item["integral"]); ?></td>
                        <td><?php echo ($item["integral_one"]); ?></td>
                        <td><?php echo ($item["bonus_one"]); ?></td>
                        <td><?php echo ($item["bonus_one_extra"]); ?></td>
                        <td><?php echo ($item["integral_two"]); ?></td>
                        <td><?php echo ($item["bonus_two"]); ?></td>
                        <td><?php echo ($item["settlement_integral"]); ?></td>
                        <td><?php echo ($item["money"]); ?></td>
                        <td>
                            <?php if($item['status'][''] == 0): ?><a href="#" toid="<?php echo ($item["id"]); ?>" class="finish_bonus">确认汇款</a>
                            <?php else: endif; ?>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
				<td colspan="15" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
                </tbody>
            </table>
        </form>
        <!-- 分页 -->
        <div class="page">
            <?php echo ($_page); ?>
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
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "/shmk", //当前网站地址
            "APP"    : "/shmk/index.php?s=", //当前项目地址
            "PUBLIC" : "/shmk/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="/shmk/Public/static/think.js"></script>

    <script type="text/javascript" src="/shmk/Public/Admin/js/common.js"></script>
    <script type="text/javascript">
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
       /* if($("input[name=year]").val() == ''){
            alert("请选择年份");
            return;
        }*/
        var url = $(this).attr('url');
        var query  = $('.search-form').find('input').serialize();
        /*var year = $("#sch-sort-txt").attr("data");*/
        query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
        query = query.replace(/^&/g,'');
       /* if(year != ''){
            query = 'year=' + year + "&" + query;
        }*/
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
    $(".search-form").find(".drop-down").hover(function(){
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
</script>
<script type="text/javascript">
    $(".finish_bonus").click(function(){
       var self = this;
       var id = $(self).attr("toid");
       if( confirm('你确定要执行这个操作?')) {
          $.ajax({
                    method:"post",
                    url:"<?php echo U('');?>",
                    data:{id:id},
                    dataType:"json",
                    success:function(data){
                        if(data.status == 1){
                            $(self).html("");
                        }else{
                            alert("确认分红失败");
                        }
                    }
                })
       }
  
    })
    $('#time-start').datetimepicker({
        format: 'yyyy',
        language:"zh-CN",
        minView:4,
        maxView:4,
        startView:4,
        autoclose:true
    });

    $('#time-end').datetimepicker({
        format: 'm',
        language:"zh-CN",
        minView:3,
        maxView:3,
        startView:3,
        autoclose:true
    });
   highlight_subnav('<?php echo U("Integral/bonusList");?>');
</script>

</body>
</html>