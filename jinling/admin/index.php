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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>金陵贸易 后台管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link media="all" href="styles/style.css" type="text/css" rel="stylesheet">
</head>
<body scroll="no">
<table height="100%" cellspacing="0" cellpadding="0" width="100%">
    <tbody>
        <tr>
            <td colspan="2" height="69">
            	<iframe name="header" src="top.php" frameBorder="0" width="100%" scrolling="no" height="69"></iframe>
            </td>
        </tr>
        <tr>
            <td valign="top" width="160">
            <iframe name="menu" src="menu.php" frameBorder="0" width="160" scrolling="no" height="100%" target="main"></iframe>
            </td>
            <td valign="top" width="100%">
            
            <iframe style="overflow:visible" name="main" src="sys_info.php" frameBorder="0" width="100%" scrolling="yes" height="100%"></iframe>
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>