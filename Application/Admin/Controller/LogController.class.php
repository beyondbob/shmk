<?php
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
// | Copyright (c)
// +----------------------------------------------------------------------
// |  
// +----------------------------------------------------------------------
namespace Admin\Controller;


/**
 * 日志管理控制器
 *  
 */
class LogController extends AdminController
{
    /**
     * 资金流水首页
     *  
     */

	 public function cashflow()
    {
        $selvalue = I('selvalue');
        $type = I('type');
        $status = I('status');
        $timeStart = I('time-start');
        $timeEnd = I('time-end');

        if (!empty($selvalue)) {
			$map['name|shmk_id'] = array(
                'like',
                '%' . (string) $selvalue . '%'
            );
        }

        if ($type != '') {
            $map['a.type'] = $type;
        }

        if ($status != '') {
            $map['a.status'] = $status;
        }

        if (!empty($timeStart)) {
            if (!empty($timeEnd)) {
                $map['time'] = array('between', array($timeStart, $timeEnd));
            } else {
                $map['time'] = array('gt', $timeStart);
            }
        } else {
            if (!empty($timeEnd)) {
                $map['time'] = array('lt', $timeEnd);
            }
        }

        $field = "a.*, name as account_name, charge, type, time, info";
        $aLeftJoinB = "LEFT JOIN __USER__ as b ON a.account_id = b.shmk_id";
        $order = array('time' => 'desc');
        $model = M('cashflow as a', 'shmk_')->join($aLeftJoinB);

        $list = $this->lists($model, $map, $order, $field);
        $this->assign('type', $type);
        $this->assign('status', $status);
        $this->assign('_list', $list);
        $this->meta_title = '用户账单';
        $this->display();
    }
	
	 /**
     * 导出cashflow为excel
     *  
     */
    public function expLog()
    {
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=用户账单.xls");
        //输出内容如下：
        echo iconv("UTF-8", "GBK", "序号")."\t";
		echo iconv("UTF-8", "GBK", "市民卡号")."\t";
        echo iconv("UTF-8", "GBK", "交易人")."\t";
        echo iconv("UTF-8", "GBK", "交易金额")."\t";
        echo iconv("UTF-8", "GBK", "交易类型")."\t";
        echo iconv("UTF-8", "GBK", "交易时间")."\t";
        echo iconv("UTF-8", "GBK", "交易信息")."\t";
        echo "\n";
        $field = "a.*, name as account_name, charge, type, time, info";
        $aLeftJoinB = "LEFT JOIN __USER__ as b ON a.account_id = b.shmk_id";
        $order = array('time' => 'desc');
        $xlsModel = M('cashflow as a', 'shmk_');
        $xlsData = $xlsModel->join($aLeftJoinB)->where(array("a.status"=>1))->order($order)->field($field)->select();
        int_to_string($xlsData, array('type' => array(0 => '充值',  1 => '提现' ,2 => '支付' )));

        foreach ($xlsData as $key => $value) {
            echo iconv("UTF-8", "GBK", $key+1)."\t";
			echo iconv("UTF-8", "GBK", $value['account_id'])."\t";
            echo iconv("UTF-8", "GBK", $value['account_name'])."\t";
            echo iconv("UTF-8", "GBK", $value['charge'])."\t";
            echo iconv("UTF-8", "GBK", $value['type_text'])."\t";
            echo iconv("UTF-8", "GBK", $value['time'])."\t";
            echo iconv("UTF-8", "GBK", $value['info'])."\t";
            echo "\n";
        }
		//var_dump($xlsData);
    }
   
   

 
}
