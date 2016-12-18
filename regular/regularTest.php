<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/16/0016
 * Time: 11:02.
 */
include_once './regular.php';

/*
 * 第二题
 */
$matchWordNum = new matchWordNum();
$array = array('Linux RedHat9.0', 'Apache2.2.9', 'MySQL5.0.51', 'PHP5.2.6', 'LAMP', '100');
//测试方法一
$grepArr = $matchWordNum->grep($array);
//测试方法二
$matchArr = $matchWordNum->match($array);
echo '<pre>';
echo '第一题方法一：<br>';
print_r($grepArr);
echo '第一题方法二：<br>';
print_r($matchArr);
echo '</pre>';
echo '-------------------------------------------------------------'."<br>";

/*
 *第三题
 */
$matchURL = new matchURL();
$url = 'http://www.yaochufa.com/rkliang/index.php';
$deal = $matchURL->getURLDeal($url);
echo "第三题:<br>";
echo $deal.'<br>';
$mainFrame = $matchURL->getURLMainFrame($url);
echo $mainFrame.'<br>';
$domainName = $matchURL->getURLDomainName($url);
echo $domainName."<br>";
$fileName = $matchURL->getURLFileName($url);
print_r($fileName);
echo "<br>";
echo '-------------------------------------------------------------'."<br>";

/*
 *第四题
 */
$matchUrlAddr = new matchURLAddr();
$str = htmlspecialchars('<tr><td><a href=”http://qzone.qq.com”>QQ空间</a></td><td><a href="http://www.ganji.com">赶 集 网</a></td><td><a href="http://www.baixing.com">百 姓 网</a></td><td><a href="http://www.taobao.com">淘 宝 网</a></td><td><a href="http://tuan.baidu.com">百度团购</a></td><td><a href="http://www.dianping.com">大众点评网</a></td></tr>');
$urlArr = $matchUrlAddr->getUrl($str);
echo "第四题:<br>";
echo '<pre>';
print_r($urlArr);
echo '</pre>';
echo '-------------------------------------------------------------'."<br>";

/*
 *第五题
 */
$matchHtml = new matchHtml();
$str = '"这个文本中有<b>粗体</b>和<u>带有下划线</u>以及<i>斜体</i>还有<font color=\'red\' size=\'7\'>带有颜色和字体大小</font>的标记",用正则把所有HTML标签去掉';
$strr = $matchHtml->deleteHtml($str);
echo $strr;