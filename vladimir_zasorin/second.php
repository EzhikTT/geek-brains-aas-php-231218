<?php

$count = 1;
$total = 0;

for ($i = 0; $i < $count; $i++) {
	$arr = array_fill(0, 10000000, 1);
	
	$it = new ArrayIterator($arr);	
	
	$time1 = microtime(true);
	
	foreach ($arr as $elem) {
		$abc = $elem;
	}
	
// 	  while($it->valid()) {
// 	     $abc = $it->current();
// 	      $it->next();
// 	 }
	
// 	while($a = current($arr)) {
// 	    $abc = $a;
// 	    next($arr);
// 	}
	
	$time2 = microtime(true);
	
	$total += abs($time1 - $time2);
}

echo "Среднее время: " . ($total / $count);

/*
Полученные результаты на 10 повторений. Сравнение элемента с true:
1) при 10000000 элементах в массиве
Среднее время: foreach - 0.46814665794373, ArrayIterator - 3.7584262132645, обычный next - 2.8376272201538
2) при 1000000 элементах в массиве
Среднее время: foreach - 0.053009486198425, ArrayIterator - 0.37477960586548, обычный next - 0.27732350826263
3) при 100000 элементах в массиве
Среднее время: foreach - 0.0053389072418213, ArrayIterator - 0.0383380651474, обычный next - 0.027393174171448
4) при 10000 элементах в массиве
Среднее время: foreach - 0.0006256103515625, ArrayIterator - 0.0040733337402344, обычный next - 0.0029372930526733
5) при 1000 элементах в массиве
Среднее время: foreach - 6.9689750671387E-5, ArrayIterator - 0.00040550231933594, обычный next - 0.00030620098114014
6) при 100 элементах в массиве
Среднее время: foreach - 8.7261199951172E-6, ArrayIterator - 4.5371055603027E-5, обычный next - 3.1709671020508E-5
6) при 10 элементах в массиве
Среднее время: foreach - 2.3841857910156E-6, ArrayIterator - 1.2111663818359E-5, обычный next - 7.1048736572266E-6

Вывод: итератор не эффективнее

*/