<?php
namespace app\admin\model;

use think\Db;
use think\Model;

class Ctroperator extends Model{
    /*
     * 获取运营服列表
     * */
    public function getOperatorlist(){
        $res = Db::table('operator')
            ->field('id,name,status')
            ->order('id asc')
            ->select();
        return $res;
    }
    /*
     * 添加运营服
     * */
    public function addoperator($id,$name,$status){
        $data = [
            'id' => $id,
            'name' => $name,
            'status' => $status
        ];
        $sql = Db::table('operator')->insert($data);
        return $sql;
    }
    /*
     * 状态
     * */

    public function status($id,$status){
        switch ($status){
            case "正常":
                $sql = Db::table('operator')->where('id',$id)->setField(['status'=>2]);
                return $sql;
                break;
            case "禁用":
                $sql = Db::table('operator')->where('id',$id)->setField(['status'=>1]);
                return $sql;
                break;
        }
    }

    /*
     * 删除
     * */
    public function deleteoperator($id){
        $res=Db::table('operator')->where('id',$id)->delete();
        return $res;
    }

    /*
 * 单条记录
 * */

    public function editoperator($id){
        $res=Db::table('operator')->where('id',$id)->field('id,name,status')->find();
        return $res;
    }

    /*
     * 更新
     * */

    public function updateoperator($ids,$id,$name,$status){
        $res=Db::table('operator')
            ->where('id', $ids)
            ->update([
                'id'  => $id,
                'name' => $name,
                'status' => $status
            ]);
        return $res;
    }
}