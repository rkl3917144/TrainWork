<?php
/* 
* @Author: anchen
* @Date:   2016-11-29 09:18:05
* @Last Modified by:   anchen
* @Last Modified time: 2016-11-29 10:29:27
*/


//该php类为过过滤器类
class Filter{
    //mixed  filter_var  ( mixed  $variable  [, int $filter  = FILTER_DEFAULT  [, mixed  $options  ]] )
    //IP地址验证
    public function ipFilter($ip){
        if(filter_var($ip, FILTER_VALIDATE_IP)){
            echo "IP合法"."<br/>";
        }else{
            echo "IP非法"."<br/>";
        }  
    }

    //Email邮箱验证
    public function emailFilter($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "E-mail合法"."<br/>";
        }else{
            echo "E-mail非法"."<br/>";
        }
    }

    //URL网址验证
    public function urlFilter($url){
        if(filter_var($url, FILTER_VALIDATE_URL)){
            echo "URL合法"."<br/>";
        }else{
            echo "URL非法"."<br/>";
        }
    }
}

$filter = new Filter();
$ip = "172.16.50.25";
$email = "rkliang@qq.com";
$url = "http://www.yaochufa.com";

$filter->ipFilter($ip);
$filter->emailFilter($email);
$filter->urlFilter($url);

?>
