<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;

class GoodsController extends Controller {
    public function show(){
        $this->display();
    }
    
    public function publish(){
    	$data = I("post.");
    	
    	/* 返回标准数据 */
    	$return  = array('status' => 1, 'info' => '上传成功', 'data' => '');
    	
    	/* 调用文件上传组件上传文件 */
    	$Picture = D('Picture');
    	$pic_driver = C('PICTURE_UPLOAD_DRIVER');
    	$info = $Picture->upload(
    			$_FILES,
    			C('PICTURE_UPLOAD'),
    			C('PICTURE_UPLOAD_DRIVER'),
    			C("UPLOAD_{$pic_driver}_CONFIG")
    	); //TODO:上传到远程服务器
    	
    	/* 记录图片信息 */
    	if($info){
    		$return['status'] = 1;
    		$return = array_merge($info['download'], $return);
    	} else {
    		$return['status'] = 0;
    		$return['info']   = $Picture->getError();
    	}
    	
    	/* 返回JSON数据 */
    	$this->ajaxReturn($return);
    	
    	$img['photo_name'] = $data['photo_name'];
    	$upload = new Upload();
    	//实例化上传类
    	$upload->maxSize = 3145728;
    	//设置上传大小,字节
    	$upload->exts = array('jpg','gif','png','jpeg');
    	//限定后缀
    	$upload->rootPath = './Upload/'; // 设置附件上传根目录
		$upload->savePath = ''; // 设置附件上传(子)目录
    	$img['url'] = '__ROOT__/Upload/';
    	$img['date'] = time();
    	$image = M('Image');
    	$image->add('$img');
    	$image_id = $image->where(Array("photo_name" => $data['photo_name']))->getField('id');
    	//在根目录Uploads下
    	$info = $upload->upload();
    	//执行上传方法
    	if (!$info) {
    		$this->error($upload->getError());
    	} else {
    		$this->success('上传成功!');
    	}
    	$data['image_id'] = $image_id;
    	$this->ajaxReturn(D("Goods")->publish($data));
    }
    
    public function display_goods() {
    	$goods = M('Goods');
    	$goodslist = $goods->order('date')->getfield('name,price,description');
    	$this->ajaxReturn($goodslist);
    }
    
    public function upload(){
    	
    }
}