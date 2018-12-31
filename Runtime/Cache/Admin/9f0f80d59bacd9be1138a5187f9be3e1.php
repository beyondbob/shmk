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
            

            
    <!-- 标签页导航 -->
    <div class="tab-wrap">
        <ul class="tab-nav nav">
            <li class="tab"><a href="<?php echo U('editGoods',array('good_id'=>I('good_id')));?>">查看商品</a></li>
            <li class="tab current"> <a href="#">编辑规格</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <!-- 表单 -->
        <form action="<?php echo U('editSpec');?>" class="form-horizontal" method="post" id="eSpecForm" >
            <div id="tab1" class="tab-pane in">
            <!-- 规格配置 -->
            <?php if(is_array($config)): foreach($config as $k=>$vo): ?><div class="form-item cf">
                    <label class="item-label"><?php echo ($vo["title"]); ?><span class="check-tips"></span></label>
                    <?php if(is_array($vo['info'][0])): foreach($vo['info'][0] as $k1=>$item): ?>&nbsp;&nbsp;&nbsp;
                        <label for="<?php echo ($k); echo ($k1); ?>">
                            <input type="checkbox" id="<?php echo ($k); echo ($k1); ?>" name="spec_id_<?php echo ($k); ?>" class="" value="<?php echo ($item['title']); ?>">
                            <?php echo ($item['title']); ?>
                        </label><?php endforeach; endif; ?>
                </div><?php endforeach; endif; ?>
            <script type="text/javascript">
                var num_goods = '<?php echo count($good_item);?>'
                var num_conf = '<?php echo ($num_conf); ?>';
               // alert(num_conf)
                '<?php if(is_array($good_item)): foreach($good_item as $key=>$vo): ?>'
                    '<?php $__FOR_START_14964__=0;$__FOR_END_14964__=$num_conf;for($i=$__FOR_START_14964__;$i < $__FOR_END_14964__;$i+=1){ ?>'
                        val = '<?php echo ($vo["specs"][$i]); ?>'
                        //alert(val)
                        $("input[value="+val+"]").attr("checked","true")
                    '<?php } ?>'
                '<?php endforeach; endif; ?>'
              
            </script>
                <button class="btn submit-btn" id="save" type="button">保存</button>
                <div class="data-table table-striped">
                    <table class="table1">
                    <thead>
                        <tr>
                        <!-- <th class="row-selected row-selected"><input class="check-all" type="checkbox"/></th> -->
                        <th class="">规格</th>
                        <th class="">编码</th>
                        <th class="">条码</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($good_item)): $k = 0; $__LIST__ = $good_item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr id="<?php echo ($vo['specs'][1]); ?>">
                           <!--  <td><input class="ids" type="checkbox" name="id[]" value="<?php echo ($vo["student_id"]); ?>" /></td> -->
                            <td>
                               <input type="hidden" name="spec_item_id[]" value="<?php echo ($vo['spec_item_id']); ?>">
                               <?php $__FOR_START_12871__=0;$__FOR_END_12871__=$num_conf;for($i=$__FOR_START_12871__;$i < $__FOR_END_12871__;$i+=1){ echo ($vo['specs'][$i]); ?>&nbsp;
                                    <input type="hidden" name="spec<?php echo ($i); ?>[]" class="spec<?php echo ($i); ?>" value="<?php echo ($vo['specs'][$i]); ?>"><?php } ?>
                            </td>
                            <td><input type="text" class="spec_no" name="spec_no[]" value="<?php echo ($vo['spec_no']); ?>"></td>
                            <td><input type="text" class="barcode" name="barcode[]" value="<?php echo ($vo['barcode']); ?>"></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                    </table>
                </div>
              
            </div>
            <div class="form-item cf">
                <input type="hidden" name="good_id" value="<?php echo I('good_id');?>">
            </div>
        </form>
         <button class="btn submit-btn hidden ajax-post" id="submit" type="button" onclick="sub_form()" target-form="form-horizontal">确 定</button>
         <a class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</a>
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
  function sub_form(){
    if(confirm("确认提交数据吗?")){
        $(".table1>tbody>tr").each(function(){
          if($(this).css("display") == 'none'){
            $(this).remove()
          }
        })
        $("#eSpecForm").submit()
    }else{
      console.log("暂时不提交的呢！！！")
      return;
    }
   
  }
 
</script>



    <script type="text/javascript">
    function  createId(){
        //遍历第一个规格
        $(".spec0").each(function(index1,val){
            $("input[name=spec_id_0]").each(function(index2,val2){
                  //alert(index2)
                if($(val).attr('value') == $(val2).attr('value')){
                    $(".spec0:eq("+index1+")").parent().parent().attr("id",index2+1);
                }
              
            })

        })
        //遍历第二个规格
        $(".spec1").each(function(index1,val){
            $("input[name=spec_id_1]").each(function(index2,val2){
                if($(val).attr('value') == $(val2).attr('value')){
                    id = $(".spec1:eq("+index1+")").parents().parents().attr("id");
                    $(".spec1:eq("+index1+")").parent().parent().attr("id",id+index2);
                }
              
            })

        })
    }
    createId();

        $("#save").click(function(){
           var s1 = $("input[name=spec_id_0]:checked").val()
           var s2 = $("input[name=spec_id_1]:checked").val()
           if(s1 == undefined || s2 == undefined){
                alert("请选择完整规格！")
                return;
           }
           $("input[name=spec_id_0]:checked").val()
           var c1_len = $("input[name=spec_id_0]").length;
           var c2_len = $("input[name=spec_id_1]").length;
           var param = {
                "spec1":{},
                "spec2":{}
           }
           param.spec1 = '';
           param.spec2 = '';
           $("input[name=spec_id_0]").each(function(index){
               temp = $("input[name=spec_id_0]:eq("+index+"):checked").val()
               untemp = $("input[name=spec_id_0]:eq("+index+")").val()
               if(temp !== undefined){
                 param.spec1 += temp+',';
               }else{
                $(".table1 input[value="+untemp+"]").parents("tr").hide();
               }
           })
            $("input[name=spec_id_1]").each(function(index){
               temp = $("input[name=spec_id_1]:eq("+index+"):checked").val()
               untemp = $("input[name=spec_id_1]:eq("+index+")").val()
               if(temp !== undefined){
                 param.spec2 += temp+','
               }else{
                $(".table1 input[value="+untemp+"]").parents("tr").hide();
               }
            })
         
             $("input[name=spec_id_0]:checked").each(function(i){
                 $("input[name=spec_id_1]:checked").each(function(j){
                    temp1 = $("input[name=spec_id_0]:checked:eq("+i+")").val()
                    temp2 = $("input[name=spec_id_1]:checked:eq("+j+")").val()
                    exist = 0;
                    $(".table1>tbody>tr").each(function(k){
                       if($(this).css("display") == 'none'){
                            console.log("这是不需要的tr行")
                            if($(".spec0:eq("+k+")").val() == temp1 && $(".spec1:eq("+k+")").val() == temp2){
                                exist = 1;
                                $(this).show();
                           }
                       }else{
                            if($(".spec0:eq("+k+")").val() == temp1 && $(".spec1:eq("+k+")").val() == temp2){
                                exist = 1
                           }
                       }
                    });
                    //第一规格的value的index
                    var myindex = $("input[name=spec_id_0][value="+temp1+"]").index()
                    if(exist == 0){
                        html = '';
                        html += '<tr id="">';
                        html += '<td>';
                        html += temp1+'&nbsp';
                        html += '<input type="hidden" name="spec_item_id[]" value="">';
                        html += '<input type="hidden" name="spec0[]" class="spec0" value="'+temp1+'">';
                        html += temp2+'&nbsp';
                        html += '<input type="hidden" name="spec1[]" class="spec1" value="'+temp2+'">';
                        html += '</td>';
                        html += '<td><input type="text" class="spec_no"  name="spec_no[]" value=""></td>';
                        html += '<td><input type="text" class="barcode" name="barcode[]" value=""></td>';
                        html += '</tr>';
                        $(".table1>tbody").append(html);
                       
                    }
                 })
             })
            //mysort();
           //console.log(param)
           createId();
           mysort();
        })
 
        function mysort(){
            var $arr = $("tbody").children();
            $arr.sort(function(a,b){
              return a.id - b.id;
            });
            $("tbody").html("");
            $("tbody").append($arr);
        }
        mysort();
//导航高亮
highlight_subnav('<?php echo U("Goods/show");?>');
</script>


</body>
</html>