<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/8/0008
 * Time: 14:56
 */

//封装 cookie 类		内部包含设置cookie的方法，查看cookie的方法
class cookieClass{
	//设置cookie
	function addCookie($name ,$value ,$time){
		setcookie($name,$value,$time);
	}
	
	//得到cookie信息
	function getCookie(){
		return $_COOKIE;
	}

	//清除cookie文件
	function cleanCookie($name){
		setcookie($name,'',time());
	}
}



//封装session类
class sessionClass{

	//开启session
	function startSession(){
		session_start();
	}

	//得到session信息
	function getSession(){
		return $_SESSION;
	}

	//清除session的信息
	function cleanSession(){
		session_start();
		//清空session值
		$_SESSION = array();
		//通过setCookie删除sessionID
		if(isset($_COOKIE[session_name()])){			//判断用户是否开启了cookie
			setcookie(session_name(),'',time()-3600,'/');
		}
		//彻底删除session
		session_destroy();
	}
}
