<?php

// создаем массив
$arrCount = 10;
$arr = [];
// заполняем массив
for ($i = 0; $i < $arrCount; $i++) {
	$arr[$i] = rand(0, $arrCount - 1);
}

// РАСЧЕТЫ
$countSort = 0;
$countMerge = 0;
$arr0 = $arr;
$start = microtime(true);
MergeSort($arr, 0, $arrCount - 1, $countSort, $countMerge);
$finish = microtime(true);
$delta = round($finish - $start, 16);

// ВЫВОД
echo "РЕЗУЛЬТАТЫ сортировки слиянием:<br>";
echo "Количество сортировок: <b>$countSort</b><br>";
echo "Количество сливаний: <b>$countMerge</b><br>";
echo "Время сортировки: <b>$delta сек.</b><br>";
echo "Сложность алгоритма: <b>O(N log<sub>2</sub> N)</b>";
echo "<br>====================================================<br>";
echo "Массив ДО сортировки:<br><pre>";
var_dump($arr0);
echo "</pre>";
echo "<br>====================================================<br>";
echo "Массив ПОСЛЕ сортировки:<br><pre>";
var_dump($arr);
echo "</pre>";

//--- алгоритм сортировки слиянием
/** разделяем массив на элементы */
function MergeSort(&$arr, $s, $f, &$countSort, &$countMerge)
{
	if ($s < $f) {
		$q = (int)(($s + $f) / 2);

		MergeSort($arr, $s, $q, $countSort, $countMerge);
		MergeSort($arr, $q + 1, $f, $countSort, $countMerge);

		Merge($arr, $s, $q, $f, $countMerge);

		$countSort++;
	}
}
/** сливаем массивы в один, сортируем */
function Merge(&$arr, $s, $q, $f, &$countMerge)
{
	for ($i = $s; $i <= $q; $i++) {
		$subArrLeft[] = $arr[$i];
	}

	for ($i = $q + 1; $i <= $f; $i++) {
		$subArrRight[] = $arr[$i];
	}

	$subArrLeft[] = INF;
	$subArrRight[] = INF;

	$l = 0;
	$r = 0;

	for ($i = $s; $i <= $f; $i++) {
		if ($subArrLeft[$l] <= $subArrRight[$r]) {
			$arr[$i] = $subArrLeft[$l];
			$l++;
		} else {
			$arr[$i] = $subArrRight[$r];
			$r++;
		}

		$countMerge++;
	}
}
