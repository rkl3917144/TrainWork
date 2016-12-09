<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/8/0008
 * Time: 21:11.
 */

//退出页面
if (isset($_COOKIE['username'])) {
    //获得cookie信息
    $name = 'username';
    $value = 'logout';
    $time = time();
    setcookie($name, $value, $time);			//清除cookie信息
    echo '成功退出'.'<br/>';
    echo '正在跳转至首页。。。'.'<br/>';
    echo "<a href='index.php' target='_blank'>未成功跳转，请点击这里</a>";
    echo "<meta http-equiv='refresh' content=2;URL='index.php'>";        //2秒后自动跳转到首页
} else {
    echo '未成功退出'."<br/>";
    echo '正在跳转至首页。。。'.'<br/>';
    echo "<a href='index.php' target='_blank'>未成功跳转，请点击这里</a>";
    echo "<meta http-equiv='refresh' content=2;URL='index.php'>";        //2秒后自动跳转到首页
}
