<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// |  
// +----------------------------------------------------------------------

namespace Admin\Controller;

use Admin\Model\AuthRuleModel;
use Admin\Model\AuthGroupModel;
use Common\Api\UserApi;

/**
 * 权限管理控制器
 * Class AuthManagerController
 *  
 */
class AuthManagerController extends AdminController
{
    /**
     * 修改密码初始化
     *  
     */
    public function updatePassword()
    {
        $this->meta_title = '修改密码';
        $this->display('updatepassword');
    }

    /**
     * 修改密码提交
     *  
     */
    public function submitPassword()
    {
        //获取参数
        $password = I('post.old');
        empty($password) && $this->error('请输入原密码');
        $data['password'] = I('post.password');
        empty($data['password']) && $this->error('请输入新密码');
        $repassword = I('post.repassword');
        empty($repassword) && $this->error('请输入确认密码');

        if ($data['password'] !== $repassword) {
            $this->error('您输入的新密码与确认密码不一致');
        }

        $old_password = M('ucenter_member')->where(array('id' => UID))->getField('password');
        if (think_admin_md5($password, UC_AUTH_KEY) != $old_password) {
            $this->error('您输入的旧密码不对');
        }

        if (think_admin_md5($data['password'], UC_AUTH_KEY) == $old_password) {
            $this->error('您输入的新密码和旧密码不能一样');
        }

		if (!preg_match('/^[\w\_]{6,30}$/u',$$data['password']))
		{
			 $this->error('密码非法！（只允许字母数字下划线，长度在6-30之间）');
		}
        $model = M('ucenter_member')->where(array('id' => UID))->data(array('password' => think_admin_md5($data['password'], UC_AUTH_KEY)))->save();
        if ($model) {
            session('user_auth', null);
            session('user_auth_sign', null);
            $this->success('密码修改成功', U('Public/login'));
        } else {
            $this->error('密码修改失败');
        }

    }

    /**
     * 编辑管理员
     *  
     */
    public function editManager()
    {
        $id = $_GET['id'];
        $manager = M('ucenter_member')->where(array('id' => $id))->find();

        if (IS_POST) {
            $map['id'] = $_POST['id'];
            $map['realname'] = $_POST['realname'];
            $password = $_POST['password'];
            if (!empty($password)) {
                $map['password'] = think_admin_md5($password, UC_AUTH_KEY);
            }
			else{
				$this->error('您输入的新密码和旧密码不能一样');
			}
			if (!preg_match('/^[a-zA-Z\x{4e00}-\x{9fa5}]{0,20}$/u', $map['realname']))
			{
				 $this->error('真实姓名非法！（只允许中英文字母）');
			}
			if (!preg_match('/^[\w\_]{6,30}$/u',$password))
			{
				 $this->error('密码非法！（只允许字母数字下划线，长度在6-30之间）');
			}
            if (M('ucenter_member')->save($map)) {
                $this->success('修改成功！', U('manager'));
            } else {
                $this->error('修改失败！');
            }
        }

        $this->assign('manager', $manager);
        $this->meta_title = '编辑管理员';
        $this->display();
    }

    /**
     * 新增管理员
     *  
     */
    public function add($username = '', $password = '', $repassword = '', $realname = '')
    {
        if (IS_POST) {
			if (empty($username)) {
                $this->error('用户名不能为空！');
            }
			if (!preg_match('/^[a-zA-Z\x{4e00}-\x{9fa5}]{0,20}$/u',$realname))
			{
				 $this->error('真实姓名非法！（只允许中英文字母）');
			}
			if (!preg_match('/^[a-zA-Z\x{4e00}-\x{9fa5}][a-zA-Z0-9_\x{4e00}-\x{9fa5}]{1,20}$/u',$username))
			{
				 $this->error('用户名非法！（中英文字母开头，只允许中英文字母、下划线和数字，长度在1-20之间）');
			}
			
            /* 检测密码 */
            if (empty($password)) {
                $this->error('密码不能为空！');
            }
            if ($password != $repassword) {
                $this->error('密码和重复密码不一致！');
            }
			if (!preg_match('/^[\w\_]{6,30}$/u',$password))
			{
				 $this->error('密码非法！（只允许字母数字下划线，长度在6-30之间）');
			}
            $model = M('ucenter_member')->where(array('username' => $username))->find();
            if (empty($model)) {
                $manager = array('username' => $username, 'status' => 1, 'password' => think_admin_md5($password, UC_AUTH_KEY), 'realname' => $realname);
                if (!M('ucenter_member')->add($manager)) {
                    $this->error('管理员添加失败！');
                } else {
                    $this->success('管理员添加成功！', U('manager'));
                }
            } else {
                $this->error('用户名已存在！');
            }
        } else {
            $this->meta_title = '新增管理员';
            $this->display();
        }
    }

    /**
     * 管理员管理首页
     *  
     */
    public function manager()
    {
        $username = I('username');
        $map['status'] = array('egt', -1);

        if (!empty($username)) {
            $map['username'] = array('like', '%' . (string)$username . '%');
        }

        $list = $this->lists('ucenter_member', $map);
        int_to_string($list);
        $this->assign('_list', $list);
        $this->meta_title = '管理员';
        $this->display();
    }

    /**
     * 管理员修改
     *  
     */
    public function changeManagerStatus($method = null)
    {
        $id = array_unique((array)I('id', 0));
        if (in_array(C('USER_ADMINISTRATOR'), $id)) {
            $this->error("不允许对超级管理员执行该操作!");
        }
        $id = is_array($id) ? implode(',', $id) : $id;
        if (empty($id)) {
            $this->error('请选择要操作的数据!');
        }
        $map['id'] = array('in', $id);
        switch (strtolower($method)) {
            case 'forbiduser':
                $this->forbid('ucenter_member', '', $map);
                break;
            case 'resumeuser':
                $this->resume('ucenter_member', '', $map);
                break;
            case 'deleteuser':
				M("ucenter_member")->where(array("id" => $map['id']))->delete();
				$this->success('删除成功!');
                break;
            default:
                $this->error('参数非法');
        }
    }

    /**
     * 后台节点配置的url作为规则存入auth_rule
     * 执行新节点的插入,已有节点的更新,无效规则的删除三项任务
     *  
     */
    public function updateRules()
    {
        //需要新增的节点必然位于$nodes
        $nodes = $this->returnNodes(false);

        $AuthRule = M('AuthRule');
        $map = array('module' => 'admin', 'type' => array('in', '1,2'));//status全部取出,以进行更新
        //需要更新和删除的节点必然位于$rules
        $rules = $AuthRule->where($map)->order('name')->select();

        //构建insert数据
        $data = array();//保存需要插入和更新的新节点
        foreach ($nodes as $value) {
            $temp['name'] = $value['url'];
            $temp['title'] = $value['title'];
            $temp['module'] = 'admin';
            if ($value['pid'] > 0) {
                $temp['type'] = AuthRuleModel::RULE_URL;
            } else {
                $temp['type'] = AuthRuleModel::RULE_MAIN;
            }
            $temp['status'] = 1;
            $data[strtolower($temp['name'] . $temp['module'] . $temp['type'])] = $temp;//去除重复项
        }

        $update = array();//保存需要更新的节点
        $ids = array();//保存需要删除的节点的id
        foreach ($rules as $index => $rule) {
            $key = strtolower($rule['name'] . $rule['module'] . $rule['type']);
            if (isset($data[$key])) {//如果数据库中的规则与配置的节点匹配,说明是需要更新的节点
                $data[$key]['id'] = $rule['id'];//为需要更新的节点补充id值
                $update[] = $data[$key];
                unset($data[$key]);
                unset($rules[$index]);
                unset($rule['condition']);
                $diff[$rule['id']] = $rule;
            } elseif ($rule['status'] == 1) {
                $ids[] = $rule['id'];
            }
        }
        if (count($update)) {
            foreach ($update as $k => $row) {
                if ($row != $diff[$row['id']]) {
                    $AuthRule->where(array('id' => $row['id']))->save($row);
                }
            }
        }
        if (count($ids)) {
            $AuthRule->where(array('id' => array('IN', implode(',', $ids))))->save(array('status' => -1));
            //删除规则是否需要从每个用户组的访问授权表中移除该规则?
        }
        if (count($data)) {
            $AuthRule->addAll(array_values($data));
        }
        if ($AuthRule->getDbError()) {
            trace('[' . __METHOD__ . ']:' . $AuthRule->getDbError());
            return false;
        } else {
            return true;
        }
    }


    /**
     * 权限管理首页
     *  
     */
    public function index()
    {
        $list = $this->lists('AuthGroup', array('module' => 'admin'), 'id asc');
        $list = int_to_string($list);
        $this->assign('_list', $list);
        $this->assign('_use_tip', true);
        $this->meta_title = '权限管理';
        $this->display();
    }

    /**
     * 创建管理员用户组
     *  
     */
    public function createGroup()
    {
        if (empty($this->auth_group)) {
            $this->assign('auth_group', array('title' => null, 'id' => null, 'description' => null, 'rules' => null,));//排除notice信息
        }

        $this->meta_title = '新增用户组';
        $this->display('editgroup');
    }

    /**
     * 编辑管理员用户组
     *  
     */
    public function editGroup()
    {
        $auth_group = M('AuthGroup')->where(array('module' => 'admin', 'type' => AuthGroupModel::TYPE_ADMIN))
            ->find((int)$_GET['id']);
        $this->assign('auth_group', $auth_group);
        $this->meta_title = '编辑用户组';
        $this->display();
    }


    /**
     * 访问授权页面
     *  
     */
    public function access()
    {
        $this->updateRules();
        $auth_group = M('AuthGroup')->where(array('status' => array('egt', '0'), 'module' => 'admin', 'type' => AuthGroupModel::TYPE_ADMIN))
            ->getfield('id,id,title,rules');
        $node_list = $this->returnNodes();
        $map = array('module' => 'admin', 'type' => AuthRuleModel::RULE_MAIN, 'status' => 1);
        $main_rules = M('AuthRule')->where($map)->getField('name,id');
        $map = array('module' => 'admin', 'type' => AuthRuleModel::RULE_URL, 'status' => 1);
        $child_rules = M('AuthRule')->where($map)->getField('name,id');

        $this->assign('main_rules', $main_rules);
        $this->assign('auth_rules', $child_rules);
        $this->assign('node_list', $node_list);
        $this->assign('auth_group', $auth_group);
        $this->assign('this_group', $auth_group[(int)$_GET['group_id']]);
        $this->meta_title = '访问授权';
        $this->display('managergroup');
    }

    /**
     * 管理员用户组数据写入/更新
     *  
     */
    public function writeGroup()
    {
		$title=I('title');
        if (isset($_POST['rules'])) {
            sort($_POST['rules']);
            $_POST['rules'] = implode(',', array_unique($_POST['rules']));
        }
        $_POST['module'] = 'admin';
        $_POST['type'] = AuthGroupModel::TYPE_ADMIN;
        $AuthGroup = D('AuthGroup');
		if (M('auth_group')->where(array('title' => $title))->find()) {
			$this->error('用户组已存在！');
		}
		if (!preg_match('/^[a-zA-Z\x{4e00}-\x{9fa5}][a-zA-Z0-9_\x{4e00}-\x{9fa5}]{1,10}$/u',$username))
		{
			 $this->error('用户组名非法！（中英文字母开头，只允许中英文字母、下划线和数字，长度10以下）');
		}
        $data = $AuthGroup->create();
        if ($data) {
            if (empty($data['id'])) {
                $r = $AuthGroup->add();
            } else {
                $r = $AuthGroup->save();
            }
            if ($r === false) {
                $this->error('操作失败' . $AuthGroup->getError());
            } else {
                $this->success('操作成功!', U('index'));
            }
        } else {
            $this->error('操作失败' . $AuthGroup->getError());
        }
    }

    /**
     * 状态修改
     *  
     */
    public function changeStatus($method = null)
    {
        if (empty($_REQUEST['id'])) {
            $this->error('请选择要操作的数据!');
        }
        switch (strtolower($method)) {
            case 'forbidgroup':
                $this->forbid('AuthGroup');
                break;
            case 'resumegroup':
                $this->resume('AuthGroup');
                break;
            case 'deletegroup':
                M("auth_group")->where(array("id" => $_REQUEST['id']))->delete();
				$this->success('删除成功!');
                break;
            default:
                $this->error($method . '参数非法');
        }
    }

    public function tree($tree = null)
    {
        $this->assign('tree', $tree);
        $this->display('tree');
    }

    /**
     * 将用户添加到用户组的编辑页面
     *  
     */
    public function group()
    {
        $uid = I('uid');
        $auth_groups = D('AuthGroup')->getGroups();
        $user_groups = AuthGroupModel::getUserGroup($uid);
        $ids = array();
        foreach ($user_groups as $value) {
            $ids[] = $value['group_id'];
        }
        $nickname = D('ucenter_member')->where(array('id' => (int)$uid))->getField('username');
        $this->assign('nickname', $nickname);
        $this->assign('auth_groups', $auth_groups);
        $this->assign('user_groups', implode(',', $ids));
        $this->meta_title = '用户组授权';
        $this->display();
    }

    /**
     * 将用户添加到用户组,入参uid,group_id
     *  
     */
    public function addToGroup()
    {
        $uid = I('uid');
        $gid = I('group_id');
        if (empty($uid)) {
            $this->error('参数有误');
        }
        $AuthGroup = D('AuthGroup');
        if (is_numeric($uid)) {
            if (is_administrator($uid)) {
                $this->error('该用户为超级管理员');
            }
            if (!M('ucenter_member')->where(array('id' => $uid))->find()) {
                $this->error('用户不存在');
            }
        }

        if ($gid && !$AuthGroup->checkGroupId($gid)) {
            $this->error($AuthGroup->error);
        }
        if ($AuthGroup->addToGroup($uid, $gid)) {
            $this->success('操作成功');
        } else {
            $this->error($AuthGroup->getError());
        }
    }

    /**
     * 将用户从用户组中移除  入参:uid,group_id
     *  
     */
    public function removeFromGroup()
    {
        $uid = I('uid');
        $gid = I('group_id');
        if ($uid == UID) {
            $this->error('不允许解除自身授权');
        }
        if (empty($uid) || empty($gid)) {
            $this->error('参数有误');
        }
        $AuthGroup = D('AuthGroup');
        if (!$AuthGroup->find($gid)) {
            $this->error('用户组不存在');
        }
        if ($AuthGroup->removeFromGroup($uid, $gid)) {
            $this->success('操作成功');
        } else {
            $this->error('操作失败');
        }
    }

    /**
     * 将分类添加到用户组  入参:cid,group_id
     *  
     */
    public function addToCategory()
    {
        $cid = I('cid');
        $gid = I('group_id');
        if (empty($gid)) {
            $this->error('参数有误');
        }
        $AuthGroup = D('AuthGroup');
        if (!$AuthGroup->find($gid)) {
            $this->error('用户组不存在');
        }
        if ($cid && !$AuthGroup->checkCategoryId($cid)) {
            $this->error($AuthGroup->error);
        }
        if ($AuthGroup->addToCategory($gid, $cid)) {
            $this->success('操作成功');
        } else {
            $this->error('操作失败');
        }
    }

    /**
     * 将模型添加到用户组  入参:mid,group_id
     */
    public function addToModel()
    {
        $mid = I('id');
        $gid = I('get.group_id');
        if (empty($gid)) {
            $this->error('参数有误');
        }
        $AuthGroup = D('AuthGroup');
        if (!$AuthGroup->find($gid)) {
            $this->error('用户组不存在');
        }
        if ($mid && !$AuthGroup->checkModelId($mid)) {
            $this->error($AuthGroup->error);
        }
        if ($AuthGroup->addToModel($gid, $mid)) {
            $this->success('操作成功');
        } else {
            $this->error('操作失败');
        }
    }

	

	


}



