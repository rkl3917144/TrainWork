<?php

include_once '../PDOClass/pdoClass.php';            //引入一个pdo类

//连接数据库
$host = '172.16.50.28';
$user = 'root';
$pass = 'root';
$dbname = 'jinling';
$link = new pdoClass($host, $user, $pass, $dbname);        //创建一个PDO对象

//查询文章表信息
$selSQL = "SELECT id,title,content,artClass,adder,addTime FROM article";
$link->query($selSQL);
$arr = $link->fetchAll();

if(($_POST['username']!=''&&$_POST['password']!='')){
    //判断表单是否提交
    echo "<pre>";
    print_r($_POST['checkbox']);



    echo "</pre>";
    //插入语句
    $sql = "INSERT INTO user(name,pass,recordDate,recordIP,state) VALUES (:name,:pass,:recordDate,:recordIP,:state)";

    $link->prepare($sql);

    $name = $_POST['username'];
    $pass = $_POST['password'];
    $recordDate = time();
    $recordIP = $_SERVER['REMOTE_ADDR'];
    $state = 0;
    $link->execute(Array(':name'=>$name,':pass'=>$pass,':recordDate'=>$recordDate,':recordIP'=>$recordIP,':state'=>$state));

}

//判断删除的选项
if(isset($_POST['chkall'])){            //全部删除

    $delSQL = "DELETE FROM articles";
    $link->exec($delSQL);

}else if(isset($_POST['articles'])){    //部分删除

    //删除产品表信息
    $delSQL = "DELETE FROM article where id=:id";
    $link->prepare($delSQL);
    foreach($_POST['articles'] as $key=>$value){
        $id = $_POST['articles']["$key"];
        $link->execute(Array(':id'=>$id));
    }
    header('localtion:news_list.php');
    //echo "<script language=JavaScript> location.replace(location.href);</script>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>最新公告</title>
<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</head>
<body>
<div class="container">
    <h3 class="marginbot">最新公告<a href="news_edit.php" class="sgbtn">添加新文章</a></h3>
    <div class="mainbox">
        <form action="" method="post">
            <table class="datalist fixwidth">
                <tbody>
                    <tr>
                        <th nowrap="nowrap"><input name="chkall" id="chkall" class="checkbox" type="checkbox"><label for="chkall">删除</label></th>
                        <th nowrap="nowrap">文章名称</th>
                        <th nowrap="nowrap">添加人</th>
                        <th nowrap="nowrap">添加时间</th>
                        <th nowrap="nowrap">详情</th>
                    </tr>
                    <?php
                    foreach($arr as $key=>$value){
                        ?>
                        <tr>
                            <td width="80"><input name="articles[]" value=<?php echo $arr["$key"]['id'];?> class="checkbox" type="checkbox"></td>
                            <td><strong><?php echo $arr["$key"]['title']?></strong></td>
                            <td width="100"><?php echo $arr["$key"]['adder']?></td>
                            <td width="150"><?php echo date("Y-m-d H:i",$arr["$key"]['addTime'])?></td>
                            <td width="100"><a href="news_update.php?id=<?php echo $arr["$key"]['id']?>">编辑</a></td>
                        </tr>
                    <?php }?>
                    <tr class="nobg">
                    	<td><input value="提 交" class="btn" type="submit"></td>
                        <td class="tdpage" colspan="4">
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
                </tbody>
        	</table>
        <div class="margintop"></div>
        </form>
    </div>
</div>
</body>
</html>