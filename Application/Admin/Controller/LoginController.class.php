<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/22
 * Time: 8:55
 */

namespace Admin\Controller;
use Admin\Controller\HCommController;
use Admin\Model\AdminModel;
class LoginController extends HCommController
{

    public function indexAction(){
        $this->display();
    }

    public function loginAction(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $m=session("__ADMIN__");
        if($m){
            $redirect_url = self::ADMIN_PATH."/Index/index";
            redirect($redirect_url);
        }else{
            $mop=new AdminModel();
            $m=$mop->verify($username,$password);

            if($m){
                if($m['is_enabled'] == 0){
                    $this->error('Permission Is Define');
                }
                $m['logintime']=time();
                $m['login_ip']=$this->ipaddr();
                $w['id']=$m['id'];
                $mop->_save($w,$m);
                session("__ADMIN__",$m);
                $this->success("login success",self::ADMIN_PATH.'/Index/index');
            }else{
                $this->error('Account number or password is wrong');
            }
        }
    }

    public function logoutAction(){
        session("__ADMIN__",null);
        $redirect_url=__APP__."/Login/index";
        redirect($redirect_url);
    }
}