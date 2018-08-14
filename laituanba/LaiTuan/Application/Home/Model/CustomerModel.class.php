<?php
namespace Home\Model;
use Think\Model;

class CustomerModel extends Model{

	//定义自动验证$_validate
	protected $_validate = array(
			array('C_name', 'require', 'username require'),
			array('C_name','checklen','username must in 5~15',0,'callback'),
			array('C_name', '','username have been registered', 0 , 'unique', self::MODEL_INSERT),
			array('C_password','require','passwod require'),
			array('C_repassword','require','valid passwod require'),
			array('C_password','C_repassword','password not same',0,'confirm'),
			//array('userage','number','您输入的不是数字'),
			//array('useremail','email','邮箱格式不正确'),
	);
	
	//定义自动完成
	protected $_auto = array(
			array('C_password','md5',1,'function') ,  //  对 userpass 字段在新增的时候使 md5 函数处理
	
			array('C_date', 'date("Y-m-d H:i:s", time()) ' ,1,'function'),   //自动把时间戳变成2013-01-25 15:23:08:009格式
	);
	public function login($data){
		$C_name = $data['C_name'];
		$C_password = $data['C_password'];
//		echo $C_name;
		
		$data1 = $this->where("C_name='".$C_name."'")->find();
		//dump($data1['id']);
		if(!count($data1)){
			$info = Array("statue"=>0, "info"=>"login fail" );
		}else{
			$info = Array("statue"=>1, "info"=>"login success" );
			session("username", $C_name);
		}
		return $info;
	}
	
	public function register($data) {
		$map['C_name'] = $data['C_name'];
		$map['C_password'] = $data['C_password'];
		$map['C_date'] = time();
		if (!$this->create()){
			// 如果创建失败 表示验证没有通过 输出错误提示信息
			$info = Array("statue"=>0, "info"=>"{$this->getError()}" );
		}else{
			// 验证通过 可以进行其他数据操作
			if($this->add($map)){
				$info = Array("statue"=>1, "info"=>"register success" );
			}else{
				$info = Array("statue"=>0, "info"=>"register fail" );
			}
		}
		
		return $info;
	}
	
	
	
	function checklen($data){
		if(strlen($data)>15 || strlen($data)<5){
			return false;
		}else{
			return true;
		}
	}
	
}