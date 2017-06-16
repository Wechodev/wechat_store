<?php
return array(
    'DEFAULT_MODULE'     => 'Admin', //默认模块
    'DEFAULT_CONTROLLER' => 'Login', //默认控制器
    'DEFAULT_ACTION'        => 'index', // 默认操作名称
    'ACTION_SUFFIX'     =>  'Action',//默认方法名后缀
    //'URL_ROUTER_ON'     => TRUE,
    'TMPL_PARSE_STRING' =>  array( // 添加输出替换
        '__PROJECTDIR__'    =>  __ROOT__.'/shendeng',//程序目录
        '__ADMINRES__'    =>  __ROOT__.'/Public/admin',//后台资源目录
        '__UPIMG__'    =>  __ROOT__.'/upimg',//文件上传目录
        '__MUPIMG__'    =>  __ROOT__.'/mupimg',//手机文件上传目录
    ),

    'SHOW_PAGE_TRACE'=>false,
    'TMPL_ACTION_ERROR'     => APP_PATH.'Common/View/error.html', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   => APP_PATH.'Common/View/success.html', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'   => APP_PATH.'Common/View/exception.html',// 异常页面的模板文件

);