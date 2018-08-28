<?php
namespace app\admin\model;

use think\Db;
use think\Model;

class Ctrgame extends Model {
    /*
     * 获取所有游戏
     * */
    public function getGamelist(){
        $res = Db::table('purview_game')->select();
        return $res;
    }

    /*
     * 添加游戏
     * */

    public function addgame($name,$remark,$status){
        $data = [
            'name' => $name,
            'remark' => $remark,
            'status' => $status
        ];
        $sql = Db::table('purview_game')->insert($data);
        return $sql;
    }

    /*
     * 状态
     * */

    public function status($id,$status){
        switch ($status){
            case "正常":
                $sql = Db::table('purview_game')->where('id',$id)->setField(['status'=>2]);
                return $sql;
                break;
            case "禁用":
                $sql = Db::table('purview_game')->where('id',$id)->setField(['status'=>1]);
                return $sql;
                break;
        }

    }

    /*
     * 删除
     * */
    public function deletegame($id){
        $res=Db::table('purview_game')->where('id',$id)->delete();
        return $res;
    }

    /*
     * 单条记录
     * */

    public function editgame($id){
        $res=Db::table('purview_game')->where('id',$id)->select();
        return $res;
    }

    /*
     * 更新
     * */

    public function updategame($id,$name,$remark,$status){
        $res=Db::table('purview_game')
            ->where('id', $id)
            ->update([
                'name'  => $name,
                'remark' => $remark,
                'status' => $status
            ]);
        return $res;
    }
}