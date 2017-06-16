<?php
namespace Admin\Controller;
use Admin\Model\AdvertModel;
use Common\Org\Page;
use Admin\Model\RegionModel;
class AdvertController extends HCommController {

    function __construct()
    {
        parent::__construct();
        $this->assign('active','advert');
        if(!session('__ADMIN__')){
            redirect(__APP__.'/Login/index');
        }
        $this->assign('userinfo',session('__ADMIN__'));
    }


    public function indexAction(){


        $this->display();
    }


    //底部广告
    public function ajax_advertAction(){

        $page = $_POST['page'] ? $_POST['page'] : 1;
        $message_model = new AdvertModel();
        $pagesize = 10;
        $count = $message_model->_count();
        $Page = new Page($count,$pagesize,$page);
        $pagestr = $Page->show_js('page_js');
        $information_info = $message_model->select_info($page,$pagesize);

        $this->assign('pagestr',$pagestr);
        $this->assign('advert',$information_info);
        $data['html'] = $this->fetch('Advert/ajax_advert');
        $this->ajaxReturn($data);
    }

    //添加信息
    public function addAction(){

        $this->display();
    }

    public function do_addAction(){
        $data = $_POST;
        $img = base64_decode($data['advert_name']);
        $new_name = 'advert_'.substr(md5(uniqid(microtime(true),true)),0,12).'.jpg';
        $res = file_put_contents('./uploads/'.$new_name, $img);
        if($res){
            $data['advert_name'] = $new_name;
            $data['addtime'] = time();
            $advert_model = new AdvertModel();
            if($_POST){
                $res = $advert_model->add_info($data);
                if($res){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }
            }
        }else{
            $this->error('添加失败');
        }


    }

    //编辑广告
    public function advert_editAction(){
        $where['id'] = $_GET['id'];
        $advert_model = new AdvertModel();
        $advert = $advert_model->get_one($where);
        $this->assign('advert',$advert);
        $this->display('Advert/edit');
    }

    public function do_advert_editAction(){
        $where['id'] = $_GET['id'];
        $advert_model = new AdvertModel();
        $advert = $advert_model->get_one($where);
        $post = $_POST;
        if($post['advert_name']){
            $img = base64_decode($post['advert_name']);
            $new_name = $advert['advert_name'];
            $res = file_put_contents('./uploads/'.$new_name, $img);
        }else{
            $res = true;
        }
        $post['advert_name'] = $advert['advert_name'];
        $post['updatetime'] = time();
        if($res){
            $result = $advert_model->_save($where,$post);
            if($result !== false){
                redirect(U('advert/index'));
            }else{
                $this->error('更新失败');
            }
        }else{
            $this->error('更新失败');
        }

    }



    //删除广告
    public function advert_delAction(){
        $where['id'] = $_GET['id'];
        $message_model = new AdvertModel();
        $res = $message_model->del($where);
        if($res !== false){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }


    //头部广告
    public function topAction(){
        $advert_model = M('cover');
        $res = $advert_model->where(array('id'=>1))->find();
        $this->assign('coverimg',$res);
        $this->display();
    }

    public function do_topAction(){
        $post = $_POST;
        $data['img_url1'] = $post['img_url'];
        $data['img_url2'] = $post['img_url1'];
        $data['img_url3'] = $post['img_url2'];
        $cover_model = M('cover');
        $cover = $cover_model->where(array('id'=>1))->find();
        if(!$post['advert_name']){
            $new_name1 = $cover['cover_img1'];
            $res1 = true;
        }else{
            $img1 = base64_decode($post['advert_name']);
            $new_name1 = $cover['cover_img1'];
            $res1 = file_put_contents('./uploads/'.$new_name1, $img1);
        }
        if(!$post['advert_name1']){
            $new_name2 = $cover['cover_img2'];
            $res2 = true;
        }else{
            $img2 = base64_decode($post['advert_name1']);
            $new_name2 = $cover['cover_img1'];
            $res2 = file_put_contents('./uploads/'.$new_name2, $img2);
        }
        if(!$post['advert_name2']){
            $new_name3 = $cover['cover_img3'];
            $res3 = true;
        }else{
            $img3 = base64_decode($post['advert_name2']);
            $new_name3 = $cover['cover_img1'];
            $res3 = file_put_contents('./uploads/'.$new_name3, $img3);
        }

        if($res1 && $res2 && $res3){
            $data['cover_img1'] = $new_name1;
            $data['cover_img2'] = $new_name2;
            $data['cover_img3'] = $new_name3;
            $data['updatetime'] = time();
            $advert_model = M('cover');
            if($_POST){
                $res = $advert_model->where(array('id'=>1))->save($data);
                if($res !== false){
                    redirect(U('advert/top'));
                }else{
                    $this->error('更新失败');
                }
            }
        }else{
            $this->error('更新失败');
        }

    }





}