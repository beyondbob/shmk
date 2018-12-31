<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// |  
// +----------------------------------------------------------------------
namespace Admin\Controller;

/**
 * 会员制器
 *  
 */
class MemberController extends AdminController {

   
    
    /**
     * 状态修改
     *    
     */
    public function changeStatus($method=null){
        $id = array_unique((array)I('shmk_id',0));
    
        $id = is_array($id) ? implode(',',$id) : $id;
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map['shmk_id'] =   array('in',$id);
        switch ( strtolower($method) ){
            case 'forbid':
                $this->forbid('user','shmk_', $map );
                break;
            case 'resume':
                $this->resume('user','shmk_', $map );
                break;
            default:
                $this->error('参数非法');
        }
    }
    /**
     *
     *  
     */
    public function index(){
        $selvalue = I('selvalue');
        $status = I('status');
        //搜索
        if (! empty($selvalue)) {
            $map['a.name|a.tel'] = array(
                'like',
                '%' . (string) $selvalue . '%'
            );
        }
        
    
        
        $order='a.shmk_id desc';
            
        $model = M()
            ->table('shmk_user a')
            ->where(array('a.shmk_id'=>array('gt', 0)));
        
        $list   = $this->lists($model, $map,$order,'a.*,a.avatar as savatar, a.name as sname');
        //dump($list);die;
        int_to_string($list);
        //dump($lists);
        $this->assign('status',$status);
        $this->assign('_list', $list);
        $this->meta_title = '用户管理';
        $this->display();
    }
	 /**
     * 乘车记录查看
     *  
     */
    public function drivingrecord()
    {
        $selvalue = I('selvalue');
        $type = I('type');
        $status = I('status');
        $timeStart = I('time-start');
        $timeEnd = I('time-end');
        $stationStart = I('station-start');
        $stationEnd = I('station-end');
        if (!empty($selvalue)) {
			$map['name|b.shmk_id'] = array(
                'like',
                '%' . (string) $selvalue . '%'
            );
        }

        if ($type != '') {
            $map['c.paytype'] = $type;
        }

        if ($status != '') {
            $map['a.status'] = $status;
        }

        if (!empty($timeStart)) {
            if (!empty($timeEnd)) {
                $map['in_station_time'] = array('between', array($timeStart, $timeEnd));
				$map['out_station_time'] = array('between', array($timeStart, $timeEnd));
            } else {
                $map['in_station_time'] = array('gt', $timeStart);
				$map['out_station_time'] = array('gt', $timeStart);
            }
        } else {
            if (!empty($timeEnd)) {
                $map['in_station_time'] = array('lt', $timeEnd);
				$map['out_station_time'] = array('lt', $timeEnd);
            }
        }

        if (!empty($stationStart)) {
			$map['in_station'] =  array('like','%' . (string) $stationStart . '%');
            if (!empty($stationEnd)) {
				$map['out_station'] = array('like','%' . (string)  $stationEnd . '%');
            }
        } else {
            if (!empty($stationEnd)) {
				$map['out_station'] = array('like','%' . (string)  $stationEnd . '%');
            }
        }

        $field = "a.*, a.account_id, b.name as account_name, b.tel, in_station, out_station, in_station_time, out_station_time,c.paytype,check,c.money";
        $aLeftJoinB = "LEFT JOIN __USER__ as b ON a.account_id = b.shmk_id";
		$bLeftJoinC = "LEFT JOIN __CASHFLOW__ as c ON a.out_station_time = c.time and a.account_id=c.account_id";
        $order = array('out_station_time' => 'desc');
        $model = M('dt_record as a', 'shmk_')->join($aLeftJoinB)->join($bLeftJoinC);

        $list = $this->lists($model, $map, $order, $field);
        $this->assign('type', $type);
        $this->assign('status', $status);
        $this->assign('_list', $list);
        $this->meta_title = '乘车记录';
        $this->display();
    }


   
	
	    /**
     * 导出drivingrecord为excel
     *  
     */
    public function expdrivingrecord()
    {
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=乘车记录.xls");
        //输出内容如下：
        echo iconv("UTF-8", "GBK", "序号")."\t";
		echo iconv("UTF-8", "GBK", "市民卡号")."\t";
        echo iconv("UTF-8", "GBK", "交易人")."\t";
		echo iconv("UTF-8", "GBK", "电话号码")."\t";
		echo iconv("UTF-8", "GBK", "起始站")."\t";
		echo iconv("UTF-8", "GBK", "结束站")."\t";
		echo iconv("UTF-8", "GBK", "进站时间")."\t";
		echo iconv("UTF-8", "GBK", "出站时间")."\t";
		echo iconv("UTF-8", "GBK", "支付类型")."\t";
        echo iconv("UTF-8", "GBK", "交易金额")."\t";
        echo iconv("UTF-8", "GBK", "余额")."\t";
        echo "\n";
        $field = "a.*, a.account_id, b.name as account_name, b.tel, in_station, out_station, in_station_time, out_station_time,c.paytype,check,c.money";
        $aLeftJoinB = "LEFT JOIN __USER__ as b ON a.account_id = b.shmk_id";
		$bLeftJoinC = "LEFT JOIN __CASHFLOW__ as c ON a.out_station_time = c.time and a.account_id=c.account_id";
        $order = array('a.in_station_time,a.out_station_time' => 'desc');
        $xlsModel = M('dt_record as a', 'shmk_')->join($aLeftJoinB)->join($bLeftJoinC);
        $xlsData = $xlsModel->where(array("a.status"=>1))->order($order)->field($field)->select();
        int_to_string($xlsData, array('paytype' => array(0 => '零钱',  1 => '银行卡' )));

        foreach ($xlsData as $key => $value) {
            echo iconv("UTF-8", "GBK", $key+1)."\t";
			echo iconv("UTF-8", "GBK", $value['account_id'])."\t";
            echo iconv("UTF-8", "GBK", $value['account_name'])."\t";
			echo iconv("UTF-8", "GBK", $value['tel'])."\t";
            echo iconv("UTF-8", "GBK", $value['in_station'])."\t";
            echo iconv("UTF-8", "GBK", $value['out_station'])."\t";
            echo iconv("UTF-8", "GBK", $value['in_station_time'])."\t";
            echo iconv("UTF-8", "GBK", $value['out_station_time'])."\t";
			echo iconv("UTF-8", "GBK", $value['paytype_text'])."\t";
			echo iconv("UTF-8", "GBK", $value['check'])."\t";
			echo iconv("UTF-8", "GBK", $value['money'])."\t";
            echo "\n";
        }
		//var_dump($xlsData);
    }

}