<?php
// +----------------------------------------------------------------------
// | 名称：
// +----------------------------------------------------------------------
// | 描述：
// +----------------------------------------------------------------------
// | 作者：豆豆
// +----------------------------------------------------------------------
// | 时间：2017-05-19 16:26
// +----------------------------------------------------------------------
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;

class Base extends Controller
{
    public function _initialize()
    {
        // session::delete('user');
        // 验证登陆
        if(!session::has('user')){
            $this->redirect('admin/login/login');
        }

        // 获取当前 模块名、控制器、方法
        $request           = Request::instance();
        $mca['module']     = $request->module();
        $mca['controller'] = $request->controller();
        $mca['action']     = $request->action();
        $this->assign('mca', $mca);

        // 验证权限
    }
}
