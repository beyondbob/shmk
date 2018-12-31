<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 李仕林 <836160610@qq.com> <http://www.XXX.cn>
// +----------------------------------------------------------------------
namespace Admin\Controller;
/**
 * 主要用于下网站参数的配置
 */
class ParameterController extends AdminController
{

 

    public function shop()
    {
		$selvalue = I('selvalue');
        //搜索
        if (!empty($selvalue)) {
            $map['a.name'] = array(
                'like',
                '%' . (string) $selvalue . '%'
            );
        }
		$order='a.name asc';
        $a2b = "LEFT JOIN __PICTURE__ as b ON a.img_id=b.id";
        $model = M("ad_imgs a")->join($a2b)->join($a2c);
        $field = "a.id as id,  a.status as status, a.time as time, b.path as path, a.name as goods_name";
		$list = $this->lists($model, $map,$order,$field);
		int_to_string($list, array("status" => array("1" => "启用中", "0" => "禁用中")));
        $this->assign("list", $list);
        $this->meta_title = '广告位配置';
        $this->display();
    }

    public function onoff()
    {
        $id = I("id", 0);
        $status = I("status");
        if ($status == '1') {
            if (M("ad_imgs", "shmk_")->where(array("id" => $id))->data(array("status" => 1))->save()) {
                $this->success("启用成功");
            } else {
                $this->error("启用失败");
            }
        }
        if ($status == '0') {
            $item = M("ad_imgs")->where(array("id" => $id))->find();
            if (M("ad_imgs")->where(array("id" => $id))->data(array("status" => 0))->save()) {
                $this->success("禁用成功");
            } else {
                $this->error("禁用失败");
            }
        }
    }

    public function editAdImg()
    {
        if (IS_POST) {
            $data['id'] = I("id");
            $data['img_id'] = I("icon");
            $data['time'] = date("Y-m-d H:i:s");
			$status = I("status");
            //$this->error(json_encode($data));
            if (empty($data['id'])) {
                $this->error("数据错误");
            }
            if (empty($data['img_id'])) {
                $this->error("请上传图片");
            }
            $isOn = M("ad_imgs")->where(array("id" => $data['id']))->find();
			if ($isOn['status'] == 0) {
                $this->error("所选商品为下架商品");
            }
			if ($status == '0') {
				$item = M("ad_imgs")->where(array("id" => $data['id']))->find();
				if (!(M("ad_imgs")->where(array("id" => $data['id']))->data(array("status" => 0))->save())) {
					$this->success("禁用失败");
				}
			}
            if (M("ad_imgs")->where(array("id" => $data['id']))->data($data)->save()) {
                $this->success("保存成功");
            }else $this->error("保存失败");
        }
        $id = I("id", null);
        $a2b = "LEFT JOIN __PICTURE__ as b ON a.img_id=b.id";
        $model = M("ad_imgs a")->join($a2b);
        $field = "a.id as id,a.img_id as img_id,  a.status as status, a.time as time, b.path as path, a.name as goods_name";
        $map['a.id'] = array("eq", $id);
        $info = $model->field($field)->where($map)->find();
        //已存在的广告信息
        //dump($info);die;
        if ($info['status'] == 0) {
            $info = array();
        }
  
 
        $this->assign("info", $info);
        $this->meta_title = '编辑广告';
        $this->display();
    }


    public function ajax_goods()
    {
        if (IS_POST) {
            $p_type_id = I("post.p_type_id", 0);
            if ($goods = M("ad_imgs")->where(array("status" => 1))->field("name,id")->select()) {
                $this->ajaxReturn($goods);
            } else {
                $this->ajaxReturn(array("status" => 0));
            }
        }
    }

	public function addAdImg()
    {
        if (IS_POST) {
            $data['name'] = I("name");
            $data['img_id'] = I("icon");
            $data['time'] = date("Y-m-d H:i:s");
			$data['status'] = I("status");
            //$this->error(json_encode($data));
            if (empty($data['name'])) {
                $this->error("请填写广告名称");
            }
			if (!preg_match('/^[a-zA-Z\x{4e00}-\x{9fa5}][a-zA-Z0-9_\x{4e00}-\x{9fa5}]{1,20}$/u',$data['name']))
			{
				 $this->error('广告名非法！（中英文字母开头，只允许中英文字母、下划线和数字，长度在1-20之间）');
			}
            if (empty($data['img_id'])) {
                $this->error("请上传图片");
            }
			if (empty($data['status'])) {
                $this->error("请选择是否启用");
            }
            $isOn = M("ad_imgs")->where(array("name" => $data['name']))->find();
			if ($isOn['name'] == $data['name']) {
                $this->error("所选广告已经存在");
            }
            if (M("ad_imgs")->data($data)->add()) {
                $this->success("新增成功");
            } else $this->error("新增失败");
			
        }
		
		
        $this->meta_title = '添加广告';
        $this->display();
    }
	
	
	public function delAdImg()
    {
        if (IS_POST) {
            $data['name'] = I("name");
            //$this->error(json_encode($data));
            if (empty($data['name'])) {
                $this->error("请填写商品名称");
            }
            $isOn = M("ad_imgs")->where(array("name" => $data['name']))->find();
			if (!$isOn['name'] == $data['name']) {
                $this->error("该商品不存在");
            }
            if (M("ad_imgs")->where(array("name" => $data['name']))->delete()) {
                $this->success("删除成功");
            } else $this->error("删除失败");
			
        }
		
		
        $this->meta_title = '删除广告';
        $this->display();
    }
    
}