<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/8/0008
 * Time: 21:11.
 */

//退出页面
if (isset($_COOKIE['username'])) {

    //设置cookie信息
    $name = 'username';
    $value = 'logout';
    $time = time();
    setcookie($name, $value, $time);			//清除用户名信息


    $name = 'isLogin';
    $value = 0;
    $time = time();
    setcookie($name, $value, $time);			//清除是否登录信息

    header('location:login.php');

} else {
    echo '未成功退出'."<br/>";
    echo '正在跳转至首页。。。'.'<br/>';
    echo "<a href='login.php' target='_blank'>未成功跳转，请点击这里</a>";
    echo "<meta http-equiv='refresh' content=2;URL='login.php'>";        //2秒后自动跳转到首页
}
