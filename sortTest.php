<?php
/**
 * Created by PhpStorm.
 * User: RKLiang
 * Date: 2016/11/30/0030
 * Time: 20:57.
 */

//该文件用于测试排序算法sort.php文件。

include 'sort.php';

//创建对象和申明原始数据
$sort = new sort();
$arr = array(19, 67, 789, 320, 5, 76, 12, 823, 102, 8);
echo '排序前数组的顺序:';
$sort->printArray($arr);

//调用插入排序算法
$insertArr = $sort->insertSort($arr);
echo '插入排序后数组的顺序:';
$sort->printArray($insertArr);

//调用冒泡排序算法
$bubbleArr = $sort->bubbleSort($arr);
echo '冒泡排序后数组的顺序:';
$sort->printArray($bubbleArr);

//调用选择排序算法
$selectArr = $sort->bubbleSort($arr);
echo '选择排序后数组的顺序:';
$sort->printArray($selectArr);

//调用归并排序算法
$mergeArr = $sort->mergeSortMain($arr);
echo '归并排序后数组的顺序:';
$sort->printArray($mergeArr);

//调用基数排序算法
$radixArr = $sort->radixSort($arr, 3);
echo '基数排序后数组的顺序:';
$sort->printArray($radixArr);
