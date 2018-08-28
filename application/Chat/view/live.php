<?php
/*
传入自定义参数，即传入应用名称和流名称
*/

//rtmp://live.stonelyshop.cn/AppName/StreamName?auth_key=1513767173-0-0-7b89a97ffe892d10ef677da293f45eb2
$AppName = 'AppName';
$StreamName = 'StreamName';

/*
时间戳，有效时间
*/
$time = time() + 1800;

/*
加密key，即直播后台鉴权里面自行设置
*/
$key = 'tong961113';

$strpush = "/$AppName/$StreamName-$time-0-0-$key";
/*
里面的直播推流中心服务器域名、vhost域名可根据自身实际情况进行设置
*/
$pushurl = "rtmp://video-center.alivecdn.com/$AppName/$StreamName?vhost=live1.playzhan.com&auth_key=$time-0-0-".md5($strpush);

$strviewrtmp = "/$AppName/$StreamName-$time-0-0-$key";
$strviewflv = "/$AppName/$StreamName.flv-$time-0-0-$key";
$strviewm3u8 = "/$AppName/$StreamName.m3u8-$time-0-0-$key";

$rtmpurl = "rtmp://live.stonelyshop.cn/$AppName/$StreamName?auth_key=$time-0-0-".md5($strviewrtmp);
//$flvurl = "http://live1.playzhan.com/$AppName/$StreamName.flv?auth_key=$time-0-0-".md5($strviewflv);
//$m3u8url = "http://live1.playzhan.com/$AppName/$StreamName.m3u8?auth_key=$time-0-0-".md5($strviewm3u8);

/*
打印推流地址，即通过鉴权签名后的推流地址
*/
echo $pushurl.'<br>';

/*
打印三种直播协议播放地址，即鉴权后的播放地址
*/
echo $rtmpurl.'<br>';
//echo $flvurl.'<br>';
//echo $m3u8url.'<br>';

?>