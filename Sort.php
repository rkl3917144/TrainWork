<?php

class Sort
{
    //输出数组元素
    public function printArray($arr)
    {
        echo '[';
        foreach ($arr as $v) {
            echo $v."\n";
        }
        echo ']';
        echo '<br/>';
    }

    //直接插入排序
    public function insertSort($arr)
    {
        for ($i = 0; $i <= count($arr) - 1; ++$i) {     //i控制当前要插入的数的位置
            $m = $arr[$i];      //$x保存当前要插入的数
            for ($j = $i - 1; $j >= 0; --$j) {        //$j记录与当前要插入数的比较位置
                if ($m < $arr[$j]) {
                    $arr[$j + 1] = $arr[$j];      //将$arr[$j]的值向后移动一位
                    if ($j == 0) {        //判断$j是否为0，如果为0，表示已经到了数组的起始位置，此后不能进行比较，应该直接插入
                        $arr[$j] = $m;
                    }
                } else {
                    //表示$x的值比要比较的值大，不用移动位置，直接插入即可
                    $arr[$j + 1] = $m;
                    break;
                }
            }
        }

        return $arr;
    }

    //冒泡排序
    public function bubbleSort($arr)
    {
        for ($i = count($arr) - 2; $i >= 0; --$i) {     //$i控制外部循环
            for ($j = 0; $j <= $i; ++$j) {        //$j控制内部循环
                //比较相邻两个数据的大小
                if ($arr[$j] > $arr[$j + 1]) {
                    //前面一个数大于后者，那么交换数据
                    $k = $arr[$j + 1];
                    $arr[$j + 1] = $arr[$j];
                    $arr[$j] = $k;
                }
            }
        }

        return $arr;
    }

    //选择排序
    public function selectSort($arr)
    {
        for ($i = 0; $i <= count($arr) - 2; ++$i) {     //$i为等待交换的数组下标
            $min = $arr[$i + 1];      //$min记录$i下标后所有元素的最小值
            for ($j = $i + 1; $j < count($arr); ++$j) {     //此循环用来寻找剩余元素中最小的元素
                if ($min > $arr[$j]) {
                    $min = $arr[$j];
                }
            }

            //将剩余元素最小值与要交换的元素进行交换
            $arr[$j] = $arr[$i];
            $arr[$i] = $min;
        }
    }

    //归并排序
    //合并两个有序的数组
    public function mergeSort($arrA, $arrB)
    {
        $arr = array();        //创建一个新数组，用于存储排序后的数组元素
        //$k = 0;         //该数组为新数组的下标
        while (count($arrA) > 0 && count($arrB) > 0) {  //将两个数组中较小的拿出来放到数组$arrC中
            if ($arrA[0] < $arrB[0]) {
                $arr[] = array_shift($arrA);     //把$arrA数组的首元素删除，使得该数组的首元素始终保持为未比较的状态
               // $k++;
            } else {
                $arr[] = array_shift($arrB);
                //$k++;
            }
        }

        $arr = array_merge($arr, $arrA, $arrB);

        return $arr;
    }

    //归并排序主程序
    public function mergeSortMain($arr)
    {
        $len = count($arr);
        if ($len <= 1) {
            return $arr;        //到这里就不用递归了，因为已经达到了分离数组的目的
        }

        $mid = intval($len / 2); //取数组中间
        $left_arr = array_slice($arr, 0, $mid); //拆分数组0-mid这部分给左边left_arr
        $right_arr = array_slice($arr, $mid); //拆分数组mid-末尾这部分给右边right_arr
        $left_arr = self::mergeSortMain($left_arr); //左边拆分完后开始递归合并往上走
        $right_arr = self::mergeSortMain($right_arr); //右边拆分完毕开始递归往上走
        $arr = self::mergeSort($left_arr, $right_arr); //合并两个数组,继续递归

        return $arr;
    }

    //基数排序
    public function GetNumInPos($num, $pos)
    {
        $temp = 1;
        for ($i = 0; $i < $pos - 1; ++$i) {
            $temp *= 10;
        }

        return ($num / $temp) % 10;
    }

    public function radixSort($arr, $d)
    {
        $l = count($arr);
        $bucket = array();
        for ($i = 0; $i < 10; ++$i) {
            $bucket[$i] = array(0);
        }

        // 由低 $p=1 至高位 $p<=$d 循环排序
        for ($p = 1; $p <= $d; ++$p) {

            // 将对应数据按当前位的数值放入桶里
            for ($i = 0; $i < $l; ++$i) {
                $n = self::GetNumInPos($arr[$i], $p);
                $index = ++$bucket[$n][0];
                $bucket[$n][$index] = $arr[$i];
            }

            // 收集桶里的数据
            for ($i = 0, $j = 0; $i < 10; ++$i) {
                for ($num = 1; $num <= $bucket[$i][0]; ++$num) {
                    $arr[$j++] = $bucket[$i][$num];
                }
                $bucket[$i][0] = 0;
            }
        }

        $bucket = null; // 习惯性释放内存
        return $arr;
    }
}

//创建对象和申明原始数据
$sort = new Sort();
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
