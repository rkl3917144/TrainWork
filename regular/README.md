# 正则表达式

标签（空格分隔）： 正则

---

##regular.php

该文件包含了第二题到第五题类：

 1. matchWordNum类
 
    该类对应第二题，有两个方法：

    > `grep()`：通过调用preg_grep()方法实现匹配
    
    > `match()`:通过使用foreach遍历和调用preg_match()方法实现匹配
    
    
    
 2. matchURL类
 
    该类对应第三题，有四个方法：

    > `getURLDeal()`  方法匹配URL内的协议，使用的正则表达式为：**"/(.\*):\/\//"**
    
    > `getURLMainFrame()` 方法匹配URL内的主机名，使用的正则表达式为：**"/:\/\/(.\*)\//U"**
    
    > `getURLDomainName()`    方法匹配URL内的域名，使用的正则表达式为：**"/\.(.\*)\//U"**
    
    > `getURLFileName()`  方法匹配URL内的文件名，使用的正则表达式为：**"/:.\*/"**
    
    

 3. matchURLAddr类
 
    该类对应第四题，有一个方法：

    
    > `getUrl()`方法匹配字符串内的所有网址，通过调用preg_match_all()函数实现匹配，使用的正则表达式为：**"/http:\/\/.*com/U"**


 4. matchHtml

    该类对应第五题，有一个方法：

    
    > `deleteHtml()`方法去除字符串内的所有html标签，调用preg_replace()函数实现替换，使用的正则表达式为**"/<.*>/U"**


------

##regularTest.php


该文件是regular.phpde测试文件


------

##register文件夹


该文件夹包含了注册页面和数据库添加的页面
    

