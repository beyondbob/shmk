<?php
require_once ("src/jpgraph.php");
require_once ("src/jpgraph_bar.php");
 
$data=$_GET['data'];
$data1=explode("|",$data);          
$ydata = array("一","二","三","四","五","六","七","八","九","十","十一","十二");
$year=date("Y");
$graph = new Graph(600,360);  //创建新的Graph对象
$graph->SetScale("textlin");  //刻度样式
$graph->SetShadow();          //设置阴影
$graph->img->SetMargin(40,30,40,50); //设置边距
 
$graph->graph_theme = null; //设置主题为null，否则value->Show(); 无效
 
$barplot = new BarPlot($data1);  //创建BarPlot对象
$barplot->SetFillColor('blue'); //设置颜色
$barplot->value->Show(); //设置显示数字
$graph->Add($barplot);  //将柱形图添加到图像中
 
$graph->title->Set("$year 年用户地铁使用总次数变化条形图"); 
$graph->xaxis->title->Set("月份"); //设置标题和X-Y轴标题
$graph->yaxis->title->Set("次 数(次)");                                                                      
$graph->title->SetColor("red");
$graph->title->SetMargin(10);
$graph->xaxis->title->SetMargin(5);
$graph->xaxis->SetTickLabels($ydata);
 
$graph->title->SetFont(FF_SIMSUN,FS_BOLD);  //设置字体
$graph->yaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
$graph->xaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
$graph->xaxis->SetFont(FF_SIMSUN,FS_BOLD);
$graph->xaxis->SetTickLabels($gDateLocale->GetShortMonth());
$graph->Stroke();
?> 