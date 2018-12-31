<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
namespace Admin\Controller;



/**
 * 后台首页控制器
 * 
 * 
 */
class PublicController extends \Think\Controller
{

    /**
     * 后台用户登录
     * 
     * 
     */
    public function login($username = null, $password = null, $verify = null, $key = NULL)
    {
        if (IS_POST) {
            /* 检测验证码 TODO: */
            // if(!check_verify($verify)){
            // $this->error('验证码输入错误！');
            // }
            $username = safe_replace($username); // 过滤
            
            $Member = D('ucenter_member')->where(array(
                'username' => $username
            ))->find();
            if (! empty($Member)) {
                switch ($Member['status']) {
                    case - 1:
                        {
                            $this->error('用户不存在');
                            break;
                        }
                    case 0:
                        {
                            $this->error('用户已被禁用');
                            break;
                        }
                    default:
                        {
                            if ($Member['password'] === think_admin_md5($password, UC_AUTH_KEY)) {
                                D('UcenterMember')->login($Member['id']);
                                // $User=new UserApi();
                                // $User->login($username, $password);
                                $this->success('登录成功！', U('Admin/Index/index'));

                            } else {
                                $this->error('密码错误');
                            }
                            break;
                        }
                }
            } else { // 登录失败
                $this->error('用户不存在');
            }
        } else {
            /* 读取数据库中的配置 */
            $config = S('DB_CONFIG_DATA');
            if (! $config) {
                $config = D('Config')->lists();
                S('DB_CONFIG_DATA', $config);
            }
            C($config); // 添加配置
            
            $this->display();
        }
    }

    /* 退出登录 */
    public function logout()
    {
        if (is_login()) {
            D('UcenterMember')->logout();
            session('[destroy]');
            $this->success('退出成功！', U('login'));
        } else {
            $this->redirect('login');
        }
    }

    public function verify()
    {
        $verify = new \Think\Verify();
        $verify->entry(1);
    }

}
