<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/19
 * Time: 9:03
 */

namespace Admin\Controller;
use Think\Controller;

class HCommController extends Controller
{
    const ADMIN_PATH = __APP__.'/Admin';
    function __construct()
    {
        parent::__construct();
    }

    protected function ipaddr(){
        $ip=false;
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
            for ($i = 0; $i < count($ips); $i++) {
                if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }

    //递归删除文件
    protected function deldir($path){
        $dh = opendir($path);
        while(($d = readdir($dh)) !== false)
        {
            if($d == '.' || $d == '..'){//如果为.或..
                continue;
            }
            $tmp = $path.'/'.$d;
            if(!is_dir($tmp)){//如果为文件
                unlink($tmp);
            }else{//如果为目录
                $this->deldir($tmp);
            }
        }
        closedir($dh);
        rmdir($path);
    }
}