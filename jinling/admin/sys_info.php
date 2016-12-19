<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/19/0019
 * Time: 0:03
 */

include_once '../PDOClass/pdoClass.php';            //引入一个pdo类

//连接数据库
$host = '172.16.50.28';
$user = 'root';
$pass = 'root';
$dbname = 'jinling';

$link = new pdoClass($host, $user, $pass, $dbname);        //创建一个PDO对象

//查询产品表信息
$sql = "SELECT COUNT(*) proCount FROM product";
$link->query($sql);
$proCount = $link->fetch();

//查询文章表信息
$sql = "SELECT COUNT(*) artCount FROM article";
$link->query($sql);
$artCount = $link->fetch();

//查询留言表信息
$sql = "SELECT COUNT(*) lyCount FROM liuyan";
$link->query($sql);
$lyCount = $link->fetch();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $page_title;?></title>
<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/common.js"></script>
</head>
<body>
<div class="container">
	<h3>统计信息</h3>
	<ul class="memlist fixwidth">
		<li><em>产品总数:</em><?php echo $proCount['proCount'];?></li>
		<li><em>文章总数:</em><?php echo $artCount['artCount'];?></li>
		<li><em>留言总数:</em><?php echo $lyCount['lyCount'];?></li>
	</ul>
	
	<h3>系统信息</h3>
	<ul class="memlist fixwidth">
    	<li><em>主机名:</em><?php echo $_SERVER['REMOTE_ADDR']; ?></li>
		<li><em>操作系统:</em><?PHP echo PHP_OS; ?></li>
		<li><em>服务器软件:</em><?php echo $_SERVER['SERVER_SOFTWARE']; ?></li>
		<li><em>数据库平台:</em>Mysql/5.7.16-0</li>
	</ul>
	<h3>版权信息</h3>
	<ul class="memlist fixwidth">
		<li>
			<em>版权所有:</em>
			<em class="memcont"><a href="http://www.jinling.com/" target="_blank">金陵贸易有限公司</a></em>
		</li>
		<li>
			<em>程序版本:</em>
			<em class="memcont">Jinling 1.0 Release</em>
		</li>
		<li>
			<em>技术支持:</em>
			<em class="memcont">admin@gmail.com</em>
		</li>
	</ul>
</div>
</body>
</html>