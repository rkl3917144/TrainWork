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

if(isset($_GET['id'])) {
    //判断表单是否提交
    $id = $_GET['id'];

    //查询用户表信息
    $selSQL = "SELECT name,pass,state FROM user WHERE id=$id";

    $link->query($selSQL);
    $arrUser = $link->fetch();
}

if(isset($_POST['name'])&&$_POST['name']!=''){
    //判断表单是否提交

    //更新语句
    $sql = "UPDATE user SET name=:name,pass=:pass,recordDate=:recordDate,recordIP=:recordIP,state=:state WHERE id=$id";

    $link->prepare($sql);

    $name= $_POST['name'];
    $pass = $_POST['pass'] ? md5($_POST['pass']) : md5($arrUser['pass']);
    $recordDate = time();
    $recordIP = $_SERVER['REMOTE_ADDR'];
    $state = $_POST['state'];

    $link->execute(Array(':name'=>$name,':pass'=>$pass,':recordDate'=>$recordDate,':recordIP'=>$recordIP,':state'=>$state));

    header('location:user_list.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>编辑用户资料</title>
<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
</head>
<body>
<div class="container">
    <h3 class="marginbot">编辑用户资料<a href="user_list.php" class="sgbtn">返回用户列表</a></h3>
    <div class="mainbox">
        <form action="#" method="post">
            <table class="opt">
                    <tbody>
                        <tr>
                            <th>用户名:</th>
                        </tr>
                        <tr>
                            <td>
                            <input name="name" class="txt" type="text" value="<?php echo $arrUser['name']?>">
                            </td>
                        </tr>
                        <tr>
                            <th>密　码:<span style="font-weight:normal"> [密码留空，保持不变]</span></th>
                        </tr>
                        <tr>
                            <td>
                            <input name="pass" value="" class="txt" type="password">
                            </td>
                        </tr>
                        <tr>
                            <th>用户状态:</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="state">
                                    <?php if($arrUser['state']==1){?>
                                        <option value="1">已启用</option>
                                        <option value="0">未启用</option>
                                    <?php }?>
                                    <?php if($arrUser['state']==0){?>
                                        <option value="0">未启用</option>
                                        <option value="1">已启用</option>
                                    <?php }?>
                                </select>
                            </td>
                        </tr>
                    </tbody>

            </table>
            <div class="opt"><input name="submit" value=" 提 交 " class="btn" tabindex="3" type="submit"></div>
        </form>
    </div>
</div>
</body>
</html>