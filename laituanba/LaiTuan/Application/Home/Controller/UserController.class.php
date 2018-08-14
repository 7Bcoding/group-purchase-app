<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller {
    public function login(){
    	
    	$data = I("post.");
    	print_r($data);
    	$this->ajaxReturn(D('Customer')->login($data));
    	
    }
    
    public function register(){
  		
    	$data = I("post.");
    	$this->ajaxReturn(D('Customer')->register($data));
    }
}