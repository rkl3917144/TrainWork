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

//查询文章表信息
$selSQL = 'SELECT DISTINCT artClass FROM article';
$link->query($selSQL);
$articleClass = $link->fetchAll();

if (isset($_POST) && $_POST['title'] != '' && $_POST['content'] != '' && $_POST['artClass'] != '') {
    //判断表单是否提交

    //添加文章表
    $sql = 'INSERT INTO article(title,content,artClass,adder,addTime) VALUES (:title,:content,:artClass,:adder,:addTime)';

    $link->prepare($sql);

    $title = $_POST['title'];
    $content = $_POST['content'];
    $artClass = $_POST['artClass'];
    $adder = $username;
    $addTime = time();

    $link->execute(array(':title' => $title, ':content' => $content, ':artClass' => $artClass, ':adder' => $adder, ':addTime' => $addTime));
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
    <h3 class="marginbot">添加新文章<a href="news_list.php" class="sgbtn">返回文章列表</a></h3>
    <div class="mainbox">
        <form action="#" method="post">
            <table class="opt" style="width:600px;">
                <tbody>
                    <tr>
                        <th>文章名称：</th>
                    </tr>
                    <tr>
                        <td>
                        <input name="title" class="txt" style="width:400px;" type="text">
                        </td>
                    </tr>
                    <tr>
                        <th>文章内容：</th>
                    </tr>
                    <tr>
                        <td><textarea style="width:400px; height:150px" name="content"></textarea></td>
                    </tr>
                    <tr>
                        <th>
                            类别选择:<select name="artClass">
                                <?php
                                foreach ($articleClass as $key => $value) {
                                    ?>
                                    <option><?php echo $articleClass["$key"]['artClass']?></option>
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