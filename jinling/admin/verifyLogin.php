<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/15/0015
 * Time: 13:58
 */
//该php文件用于验证登陆信息

include_once '../PDOClass/pdoClass.php';			//引入一个pdo类
include_once '../cookieClass/cookieClass.php';		//引入cookie类

//连接数据库
$host = '172.16.50.28';
$user = 'root';
$pass = 'root';
$dbname = 'jinling';

$link = new pdoClass($host,$user,$pass,$dbname);		//创建一个PDO对象

$user = $_POST['username'];				//用户账号
$pass = md5($_POST['password']);		//用户密码

$sql = "select pass from user where name = '$user'";		//查询数据库内的账号信息

$link->query($sql);					//调用封装类的query方法，执行sql语句
$result = $link->fetch();			//获得结果集内的函数



// 判断登陆信息是否正确
if($result['pass']==$pass){

	//设置一条cookie信息,包含用户名
	$name = 'username';
	$value = $user;
	$time = time()+60*60*24;
	$myCookie = new cookieClass();
	$myCookie->addCookie($name,$value,$time);

	//设置一条cookie信息,包含是否登陆
	$name = 'isLogin';
	$value = 1;
	$time = time()+60*60*24;
	$myCookie->addCookie($name,$value,$time);

	header("location:index.php");
	//echo "登陆成功，正在跳转到管理首页<br/>";
	//echo "<a href='index.php' target='_blank'>未成功跳转，请点击这里</a>";
	//echo "<meta http-equiv='refresh' content=2;URL='index.php'>";        //2秒后自动跳转到登陆页面
}else{
	echo "登陆失败，正在跳转到登陆页面<br/>";
	echo "<a href='login.php' target='_blank'>未成功跳转，请点击这里</a>";
	//header("location:login.html");
	echo "<meta http-equiv='refresh' content=2;URL='login.php'>";        //2秒后自动跳转到登陆页面
}

