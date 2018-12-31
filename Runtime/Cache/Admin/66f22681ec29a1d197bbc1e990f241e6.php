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
            

             <script type="text/javascript"
	src="/shmk/Public/static/uploadify/jquery.uploadify.min.js"></script> <script
	type="text/javascript" src="/shmk/Public/static/UploadImages.js"></script> <!-- 标签页导航 -->
<ul class="tab-nav nav">
	<li class="tab current"><a href="#">查看商品</a></li>
	<li class="tab"><a href="<?php echo U('editSpec',array('good_id'=>I('good_id')));?>">编辑规格</a></li>
</ul>

<div class="tab-content">
	<!-- 表单 -->
	<form action="<?php echo U('editGoods');?>" class="form-horizontal" method="post">
		<table class="item-details">
	        <tbody>
	            <tr class="form-item">
	                <td class="row-left">标题</td>
	                <td class="row-right">
	                    <input type="text" class="text input-large" name="name" value="<?php echo ($goods["name"]); ?>">
	                    <span class="check-tips">（商品名称）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">商品详细描述</td>
	                <td class="row-right">
	                    <label class="textarea"> <textarea name="info"><?php echo ($goods["info"]); ?></textarea>
							<?php echo hook('adminArticleEdit', array('name'=>$info,'value'=>$field['value']));?>
						</label>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">封面图片</td>
	                <td class="row-right">
	                    <input type="file" id="upload_picture">
						<input type="hidden" name="icon" value="<?php echo ((isset($firstimg["id"]) && ($firstimg["id"] !== ""))?($firstimg["id"]):''); ?>" class="icon" />
						
						<div class="upload-img-box">
							<?php if(!empty($firstimg["path"])): ?><div class="upload-pre-item">
								<img src=".<?php echo ((isset($firstimg["path"]) && ($firstimg["path"] !== ""))?($firstimg["path"]):$model['path']); ?>"
									data-id="<?php echo ((isset($firstimg["id"]) && ($firstimg["id"] !== ""))?($firstimg["id"]):''); ?>" /> <span
									class='btn-close' title='删除图片' onclick='del(event);'></span>
							</div><?php endif; ?>
						</div>
						<span class="check-tips">（显示在列表页中，只能上传一张图片，推荐尺寸300*300）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">商品幻灯片</td>
	                <td class="row-right">
	                    <input type="file" id="upload_picture_more">
	                    <input type="hidden" name="icon_more" value="<?php echo ((isset($goods['img_ids']) && ($goods['img_ids'] !== ""))?($goods['img_ids']):''); ?>" class="icon_more" />
	                    <?php if($goods['img_ids']) { $valArr= explode(',',$goods['img_ids']); } else{ $valArr="";} ?>
	                    <div class="upload-img-box">
							<?php if(!empty($goods['pic'])): if(is_array($goods['pic'])): $i = 0; $__LIST__ = $goods['pic'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="upload-pre-item pics">
				                    <img src="<?php echo ($v["path"]); ?>" data-id="<?php echo ($v["id"]); ?>"/>
				                    <span class='btn-close btn-close-<?php echo ($field["name"]); ?>' title='删除图片'onclick='delmore(event);'></span>
				                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</div>
	                	<span class="check-tips">（最多支持5张幻灯片，推荐尺寸400*400）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">原价</td>
	                <td class="row-right">
	                    <input type="number" min="0" class="text input-large" name="original_price" value="<?php echo ($goods["original_price"]); ?>">
	                    <span class="check-tips">（原价）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">现价</td>
	                <td class="row-right">
	                    <input type="number" min="0" class="text input-large" name="current_price" value="<?php echo ($goods["current_price"]); ?>">
	                    <span class="check-tips">（现价）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">初级经销商价格</td>
	                <td class="row-right">
	                    <input type="number" min="0" class="text input-large" name="level_one_price" value="<?php echo ($goods["level_one_price"]); ?>">
	                    <span class="check-tips">（初级经销商购买价格）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">中级经销商价格</td>
	                <td class="row-right">
	                    <input type="number" min="0" class="text input-large" name="level_two_price" value="<?php echo ($goods["level_two_price"]); ?>" />
	                	<span class="check-tips">（中级经销商购买价格）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">高级经销商价格</td>
	                <td class="row-right">
	                    <input type="number" min="0" class="text input-large" name="level_three_price" value="<?php echo ($goods["level_three_price"]); ?>" />
	                    <span class="check-tips">（高级经销商购买价格）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">特约经销商价格</td>
	                <td class="row-right">
	                    <input type="number" min="0" class="text input-large" name="level_four_price" value="<?php echo ($goods["level_four_price"]); ?>" />
	                    <span class="check-tips">（特约经销商购买价格）</span>
	                </td>
	            </tr>
				<tr class="form-item">
					<td class="row-left">佣金</td>
					<td class="row-right">
						<input type="number" class="text input-large" name="commission" value="<?php echo ($goods["commission"]); ?>" />
						<span class="check-tips"></span>
					</td>
				</tr>
	            <tr class="form-item">
	                <td class="row-left">单位</td>
	                <td class="row-right">
	                    <input type="text" class="text input-large" name="unit" value="<?php echo ($goods["unit"]); ?>">
	                    <span class="check-tips">（比如：双，支）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">库存</td>
	                <td class="row-right">
	                   <input type="number" min="1" class="text input-large" name="stock" value="<?php echo ($goods["stock"]); ?>">
	                   <span class="check-tips">（比如：双，支）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">积分</td>
	                <td class="row-right">
	                   <input type="number" min="0" class="text input-large" name="integral" value="<?php echo ($goods["integral"]); ?>">
	                   <span class="check-tips">（此商品的积分）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">新品标记<span class="check-tips"></span></td>
	                <td class="row-right">
	                   <label class="radio-inline">
	                		<input type="radio" name="marknew" value="1" <?php if(($goods["marknew"]) == "1"): ?>checked="true"<?php endif; ?>> 是
						</label>
						<label class="radio-inline">
							<input type="radio" name="marknew" value="0" <?php if(($goods["marknew"]) == "0"): ?>checked="true"<?php endif; ?>> 否
						</label>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">热销标记<span class="check-tips"></span></td>
	                <td class="row-right">
	                   <label class="radio-inline">
	                		<input type="radio" name="markhot" value="1" <?php if(($goods["markhot"]) == "1"): ?>checked="true"<?php endif; ?>> 是
						</label>
						<label class="radio-inline">
							<input type="radio" name="markhot" value="0" <?php if(($goods["markhot"]) == "0"): ?>checked="true"<?php endif; ?>> 否
						</label>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">推荐标记<span class="check-tips"></span></td>
	                <td class="row-right">
	                	<label class="radio-inline">
	                		<input type="radio" name="markcomm" value="1" <?php if(($goods["markcomm"]) == "1"): ?>checked="true"<?php endif; ?>> 是
						</label>
						<label class="radio-inline">
							<input type="radio" name="markcomm" value="0" <?php if(($goods["markcomm"]) == "0"): ?>checked="true"<?php endif; ?>> 否
						</label>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">创建时间</td>
	                <td class="row-right">
	                	<?php echo ($goods["create_time"]); ?>
	                	<span class="check-tips">（商品创建时间）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	                <td class="row-left">更新时间</td>
	                <td class="row-right">
	                	<?php echo ($goods["update_time"]); ?>
	                	<span class="check-tips">（商品最近更新时间）</span>
	                </td>
	            </tr>
	            <tr class="form-item">
	            	<input type="hidden" name="good_id" value="<?php echo I('good_id');?>">
	                <td class="row-left">
	                </td>
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
    
<script type="text/javascript">
	var that = this;
    $(function(){
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
            //'uploadLimit'     : 1,//允许连续上传的次数,超过会提示
            'onFallback' : function() {
                alert('未检测到兼容版本的Flash.');
            }
        });



        /* 初始化上传插件*///多图上传图片
        $("#upload_picture_more").uploadify({
            "height"          : 30,
            "swf"             : "/shmk/Public/static/uploadify/uploadify.swf",
            "fileObjName"     : "download",
            "buttonText"      : "上传图片",
            "uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
            "width"           : 120,
            'removeTimeout'   : 1,
            'fileTypeExts'    : '*.jpg; *.png; *.gif;',
            "onUploadSuccess" : uploadPictureMore,
            'uploadLimit'     : 100,//允许连续上传的次数,超过会提示
            'onFallback' : function() {
                alert('未检测到兼容版本的Flash.');
            }
        });




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
    //多图
    function uploadPictureMore(file, data){
        var data = $.parseJSON(data);
        var src = '';
        if(data.status){
            src = data.url || '/shmk' + data.path;
            upload_img = "<div class='upload-pre-item pics'><img src=" + src +" title='点击显示大图' data-id="+data.id+"> <span class='btn-close btn-close-<?php echo ($field["name"]); ?>' title='删除图片' onclick='delmore(event);'></span></div>";
            picsbox = $("#upload_picture_more").siblings('.upload-img-box');
            picsbox.append(upload_img);//多图是追加
            picArr = [];
            for (var i = 0; i < picsbox.children().length ; i++) {
                picArr.push(picsbox.children('.upload-pre-item:eq('+i+')').find('img').attr('data-id'));
            };
            picStr = picArr.join(',');
            $('.icon_more').val(picStr);
            limitPics();
        } else {
            updateAlert(data.info);
            setTimeout(function(){
                $('#top-alert').find('button').click();
                $(that).removeClass('disabled').prop('disabled',false);
            },1500);
        }
    }
    function limitPics() {
        // 多图上传图片 已有图片数量
        try {
            pics = $(".pics").length;
            // alert(pics)
        }catch (e) {
            pics = 0
        }

        if( pics > 5 ){
            $(".pics").each(function (j) {
                if( j >= 5 ){
                    $(this).remove();
                }
            });
            picsbox = $("#upload_picture_more").siblings('.upload-img-box');
            picArr = [];
            for (var i = 0; i < picsbox.children().length ; i++) {
                picArr.push(picsbox.children('.upload-pre-item:eq('+i+')').find('img').attr('data-id'));
            };
            picStr = picArr.join(',');
            $('.icon_more').val(picStr);

        }
        //$('#upload_picture_more').uploadify('settings','uploadLimit', 6-pics);
    }
    function delmore(event)
    { //获取事件源
        event = event ? event : window.event; 
        var obj = event.srcElement ? event.srcElement : event.target; 
        //这时obj就是触发事件的对象，可以使用它的各个属性 
        //还可以将obj转换成jquery对象，方便选用其他元素 
        str = obj.innerHTML.replace(/<\/?[^>]*>/g,''); //去除HTML tag

        var $obj = $(obj);
        $obj.parents(".upload-pre-item").remove();
        picsbox = $("#upload_picture_more").siblings('.upload-img-box');
            picArr = [];
            for (var i = 0; i < picsbox.children().length ; i++) {
                picArr.push(picsbox.children('.upload-pre-item:eq('+i+')').find('img').attr('data-id'));
            };
            picStr = picArr.join(',');
            $('.icon_more').val(picStr);     
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

        $('#upload_picture').uploadify('settings', 'uploadLimit','100');

        picsbox = $("#upload_picture").siblings('.upload-img-box');
            picArr = [];
            for (var i = 0; i < picsbox.children().length ; i++) {
                picArr.push(picsbox.children('.upload-pre-item:eq('+i+')').find('img').attr('data-id'));
            };
            picStr = picArr.join(',');
            $('.icon').val(picStr);

    
    }
    //导航高亮
	highlight_subnav('<?php echo U("Goods/show");?>');
</script>

</body>
</html>