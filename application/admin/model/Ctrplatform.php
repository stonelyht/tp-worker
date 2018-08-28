<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class Ctrplatform extends Model{
    /*
     * 获取平台列表
     * */
    public function getPlatformlist(){
        $res = Db::table('platform')->alias('a')
            ->join('operator b','a.operator_id = b.id')
            ->field('a.id,a.name,b.id as operator_id,b.name as operator_name,a.father')
            ->order('a.id asc')
            ->select();
        return $res;
    }
    /*
     * 获取渠道
     * */
    public function getOperator(){
        $res = Db::table('operator')
            ->field('id,name')
            ->order('id asc')
            ->select();
        return $res;
    }
    /*
     * 添加
     * */
    public function addplatform($name,$operator_id,$father){
        $data = [
            'name' => $name,
            'operator_id' => $operator_id,
            'father' => $father
        ];
        $sql = Db::table('platform')
            ->insert($data);
        return $sql;
    }
    /*
     * 删除
     * */
    public function deleteplatform($id){
        $res=Db::table('platform')
            ->where('id',$id)
            ->delete();
        return $res;
    }
    /*
     * 获取单条记录
     * */
    public function editplatform($id){
        $res=Db::table('platform')
            ->where('id',$id)
            ->field('id,name,operator_id,father')
            ->find();
        return $res;
    }
    /*
     * 更新
     * */
    public function updateplatform($id,$name,$operator_id,$father){
        $res=Db::table('platform')
            ->where('id', $id)
            ->update([
                'name'  => $name,
                'operator_id' => $operator_id,
                'father' => $father
            ]);
        return $res;
    }
}