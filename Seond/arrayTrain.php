<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/12/1/0001
 * Time: 14:14.
 */
//这是自己写的方法，太麻烦，原因是没有对数组函数进行活学活用，
function arrayTrainOne($arrOne)
{
    $fid_values = array_column($arrOne, 'fid', 'tid');        //$fid_values包含了：在$arrOne中fid键对应的所有值。
    $fid_values_unique = array_unique($fid_values);            //$fid_values_unique包含了：$fid_values中去掉所有重复值，剩余的部分

    $arrTwo = [];                    //$arrTwo是要转化的数组
    foreach ($fid_values_unique as $vUniqueKey) {            //$vUniqueKey为不重复键的值
        $arrTwo[] = array_keys($fid_values, $vUniqueKey);
    }

    foreach ($arrOne as $kOne => $v1) {
        unset($arrOne[$kOne]['fid']);
    }//处理$arrOne过程

    foreach ($arrTwo as $k1 => $v1) {
        static $i = 0;
        if (is_array($arrTwo[$k1])) {
            foreach ($arrTwo[$k1] as $k2 => $v2) {
                $arrTwo[$k1][$k2] = $arrOne[$i++];
            }
        } else {
            $arrTwo[$k1] = $arrOne[$i++];
        }
    }

    return $arrTwo;
}

//这是第二种方法，借鉴的算法思想
function arrayTrainTwo($arrOne)
{
	$arr = $arrOne;

	foreach ($arrOne as $kOne => $v1) {
		unset($arrOne[$kOne]['fid']);
	}//处理$arrOne过程,将数组$arrOne内的fid键值对删除

	foreach($arr as $k=>$v){
		static $i = 0;
		$arrTwo[$v['fid']][] = $arrOne[$i++];
	}//遍历数组，将处理过的$arrOne赋值给$arrTwo


	return array_values($arrTwo);		//重置键名
}

$arrOne = [
    0 => ['fid' => 1, 'tid' => 1, 'name' => 'xiaoming'],
    1 => ['fid' => 1, 'tid' => 2, 'name' => 'zhangsan'],
    2 => ['fid' => 1, 'tid' => 5, 'name' => 'lisi'],
    3 => ['fid' => 1, 'tid' => 7, 'name' => 'wangwu'],
    4 => ['fid' => 3, 'tid' => 9, 'name' => 'zhaoliu'],
];

$arrTwo = arrayTrainOne($arrOne);
echo '<pre>';
print_r($arrTwo);

$arrTwo = arrayTrainTwo($arrOne);
print_r($arrTwo);
