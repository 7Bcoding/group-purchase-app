<?php
namespace Home\Model;
use Think\Model;

class GoodsModel extends Model{
	
	//定义自动验证$_validate
	protected $_validate = array(
			array('name', 'require', 'name require'),
			array('price','require','passwod require'),
	);
	
	//定义自动完成
	protected $_auto = array(
		//	array('C_password','md5',1,'function') ,  //  对 userpass 字段在新增的时候使 md5 函数处理
			array('date', 'date("Y-m-d H:i:s", time()) ' ,1,'function'),   //自动把时间戳变成2013-01-25 15:23:08:009格式
	);
	
	public function publish($data) {
		$map['name'] = $data['name'];
		$map['price'] = $data['price'];
		$map['description'] = $data['description'];
		$map['date'] = time();
		if (!$this->create()){
			// 如果创建失败 表示验证没有通过 输出错误提示信息
			$info = Array("statue"=>0, "info"=>"{$this->getError()}" );
		}else{
			// 验证通过 可以进行其他数据操作
			if($this->add($map)){
				$info = Array("statue"=>1, "info"=>"good public success" );
			}else{
				$info = Array("statue"=>0, "info"=>"good public fail" );
			}
		}
		$good_id = $data['image_id'];
		$goods = $this->where("id = $good_id")->setField('image',$good_id);
		
		
		
		return $info;
	}
	
}