<?php
namespace app\admin\model;

use think\Db;
use think\Model;

class Ctruser extends Model
{

    /*
     * 获取所有用户信息
     * */
    public function getUserlist()
    {
        $list = Db::table('user')->select();
        return $list;
    }
    /*
     * 添加
     * */
    public function addUser($res)
    {
        $uname = Db::name('user')->where('username', $res['username'])->find();
        if (empty($uname)) {
            $ctime = date("Y-m-d");
            $data = [
                'username' => $res['username'],
                'password' => md5($res['password']),
                'nickname' => $res['nickname'],
                'group_id' => $res['group'],
                'create_time' => $ctime
            ];
            $sql = Db::name('user')->insert($data);
            return $sql;
        }
    }

    /*
     * 获取单用户信息
     * */
    public function editUser($res){
        $res=Db::table('user')->where('id',$res['id'])->select();
        return $res;
    }

    /*
     * 更新
     * */

    public function updateUser($id,$username,$password,$nickname,$group_id){
        $sql=Db::execute("update user set username='{$username}',password='{$password}',nickname='{$nickname}',group_id={$group_id} where id = {$id}");
        return $sql;
    }

    /*
     * 删除
     * */

    public function deleteUser($id){
        $res=Db::table('user')->where('id',$id)->delete();
        return $res;
    }
}