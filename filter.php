<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/11/30/0030
 * Time: 21:08.
 */

//该类为过滤器类
class filter
{
    //mixed  filter_var  ( mixed  $variable  [, int $filter  = FILTER_DEFAULT  [, mixed  $options  ]] )
    //IP地址验证
    public function ipFilter($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            echo 'IP合法'.'<br/>';
        } else {
            echo 'IP非法'.'<br/>';
        }
    }

    //Email邮箱验证
    public function emailFilter($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'E-mail合法'.'<br/>';
        } else {
            echo 'E-mail非法'.'<br/>';
        }
    }

    //URL网址验证
    public function urlFilter($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            echo 'URL合法'.'<br/>';
        } else {
            echo 'URL非法'.'<br/>';
        }
    }
}
