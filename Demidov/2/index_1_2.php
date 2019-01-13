<?php
// массив с ценами, который будем сортировать
$prices = [
	[
		'price' => 21999,
		'shop_name' => 'Shop 1',
		'shop_link' => 'http://'
	],
	[
		'price' => 21550,
		'shop_name' => 'Shop 2',
		'shop_link' => 'http://'
	],
	[
		'price' => 21950,
		'shop_name' => 'Shop 2',
		'shop_link' => 'http://'
	],
	[
		'price' => 21350,
		'shop_name' => 'Shop 2',
		'shop_link' => 'http://'
	],
	[
		'price' => 21050,
		'shop_name' => 'Shop 2',
		'shop_link' => 'http://'
	]
];

// ВЫВОД
$count = 0;
$result = ShellSort($prices, $count);
echo "РЕЗУЛЬТАТЫ Shell-сортировки:<br>";
echo "Количество проходов: <b>$count</b><br>";
echo "Сложность алгоритма: <b>O(N<sup>3</sup>)</b>";
echo "<br>====================================================<br>";
echo "Массив ДО сортировки:<br><pre>";
var_dump($prices);
echo "</pre>";
echo "<br>====================================================<br>";
echo "Массив ПОСЛЕ сортировки:<br><pre>";
var_dump($result);
echo "</pre>";

// алгоритм Shell-сортировки
function ShellSort($elements, &$count)
{
	$length = count($elements);
	$gap[0] = ( int )($length / 2);
	$k = 0;

	while ($gap[$k] > 1) {
		$k++;
		$gap[$k] = ( int )($gap[$k - 1] / 2);
	}

	for ($i = 0; $i <= $k; $i++) {
		$step = $gap[$i];

		for ($j = $step; $j < $length; $j++) {
			$temp = $elements[$j];
			$p = $j - $step;

			while ($p >= 0 && $temp['price'] < $elements[$p]['price']) {
				$elements[$p + $step] = $elements[$p];
				$p = $p - $step;
			}

			$elements[$p + $step] = $temp;
			$count++;
		}
	}

	return $elements;
}
