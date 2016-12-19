# 金陵后台项目

标签（空格分隔）： 金陵

---

##引用的类

1. **cookiesClass文件夹**
 
    > 该文件夹内含有文件`cookieClass.php`，封装了cookie类

2. **fileUploadClass文件夹**

    > 该文件夹内含有文件`fileUpload.php`，封装了文件上传类
    
3. **PDOClass文件夹**
    
    > 该文件夹内含有文件`pdoClass.php`，封装了PDO类

---

##数据库

**jinling.sql**是数据库导出文件

---

##**后台admin**

###登陆###

*login.php*

> 该文件为登陆界面
    
*verifyLogin.php*
    
> 该文件是验证登陆信息是否正确的脚本，包含了向浏览器写入cookie信息，跳转到首页等功能。
    
###退出###

*logout.php*

> 该文件是退出脚本，包含了去除cookie信息，跳转页面功能。
    
###关于**产品**的脚本###

*product_edit.php*
    
> 产品添加
        
*product_list.php*
    
> 列出产品信息，以及删除功能的实现
        
*product_update.php*
    
> 产品更新
        
###关于**公告、资讯、新闻**的脚本###

*news_edit.php*
    
> 文章添加
        
*news_list.php*
    
> 列出文章信息，以及删除文章
        
*news_update.php*
    
> 文章更新
        
###关于**用户**的脚本###

*user_edit.php*
    
> 更新用户信息脚本
        
*user_list.php*
    
> 包含列出用户信息，添加用户，删除用户的功能
        
###关于**公司简介、联系我们**的脚本###

*about_us.php*
    
> 编辑公司简介的功能实现
        
contact_us.php*
    
> 编辑公司信息，内容有地址，电话，联系人等。

##**前端**

> `about_us.php` 是公司的简介
> `article.php` 是文章详细信息
> `contact_us.php`  是联系我们的内容
> `guestbook.php`   是留言本功能的实现
> `index.php`   为首页
> `info.php`    为行业资讯内容
> `product_info.php` 为某一样产品的详细信息    
> `product_list.php` 为所有产品的展示

**PS:关于友情链接，公司底部信息的展示几乎在每个页面都有。**

