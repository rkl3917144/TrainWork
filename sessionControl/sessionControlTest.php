<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/8/0008
 * Time: 15:04.
 */

//cookie.php的测试文件
include 'sessionControl.php';


//下面测试cookie类，如果不需要测试，请将注释加上

$name = 'user';
$value = 'RKLiang';
$time = time() + 60*60*24;        //将cookie信息保留有一天

$cook = new cookieClass();
//$cook->addCookie($name, $value, $time);
echo "<pre>";
//print_r($cook->getCookie());
echo "</pre>";

$cook->cleanCookie($name);




/*	下面是测试session类，如需要测试，请删除注释。另外开机和清除如果需要同时测试，请将cleanSession()方法内的开启session语句注释掉
$session = new sessionClass();
//开启session

$session->startSession();
$sessionID = session_id();
echo $sessionID();


//清除session
$session->cleanSession();
*/
