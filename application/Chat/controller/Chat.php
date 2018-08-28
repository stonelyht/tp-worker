<?php
namespace app\chat\controller;

use think\Controller;

class Chat extends Controller{
    /*
     * 阿里云视频直播流
     * */
    public function aliyun(){
//rtmp://video-center-bj.alivecdn.com/AppName/
//StreamName?vhost=live.stonelyshop.cn&auth_key=1515576897-0-0-bd29528d3c51f23fd036e206e0ea16ed
        $AppName = 'AppName';
        $StreamName = 'StreamName';
        /*
        时间戳，有效时间
        */
        $time = time() + 30000;

        /*
        加密key，即直播后台鉴权里面自行设置
        */
        $key = 'tong961113';

        $strpush = "/$AppName/$StreamName-$time-0-0-$key";
        /*
        里面的直播推流中心服务器域名、vhost域名可根据自身实际情况进行设置
        */
        $pushurl = "rtmp://video-center-bj.alivecdn.com/$AppName/$StreamName?vhost=live.stonelyshop.cn&auth_key=$time-0-0-".md5($strpush);

        $strviewm3u8 = "/$AppName/$StreamName.m3u8-$time-0-0-$key";
        $m3u8url = "http://live.stonelyshop.cn/$AppName/$StreamName.m3u8?auth_key=$time-0-0-".md5($strviewm3u8);
        $aa=strrpos($pushurl,'/')+1;  //截取字符串
        $url=substr($pushurl,0,$aa);//  url
        $name=substr($pushurl,$aa);   //流名称
        $zb=1;
        $room = isset($_GET['room_id']) ? $_GET['room_id'] : 1;
        $this->assign('room',$room);
        $this->assign('pushurl',$pushurl);
        $this->assign('m3u8url',$m3u8url);
        $this->assign('url',$url);
        $this->assign('name',$name);
        $this->assign('zb',$zb);
        return view('chat/index');
    }
}
