<?php 
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
use \Workerman\Worker;
use \Workerman\WebServer;
use \Workerman\Connection\TcpConnection;

// #### 一个web界面的vmstat工具 ####

// 自动加载类
require_once __DIR__ . '/../../../../vendor/autoload.php';
// WebServer，用来给浏览器吐html js css
$web = new WebServer("http://0.0.0.0:55555");
// WebServer数量
$web->count = 2;
$web->name = 'WebServer';
// 设置站点根目录
$web->addRoot('www.your_domain.com', __DIR__.'/Web');


// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

