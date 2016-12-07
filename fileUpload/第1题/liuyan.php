<?php
/* 
* @Author: RKLiang
* @Date:   2016-12-06 16:56:15
* @Last Modified by:   RKLiang
* @Last Modified time: 2016-12-06 17:02:07
*/

echo "<pre>";
print_r($_GET);
echo "</pre>";

echo "正在提交..."."<br/>";
$file =  fopen("./liuyan.txt","a");
fwrite($file,"昵称:"."\t".$_GET["user"]."\r\n");			//写昵称
fwrite($file,"内容:"."\t".$_GET["ly"]."\r\n");			//写留言内容
fwrite($file,"\r\n");
fclose($file);			//关闭资源
echo "提交成功!";
?>
