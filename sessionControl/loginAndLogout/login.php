<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/8/0008
 * Time: 16:09.
 */

//首页

/*
 * 验证登陆信息是否正确
*/
$userResource = fopen('./user.txt', 'r');                        //user.txt存储了所有用户的账号
while ($userMessage = fgets($userResource)) {
    $user = $_GET['use'].'---||---'.$_GET['pass'];            //连接字符串使得成为标准格式
    $userMessage = trim($userMessage);                            //删除两边空格
    if ($user == $userMessage) {
        //登陆成功，设置cookie信息
        $name = 'username';
        $value = $_GET['use'];        //登录名
        $time = time() + 60 * 60 * 24 * 7;        //保留一周
        setcookie($name, $value, $time);
        header('location:index.php');        //登陆成功跳转至首页
        break;
    } elseif ($userMessage == '!END') {
        echo '用户名或密码错误，登录失败！<br/>';
        echo '正在跳转到登陆页面。。。<br/>';
        echo "<a href='login.html' target='_blank'>未成功跳转，请点击这里</a>";
        //header("location:login.html");
        echo "<meta http-equiv='refresh' content=3;URL='login.html'>";        //3秒后自动跳转到登陆页面
        break;
    }
}
fclose($userResource);
