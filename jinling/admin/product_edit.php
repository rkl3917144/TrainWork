<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/15/0015
 * Time: 18:58
 */

if (isset($_COOKIE['username'])&&isset($_COOKIE['isLogin'])) {        //检查用户cookie是否存在
	//用户成功登陆
	$username = $_COOKIE['username'];
}

include_once '../PDOClass/pdoClass.php';            //引入一个pdo类

//连接数据库
$host = '172.16.50.28';
$user = 'root';
$pass = 'root';
$dbname = 'jinling';
$link = new pdoClass($host, $user, $pass, $dbname);        //创建一个PDO对象

//查询产品分类表信息
$selSQL = 'SELECT id,name,description FROM proClass';
$link->query($selSQL);
$arrProClass = $link->fetchAll();

if($_POST['name']!=''&&$_POST['description']!=''&&$_POST['proClassID']!=''){
	//判断表单是否提交
	include_once '../fileUploadClass/fileUpload.php';			//引入一个文件上传类

	$file = $_FILES;
	$toPath = './images/';
	$fileUpload = new 	fileUpload($file,"image",$toPath);		//创建一个文件上传类
	$filename = $fileUpload->copyFile();							//调用拷贝方法

	$fileSrc = "./images/"."$filename";	//上传后的文件绝对路径

	$sql = "INSERT INTO product(name,description,proClassID,image,adder,addTime) VALUES (:name,:description,:proClassID,:image,:adder,:addTime)";

	$link->prepare($sql);

	//获取$_POST和$_FILES两个超全局变量的内部值
	$name = $_POST['name'];
	$description = $_POST['description'];
	$proClassID = $_POST['proClassID'];
	$image = $fileSrc;
	$adder = $username;
	$addTime = time();

	$link->execute(Array(':name'=>$name,':description'=>$description,':proClassID'=>$proClassID,':image'=>$image,':adder'=>$adder,':addTime'=>$addTime));		//执行sql语句

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>添加新产品</title>
	<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
</head>
<body>
<div class="container">
	<h3 class="marginbot">添加新产品<a href="product_list.php" class="sgbtn">返回产品列表</a></h3>
	<div class="mainbox">
		<form action="#" method="post" enctype="multipart/form-data">
			<table class="opt" style="width:600px;">
				<tbody>
				<tr>
					<th>产品名称：</th>
				</tr>
				<tr>
					<td>
						<input name="name" class="txt" style="width:400px;" type="text">
					</td>
				</tr>
				<tr>
					<th>
						上传图片:<input type="file" name="image">
					</th>
				</tr>
				<tr>
					<th>产品描述：</th>
				</tr>
				<tr>
					<td><textarea style="width:400px; height:150px" name="description"></textarea></td>
				</tr>
				<tr>
					<th>
						类别选择:<select name="proClassID">
							<?php
							foreach ($arrProClass as $key => $value) {
								?>
								<option value="<?php echo $arrProClass["$key"]['id']?>"><?php echo $arrProClass["$key"]['name']?></option>
								<?php
							}
							?>
						</select>
					</th>
				</tr>

				</tbody>
			</table>
			<div class="opt"><input name="submit" value=" 提 交 " class="btn" tabindex="3" type="submit"></div>
		</form>
	</div>
</div>
</body>
</html>