# 用户注册、数据库

标签（空格分隔）： 注册

---

##register.php

该文件包含以下内容

 1. 引入pdoClass.php和fileUploadClass.php文件

 2. 注册页面

 3. 对密码进行加密，采用MD5()加密算法。

 4. 将用户注册的数据写入数据库

 5. 对上传照片进行处理


##pdoClass.php、fileUploadClass.php

该文件分别封装了pdo类和文件上传类，是为了方便实现注册功能而引入的文件。


------

##images文件夹

该文件夹存储了在注册时上传的照片


------

##sql.sql

该文件是为了建立存储用户信息表而写的sql语句


用户信息表的结构如下

| Field    | Type              | Null | Key | Default | Extra          |
| --------   | :-----  | :----:  |:----:|:----:|:-----|
| id       | int(10) unsigned  | NO   | PRI | NULL    | auto_increment |
| name     | char(20)          | NO   |     | NULL    |                |
| password | char(180)         | NO   |     | NULL    |                |
| sex      | enum('男','女')   | NO   |     | 男      |                |
| hobbies  | char(50)          | NO   |     |         |                |
| addr     | char(20)          | NO   |     |         |                |
| photo    | char(80)          | NO   |     |         |                |
| intro    | text              | NO   |     | NULL    |                |



