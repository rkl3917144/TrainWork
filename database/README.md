# MySQL


标签： 作业

---


##<font color="red">第一题</font>

要求：为公司建立内部通讯录，记录每个员工的姓名、所在部门、职位、家庭地址、电话号码和电子信箱
（提示三个表，员工表，部门表，职位表） 


**<font color="green">员工表(employee)SQL语句:</font>**
 
    
```sql
CREATE TABLE employee (
    employId int(10) unsigned NOT NULL AUTO_INCREMENT,
    departId int(10) unsigned NOT NULL,
    name char(20) NOT NULL DEFAULT 'null',
    addr varchar(200) NOT NULL DEFAULT 'null',
    tel char(20) NOT NULL DEFAULT 'null',
    eamil char(30) NOT NULL DEFAULT 'null',
    PRIMARY KEY (employId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
```
      
`员工表(employee)`<font color="red">**结构**</font>如图

| Field    | Type             | Null | Key | Default | Extra          |
| :----    | :----            | :---:| :--:| :----:  | ----           |
| employId | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| departId | int(10) unsigned | NO   |     | NULL    |                |
| name     | char(20)         | NO   |     | null    |                |
| addr     | varchar(200)     | NO   |     | null    |                |
| tel      | char(20)         | NO   |     | null    |                |
| eamil    | char(30)         | NO   |     | null    |                |


**<font color="green">部门表(post)SQL语句:</font>**

```sql
CREATE TABLE post (
    postId int(10) unsigned NOT NULL AUTO_INCREMENT,
    manageId int(10) unsigned NOT NULL DEFAULT '0',
    name char(20) NOT NULL DEFAULT 'null',
    PRIMARY KEY (postId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
```
    
`部门表(post)`<font color="red">**结构**</font>如图


| Field    | Type             | Null | Key | Default | Extra          |
| :----    | :----            | :---:| :--:| :----:  | ----           |
| postId   | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| manageId | int(10) unsigned | NO   |     | 0       |                |
| name     | char(20)         | NO   |     | null    |                |


**<font color="green">职位表(department)SQL语句:</font>**

```sql
CREATE TABLE department (
    departId int(10) unsigned NOT NULL AUTO_INCREMENT,
    postId int(10) unsigned NOT NULL DEFAULT '0',
    name char(20) NOT NULL DEFAULT 'null',
    PRIMARY KEY (departId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
```

`职位表(department)`<font color="red">**结构**</font>如图

| Field    | Type             | Null | Key | Default | Extra          |
| :----    | :----            | :---:| :--:| :----:  | ----           |
| departId | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| postId   | int(10) unsigned | NO   |     | 0       |                |
| name     | char(20)         | NO   |     | null    |                |



------

##<font color="red">第二题</font>

要求：练习sql查询

<font color="red">**1)**</font>创建一张学生表，包含以下信息，学号，姓名，年龄，性别，家庭住址，联系电话

**<font color= "green">学生表(student)SQL语句:</font>**

```sql
CREATE TABLE if not exists student(
    stuNum INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    name CHAR(10) NOT NULL DEFAULT "null",
    age INT(10) UNSIGNED NOT NUL DEFAULT 0,
    sex ENUM("man","woman") NOT NULL DEFAULT "man",
    addr CHAR(30) NOT NULL DEFAULT "null",
    tel CHAR(15) NOT NULL DEFAULT "null",
    PRIMARY KEY(stuNum)
);
``` 
    
<font color="red">**2)**</font>修改学生表的结构，添加一列信息，学历 

```sql
ALTER TABLE student ADD education CHAR(20) NOT NULL DEFAULT "null";
```

<font color="red">**3)**</font>修改学生表的结构，删除一列信息，家庭住址

```sql
ALTER TABLE student DROP addr;
```

<font color="red">**4)**</font>向学生表添加如下信息：

| 学号  | 姓名   |  年龄  |性别|联系电话|学历|
| :----:|:----:| :----:  | :----:|:----:| :----:  |
| 1     | A |   22   |男|123456|小学|
| 2     | B |   21   |男|119|中学|
| 3     | C |   23   |男|110|高中|
| 4     | D |   18   |女|114|大学|


```sql
INSERT INTO student(name,age,sex,tel,education) VALUES("A",22,"男","123456" ,"小学"),
    ("B",21,"男","119" ,"中学"),
    ("B",21,"男","119" ,"中学"),
    ("B",21,"男","119" ,"中学");
```

<font color="red">**5)**</font>修改学生表的数据，将电话号码以11开头的学员的学历改为“大专” 

```sql
UPDATE student SET education="大专" WHERE tel LIKE "11%";
```    

<font color="red">**6)**</font>删除学生表的数据，姓名以C开头，性别为‘男’的记录删除

```sql
DELETE FROM student WHERE name like "C%" AND sex="男";
```    
    
<font color="red">**7)**</font>查询学生表的数据，将所有年龄小于22岁的，学历为“大专”的，学生的姓名和学号示出来

```sql
SELECT name 姓名,stuNum 学号 FROM student WHERE age<22 AND education="大专" ;
```    
    
<font color="red">**8)**</font>查询学生表的数据，查询所有信息，列出前25%的记录 



```sql
PREPARE selSql FROM "SELECT * FROM student LIMIT ?";
SET @a = ceil((SELECT COUNT(*) FROM student)*0.25);
EXECUTE selSQL USING @a;
```

<font color="red">**9)**</font>查询出所有学生的姓名，性别，年龄降序排列

```sql
SELECT name 姓名,sex 性别,age 年龄 FROM student ORDER BY age DESC;
```    

<font color="red">**10)**</font>按照性别分组查询所有的平均年龄

```sql
SELECT sex 性别,AVG(age) 平均年龄 from student GROUP BY sex;
```

----

##<font color="red">第三题</font>

为管理岗位业务培训信息，建立3个表:

`user`(userNo,userName,currentUnit,age) userNo,userName,currentUnit,age
分别代表学号、学员姓名、所属单位、学员年龄
`course`(courseNo,courseName)courseNo,courseName 分别代表课程编号、课程名称
`point`(userNo,courseNo,grade ) userNo,courseNo,grade分别代表学号、所选修的课程编号、学习成绩

**<font color= "green">user表SQL语句:</font>**

```sql
CREATE TABLE user(
    userNo INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userName CHAR(20) NOT NULL DEFAULT "",
    currentUnit CHAR(30) NOT NULL DEFAULT "",
    age INT UNSIGNED NOT NULL DEFAULT 0
);
```    
    
 **<font color= "green">course表SQL语句:</font>**   

```sql
CREATE TABLE course(
    courseNo CHAR(20) NOT NULL PRIMARY KEY,
    courseName CHAR(30) NOT NULL DEFAULT ""
);
```

 **<font color= "green">point表SQL语句:</font>**
 
```sql
CREATE TABLE point (
    userNo INT UNSIGNED NOT NULL ,
    courseNo CHAR(20) NOT NULL,
    grade DOUBLE(5,2) NOT NULL DEFAULT 0.00,
    PRIMARY KEY(userNo,courseNo)
);
```

<font color="red">**1)**</font>使用标准SQL嵌套语句查询选修课程名称为’税收基础’的学员学号和姓名

```sql
 select userNo ,userName from user where userNo in(
    select userNo from point where courseNo in(
        select courseNo from course where courseName='税收基础'));
```

<font color="red">**2)**</font>使用标准SQL嵌套语句查询选修课程编号为’C2’的学员姓名和所属单位

```sql
select userName,currentUnit from user where userNo in(
    select userNo from point where courseNo ='C2');
```

<font color="red">**3)**</font>使用标准SQL嵌套语句查询不选修课程编号为’C5’的学员姓名和所属单位

```sql
select userNo,currentUnit from user where userNo not in(
        select userNo from point where courseNo='C5');
```

<font color="red">**4)**</font>使用标准SQL嵌套语句查询选修全部课程的学员姓名和所属单位

```sql
SELECT userName,currentUnit FROM user WHERE userNo IN (
    SELECT userNo FROM point GROUP BY userNo HAVING COUNT(*) = (
        SELECT COUNT(*) FROM course));
```

<font color="red">**5)**</font> 查询选修了课程的学员人数

```sql
select count(*) 人数 from(
    select distinct userNo from point) p;
```  

<font color="red">**6)**</font>) 查询选修课程超过3门的学员学号和所属单位

```sql
SELECT userName,currentUnit FROM user WHERE userNo IN(
    SELECT userNo FROM point GROUP BY userNo HAVING COUNT(*)>3);
```

---

##<font color="red">第四题</font>


写一个四表联查示例


有四个表A,B,C,D;表结构分别如下：

    product(productId,productName,price);             //产品ID，产品名称，产品价格
    company(companyId,postId,companyName,manage);     //公司ID，部门ID，公司名称，公司管理人
    user   (userId,productId,userName,userAge);       //用户ID，产品ID，用户名称，用户年龄
    post   (postId,productId,postName);               //部门ID，产品ID，部门名称


`问题:`现在要查询使用了某种产品的用户姓名，以及生产了该产品的部门名称和对应的公司名称。


```sql
select userName 用户名称,productName 产品名称,postName 部门名称,companyName 公司名称 
    from 
        user,product,post,company 
    where 
        user.productId=product.productId and product.productId=post.productId and company.postId=post.postId;
```

---

##<font color="red">第五题</font>

封装一个mysql类，封装一个mysqli类 ，封装一个pdo 类 

<font color="red">**见`mysqlClass.php`、`mysqliClass.php`、`PDOClass.php`三个文件**</font>

