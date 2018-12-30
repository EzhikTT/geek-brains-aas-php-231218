<?php
$arrSize = 16000000;
$arr = array_fill(0, $arrSize, 'apple');

echo 'Количество элементов в массиве ' . $arrSize . "<hr>";

// foreach

$start = microtime(true);
foreach ($arr as $key => $value) {

}
$finish = microtime(true);

$delta = $finish - $start;
echo "Время работы foreach:<br>";
echo $delta . ' сек.<hr>';

// iterator
$obj = new ArrayObject ( $arr );
$iter = $obj -> getIterator ();

$start = microtime(true);
while ( $iter -> valid () )
{
	$iter -> next ();
}
$finish = microtime(true);

$delta = $finish - $start;
echo "Время работы итератора:<br>";
echo $delta . ' сек.<hr>';

/*
на малых и больших объемах массива $arr, foreach всегда работает быстрее! О_о
*/
