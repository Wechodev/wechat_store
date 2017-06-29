<?php
/*if ($_SERVER["SERVER_ADDR"] == '59.46.10.195') {
    $array1 = array(
        'DB_USER'               => 'guangbo',      // 用户名
        'DB_PWD'                => 'gbsjk!@#EDC',          // 密码
    );
}else{
    $array1 = array(
        'DB_USER'               => 'root',      // 用户名
        'DB_PWD'                => 'root',          // 密码
    );
}*/

return $array2 = array(
    'DB_USER'               => 'root',      // 用户名
    'DB_PWD'                => 'root',          // 密码shenDENG201
    'DB_TYPE'               => 'mysqli',     // 数据库类型
    'DB_HOST'               => 'localhost', // 服务器地址
    'DB_NAME'               => 'shendeng',          // 数据库名
    'DB_PORT'               => '3306',        // 端口
    'DB_PREFIX'             => 'sd_',    // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'VAR_PAGE'=>'page',

    'IMGUPLOADPARAM' =>  array( // 图片上传参数
        'THUMBIMG' =>  array( // 缩略图
            'WIDTH'=>210,//小图宽
            'HEIGHT'=>150
        ),
        'DEFAULT'=>'THUMBIMG'
    ),


    /* Cookie设置 */
    'COOKIE_EXPIRE'         =>  86400,    // Cookie有效期
    //'COOKIE_DOMAIN'         =>  'sky0351.com',      // Cookie有效域名
    'COOKIE_PATH'           =>  '/',     // Cookie路径
    'COOKIE_PREFIX'         =>  'sd_',      // Cookie前缀 避免冲突
    'COOKIE_HTTPONLY'       =>  '',      // Cookie httponly设置

    /* SESSION设置 */
    'SESSION_AUTO_START'    =>  true,    // 是否自动开启Session
    //'SESSION_OPTIONS'       =>  array("domain"=>"sky0351.com"), // session 配置数组 支持type name id path expire domain 等参数
    'SESSION_TYPE'          =>  '', // session hander类型 默认无需设置 除非扩展了session hander驱动
    'SESSION_PREFIX'        =>  'sd_', // session 前缀
    'VAR_SESSION_ID'      =>  'session_id',     //sessionID的提交变量

    //'LOAD_EXT_CONFIG' => 'wechat'

);

//return array_merge($array1,$array2);