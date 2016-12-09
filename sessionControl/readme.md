#会话控制#
------
***sessionControl.php***
该php文件封装了下面的类

*cookieClass*有下面三个方法
> `addCookie()`设置cookie

> `getcookie()`得到cookie信息

> `cleacookie()`清除cookie信息

*sessionClass*有下面三个方法
> `startSession()`开启session

> `getSession()`得到session信息

> `cleaSession()`清除session信息

------
***sessionControlTest.php***
该文件是`sessionControl.php`的测试文件

------
***loginAndLogout文件夹***

该文件夹包含了下面这些文件
> **login.html**        登陆页面
> **login.php**         登陆跳转页面
> **logout.php**        退出跳转页面
> **iphoneShop.php**    为了测试写的手机商城页面
> **fruitShop.php**     为了测试写的水果商城页面
> **index.php**         首页
> **user.txt**          存储了用户的账号和密码信息

------
整个**登陆退出流程**如下
<pre>
首先用户在login.html表单上填写用户登陆的信息
之后点击提交按钮，浏览器将用户信息提交到login.php页面
        在login.php脚本里，会根据user.txt的内容检查账号密码是否正确
                如果登陆正确，会设置cookie信息，
                不正确则提示用户,
                无论正确与否都户跳转到index.php。
在index.php/fruitShop.php/iphoneShop.php页面内都会首先检测用户的cookie信息
        发现cookie，会读取用户的账户名并显示在页面，
        未发现cookie，就将使用游客登陆。
当用户点击退出按钮时，跳转到logout.php页面。
        在logout.php页面，首先检测是否满足退出要求；
                如果满足，就清除cookie页面并退出，
                如果不满足就提示用户。
</pre>
通过上述流程跟踪用户信息，实现会话控制。