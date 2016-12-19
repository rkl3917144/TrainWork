<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/18/0018
 * Time: 23:14
 */
if (isset($_COOKIE['username'])&&isset($_COOKIE['isLogin'])) {        //检查用户cookie是否存在
	//用户成功登陆
	$username = $_COOKIE['username'];
}
if(isset($_GET['id'])) {
	//判断表单是否提交
	$id = $_GET['id'];
	include_once '../PDOClass/pdoClass.php';            //引入一个pdo类

	//连接数据库
	$host = '172.16.50.28';
	$user = 'root';
	$pass = 'root';
	$dbname = 'jinling';

	$link = new pdoClass($host, $user, $pass, $dbname);        //创建一个PDO对象
	
	
	//查询新闻信息
	$sql = "SELECT title,content,artClass FROM article WHERE id=$id";

	$link->query($sql);
	$arrArticle = $link->fetch();

	//在article表查询除artClass类别外的新闻类别
	$sql = "SELECT DISTINCT artClass FROM article WHERE artClass!=:artClass";
	$link->prepare($sql);						//预处理
	$artClass = $arrArticle['artClass'];		//文章类别
	$link->execute(Array(':artClass'=>$artClass));
	$arrC = $link->fetchAll();
}
if(isset($_POST)&&$_POST['title']!=''&&$_POST['content']!=''&&$_POST['artClass']!=''){
	//判断表单是否提交

	$sql = "UPDATE article SET title=:title,content=:content,adder=:adder,addTime=:addTime,artClass=:artClass WHERE id=$id";

	$link->prepare($sql);

	$title = $_POST['title'];
	$content = $_POST['content'];
	$artClass = $_POST['artClass'];
	$adder = $username;
	$addTime = time();

	$link->execute(Array(':title'=>$title,':content'=>$content,':artClass'=>$artClass,':adder'=>$adder,':addTime'=>$addTime));
	header("location:news_list.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>添加新文章</title>
	<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
</head>
<body>
<div class="container">
	<h3 class="marginbot">更新文章<a href="news_list.php" class="sgbtn">返回文章列表</a></h3>
	<div class="mainbox">
		<form action="#" method="post">
			<table class="opt" style="width:600px;">
				<tbody>
				<tr>
					<th>文章名称：</th>
				</tr>
				<tr>
					<td>
						<input name="title" class="txt" style="width:400px;" type="text" value=<?php echo $arrArticle['title']?>>
					</td>
				</tr>
				<tr>
					<th>文章内容：</th>
				</tr>
				<tr>
					<td><textarea style="width:400px; height:150px" name="content"><?php echo $arrArticle['content']?></textarea></td>
				</tr>
				<tr>
					<th>
						类别选择:<select name="artClass">
							<option ><?php echo $arrArticle['artClass']?></option>
							<?php
								foreach($arrC as $key=>$velue){
							?>
									<option ><?php echo $arrC["$key"]['artClass']?></option>
							<?php }?>
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