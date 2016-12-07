<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/11/30/0030
 * Time: 21:09.
 */

//该文件用于测试filter.php文件。

include 'filter.php';

$filter = new filter();
$ip = '172.16.50.25';
$email = 'rkliang@qq.com';
$url = 'http://www.yaochufa.com';

$filter->ipFilter($ip);
$filter->emailFilter($email);
$filter->urlFilter($url);
