<?php

/*
第一题
将1112223334445转换成5,444,333,222,111每3位用逗号隔开
*/
$str = "1112223334445";
$str = number_format(strrev($str));
echo $str."<br/>";
echo "<br/>";



/*
第二题
假设现在有一个字符串www.yaochufa.com 如何用php对它进行操作使字符串以moc.afuhcoay.输出
*/
$str = "www.yaochufa.com";
$str = strrev((ltrim($str,"w")));
echo $str."<br/>";
echo "<br/>";



/*
第三题
请写一个函数，实现以下功能 字符串“my_leader”转换成“MyLeader”、字符串“make_by_name”转换成“MakeByName”
 */
function strTransForm($str){
    $str = str_replace('_', ' ', $str);     //将字符串中的下划线替换为空格
    $str = ucwords($str);                   //使字符串的单词首字母大写
    $str = str_replace(' ','',$str);                      //删除字符串内的空白字符
    return $str;
}
$str = "make_by_name";
echo strTransForm($str)."<br/>";
echo "<br/>";



/*
第四题
$mail=liming@yaochufa.com;请将此邮箱的域（yaochufa.com）取出来，看最多能有几种方法
*/
$mail = "liming@yaochufa.com";

//方法一
$str1 = ltrim(strstr($mail, "@"),"@");
echo $str1."<br/>";

//方法二
$str2 =ltrim(substr($mail, stripos($mail, "@")),"@");
echo $str2."<br/>";
echo "<br/>";



/*
第五题
翻转字符串中的单词，字符串仅包含大小写字母和空格，单词间使用空格分割。如输入“There is hainan”,输出“hainan is There”（不要使用php自带函数，主要是考核字符串和数组的灵活使用）
*/
$str = "There is hainan";
$var = explode(" ", $str);
for($i = 0;$i< count($var)/2;$i++){
    $arr = $var[$i];
    $var[$i] = $var[count($var)-$i-1];
    $var[count($var)-$i-1] = $arr;
}
$str = implode(" ", $var);      //将数组转化为字符串
echo $str."<br/>";
echo "<br/>";



/*
第六题
封装一个截取字符串类，例如新闻标题过长只需截取20个汉字，多余的用...省略
*/
class sliceString{
    function slice($str){
        if(strlen($str)>20){        //判断字符串长度是否在20个之内
            $str = substr($str, 0, 20);
            return $str."...";
        }else{
            return $str;
        }
    }
}
$sliceClass = new sliceString();
$str1 = "PHP is one of the best language in the world";
$str2 = "Hello World！";
echo $sliceClass->slice($str1)."<br/>";
echo $sliceClass->slice($str2)."<br/>";
echo "<br/>";
?>
