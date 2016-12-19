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

//查询公司信息表
$selSQL = 'SELECT * FROM compMes';
$link->query($selSQL);
$compMes = $link->fetch();

if (isset($_POST['addr'])&&$_POST['addr'] !=''&&$_POST['linkman'] !='') {
	//判断表单是否提交


	//更新公司联系人和电话
	$sql = 'UPDATE compMes SET addr=:addr,linkman=:linkman,mtel=:mtel,fTel=:fTel,fax=:fax,addTime=:addTime,adder=:adder WHERE id=1';

	$link->prepare($sql);

	$addr = $_POST['addr'];
	$linkman = $_POST['linkman'];
	$mtel = $_POST['mtel'];
	$fTel = $_POST['fTel'];
	$fax = $_POST['fax'];
	$adder = $username;
	$addTime = time();

	$link->execute(array(':addr' => $addr,':linkman' => $linkman,':mtel' => $mtel,':fTel' => $fTel,':fax' => $fax,':adder' => $adder,':addTime' => $addTime));

	header('location:contact_us.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>编辑联系我们</title>
<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
</head>
<body>
<div id="append"></div>
<div class="container">
	<h3>编辑联系我们</h3>
    <div class="mainbox">
        <form action="#" method="post">
            <table style="width:700px;">
                <tbody>
					<tr>
						<th>公司地址：</th>
					</tr>
					<tr>
						<td>
							<input name="addr" class="txt" style="width:400px;" type="text" value="<?php echo $compMes['addr']?>">
						</td>
					</tr>
					<tr>
						<th>联系人：</th>
					</tr>
					<tr>
						<td>
							<input name="linkman" class="txt" style="width:200px;" type="text" value="<?php echo $compMes['linkman']?>">
						</td>
					</tr>
					<tr>
						<th>移动电话：</th>
					</tr>
					<tr>
						<td>
							<input name="mtel" class="txt" style="width:200px;" type="text" value="<?php echo $compMes['mtel']?>">
						</td>
					</tr>
					<tr>
						<th>固定电话：</th>
					</tr>
					<tr>
						<td>
							<input name="fTel" class="txt" style="width:200px;" type="text" value="<?php echo $compMes['fTel']?>">
						</td>
					</tr>
					<tr>
						<th>传真：</th>
					</tr>
					<tr>
						<td>
							<input name="fax" class="txt" style="width:200px;" type="text" value="<?php echo $compMes['fax']?>">
						</td>
					</tr>

                    <tr>
                    	<td>添加人：<?php echo $username; ?> &nbsp;&nbsp;&nbsp;添加时间：<?php echo date('Y-m-d H:i',time()); ?></td>
                    </tr>
                    <tr>
                        <td><input value="提 交" class="btn" type="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
</body>
</html>

