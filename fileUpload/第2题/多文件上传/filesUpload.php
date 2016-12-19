<?php
/* 
* @Author: RKLiang
* @Date:   2016-12-07 17:49:40
* @Last Modified by:   RKLiang
* @Last Modified time: 2016-12-07 18:37:35
*/



//获取所有上传文件的扩展名
foreach($_FILES["files"]["name"] as $v){
    $filename = explode("." ,$v);
    $randNames[] = $filename[count($filename)-1];
}


//文件要拷贝到的目录
$toPath = "./upload/";
if(!file_exists($toPath)){
    mkdir($toPath);
}

//获取缓存目录内的上传的文件的路径
foreach($_FILES["files"]["tmp_name"] as $values){
    $filesSrc[] = $values;
}

//产生随机名
for($i = 0;$i<count($_FILES["files"]["name"]);$i++){
    $randNames[] = date('YmdHis').rand(100,999).".".$extensions[$i];
}


//将上传文件从缓冲区拷贝到文件夹内
$i= 0;
foreach($filesSrc as $v){
    if(is_uploaded_file($v)){
        if(move_uploaded_file($v, $toPath.$randNames[$i++])){
            echo $_FILES["files"]["name"][--$i]."文件上传成功"."<br/>";
            $i++;
        }else{
            echo $_FILES["files"]["name"][--$i]."文件上传失败"."<br/>";
            $i++;
        }
    }else{
        echo "文件不存在"."<br/>";
    }
}
?>
