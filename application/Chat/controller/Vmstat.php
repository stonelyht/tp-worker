<?php
namespace app\chat\controller;

use think\Controller;

class Vmstat extends Controller{
    public function index(){
        return view('vmstat/index');
    }
}