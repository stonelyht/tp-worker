<?php
namespace app\admin\controller;


use app\admin\model\Ctroperator;
use think\Controller;
use think\Request;

class OperatorCtr extends Controller{
    /*
     * 获取运营服列表
     * */
    public function lsts(){
        $res = new Ctroperator();
        $sql = $res->getOperatorlist();
        foreach ($sql as $val){
            if($val['status']==1){
                $val['status']='正常';
            }else{
                $val['status']='禁用';
            }
            $href="editoperator?id=".$val['id'];
            $status=$val['status']=='正常'?'禁用':'开启';
            $val['action']= "<a href='$href' class='edit' id='{$val['id']}'>编辑</a>"."&nbsp;|&nbsp;".
                "<a href='javascript:void(0);' class='status' onclick='status(this)' id='{$val['id']}'>"."{$status}"."</a>"."&nbsp;|&nbsp;".
                "<a href='javascript:void(0);' class='delete' onclick='dele(this)' id='{$val['id']}' class='cancel' style='background-color: #af3462;color: white'>删除</a>";
            $data[]=$val;
        }
        $list = json_encode($data);
        $this->assign('list', $list);
        return view('operator/operatorlist');
    }

    /*
     * 添加运营服
     * */

    public function addoperator(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $name = $res['name'];
        $status = $res['status'];
        $res = new Ctroperator();
        $sql = $res->addoperator($id,$name,$status);
        if($sql==1){
            return redirect('admin/operator_ctr/lsts');
        }
    }

    /*
     * 状态
     * */

    public function status(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $status = $res['status'];
        $res = new Ctroperator();
        $sql = $res->status($id,$status);
        $status = $status=='正常'?'disable':'open';
        if($sql==1){
            $data[] = ['msg'=>'success','status'=>$status];
            return json_encode($data);
        }else{
            $data[] = ['msg'=>'defeat','status'=>$status];
            return json_encode($data);
        }
    }

    /*
     * 删除
     * */

    public function deleteoperator(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $res = new Ctroperator();
        $sql = $res->deleteoperator($id);
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
    public function editoperator(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $res = new Ctroperator();
        $sql = $res->editoperator($id);
        $sql = [$sql];
        $this->assign('res',$sql);
        return view('operator/editoperator');
    }

    /*
     * 更新
     * */

    public function updateoperator(){
        $res = Request::instance()->param();
        $ids = $res['ids'];
        $id = $res['id'];
        $name = $res['name'];
        $status = $res['status'];
        $res = new Ctroperator();
        $sql = $res->updateoperator($ids,$id,$name,$status);
        if($sql==1){
            return redirect('admin/operator_ctr/lsts');
        }
    }
}