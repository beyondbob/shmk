<?php
require_once ("src/jpgraph.php");
require_once ("src/jpgraph_line.php");
 
$data = $_GET['data']; //第一条曲线的数组
$data1=explode("|",$data);  
$graph = new Graph(600,360); 
$graph->SetScale("textlin");
$graph->SetShadow();   
$graph->img->SetMargin(60,30,40,50); //设置图像边距
$year=date("Y");
$graph->graph_theme = null; //设置主题为null，否则value->Show(); 无效
 
$lineplot1=new LinePlot($data1); //创建设置两条曲线对象
$lineplot1->value->SetColor("blue");
$lineplot1->value->Show();
$graph->Add($lineplot1);  //将曲线放置到图像上
 
$graph->title->Set("$year 用户银行卡支付变化折线图");   //设置图像标题
$graph->xaxis->title->Set("月份"); //设置坐标轴名称
$graph->yaxis->title->Set("次 数(次)");
$graph->title->SetMargin(10);
$graph->title->SetColor("red");
$graph->xaxis->title->SetMargin(10);
$graph->yaxis->title->SetMargin(10);
 
$graph->title->SetFont(FF_SIMSUN,FS_BOLD); //设置字体
$graph->yaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
$graph->xaxis->title->SetFont(FF_SIMSUN,FS_BOLD); 
$graph->xaxis->SetTickLabels($gDateLocale->GetShortMonth());
 
$graph->Stroke();  //输出图像
?>
