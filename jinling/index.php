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

//查询文章表行业资讯信息
$selSQL = "SELECT id,title,addTime FROM article WHERE artClass='行业资讯'";
$link->query($selSQL);
$arrMessage = $link->fetchAll();

//查询产品表信息
$selSQL = "SELECT id,name,image FROM product";
$link->query($selSQL);
$arrProduct = $link->fetchAll();

//查询公司信息表信息
$selSQL = "SELECT * FROM compMes";
$link->query($selSQL);
$arrCompany = $link->fetch();

//查询友情链接表信息
$selSQL = "SELECT * FROM friendlyLink";
$link->query($selSQL);
$arrLink = $link->fetchAll();

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
     	<li class="sel"><a href="index.php">首  页</a></li>
        <li><a href="about_us.php">公司简介</a></li>
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
	<div class="w475_l">
    	<div class="title">
        	<h2 class="cBlue fB">公司简介<b class="cGrey fn">About us</b></h2>
        </div>
        <div class="intro">
				<?php echo substr($arrCompany['intro'],0,500)?>
                <a href="about_us.php" class="cBlue"> 查看更多...</a>
                <div class="hackbox"></div>
        </div>
        <div class="blank10"></div>
        <div class="title">
        	<h2 class="cBlue fB">产品展示<b class="cGrey fn">Products</b></h2><span class="more"><a href="product_list.php" class="cBlue"> 更多...</a></span>
        </div>
        <ul class="list_l">
			<?php
				foreach($arrProduct as $key=>$value){
			?>
				<li>
                <span class="listimg">
                    <a href="product_info.php?id=<?php echo $arrProduct["$key"]['id']?>" alt=<?php echo $arrProduct["$key"]['name']?>> <img src=<?php echo preg_replace('/\.\//','./admin/',$arrProduct["$key"]['image'])?> > </a>
                </span>
					<span class="listtxt"><a href="product_info.php"><?php echo $arrProduct["$key"]['name']?></a></span>
				</li>
			<?php
				}
			?>
           
        </ul>
    </div>
    <div class="w370_r">
    	<div class="title">
        	<h2 class="cBlue fB">最新公告<b class="cGrey fn">News</b></h2>
        </div>
        <ul class="list_r">
			<?php
				foreach($arrNotice as $key=>$value){
			?>
				<li>
					<a title=<?php echo $arrNotice["$key"]['title']?> href="article.php?id=<?php echo $arrNotice["$key"]['id']?>"><?php echo substr($arrNotice["$key"]['title'],0,15)?></a>
					<span class="time1"><?php echo date("Y-m-d H:i:s",$arrNotice["$key"]['addTime'])?></span>
				</li>
			<?php }?>
        </ul>
        <div class="blank29"></div>
        <div class="title">
        	<h2 class="cBlue fB">行业资讯<b class="cGrey fn">Information</b></h2><span class="more"><a href="info.php" class="cBlue"> 更多...</a></span>
        </div>
        <ul class="list_r">
			<?php
			foreach($arrMessage as $key=>$value){
				?>
				<li>
					<a title=<?php echo $arrMessage["$key"]['title']?> href="article.php?id=<?php echo $arrMessage["$key"]['id']?>"><?php echo substr($arrMessage["$key"]['title'],0,15)?></a>
					<span class="time1"><?php echo date("Y-m-d H:i:s",$arrMessage["$key"]['addTime'])?></span>
				</li>
			<?php }?>
        </ul>
    </div>
    <div class="hackbox"></div>
    
	<div class="title">
        	<h2 class="cBlue fB">友情链接<b class="cGrey fn">Links</b></h2>
    </div>
    <p class="links">
			<?php
			foreach($arrLink as $key=>$value){
			?>
			<a href=<?php echo $arrLink["$key"]['url']?>><?php echo $arrLink["$key"]['name']?></a> |
			<?php }?>
    </p>
</div>
<div class="footer">
	<p>地址:<?php echo $arrCompany['addr']?>&nbsp;&nbsp;&nbsp;联系人:<?php echo $arrCompany['linkman']?>&nbsp;&nbsp;&nbsp;移动电话:<?php echo $arrCompany['mtel']?>
		&nbsp;&nbsp;&nbsp;固定电话:<?php echo $arrCompany['fTel']?>&nbsp;&nbsp;&nbsp;传 真:<?php echo $arrCompany['fax']?></p>
	<p><?php echo $arrCompany['LDN']?> <?php echo $arrCompany['copyrighter']?> 版权所有</p>
	<p><a href="#"><?php echo $arrCompany['icpNo']?></a></p>
</div>
</body>
</html>