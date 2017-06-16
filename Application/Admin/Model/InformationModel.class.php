<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23
 * Time: 16:47
 */
namespace Admin\Model;
use Common\Model\CommModel;

class InformationModel extends CommModel
{

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
    public function add_info($data){
        if($data){
            return $this->data($data)->add();
        }
    }

    //删除用户
    public function del($where){
        return $this->where($where)->delete();
    }

    //分页
    public function select_info($page=1,$pagesize=10,$where=array(),$orderby='create_time desc'){
        return $this->where($where)->order($orderby)->page($page,$pagesize)->select();
    }

    //记录总数
    public function _count($where=''){
        return $this->where($where)->count();
    }
}