<?php
//判断是否登陆成功，并且获取登陆信息
if (isset($_COOKIE['username'])&&isset($_COOKIE['isLogin'])) {        //检查用户cookie是否存在
    //用户成功登陆
    $username = $_COOKIE['username'];
    $isLogin = $_COOKIE['isLogin'];
} else{
    header("location:login.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>金陵贸易 后台管理系统</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<link media="all" href="styles/style.css" type=text/css rel="stylesheet">
</head>
<body>
<div class="mainhd">
<div class="logo">金陵贸易 后台管理系统</div>
<div class="uinfo">
    <p>
        您好, <EM><?php echo "$username";?></EM> [ <a href="logout.php" target="_top">退出</a> ]
    </p>
</div>
</div>
</body>
</html>
