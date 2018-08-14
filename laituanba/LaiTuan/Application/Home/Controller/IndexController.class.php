<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$goods = M('Goods');
    	$goodslist = $goods->order('date')->getfield('name,price,description');
    	$this->assign("g_list", $goodslist);
    	//$this->show(__APP__);
    	//$this->show(__ROOT__);
    	//$this->show(__MODULE__);
    	//$this->show(__DIR__);
        $this->display();
    }
}