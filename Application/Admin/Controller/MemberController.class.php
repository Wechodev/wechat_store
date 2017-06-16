<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/27
 * Time: 17:19
 */

namespace Admin\Controller;
use Admin\Model\MemberModel;
use Common\Org\Page;

class MemberController extends HCommController
{

    function __construct()
    {
        parent::__construct();
        $this->assign('active','member');
        if(!session('__ADMIN__')){
            redirect(__APP__.'/Login/index');
        }
        $this->assign('userinfo',session('__ADMIN__'));
    }


    public function indexAction(){
        $this->display();
    }

    public function ajax_memberAction(){

        $mobilephone = $_POST['username'];
        $start_time = strtotime($_POST['start_time']);
        $end_time = strtotime($_POST['end_time']);

        $where = array();
        if($mobilephone){
            $where['username'] = array('like','%'.$mobilephone.'%');
        }elseif ($start_time){
            if($end_time){
                $where['addtime'] = array(array('gt',$start_time),array('lt',$end_time));
            }else{
                $where['addtime'] = array('gt',$start_time);
            }
        }elseif($end_time){
            if($start_time){
                $where['addtime'] = array(array('gt',$start_time),array('lt',$end_time));
            }else{
                $where['addtime'] = array('lt',$end_time);
            }
        }


        $page = $_POST['page'] ? $_POST['page'] : 1;
        $member_model = new MemberModel();
        $pagesize = 10;
        $count = $member_model->_count($where);
        $Page = new Page($count,$pagesize,$page);
        $pagestr = $Page->show_js('page_js');
        $information_info = $member_model->select_info($page,$pagesize,$where);

        $this->assign('pagestr',$pagestr);
        $this->assign('members',$information_info);
        $this->assign('page',$page);
        $data['html'] = $this->fetch('Member/ajax_member');
        $this->ajaxReturn($data);
    }

    //删除会员
    public function member_delAction()
    {
        $where['id'] = I('param.id');
        $member_model = new MemberModel();
        $res = $member_model->_del($where);
        if($res !== false){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }

    //更新
    public function enabledAction(){
        $where['id'] = I('param.id');
        $data['is_enabled'] = I('param.is_enabled');
        $data['updatetime'] = time();
        $member_model = new MemberModel();
        $res = $member_model->_save($where,$data);
        if($res !== false){
            $ajax['error'] = 0;
        }else{
            $ajax['error'] = 1;
        }
        $this->ajaxReturn($ajax);

    }


}