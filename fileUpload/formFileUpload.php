<?php
/*
* @Author: RKLiang
* @Date:   2016-12-07 10:35:27
* @Last Modified by:   anchen
* @Last Modified time: 2016-12-07 11:31:00
*/

/*
 *
 * 第三题：作业要求：写一个遍历文件夹的类
 * 此类用于遍历文件夹，里面包括了删除目录，统计目录内文件的数目，统计目录的大小,打印目录内的文件名四个方法
 *
 */
class traversalDir
{
    //打印目录内的文件
    public function printDirFile($dirName)
    {
        if (file_exists($dirName)) {
            static $k = '';                          //$k控制输出样式
            $resourceDir = opendir($dirName);       //打开目录资源
            while ($dir = readdir($resourceDir)) {
                if ($dir != '.' && $dir != '..') {
                    $fileName = $dirName.'/'.$dir;
                    if (is_dir($fileName)) {
                        echo "<font color='red'>".$k.$dir.'</font>'.'<br/>';       //为了区分目录和文件，特此把目录名输出为红色,
                        $k = $k.'---';
                        $this->printDirFile($fileName);
                        $k = substr($k, 0, strlen($k) - 3);
                    } else {
                        echo $k.$dir.'<br/>';                                      //输出文件名
                    }
                }
            }
            closedir($resourceDir);
        }
    }

    //统计目录大小
    public function getDirSize($dirName)
    {
        static $size = 0;                               //存储目录总容量
        if (file_exists($dirName)) {                      //判断目录是否存在
            $resourceDir = opendir($dirName);           //打开目录资源
            while ($dir = readdir($resourceDir)) {
                if ($dir != '.' && $dir != '..') {            //同样的要去除这两种情况
                    $fileName = $dirName.'/'.$dir;      //连接
                    if (is_dir($fileName)) {
                        $this->getDirSize($fileName);
                    } else {
                        $size += filesize($fileName);
                    }
                }
            }
            closedir($resourceDir);

            return $this->transformDW($size);
        }
    }

    //统计目录内文件数目
    public function countDir($dirName)
    {
        static $count = 0;     //统计文件数目
        if (file_exists($dirName)) {         //判断目录是否存在，防止报错
            $resourceDir = opendir($dirName);
            //下面是遍历主要方法
            while ($dir = readdir($resourceDir)) {
                if ($dir != '.' && $dir != '..') {         //去除这两种情况，防止向上遍历
                    $fileName = $dirName.'/'.$dir;      //连接目录和文件名，使之能够遍历
                    if (is_dir($fileName)) {
                        $this->countDir($fileName);
                    } else {
                        ++$count;
                    }
                }
            }
            closedir($resourceDir);

            return $count;
        }
    }

    //删除目录
    public function delDir($dirName)
    {
        if (file_exists($dirName)) {
            $resourceDir = opendir($dirName);           //打开目录资源类型
          while ($dir = readdir($resourceDir)) {
              if ($dir != '.' && $dir != '..') {          //除去目录为.和..的情况,因为如果不去掉的话，遍历时会往上遍历，这很危险
                  $file = $dirName.'/'.$dir;
                  //将目录和文件连接，使得成为一个路径，如果不连接，传参时会被当作相对路径，而对于本脚本是不存在这个参数的相对路径的
                  if (is_dir($file)) {
                      $this->delDir($file);
                      //rmdir($dirName);
                      /*
                       如果只在这里写删除目录的语句，而下面不写，
                       那么我们最初传入的根目录是不会删除的，
                       因为此while语句遍历时，是只往下层读取的，开始传入的根目录就不会被删除。
                      */
                  } else {
                      //进入该判断说明此资源时一个文件
                      unlink($file);
                  }
              }
          }
            closedir($resourceDir);
            rmdir($dirName);        //执行完上面的步骤，已经完全删除了目录中的文件，此时可以把空目录删除
        }
    }

    //容量大小单位转换函数
    public function transformDW($size)
    {
        if ($size > pow(2, 30)) {       //转化为GB
            $size = round($size / pow(2, 30), 2);      //保留两位有效数字
            $dw = 'GB';
        } elseif ($size > pow(2, 20)) {       //转化为GB
            $size = round($size / pow(2, 20), 2);
            $dw = 'MB';
        } elseif ($size > pow(2, 10)) {       //转化为GB
            $size = round($size / pow(2, 10), 2);
            $dw = 'KB';
        } else {
            $dw = 'Bytes';
        }

        return $size.$dw;
    }
}

/*
 *
 * 第四题
 * 写一个类，传入一个文件夹路径，该函数可以把这个文件夹及文件夹下面的所有文件及文件夹删除
 *
 */
class delDir
{
    public function remove($dirName)
    {
        if (file_exists($dirName)) {
            $resourceDir = opendir($dirName);           //打开目录资源类型
            while ($dir = readdir($resourceDir)) {
                if ($dir != '.' && $dir != '..') {          //除去目录为.和..的情况,因为如果不去掉的话，遍历时会往上遍历，这很危险
                    $file = $dirName.'/'.$dir;
                    //将目录和文件连接，使得成为一个路径，如果不连接，传参时会被当作相对路径，而对于本脚本是不存在这个参数的相对路径的
                    if (is_dir($file)) {
                        $this->remove($file);
                        //rmdir($dirName);
                        /*
                         如果只在这里写删除目录的语句，而下面不写，
                         那么我们最初传入的根目录是不会删除的，
                         因为此while语句遍历时，是只往下层读取的，开始传入的根目录就不会被删除。
                        */
                    } else {
                        //进入该判断说明此资源时一个文件
                        unlink($file);
                    }
                }
            }
            closedir($resourceDir);
            rmdir($dirName);        //执行完上面的步骤，已经完全删除了目录中的文件，此时可以把空目录删除
        }
    }
}

/*
 *
 * 第五题
 * 写3个以上不同的函数，来获取一个全路径的文件的扩展名，允许封装php库值中已有的函数
 *
 */
class getExten
{
    //方法一
    public function getExtenFunction1($fileName)
    {
        return pathinfo($fileName, PATHINFO_EXTENSION);        //通过pathinfo()信息获得扩展名
    }

    //方法二
    public function getExtenFunction2($fileName)
    {
        $file = basename($fileName);                       //获取文件名
        strtok($file, '.');                                //使用分隔函数分割字符串
        return strtok('.');                                //再次分割即可得到扩展名
    }

    //方法三
    public function getExtenFunction3($fileName)
    {
        $ExtenName = strrchr($fileName, '.');               //截取字符串后面的扩展名
        return ltrim($ExtenName, '.');                      //去除字符串左侧的"."
    }

    //方法四
    public function getExtenFunction4($fileName)
    {
        return pathinfo($fileName)['extension'];            //使用pathinfo()函数的另一种形式，之后在访问数组
    }
}
