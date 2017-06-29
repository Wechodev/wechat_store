<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23
 * Time: 16:47
 */
namespace Admin\Model;
use Common\Model\CommModel;

class AdminModel extends CommModel
{


    //登录验证
    public function verify($username,$password){
        $w=array();
        $w['username']=array('eq',$username);
        $w['password']=array('eq',md5($password));
        $m=$this->where($w)->find();
        return $m;
    }

    //用户查询
    public function find_one($where){
        return $this->where($where)->find();
    }

    //保存更新数据
    public function _save($where,$data){
        if($where){
            return $this->where($where)->data($data)->save();
        }
    }

    //管理员列表
    public function select_all($where=''){
        return $this->where($where)->select();
    }

    //添加用户
    public function add_admin($data){
        if($data){
            return $this->add($data);
        }
    }

    //删除用户
    public function del($where){
        return $this->where($where)->delete();
    }
}