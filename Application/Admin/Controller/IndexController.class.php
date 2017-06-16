<?php
namespace Admin\Controller;
use Admin\Model\FeedbackModel;
use Admin\Model\InformationModel;
use Common\Org\Page;
use Admin\Model\RegionModel;
class IndexController extends HCommController {

    function __construct()
    {
        parent::__construct();
        $this->assign('active','Index');
        if(!session('__ADMIN__')){
            redirect(__APP__.'/Login/index');
        }
        $this->assign('userinfo',session('__ADMIN__'));
    }


    public function indexAction(){


        $this->display();
    }

    public function ajax_pageAction(){

        $mobilephone = $_POST['mobilephone'];
        $street = $_POST['street'];
        $content = $_POST['content'];
        $start_time = strtotime($_POST['start_time']);
        $end_time = strtotime($_POST['end_time']);

        $where = array();
        if($mobilephone){
            $where['mobilephone'] = array('like','%'.$mobilephone.'%');
        }elseif($street){
            $where['street'] = array('like','%'.$street.'%');
        }elseif($content){
            $where['content'] = array('like','%'.$content.'%');
        }elseif ($start_time){
            if($end_time){
                $where['publish_time'] = array(array('gt',$start_time),array('lt',$end_time));
            }else{
                $where['publish_time'] = array('gt',$start_time);
            }
        }elseif($end_time){
            if($start_time){
                $where['publish_time'] = array(array('gt',$start_time),array('lt',$end_time));
            }else{
                $where['publish_time'] = array('lt',$end_time);
            }
        }


        $page = $_POST['page'] ? $_POST['page'] : 1;
        $information_model = new InformationModel();
        $pagesize = 10;
        $count = $information_model->_count($where);
        $Page = new Page($count,$pagesize,$page);
        $pagestr = $Page->show_js('page_js');
        $information_info = $information_model->select_info($page,$pagesize,$where);
        foreach ($information_info as $k=>$v){
            $information_info[$k]['street'] = str_replace('/',' ',$v['street']);
        }
        $this->assign('pagestr',$pagestr);
        $this->assign('information',$information_info);
        $data['html'] = $this->fetch('Index/ajax_page');
        $this->ajaxReturn($data);
    }

    //添加信息
    public function addAction(){

        $region_model = new RegionModel();
        $where['level'] = 1;
        $where['upid'] = 0;
        $province = $region_model->find_all($where);
        $this->assign('province',$province);

        $this->display();
    }

    public function do_addAction(){
        $data = $_POST;

        $data['street'] = $data['province'].'/'.$data['address'];
        $addr = explode('/',$data['province']);
        $data['province'] = $addr[0];
        $data['city'] = $addr[1];
        $data['county'] = $addr[2];
        $data['publish_time'] = strtotime($data['appDateTime']);
        unset($data['appDateTime']);
        if($data['publish_time'] <= time()){
            $data['publish_time'] = $data['publish_time']+30*60;
        }

        $data['create_time'] = time();
        $information_model = new InformationModel();
        if($_POST){
            $res = $information_model->add_info($data);
            if($res){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }

    }


    //查看
    public function lookAction(){
        $where['id'] = I('param.id');
        $information_model = new InformationModel();
        $information = $information_model->find_one($where);
        $information['street'] = str_replace('/',' ',$information['street']);
        $this->assign('information',$information);
        $this->display();
    }

    //删除
    public function delAction(){
        $where['id'] = I('param.id');
        $information_model = new InformationModel();
        $res = $information_model->del($where);
        if($res !== false){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    //获取省、市、县
    public function regionAction(){
        $region_model = new RegionModel();
        $where['level'] = $_POST['level'];
        $where['upid'] = $_POST['upid'];
        $province = $region_model->find_all($where);
        $this->ajaxReturn($province);
    }

    //留言建议
    public function messageAction(){
        $this->assign('active','message');
        $this->display('Index/message');
    }

    //留言建议
    public function ajax_messageAction(){

        $page = $_POST['page'] ? $_POST['page'] : 1;
        $message_model = new FeedbackModel();
        $pagesize = 10;
        $count = $message_model->_count();
        $Page = new Page($count,$pagesize,$page);
        $pagestr = $Page->show_js('page_js');
        $information_info = $message_model->select_info($page,$pagesize);

        $this->assign('pagestr',$pagestr);
        $this->assign('message',$information_info);
        $data['html'] = $this->fetch('Index/ajax_message');
        $this->ajaxReturn($data);
    }

    //删除留言
    public function message_delAction(){
        $where['id'] = $_GET['id'];
        $message_model = new FeedbackModel();
        $res = $message_model->del($where);
        if($res !== false){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    //信息评论
    public function commentAction(){
        $comment_model = M('comment');
        $where['info_id'] = $_GET['id'];
        $comment = $comment_model->where($where)->select();
        $this->assign('comment',$comment);
        $this->display('Index/comment');
    }

    //信息评论删除
    public function comment_delAction(){
        $comment_model = M('comment');
        $where['id'] = $_GET['id'];
        $comment = $comment_model->where($where)->delete();
        if($comment !== false){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }



}