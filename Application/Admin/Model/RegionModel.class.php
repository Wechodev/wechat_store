<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/19
 * Time: 14:41
 */

namespace Admin\Model;
use Common\Model\CommModel;

class RegionModel extends CommModel
{
    public function find_all($where){
        return $this->where($where)->select();
    }

}