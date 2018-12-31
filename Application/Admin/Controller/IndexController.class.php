<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Admin\Controller;

/**
 * 后台首页控制器
 * 
 */
class IndexController extends AdminController
{
    /**
     * 后台首页
     * 
     */
    public function index()
    {
		$field = "count(a.id) as times" ;
		$aRightJoinB = "RIGHT JOIN __MONTH__ as b ON MONTH(a.out_station_time) = b.month";
		$model = M('dt_record as a','shmk_')->join($aRightJoinB);
		$list = $model->field($field)->where('YEAR(a.out_station_time) ='+date("Y"))->group('month')->select();
		foreach($list as $key => $value)
		{
			$data[] = $value[times];
		}
		//dump(date('Y'));
		//$data="100|334|371|278|685|587|490|256|398|545|367|577";//构造数据 
		$this->assign('data',implode("|",$data)); 
		
		//零钱支付
		$field1 = "count(a1.id) as times" ;
		$a1RightJoinB1 = "RIGHT JOIN __MONTH__ as b1 ON MONTH(a1.time) = b1.month";
		$b1LEFTJoinC1 = "LEFT JOIN __DT_RECORD__ as c1 ON a1.time=c1.out_station_time and a1.account_id=c1.account_id";
		$model1 = M('cashflow as a1','shmk_')->join($a1RightJoinB1)->join($b1LEFTJoinC1);
		$list1 = $model1->field($field1)->where('YEAR(a1.time)='+date("Y")+' and a1.paytype=0 and a1.type=2 or a1.type is NULL')->group('b1.month')->select();
		
		foreach($list1 as $key => $value)
		{
			$data1[] = $value[times];
		}

		//银行卡支付
		$field2 = "count(a2.id) as times" ;
		$a2RightJoinB2 = "RIGHT JOIN __MONTH__ as b2 ON MONTH(a2.time) = b2.month";
		$b2LEFTJoinC2 = "LEFT JOIN __DT_RECORD__ as c2 ON a2.time=c2.out_station_time and a2.account_id=c2.account_id";
		$model2 = M('cashflow as a2','shmk_')->join($a2RightJoinB2)->join($b2LEFTJoinC2);
		$list2 = $model2->field($field2)->where('YEAR(a2.time)='+date("Y")+' and a2.paytype=1 and a2.type=2 or a2.type is NULL')->group('b2.month')->select();
		//dump(date("Y"));
		foreach($list2 as $key => $value)
		{
			$data2[] = $value[times];
		}
				
		//$data="100|334|371|278|685|587|490|256|398|545|367|577";//构造数据 
		$this->assign('data1',implode("|",$data1)); 
		$this->assign('data2',implode("|",$data2)); 
       

        $this->meta_title = '首页';
        $this->display();
    }
	   /**
    * 地铁统计报表
    *
	*/
	public function dt_datareport()
	{
		$field = "count(a.id) as times" ;
		$aRightJoinB = "RIGHT JOIN __MONTH__ as b ON MONTH(a.out_station_time) = b.month";
		$model = M('dt_record as a','shmk_')->join($aRightJoinB);
		$list = $model->field($field)->where('YEAR(a.out_station_time) ='+date("Y"))->group('month')->select();
		foreach($list as $key => $value)
		{
			$data[] = $value[times];
		}
		//dump(date('Y'));
		//$data="100|334|371|278|685|587|490|256|398|545|367|577";//构造数据 
		$this->assign('data',implode("|",$data)); 
		$this->meta_title = '统计报表';
        $this->display();
		//dump($data);
	}
	
	   /**
    * 支付方式统计报表
    *
	*/
	public function pay_datareport()
	{
		//零钱支付
		$field1 = "count(a1.id) as times" ;
		$a1RightJoinB1 = "RIGHT JOIN __MONTH__ as b1 ON MONTH(a1.time) = b1.month";
		$b1LEFTJoinC1 = "LEFT JOIN __DT_RECORD__ as c1 ON a1.time=c1.out_station_time and a1.account_id=c1.account_id";
		$model1 = M('cashflow as a1','shmk_')->join($a1RightJoinB1)->join($b1LEFTJoinC1);
		$list1 = $model1->field($field1)->where('YEAR(a1.time)='+date("Y")+' and a1.paytype=0 and a1.type=2 or a1.type is NULL')->group('b1.month')->select();
		
		foreach($list1 as $key => $value)
		{
			$data1[] = $value[times];
		}

		//银行卡支付
		$field2 = "count(a2.id) as times" ;
		$a2RightJoinB2 = "RIGHT JOIN __MONTH__ as b2 ON MONTH(a2.time) = b2.month";
		$b2LEFTJoinC2 = "LEFT JOIN __DT_RECORD__ as c2 ON a2.time=c2.out_station_time and a2.account_id=c2.account_id";
		$model2 = M('cashflow as a2','shmk_')->join($a2RightJoinB2)->join($b2LEFTJoinC2);
		$list2 = $model2->field($field2)->where('YEAR(a2.time)='+date("Y")+' and a2.paytype=1 and a2.type=2 or a2.type is NULL')->group('b2.month')->select();
		//dump(date("Y"));
		foreach($list2 as $key => $value)
		{
			$data2[] = $value[times];
		}
				
		//$data="100|334|371|278|685|587|490|256|398|545|367|577";//构造数据 
		$this->assign('data1',implode("|",$data1)); 
		$this->assign('data2',implode("|",$data2)); 
		$this->meta_title = '统计报表';
        $this->display();
		//dump($data);
	}
}
