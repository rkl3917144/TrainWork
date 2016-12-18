<?php

//print_r($_POST);
    if (isset($_POST['username']) && $_POST['username'] != '' && $_POST['password'] != '' && $_POST['sex'] != '') {

        include_once './pdoClass.php';
        include_once './fileUploadClass.php';

        //连接数据库
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbname = 'rkliang';

        $link = new pdoClass($host, $user, $pass, $dbname);        //创建一个PDO对象

        $file = $_FILES;
        $toPath = './images/';
        $fileUpload = new fileUpload($file, 'photo', $toPath);        //创建一个文件上传类
        $filename = $fileUpload->copyFile();                            //调用拷贝方法

        $fileSrc = $toPath."$filename";        //上传后的文件相对路径

        $sql = 'INSERT INTO user(name,password,sex,hobbies,addr,photo,intro) VALUES (:username,:password,:sex,:hobbies,:addr,:photo,:intro)';

        $link->prepare($sql);

        //获取$_POST和$_FILES两个超全局变量的内部值
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sex = $_POST['sex'];
        $hobbies = implode(',', $_POST['hobbies']);
        $addr = $_POST['addr'];
        $photo = $fileSrc;
        $intro = $_POST['intro'];

        $link->execute(array(':username' => $username, ':password' => $password, ':sex' => $sex, ':hobbies' => $hobbies, ':addr' => $addr, ':photo' => $photo, ':intro' => $intro));        //执行sql语句
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>注册页面</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="#" target="_self" title="注册界面" method="post" enctype="multipart/form-data">
            <table border="1" align="center">
                <title>表单</title>
                    <tr>
                        <th colspan="2">用户注册</th>
                    </tr>
                    <tr>
                        <th>用户名</th>
                        <td><input type="text" name="username"></td>
                    </tr>

                    <tr>
                        <th>密码</th>
                        <td><input type="password" name="password"></td>
                    </tr>

                    <tr>
                        <th>确认密码</th>
                        <td><input type="password" name="password"></td>
                    </tr>

                    <tr>
                        <th>性别</th>
                        <td>
                            <input type="radio" name="sex" value="男" checked>男
                            <input type="radio" name="sex" value="女">女
                        </td>
                    </tr>

                    <tr>
                        <th>爱好</th>
                        <td>
                            <input type="checkbox" name="hobbies[]" value="看电影">看电影
                            <input type="checkbox" name="hobbies[]" value="敲代码" checked>敲代码
                            <input type="checkbox" name="hobbies[]" value="篮球">篮球
                            <input type="checkbox" name="hobbies[]" value="足球">足球
                        </td>
                    </tr>

                    <tr>
                        <th>你所在的城市</th>
                        <td>
                            <select name="addr">
                                <option value="广州市">广州市</option>
                                <option value="北京市">北京市</option>
                                <option value="上海市">上海市</option>
                                <option value="海口市">海口市</option>
                                <option value="深圳市">深圳市</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>照片</th>
                        <td>
                            <input type="file" name="photo">
                        </td>
                    </tr>

                    <tr>
                        <th>个人简介</th>
                        <td>
                            <textarea name="intro" cols="40" rows="10"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="注册">
                            <input type="reset">
                        </td>
                    </tr>

            </table>
        </form>
    </body>
</html>