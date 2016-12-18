<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/16/0016
 * Time: 15:23
 */


/*
 * 	第二题:
 *	$array=array("Linux RedHat9.0", "Apache2.2.9", "MySQL5.0.51", "PHP5.2.6", "LAMP", "100");
 * 	使用正则表达式找出数组中以字母开始和以数字结束，并且没有空格的单元
 */
class matchWordNum{
	
	private $patten = '/^[a-zA-Z]\S*[0-9]$/';
	
	//方法一,使用preg_grep()方法直接获得
	public function grep($array){
		$reguArr = preg_grep($this->patten,$array);
		return $reguArr;
	}
	
	//方法二,使用preg_match()方法结合foreach遍历得到
	public function match($array){
		$reguArr = [];			//存储符合正则表达式的数组单元
		foreach ($array	as $key=>$value){
			if(preg_match($this->patten,$value)){
				$reguArr[] = $value;
			}
		}
		return $reguArr;
	}
}


/*
 * 	第三题:
 *	网址http://www.yaochufa.com/index.php,
 * 	请用正则取出 URL中的协议，URL中的主机, URL中的域名,URL中的文件名
 */
class matchURL{

	//取出URL中的协议
	public function	getURLDeal($url){
		$patten = '/(.*):\/\//';
		preg_match($patten,$url,$Deal);
		return $Deal[1];
	}

	//取出URL中的主机名
	public function getURLMainFrame($url){
		$patten = '/:\/\/(.*)\//U';
		preg_match($patten,$url,$mainFrame);
		return $mainFrame[1];
	}

	//取出URL中的域名
	public function getURLDomainName($url){
		$patten = '/\.(.*)\//U';
		preg_match($patten,$url,$domainName);
		return $domainName[1];
	}

	//取出URL中的文件名
	public function getURLFileName($url){
		$patten = '/:.*/';
		preg_match($patten,$url,$noDeal);			//首先取出去除协议的部分
		$patten = '/:.*\//';
		$fileName = preg_replace($patten,'',$noDeal[0]);
		return $fileName;
	}
}


/*
 * 第四题
 * <tr>
 * 		<td>
 * 			<a href=”http://qzone.qq.com”>QQ空间</a>
 * 		</td>
 * 		<td>
 * 			<a href="http://www.ganji.com">赶 集 网</a>
 * 		</td>
 * 		<td>
 * 			<a href="http://www.baixing.com">百 姓 网</a>
 * 		</td>
 * 		<td>
 * 			<a href="http://www.taobao.com">淘 宝 网</a>
 * 		</td>
 * 		<td>
 * 			<a href="http://tuan.baidu.com">百度团购</a>
 * 		</td>
 * 		<td>
 * 			<a href="http://www.dianping.com">大众点评网</a>
 * 		</td>
 * </tr>
 *
 * 用正则取出上面字符串里的所有网址
 *
 */
class matchURLAddr{
	
	public function	getUrl($str){
		$patten = '/http:\/\/.*com/U';
		preg_match_all($patten,$str,$arr);
		return $arr;
	}
}


/*
 * 第五题
 * 这个文本中有<b>粗体</b>和<u>带有下划线</u>以及<i>斜体</i>还有<font color='red' size='7'>带有颜色和字体大小</font>的标记
 * 用正则把所有HTML标签去掉
 */
class matchHtml{
	
	public function deleteHtml($str){
		$patten = '/<.*>/U';
		$str = preg_replace($patten,'',$str);
		return $str;
	}
}
