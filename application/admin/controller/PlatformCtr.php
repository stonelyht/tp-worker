<?php
namespace app\admin\controller;

use app\admin\model\Ctrplatform;
use think\Controller;
use think\Request;

class PlatformCtr extends Controller{
    /*
     * 获取渠道列表
     * */
    public function lsts(){
        $res = new Ctrplatform();
        $sql = $res->getPlatformlist();
        foreach ($sql as $val){
            $href="editplatform?id=".$val['id'];
            $val['action']=
                "<a href='$href' class='edit' id='{$val['id']}'>编辑</a>"."&nbsp;|&nbsp;".
                "<a href='javascript:void(0);' class='delete' onclick='dele(this)' id='{$val['id']}' class='cancel' style='background-color: #af3462;color: white'>删除</a>";
            $data[]=$val;
        }
        $olist = $res->getOperator();
        $list = json_encode($data);
        $this->assign('olist', $olist);
        $this->assign('list', $list);
        return view('platform/platformlist');
    }
    /*
     * 添加
     * */
    public function addplatform(){
        $res = Request::instance()->param();
        if(empty($res['father_id'])){
            $res['father_id']=0;
        }
        $name = $res['name'];
        $operator_id = $res['operator_id'];
        $father = $res['father_id'];
        $res = new Ctrplatform();
        $sql = $res->addplatform($name,$operator_id,$father);
        if($sql==1){
            return redirect('admin/platform_ctr/lsts');
        }
    }
    /*
     * 删除
     * */
    public function deleteplatform(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $res = new Ctrplatform();
        $sql = $res->deleteplatform($id);
        if($sql == 1){
            $data[] = ['msg'=>'success'];
            return json_encode($data);
        }else{
            $data[] = ['msg'=>'defeat'];
            return json_encode($data);
        }
    }
    /*
     * 获取单条记录
     * */
    public function editplatform(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $res = new Ctrplatform();
        $list = $res->getOperator();
        $sql = $res->editplatform($id);
        $sql = [$sql];
        $this->assign('list',$list);
        $this->assign('res',$sql);
//        print_r($sql);die;
        return view('platform/editplatform');
    }
    /*
     * 更新
     * */
    public function updateplatform(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $name = $res['name'];
        $operator_id = $res['operator_id'];
        $father = $res['father'];
        $res = new Ctrplatform();
        $sql = $res->updateplatform($id,$name,$operator_id,$father);
        if($sql==1){
            return redirect('admin/platform_ctr/lsts');
        }
    }
}