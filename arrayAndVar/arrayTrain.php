<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/1/0001
 * Time: 14:14.
 */
//这是自己写的方法，太麻烦，原因是没有对数组函数进行活学活用，
function arrayTrainOne($arrSrc)
{
    $fidValues = array_column($arrSrc, 'fid', 'tid');        //$fidValues包含了：在$arrSrc中fid键对应的所有值。
    $fidValuesUnique = array_unique($fidValues);            //$fidValuesUnique包含了：$fidValues中去掉所有重复值，剩余的部分

    $arrTo = [];                    //$arrTo是要转化的数组
    foreach ($fidValuesUnique as $vUniqueKey) {            //$vUniqueKey为不重复键的值
        $arrTo[] = array_keys($fidValues, $vUniqueKey);
    }

    foreach ($arrSrc as $key => $v1) {
        unset($arrSrc[$key]['fid']);
    }//处理$arrSrc过程

    foreach ($arrTo as $k1 => $v1) {
        static $i = 0;
        if (is_array($arrTo[$k1])) {
            foreach ($arrTo[$k1] as $k2 => $v2) {
                $arrTo[$k1][$k2] = $arrSrc[$i++];
            }
        } else {
            $arrTo[$k1] = $arrSrc[$i++];
        }
    }

    return $arrTo;
}

//这是第二种方法，借鉴的算法思想
function arrayTrainTwo($arrSrc)
{
	$arr = $arrSrc;

	foreach ($arrSrc as $key => $v1) {
		unset($arrSrc[$key]['fid']);
	}//处理$arrSrc过程,将数组$arrSrc内的fid键值对删除

	foreach($arr as $k=>$v){
		static $i = 0;
		$arrTo[$v['fid']][] = $arrSrc[$i++];
	}//遍历数组，将处理过的$arrSrc赋值给$arrTo


	return array_values($arrTo);		//重置键名
}

$arrSrc = [
    0 => ['fid' => 1, 'tid' => 1, 'name' => 'xiaoming'],
    1 => ['fid' => 1, 'tid' => 2, 'name' => 'zhangsan'],
    2 => ['fid' => 1, 'tid' => 5, 'name' => 'lisi'],
    3 => ['fid' => 1, 'tid' => 7, 'name' => 'wangwu'],
    4 => ['fid' => 3, 'tid' => 9, 'name' => 'zhaoliu'],
];

$arrTo = arrayTrainOne($arrSrc);
echo '<pre>';
print_r($arrTo);

$arrTo = arrayTrainTwo($arrSrc);
print_r($arrTo);
