<?php
if (isset($_COOKIE['username']) && isset($_COOKIE['isLogin'])) {        //检查用户cookie是否存在
	$username = $_COOKIE['username'];
}
include_once '../PDOClass/pdoClass.php';            //引入一个pdo类

//连接数据库
$host = '172.16.50.28';
$user = 'root';
$pass = 'root';
$dbname = 'jinling';

$link = new pdoClass($host, $user, $pass, $dbname);        //创建一个PDO对象

//查询新闻信息
$sql = "SELECT intro FROM compMes WHERE id=1";

$link->query($sql);
$compMes = $link->fetch();

if (isset($_POST['intro'])&&$_POST['intro'] !='') {
	//判断表单是否提交

	//更新公司简介
	$sql = 'UPDATE compMes SET intro=:intro,adder=:adder,addTime=:addTime WHERE id=1';

	$link->prepare($sql);

	$intro = $_POST['intro'];
	$adder = $username;
	$addTime = time();

	$link->execute(array(':intro' => $intro,':adder' => $adder,':addTime' => $addTime));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>编辑公司简介</title>
<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
</head>
<body>
<div id="append"></div>
<div class="container">
	<h3>编辑公司简介</h3>
    <div class="mainbox">
        <form action="" method="post">
            <table style="width:700px;">
                <tbody>
				<form action="#" method="post">
                	<tr>
                    	<td><textarea rows="10" cols="80" name="intro"><?php echo $compMes['intro'];?></textarea></td>
                    </tr>
                    <tr>
                    	<td>添加人：<?php echo $username; ?> &nbsp;&nbsp;&nbsp;添加时间：<?php echo date('Y-m-d H:i',time()); ?></td>
                    </tr>
                    <tr>
                        <td><input value="提 交" class="btn" type="submit"></td>
                    </tr>
				</form>
                </tbody>
            </table>
        </form>
    </div>
</div>
</body>
</html>

