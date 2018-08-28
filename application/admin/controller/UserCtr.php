<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\admin\model\Ctruser;


class UserCtr extends Controller{


    /*
     * 获取用户列表
     * */
    public  function lsts(){
        $res = new Ctruser();
        $list = $res->getUserlist();

         /*
          * 遍历数据   添加操作$val['action']
          *
          * $href  拼接的编辑连接地址
          *
          * $shref  拼接的更改状态的地址
          *
          * $dhref  拼接的删除地址
          *
          * */
        foreach ($list as $val){
            if($val['group_id']==1){
                $val['group_id']='超级管理员';
                if($val['status']==1){
                    $val['status']="正常";
                }else{
                    $val['status']="禁用";
                }
                $shref="status?id="."{$val['id']}"."&status={$val['status']}";
            }else{
                $val['group_id']='普通管理员';
                if($val['status']==1){
                    $val['status']="正常";
                }else{
                    $val['status']="禁用";
                }
                $shref="status?id="."{$val['id']}"."&status={$val['status']}";
            }
            $href="edituser?username="."{$val['username']}"."&id={$val['id']}";
            $status=$val['status']=='正常'?'禁用':'开启';
            $dhref="deluser?id="."{$val['id']}";
            $val['action']="<a href='{$href}'>编辑</a>"."&nbsp;|&nbsp;"."<a href='{$shref}'>"."{$status}"."</a>"."&nbsp;|&nbsp;"."<a href='{$dhref}' onclick='alt();' class='cancel' style='background-color: #af3462;color: white'>删除</a>";
            unset($val['password']);
            $data[]=$val;
        }
        $list = json_encode($data);
        $this->assign('list', $list);
        return $this->fetch('user/userlist');
    }

    /*
     * 添加
     * */
    public function adduser(){
        $res = Request::instance()->param();
        $rq= new Ctruser();
        $sql=$rq->addUser($res);
            if($sql==1){
                return redirect('admin/user_ctr/lsts');
            }else{
                return redirect('admin/user_ctr/lsts');
            }
        }
        /*
         * 改变状态
         * */
    public function status(){
        $res = Request::instance()->param();
        switch ($res['status']){
            case "正常":
                Db::table('user')->where('id', $res['id'])->setField(['status' => 0]);
                return redirect('admin/user_ctr/lsts');
                break;
            case "禁用":
                Db::table('user')->where('id', $res['id'])->setField(['status' => 1]);
                return redirect('admin/user_ctr/lsts');
                break;
        }
    }

    /*
     * 获取单用户信息
     * */
    public function edituser(){
        $res = Request::instance()->param();
        $edit = new Ctruser();
        $res= $edit->editUser($res);
        $this->assign('res',$res);
        return view('user/edituser');
    }

    /*
     * 更新用户信息
     * */
    public function updateuser(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $username = $res['username'];
        $password = md5($res['password']);
        $nickname = $res['nickname'];
        $group_id = $res['group'];
        $res = new Ctruser();
        $sql= $res->updateUser($id,$username,$password,$nickname,$group_id);
        if($sql==1){
            return redirect('admin/user_ctr/lsts');
        }

    }

    /*
     * 删除用户信息
     * */
    public function deluser(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $res = new Ctruser();
        $res = $res->deleteUser($id);
        if($res==1){
            return redirect('admin/user_ctr/lsts');
        }

    }
}