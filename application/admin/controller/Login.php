<?php
// +----------------------------------------------------------------------
// | 名称：Login.php
// +----------------------------------------------------------------------
// | 描述：登陆控制器
// +----------------------------------------------------------------------
// | 作者：豆豆
// +----------------------------------------------------------------------
// | 时间：2017-05-19 16:26
// +----------------------------------------------------------------------
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Session;

class Login extends Controller
{
    public function index()
    {
    	$this->redirect('admin/login/login');
    }

    public function login()
    {
    	if(session::has('user')){
    		$this->redirect('admin/Index/index');
    	}
    	if(Request::instance()->isAjax()){
    		$res = ['errno'=>0,'message'=>'操作失败'];
    		$input = input('post.');
    		$loginData = [
    			'user_name' => $input['user_name'],
    			'password'  => $input['password']
    			];
    		$msg = $this->validate($loginData,'User');
    		if($msg!='ture'){
    			$res['message'] = $msg;
    			return $res;
    		}

    		if(model('user')->login($loginData)){
    			$res = ['errno'=>1,'message'=>'登陆成功'];
    		}
    		
    		return $res;
    	}
    	return view();
    }

    public function loginOut()
    {
    	session::delete('user');
    	$this->redirect('login/login');
    }
}
