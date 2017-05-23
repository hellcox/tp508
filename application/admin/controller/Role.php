<?php
// +----------------------------------------------------------------------
// | 名称：Role.php
// +----------------------------------------------------------------------
// | 描述：角色分组管理 一个角色对应多个权限规则
// +----------------------------------------------------------------------
// | 作者：豆豆
// +----------------------------------------------------------------------
// | 时间：2017-05-19 16:26
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\controller\Base;
use think\Db;
use think\Request;

class Role extends Base
{
	/**
	 * [index 角色列表]
	 * @return [array] [角色列表]
	 */
    public function index()
    {
    	$roles = Db::table('auth_group')->select();
    	$this->assign('roles',$roles);
        return view();
    }

    public function add()
    {
    	if (Request::instance()->isAjax()) {
            $input = input('post.');
            $res   = ['errno' => 0, 'message' => '添加失败'];

            if (in_array('', $input)) {
                $res = ['errno' => 0, 'message' => '请填写数据'];
                return $res;
            }
            if (Db::table('auth_group')->where('title',$input['title'])->find()) {
                $res = ['errno' => 0, 'message' => '已有当前角色'];
                return $res;
            }
            if (Db::table('auth_group')->insert($input)) {
                $res = ['errno' => 1, 'message' => '添加角色成功'];
                return $res;
            }
            return $res;
        }
        return view();
    }

    public function edit()
    {
        if (Request::instance()->isGet()) {
            $id = input('param.id');
            if (!$id)die('参数错误');

            $rule = Db::table('auth_group')->find($id);
            $this->assign('role', $rule);
        }

        if (Request::instance()->isAjax()) {
            $input = input('post.');
            $res   = ['errno' => 0, 'message' => '修改失败'];

            if (in_array('', $input)) {
                $res = ['errno' => 0, 'message' => '请填写所有数据'];
                return $res;
            }
            if (Db::table('auth_group')->where(['title'=>$input['title']])->find()) {
                $res = ['errno' => 0, 'message' => '已有当前角色'];
                return $res;
            }
            if (Db::table('auth_group')->update($input)) {
                $res = ['errno' => 1, 'message' => '修改角色名称成功'];
                return $res;
            }
            return $res;
        }

        return view();
    }

    public function del()
    {
        if (Request::instance()->isAjax()) {
            $id  = input('post.id');
            $res = ['errno' => 0, 'message' => '删除失败'];

            if (!$id) {
                $res = ['errno' => 0, 'message' => '参数错误'];
                return $res;
            }
            if (Db::table('auth_group')->delete($id)) {
                $res = ['errno' => 1, 'message' => '删除角色成功'];
                return $res;
            }
            return $res;
        }
        return 0;
    }

    public function rulesAdd()
    {
        // if (Request::instance()->isGet()) {
            $id = input('param.id');
            if (!$id)die('参数错误');

            $rule = Db::table('auth_group')->find($id);
            if(isset($rule['rules'])){
                $rule['rules'] = explode(',', $rule['rules']);
            }
            $this->assign('role', $rule);
        // }

        if (Request::instance()->isPost()) {
            $data = input('post.');
            if(isset($data['rules'])){
                $data['rules'] = implode(',', $data['rules']);
                if(Db::table('auth_group')->where('id',$id)->update($data)){
                    $this->success('修改成功');
                }
            }
        }

        $rules = Db::table('auth_rule')->field('id,title,name')->group('name')->select();
        $this->assign('rules',$rules);
        return view();
    }

}
