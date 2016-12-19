<?php
/*
* @Author: RKLiang
* @Date:   2016-12-07 16:54:17
* @Last Modified by:   RKLiang
* @Last Modified time: 2016-12-07 18:03:43
*/


//获取上传文件的文件名
$fileName = $_FILES['file']['name'];

//得到扩展名
$arr = explode('.', $fileName);
$kz = $arr[count($arr) - 1];
//print_r(explode(".", $fileName));

//文件要拷贝到的目录
$toPath = './upload/';

//获取缓存目录内的上传的文件路径
$fileSrc = $_FILES['file']['tmp_name'];
//产生随机名
$randName = date('YmdHis').'.'.$extension;

//从缓冲区重命名和拷贝上传的文件
if (is_uploaded_file($fileSrc)) {        //判断上传的文件是否存在
    if (move_uploaded_file($fileSrc, $toPath.$randName)) {
        echo $fileName.'文件上传成功';
    } else {
        echo '文件上传失败';
    }
} else {
    echo '文件不存在';
}
