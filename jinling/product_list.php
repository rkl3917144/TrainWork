<?php

include_once './PDOClass/pdoClass.php';            //引入一个pdo类

//连接数据库
$host = '172.16.50.28';
$user = 'root';
$pass = 'root';
$dbname = 'jinling';
$link = new pdoClass($host, $user, $pass, $dbname);        //创建一个PDO对象

//查询产品表信息
$selSQL = 'SELECT id,name,image FROM product';
$link->query($selSQL);
$arrProduct = $link->fetchAll();

//查询公司信息表信息
$selSQL = 'SELECT * FROM compMes';
$link->query($selSQL);
$arrCompany = $link->fetch();

//查询产品分类表信息
$selSQL = 'SELECT id,name,description FROM proClass';
$link->query($selSQL);
$arrProClass = $link->fetchAll();

if(isset($_GET['id'])) {
    //判断表单是否提交
    $proClassID = $_GET['id'];

    //查询产品表信息
    $selSQL = "SELECT id,name,image,description FROM product where proClassID=$proClassID";

    $link->query($selSQL);
    $arrProduct = $link->fetchAll();
}else{

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
	<div class="lefter">
    	<div class="title">
        	<h2 class="cBlue fB">产品展示<b class="cGrey fn">Products</b></h2>
        </div>
        <ul class="list_l">
			<?php
            foreach ($arrProduct as $key => $value) {
                ?>
				<li>
                <span class="listimg">
                    <a href="product_info.php?id=<?php echo $arrProduct["$key"]['id']?>" alt=<?php echo $arrProduct["$key"]['name']?>> <img src=<?php echo preg_replace('/\.\//', './admin/', $arrProduct["$key"]['image'])?> > </a>
                </span>
					<span class="listtxt"><a href="product_info.php?id=<?php echo $arrProduct["$key"]['id']?>"><?php echo $arrProduct["$key"]['name']?></a></span>
				</li>
				<?php
            }
            ?>
        </ul>
        <div class="blank10"></div>
        <div class="pages"><a href="#" class="pre">上一页</a><a class="current">1</a><a href="#?page=2">2</a><a href="#?page=3">3</a><a href="#?page=2" class="next">下一页</a></div>
        <div class="blank6"></div>
    </div>
	<div class="righter">
    	<div class="rightBox">
        	<h3>产品分类</h3>
            <ul class="list_r">
				<?php
                foreach ($arrProClass as $key => $value) {
                    ?>
					<li><a href="product_list.php?id=<?php echo $arrProClass["$key"]['id']?>"><?php echo $arrProClass["$key"]['name']?></a></li>
				<?php

                }
                ?>

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
