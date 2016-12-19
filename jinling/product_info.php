<?php

	include_once './PDOClass/pdoClass.php';            //引入一个pdo类
	
	//连接数据库
	$host = '172.16.50.28';
	$user = 'root';
	$pass = 'root';
	$dbname = 'jinling';
	
	$link = new pdoClass($host, $user, $pass, $dbname);        //创建一个PDO对象


	//查询文章表最新公告信息
	$selSQL = "SELECT id,title,addTime FROM article WHERE artClass='最新公告'";
	$link->query($selSQL);
	$arrNotice = $link->fetchAll();
	
	//查询公司信息表信息
	$selSQL = "SELECT * FROM compMes";
	$link->query($selSQL);
	$arrCompany = $link->fetch();
	
	//查询友情链接表信息
	$selSQL = "SELECT * FROM friendlyLink";
	$link->query($selSQL);
	$arrLink = $link->fetchAll();

if(isset($_GET)) {
	//判断表单是否提交
	$id = $_GET['id'];
	
	//查询产品表信息
	$selSQL = "SELECT name,image,description FROM product where id=$id";

	$link->query($selSQL);
	$arrProduct = $link->fetch();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>金陵贸易有限公司</title>
<link type="text/css" rel="stylesheet" href="style/style.css" />
</head>

<body>
<div class="header">
	<h1 class="logo" title="金陵贸易有限公司"><a href="index.php"><img src="images/logo.gif" alt="金陵贸易有限公司" /></a></h1>
    <p class="top_r"><a href="#" class="btn_i">设为主页</a><a href="#" class="btn_f">收藏本站</a></p>
</div>
<div class="nav">
	<div class="nav_left"></div>
    <ul>
     	<li><a href="index.php">首  页</a></li>
        <li class="sel"><a href="about_us.php">公司简介</a></li>
        <li><a href="product_list.php">产品展示</a></li>
        <li><a href="info.php">行业资讯</a></li>
        <li><a href="guestbook.php">客户留言</a></li>
        <li><a href="contact_us.php" class="nobg">联系我们</a></li>
     </ul>
     <div class="time">2009-07-10 8:00</div>
    <div class="nav_right"></div>
</div>
<div class="banner">
	<a href="#"><img src="images/banner.jpg" align="banner" /></a>
</div>
<div class="content">
	<div class="lefter">
    	<div class="title">
        	<h2 class="cBlue fB">产品信息<b class="cGrey fn">Product Info</b></h2>
        </div>
        <div class="product">
			<img src=<?php echo preg_replace('/\.\//','./admin/',$arrProduct['image'])?> alt=<?php echo $arrProduct['name']?> />
			<p><strong>产品名称</strong>：<?php echo $arrProduct['name']?></p>
			<p><strong>产品描述</strong>：</p>
			<?php echo $arrProduct['description']?>
        	
        </div>
    </div>
	<div class="righter">
    	<div class="rightBox">
        	<a href="#" class="btn_s">我要留言</a>
        </div>
        <div class="blank10"></div>
    	<div class="rightBox">
        	<h3>最新公告<b class="cGrey fn">News</b></h3>
            <ul class="list_r">
				<?php
				foreach($arrNotice as $key=>$value){
					?>
					<li>
						<a  href="article.php?id=<?php echo $arrNotice["$key"]['id']?>"><?php echo substr($arrNotice["$key"]['title'],0,15)?></a>
					</li>
				<?php }?>
            </ul>
        </div>
        <div class="blank10"></div>
        <div class="rightBox">
        	<h3>友情链接<b class="cGrey fn">Links</b></h3>
            <ul class="list_r">
				<?php
				foreach($arrLink as $key=>$value){
					?>
					<a href=<?php echo $arrLink["$key"]['url']?>><?php echo $arrLink["$key"]['name']?></a> |
				<?php }?>
            </ul>
        </div>
    </div>
    <div class="hackbox"></div>
    
    
</div>
<div class="footer">
	<p>地址:<?php echo $arrCompany['addr']?>&nbsp;&nbsp;&nbsp;联系人:<?php echo $arrCompany['linkman']?>&nbsp;&nbsp;&nbsp;移动电话:<?php echo $arrCompany['mtel']?>
		&nbsp;&nbsp;&nbsp;固定电话:<?php echo $arrCompany['fTel']?>&nbsp;&nbsp;&nbsp;传 真:<?php echo $arrCompany['fax']?></p>
	<p><?php echo $arrCompany['LDN']?> <?php echo $arrCompany['copyrighter']?> 版权所有</p>
	<p><a href="#"><?php echo $arrCompany['icpNo']?></a></p>
</div>
</body>
</html>
