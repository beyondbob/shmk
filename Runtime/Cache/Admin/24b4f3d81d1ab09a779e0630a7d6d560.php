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
            

            
    <script type="text/javascript" src="/shmk/Public/static/uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript" src="/shmk/Public/static/UploadImages.js"></script>
   <div class="main-title">
       <h2>新增广告</h2>
    </div>
    <div class="tab-content">
        <!-- 表单 -->
        <form action="<?php echo U('addAdImg');?>" class="form-horizontal" method="post" >
            <table class="item-details">
                <tbody>
                    <tr class="form-item">
                        <td class="row-left">填写商品名称</td>
                        <td class="row-right">
                            <div class="controls">
                                <input type="text" class="text input-large" name="name" value="">
                            </div>
                           
                        </td>
                    </tr>

                    <tr class="form-item">
                    <td class="row-left">封面图片</td>
                    <td class="row-right">
                        <input type="file" id="upload_picture">
                        <input type="hidden" name="icon" value="<?php echo ((isset($info["img_id"]) && ($info["img_id"] !== ""))?($info["img_id"]):''); ?>" class="icon" />
                        <div class="upload-img-box">
                            <?php if(!empty($info["path"])): ?><div class="upload-pre-item">
                            
                                <img src=".<?php echo ((isset($model['path']) && ($model['path'] !== ""))?($model['path']):$info['path']); ?>" data-id="<?php echo ((isset($info["img_id"]) && ($info["img_id"] !== ""))?($info["img_id"]):''); ?>" /> <span class='btn-close' title='删除图片' onclick='del(event);'></span>
                            </div><?php endif; ?>
                        </div>
                        <span class="check-tips">（显示在列表页中，只能上传一张图片，图片尺寸400*240）</span>
                    </td>
                </tr>
                    <tr class="form-item">
                        <td class="row-left">启用禁用</td>
                        <td class="row-right">
                            <label class="radio-inline">
                                <input type="radio" name="status" value="1" <?php if(($info["status"]) == "1"): ?>checked="true"<?php endif; ?>> 启用
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="0" <?php if(($info["status"]) == "0"): ?>checked="true"<?php endif; ?>> 禁用
                            </label>
                            <span class="check-tips">（是否启用）</span>
                        </td>
                    </tr>
                    <tr class="form-item">
                        <td class="row-left"></td>
                        <td class="row-right">
                           <button class="btn submit-btn ajax-post hidden" id="submit" type="submit" target-form="form-horizontal">确 定</button>
                            <a class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
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
    


    

<script type="text/javascript">
        /* 初始化上传插件*///单图上传图片
        $("#upload_picture").uploadify({
            "height"          : 30,
            "swf"             : "/shmk/Public/static/uploadify/uploadify.swf",
            "fileObjName"     : "download",
            "buttonText"      : "上传图片",
            "uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
            "width"           : 120,
            'removeTimeout'   : 1,
            'fileTypeExts'    : '*.jpg; *.png; *.gif;',
            "onUploadSuccess" : uploadPicture,
           // 'uploadLimit'     : 1,//允许连续上传的次数,超过会提示
            'onFallback' : function() {
                alert('未检测到兼容版本的Flash.');
            }
        });
    //单图
    function uploadPicture(file, data){
        var data = $.parseJSON(data);
        var src = '';
        if(data.status){
            src = data.url || '/shmk' + data.path;
            upload_img = "<div class='upload-pre-item'><img src=" + src +" title='点击显示大图' data-id="+data.id+"> <span class='btn-close btn-close-<?php echo ($field["name"]); ?>' title='删除图片' onclick='del(event);'></span></div>";
            picsbox = $("#upload_picture").siblings('.upload-img-box');
            picsbox.html(upload_img);//单图是替换
            picArr = [];
            for (var i = 0; i < picsbox.children().length ; i++) {
                picArr.push(picsbox.children('.upload-pre-item:eq('+i+')').find('img').attr('data-id'));
            };
            picStr = picArr.join(',');
            $('.icon').val(picStr);
           
        } else {
            updateAlert(data.info);
            setTimeout(function(){
                $('#top-alert').find('button').click();
                $(that).removeClass('disabled').prop('disabled',false);
            },1500);
        }
    }

     function del(event)
    { //获取事件源
        event = event ? event : window.event; 
        var obj = event.srcElement ? event.srcElement : event.target; 
        //这时obj就是触发事件的对象，可以使用它的各个属性 
        //还可以将obj转换成jquery对象，方便选用其他元素 
        str = obj.innerHTML.replace(/<\/?[^>]*>/g,''); //去除HTML tag

        var $obj = $(obj);
        $obj.parents(".upload-pre-item").remove();
        picsbox = $("#upload_picture").siblings('.upload-img-box');
            picArr = [];
            for (var i = 0; i < picsbox.children().length ; i++) {
                picArr.push(picsbox.children('.upload-pre-item:eq('+i+')').find('img').attr('data-id'));
            };
            picStr = picArr.join(',');
            $('.icon').val(picStr); 
    
    }
    //导航高亮
    highlight_subnav('<?php echo U("shop");?>');
</script>

</body>
</html>