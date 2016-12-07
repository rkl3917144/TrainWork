<?php

//下面是测试文件。当要测试其中的一道题目时，请把别的题目注释掉


include 'formFileUpload.php';

//第三题
$travdir = new traversalDir();      //创建类
$dirName = "test";

//测试打印目录内的文件的方法printDirFile()
$travdir->printDirFile($dirName);

//测试统计目录大小的方法getDirSize()
$size = $travdir->getDirSize($dirName);
echo $dirName."文件夹内的容量大小为".$size."<br/>";

//测试统计目录内文件数目的方法countDir()
$num = $travdir->countDir($dirName);
echo $dirName."文件夹里共有".$num."个文件。<br/>";

//测试删除目录方法delDir()，用时请把注释去掉，注意备份删除的文件夹，方便下次测试使用
//$travdir->delDir($dirName);







/*

//第四题
$delD = new delDir();
$dirName = 'test';      //创建目录资源
$delD->remove($dirName);

*/








/*
//第五题
$fileName = 'F:/Demo/peixun/fileTest/baidu.php';

//调用方法测试
$get = new getExten();
echo $get->getExtenFunction1($fileName).'<br/>';
echo $get->getExtenFunction2($fileName).'<br/>';
echo $get->getExtenFunction3($fileName).'<br/>';
echo $get->getExtenFunction4($fileName).'<br/>';
*/

?>