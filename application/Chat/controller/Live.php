<?php
namespace app\chat\controller;

use think\Controller;

class Live extends Controller{
    public function index(){
        return view('live/index');
    }
    public function camera(){
        return view('live/camera');
    }
}