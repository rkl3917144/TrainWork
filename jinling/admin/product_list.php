<?php

include_once '../PDOClass/pdoClass.php';            //引入一个pdo类

//连接数据库
$host = '172.16.50.28';
$user = 'root';
$pass = 'root';
$dbname = 'jinling';
$link = new pdoClass($host, $user, $pass, $dbname);        //创建一个PDO对象

//查询产品表，获取产品表信息
$selSQL = "SELECT id,name,description,proClassID,image,adder,addTime FROM product";
$link->query($selSQL);
$arr = $link->fetchAll();


//判断删除的选项
if(isset($_POST['chkall'])){            //全部删除
    
    $delSQL = "DELETE FROM product";
    $link->exec($delSQL);
    
}else if(isset($_POST['products'])){    //部分删除
    
    //删除产品表信息
    $delSQL = "DELETE FROM product where id=:id";
    $link->prepare($delSQL);
    foreach($_POST['products'] as $key=>$value){
        $id = $_POST['products']["$key"];
        $link->execute(Array(':id'=>$id));
    }
    header('localtion:product_list.php');
    //echo "<script language=JavaScript> location.replace(location.href);</script>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>产品管理</title>
<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</head>
<body>
<div class="container">
    <h3 class="marginbot">产品管理<a href="product_edit.php" class="sgbtn">添加新产品</a></h3>
    <div class="mainbox">
        <form action="#" method="post">
            <table class="datalist fixwidth">
                <tbody>
                    <tr>
                        <th nowrap="nowrap"><input name="chkall" id="chkall" class="checkbox" type="checkbox"><label for="chkall">删除</label></th>
                        <th nowrap="nowrap">产品名称</th>
						<th nowrap="nowrap">产品团片</th>
                        <th nowrap="nowrap">添加人</th>
                        <th nowrap="nowrap">添加时间</th>
                        <th nowrap="nowrap">详情</th>
                    </tr>
                    <?php
                    foreach($arr as $key=>$value){
                        ?>
                        <tr>
                            <td width="80"><input name="products[]" value=<?php echo $arr["$key"]['id'];?> class="checkbox" type="checkbox"></td>
                            <td width="200"><strong><?php echo $arr["$key"]['name'];?></strong></td>
                            <td width="100"><img src=<?php echo $arr["$key"]['image'];?>></td>
                            <td width="100"><?php echo $arr["$key"]['adder'];?></td>
                            <td width="150"><?php echo date("Y-m-d H:i",$arr["$key"]['addTime']);?></td>
                            <td width="100"><a href="product_update.php?id=<?php echo $arr["$key"]['id'];?>">编辑</a></td>
                        </tr>
                    <?php }?>
                    <tr class="nobg">
                    	<td ><input value="提 交" class="btn" type="submit"></td>
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