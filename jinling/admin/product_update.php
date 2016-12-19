<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/19/0019
 * Time: 0:03
 */
if (isset($_COOKIE['username'])&&isset($_COOKIE['isLogin'])) {        //检查用户cookie是否存在
	$username = $_COOKIE['username'];
}
if(isset($_GET)) {
	//判断表单是否提交
	$id = $_GET['id'];
	include_once '../PDOClass/pdoClass.php';            //引入一个pdo类

	//连接数据库
	$host = '172.16.50.28';
	$user = 'root';
	$pass = 'root';
	$dbname = 'jinling';

	$link = new pdoClass($host, $user, $pass, $dbname);        //创建一个PDO对象

	//查询产品表信息
	$sql = "SELECT name,image,description,proClassID FROM product WHERE id=$id";
	$link->query($sql);
	$arrProduct = $link->fetchAll();

	//查询产品对应的类名
	$sql = "SELECT id,name FROM proClass WHERE id=:proClaID";
	$link->prepare($sql);						//预处理
	$proClaID = $arrProduct['0']['proClassID'];		//文章类别
	$link->execute(Array(':proClaID'=>$proClaID));
	$proClass = $link->fetch();

	//查询产品分类表，找到除已知类名外的其他类名
	$sql = "SELECT DISTINCT id,name FROM proClass WHERE id!=:proClaID";
	$link->prepare($sql);						//预处理
	$proClaID = $arrProduct['0']['proClassID'];		//产品类别
	$link->execute(Array(':proClaID'=>$proClaID));
	$arrProClass = $link->fetchAll();

}
if($_POST['name']!=''&&$_POST['description']!=''&&$_POST['proClassID']!=''){
	
	//判断表单是否提交
	include_once '../fileUploadClass/fileUpload.php';			//引入一个文件上传类

	$file = $_FILES;
	$toPath = './images/';
	$fileUpload = new fileUpload($file,"image",$toPath);		//创建一个文件上传类
	$filename = $fileUpload->copyFile();							//调用拷贝方法

	$fileSrc = "./images/"."$filename";	//上传后的文件绝对路径

	//更新语句
	$sql = "UPDATE product SET name=:name,description=:description,proClassID=:proClassID,image=:image,adder=:adder,addTime=:addTime WHERE id=$id";

	$link->prepare($sql);

	//获取$_POST和$_FILES两个超全局变量的内部值
	$name = $_POST['name'];
	$description = $_POST['description'];
	$proClassID = $_POST['proClassID'];
	$image = $fileSrc;
	$adder = $username;
	$addTime = time();

	$link->execute(Array(':name'=>$name,':description'=>$description,':proClassID'=>$proClassID,':image'=>$image,':adder'=>$adder,':addTime'=>$addTime));		//执行sql语句
	header("location:product_list.php");
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
	<h3 class="marginbot">更新产品<a href="product_list.php" class="sgbtn">返回产品列表</a></h3>
	<div class="mainbox">
		<form action="#" method="post" enctype="multipart/form-data">
			<table class="opt" style="width:600px;">
				<tbody>
				<tr>
					<th>产品名称：</th>
				</tr>
				<tr>
					<td>
						<input name="name" class="txt" style="width:400px;" type="text" value=<?php echo $arrProduct['0']['name']?>>
					</td>
				</tr>
				<tr>
					<th>
						上传图片:<input type="file" name="image" value=<?php echo $arrProduct['0']['image']?>>
					</th>
				</tr>
				<tr>
					<th>产品描述：</th>
				</tr>
				<tr>
					<td><textarea style="width:400px; height:150px" name="description"><?php echo $arrProduct['0']['description']?></textarea></td>
				</tr>
				<tr>
					<th>
						类别选择:<select name="proClassID">
							<option value=<?php echo $proClaID?>><?php echo $proClass['name']?></option>
							<?php
							foreach($arrProClass as $key=>$velue){
								?>
								<option value=<?php echo $arrProClass["$key"]['id']?>><?php echo $arrProClass["$key"]['name']?></option>
							<?php }?>
							<?php /*if($arrProduct['0']['proClassID']==1){*/?><!--
								<option value="1">第一类</option>
								<option value="2">第二类</option>
								<option value="3">第三类</option>
							<?php /*}else if($arrProduct['0']['proClassID']==2){*/?>
								<option value="2">第二类</option>
								<option value="1">第一类</option>
								<option value="3">第三类</option>
							<?php /*}else if($arrProduct['0']['proClassID']==3){*/?>
								<option value="3">第三类</option>
								<option value="1">第一类</option>
								<option value="2">第二类</option>
							--><?php /*}*/?>
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