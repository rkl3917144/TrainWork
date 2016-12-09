<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/8/0008
 * Time: 21:47.
 */

//随意写的水果商城页面
if (isset($_COOKIE['username'])) {        //检查用户cookie是否存在
    //用户成功登陆
    $username = $_COOKIE['username'];
    echo $username.'您好'.'<br/>';
	echo "<a href='logout.php' target='_blank'>退出</a>".'<br/>';
} else {
    //未登陆
    echo '用户未登录<br/>';
    echo "<a href='login.html' target='_blank'>登陆</a>"."<br/>";
}

echo "<font color='red' size='12'>".'欢迎来到水果商城'.'</font>'.'<br/>';
echo "<a href='index.php'>首页</a>".'<br/>';
echo "<a href='iphoneShop.php'>手机商城</a>".'<br/>';

