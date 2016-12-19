<?php

include_once '../PDOClass/pdoClass.php';            //引入一个pdo类

//连接数据库
$host = '172.16.50.28';
$user = 'root';
$pass = 'root';
$dbname = 'jinling';
$link = new pdoClass($host, $user, $pass, $dbname);        //创建一个PDO对象

//查询用户表信息
$selSQL = "SELECT id,name,recordDate,recordIP,state FROM user";
$link->query($selSQL);
$arr = $link->fetchAll();

if(($_POST['username']!=''&&$_POST['password']!='')){
    //判断表单是否提交
   
    //插入语句
    $sql = "INSERT INTO user(name,pass,recordDate,recordIP,state) VALUES (:name,:pass,:recordDate,:recordIP,:state)";

    $link->prepare($sql);

    $name = $_POST['username'];
    $pass = md5($_POST['password']);
    $recordDate = time();
    $recordIP = $_SERVER['REMOTE_ADDR'];
    $state = 0;
    $link->execute(Array(':name'=>$name,':pass'=>$pass,':recordDate'=>$recordDate,':recordIP'=>$recordIP,':state'=>$state));

}

//判断删除的选项
if(isset($_POST['chkall'])){            //全部删除

    $delSQL = "DELETE FROM user";
    $link->exec($delSQL);

}else if(isset($_POST['users'])){    //部分删除

    var_dump($_POST['users']);
    //删除产品表信息
    $delSQL = "DELETE FROM user where id=:id";
    $link->prepare($delSQL);
    foreach($_POST['users'] as $key=>$value){
        $id = $_POST['users']["$key"];
        $link->execute(Array(':id'=>$id));
    }
    header('localtion:user_list.php');
    //echo "<script language=JavaScript> location.replace(location.href);</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员列表</title>
<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</head>
<body>

<div class="container">
    <div class="hastabmenu">
        <form action="#" method="post">
            <ul class="tabmenu">
                <li id="adduserbtn" class="tabcurrent"><a href="#" >添加管理员</a></li>
            </ul>
            <div id="adduserdiv" class="tabcontentcur">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td>用户名:</td>
                            <td><input name="username" class="txt" type="text"></td>
                            <td>密码:</td>
                            <td><input name="password" class="txt" type="password"></td>
                            <td><input value="提 交" class="btn" type="submit"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
	</div>

    <br>
    <h3>管理员列表</h3>
    <div class="mainbox">
            <table class="datalist fixwidth">
                <tbody>
                    <tr>
                        <th>
                        	<input name="chkall" id="chkall" class="checkbox" type="checkbox"><label for="chkall">删除</label>
                        </th>
                        <th>用户名</th>
                        <th>最后更新日期</th>
                        <th>最后更新IP</th>
                        <th>用户状态</th>
                        <th>编辑</th>
                    </tr>
                    <form action="#" method="post">
                        <?php
                            foreach($arr as $key=>$value){
                        ?>
                            <tr>
                                <td class="option">
                                    <input name="users[]" class="checkbox" type="checkbox" value="<?php echo $arr["$key"]['id']?>">
                                </td>
                                <td><strong><?php echo $arr["$key"]['name']?></strong></td>
                                <td><?php echo date("Y/m/d H:i:s",$arr["$key"]['recordDate'])?></td>
                                <td><?php echo $arr["$key"]['recordIP']?></td>
                                <td><?php echo $arr["$key"]['state'] ? "启用" : "未启用"?></td>
                                <td><a href="user_edit.php?id=<?php echo $arr["$key"]['id']?>">编辑</a></td>
                            </tr>
                        <?php }?>
                        <tr class="nobg">
                            <td><input value="提 交" class="btn" type="submit"></td>
                            <td class="tdpage" colspan="6">
                                <div class="pages">
                                <em>100</em>
                                <strong>1</strong>
                                <a href="">2</a>
                                <a href="">3</a>
                                <a href="">4</a>
                                <a href="" class="next">&rsaquo;&rsaquo;</a>
                                <a href="" class="last">... </a>
                                <kbd><input type="text" name="custompage" size="3" onkeydown="if(event.keyCode==13) {window.location='?page='+this.value; return false;}" /></kbd>
                                </div>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
    </div>
</div>
</body>
</html>