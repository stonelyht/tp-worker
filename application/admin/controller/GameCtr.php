<?php
namespace app\admin\controller;

use app\admin\model\Ctrgame;
use think\Controller;
use think\Request;

class GameCtr extends Controller{
    /*
     * 获取游戏列表
     * */
    public function lsts(){
        $res = new Ctrgame();
        $res = $res->getGamelist();
        foreach ($res as $val){
            if($val['status']==1){
                $val['status']='正常';
            }else{
                $val['status']='禁用';
            }
            $status=$val['status']=='正常'?'禁用':'开启';
            $href="editgame?id=".$val['id'];
            $val['action']=
                "<a href='$href' class='edit' id='{$val['id']}'>编辑</a>"."&nbsp;|&nbsp;".
                "<a href='javascript:void(0);' class='status' onclick='status(this)' id='{$val['id']}'>"."{$status}"."</a>"."&nbsp;|&nbsp;".
                "<a href='javascript:void(0);' class='delete' onclick='dele(this)' id='{$val['id']}' class='cancel' style='background-color: #af3462;color: white'>删除</a>";
            $data[]=$val;
        }
        $list = json_encode($data);
        $this->assign('list', $list);
        return view('game/gamelist');
    }

    /*
     *
     * 添加游戏
     * */

    public function addgame(){
        $res = Request::instance()->param();
        if(empty($res['remark'])){
            $res['remark']=null;
        }
        $name = $res['name'];
        $remark = $res['remark'];
        $status = $res['status'];
        $res = new Ctrgame();
        $sql = $res->addgame($name,$remark,$status);
        if($sql==1){
            return redirect('admin/game_ctr/lsts');
        }
    }
    /*
     * 游戏状态
     * */
    public function status(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $status = $res['status'];
        $res = new Ctrgame();
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
    public function deletegame(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $res = new Ctrgame();
        $sql = $res->deletegame($id);
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
    public function editgame(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $res = new Ctrgame();
        $sql = $res->editgame($id);
        $this->assign('res',$sql);
        return view('game/editgame');
    }

    /*
     * 更新
     * */
    public function updategame(){
        $res = Request::instance()->param();
        $id = $res['id'];
        $name = $res['name'];
        if(empty($res['remark'])){
            $res['remark']=null;
        }
        $remark = $res['remark'];
        $status = $res['status'];
        $res = new Ctrgame();
        $sql = $res->updategame($id,$name,$remark,$status);
        if($sql==1){
            return redirect('admin/game_ctr/lsts');
        }
    }
}