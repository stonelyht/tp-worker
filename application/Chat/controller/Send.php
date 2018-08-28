<?php
namespace app\chat\controller;
use Workerman\Worker;
use Workerman\WebServer;
use Workerman\Lib\Timer;
use PHPSocketIO\SocketIO;
use think\Controller;

class Send extends Controller{
    public function index(){
        return view('send/index');
    }
}