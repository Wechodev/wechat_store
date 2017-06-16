<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/14
 * Time: 14:23
 */

namespace Admin\Controller;


class LinkController extends HCommController
{

    function __construct()
    {
        parent::__construct();
        $this->assign('active','link');
        if(!session('__ADMIN__')){
            redirect(__APP__.'/Login/index');
        }
        $this->assign('userinfo',session('__ADMIN__'));
    }


    //协议
    public function indexAction(){
        $parameter_model = M('parameter');
        $parameter = $parameter_model->where(array('id'=>1))->find();
        $this->assign('parameter',$parameter);
        $this->display();
    }

    public function do_agreement_editAction(){
        $where['id'] = $_GET['id'];
        $data['agreement'] = $_POST['agreement'];
        $data['updatetime'] = time();
        $parameter_model = M('parameter');
        $res = $parameter_model->where($where)->save($data);
        if($res !== false){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

    //联系我们
    public function contactAction(){
        $parameter_model = M('parameter');
        $parameter = $parameter_model->where(array('id'=>1))->find();
        $this->assign('parameter',$parameter);
        $this->display();
    }

    public function do_contactAction(){
        $where['id'] = $_GET['id'];
        $data = $_POST;
        //print_r($data);
        $data['updatetime'] = time();
        $parameter_model = M('parameter');
        $res = $parameter_model->where($where)->save($data);
        if($res !== false){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

    //添加友情链接
    public function link_addAction(){
        $this->display('Link/link_add');
    }

    public function do_link_addAction(){
        $post = $_POST;
        $post['addtime'] = time();
        $link_model = M('link');
        $res = $link_model->add($post);
        if($res){
            $this->success('添加成功',U('Link/link'));
        }else{
            $this->error('添加失败');
        }
    }


    //友情链接
    public function linkAction(){
        $link_model = M('link');
        $link = $link_model->select();
        $this->assign('link',$link);
        $this->display('Link/link');
    }

    //编辑
    public function link_editAction()
    {
        $where['id'] = $_GET['id'];
        $link_model = M('link');
        $link = $link_model->where($where)->find();
        $this->assign('link',$link);
        $this->display('Link/link_edit');

    }


    public function do_link_editAction(){
        $where['id'] = $_GET['id'];
        $data = $_POST;
        $data['updatetime'] = time();
        $link_model = M('link');
        $res = $link_model->where($where)->save($data);
        if($res !== false){
            $this->success('修改成功',U('Link/link'));
        }else{
            $this->error('修改失败');
        }
    }

    //删除链接
    public function link_delAction(){
        $where['id'] = $_GET['id'];
        $link_model = M('link');
        $res = $link_model->where($where)->delete();
        if($res !== false){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    //清楚缓冲
    public function clear_buffAction(){
        $path = './WebApp/Runtime/Cache';
        $res = $this->deldir($path);
        redirect(U('Index/index'));

    }


}