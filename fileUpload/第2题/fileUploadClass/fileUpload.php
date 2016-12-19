<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/15/0015
 * Time: 19:51
 */

/*
 * 该类为文件上传类
 */
//include_once '../admin';
class fileUpload{

	//设置私有属性
	private $fileName = null;		//文件名
	private $_file = null;			//接收$_FILES;
	private $fileSrc = null;		//接收缓冲区路径
	private $extension = null;				//文件扩展名
	private $toPath = null;			//文件的拷贝目录
	private $formName = null;		//上传表单内的name属性
	public 	$randName = null;		//随机名
	//构造方法
	public function __construct($_file,$formName,$toPath = '../admin/images/')
	{
		$this->_file = $_file;
		$this->toPath = $toPath;
		$this->formName = $formName;
		$this->fileName = $this->getFileName();			//赋值文件名
		$this->fileSrc = $this->getCacheDir();		//赋值缓冲路径
		$this->extension = $this->getExtension();
	}
	
	//获取文件扩展名
	public function getExtension(){
		
		//得到扩展名
		$arr = explode('.', $this->fileName);
		return $arr[count($arr) - 1];
	}
	
	//获取上传的文件名
	public function getFileName(){
		return $this->_file["$this->formName"]['name'];
	}
	
	//获取缓冲区的路径
	public function getCacheDir(){
		return $this->_file["$this->formName"]['tmp_name'];
	}
	
	//产生随机名
	public function getNewName(){
		$this->randName = date('YmdHis').'.'.$this->extension;
		return $this->randName;
	}
	
	//拷贝文件
	public function copyFile(){
		if (is_uploaded_file($this->fileSrc)) {        //判断上传的文件是否存在
			if (move_uploaded_file($this->fileSrc, $this->toPath.$this->getNewName())) {
				return $this->randName;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
