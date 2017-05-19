<?php
// +----------------------------------------------------------------------
// | 名称：Rule.php
// +----------------------------------------------------------------------
// | 描述：权限规则功能控制器
// +----------------------------------------------------------------------
// | 作者：豆豆
// +----------------------------------------------------------------------
// | 时间：2017-05-19 16:26
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\controller\Base;
use think\Db;
use think\Request;

class Rule extends Base
{
    /**
     * [index 权限规则列表]
     * @return [rules and view] [规则数组 和 视图]
     */
    public function index()
    {
        $rules = Db::table('auth_rule')->order('name asc')->select();
        $this->assign('rules', $rules);
        return view();
    }

    /**
     * [add 添加权限规则]
     */
    public function add()
    {
        if (Request::instance()->isAjax()) {
            $input = input('post.');
            $res   = ['errno' => 0, 'message' => '添加失败'];

            if (in_array('', $input)) {
                $res = ['errno' => 0, 'message' => '请填写所有数据'];
                return $res;
            }
            if (Db::table('auth_rule')->where($input)->find()) {
                $res = ['errno' => 0, 'message' => '已有当前规则'];
                return $res;
            }
            if (Db::table('auth_rule')->insert($input)) {
                $res = ['errno' => 1, 'message' => '添加权限规则成功'];
                return $res;
            }
        }
        return view();
    }

    /**
     * [del 通过ID删除一条记录]
     * @return [json] [错误码及提示]
     */
    public function del()
    {
        if (Request::instance()->isAjax()) {
            $id  = input('post.id');
            $res = ['errno' => 0, 'message' => '删除失败'];

            if (!$id) {
                $res = ['errno' => 0, 'message' => '参数错误'];
                return $res;
            }
            if (Db::table('auth_rule')->delete($id)) {
                $res = ['errno' => 1, 'message' => '删除规则成功'];
                return $res;
            }
        }
        return 0;
    }

    /**
     * [edit 权限规则编辑]
     * @return [json or view/array] [执行编辑返回JSON 不执行返回视图/数组]
     */
    public function edit()
    {
        if (Request::instance()->isGet()) {
            $id = input('param.id');
            if (!$id)die('参数错误');

            $rule = Db::table('auth_rule')->find($id);
            $this->assign('rule', $rule);
        }

        if (Request::instance()->isAjax()) {
            $input = input('post.');
            $res   = ['errno' => 0, 'message' => '修改失败'];

            if (in_array('', $input)) {
                $res = ['errno' => 0, 'message' => '请填写所有数据'];
                return $res;
            }
            if (Db::table('auth_rule')->where(['name'=>$input['name']])->where('id','not in',$input['id'])->find()) {
                $res = ['errno' => 0, 'message' => '已有当前规则'];
                return $res;
            }
            if (Db::table('auth_rule')->update($input)) {
                $res = ['errno' => 1, 'message' => '修改权限规则成功'];
                return $res;
            }
        }
        return view();
    }

    /**
     * [delList 根据选中条目删除]
     * @return [type] [description]
     */
    public function delList()
    {
        return 0;
    }
}
