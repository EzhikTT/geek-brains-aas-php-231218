<?
$arr = [300, 1000, 1, 54, 1, 23, 1, 1000, 3000, 40000, 10, 4, 5, 3, 1, 2];

$maxIndex = count($arr) - 1;
reset($arr);
$minIndex = key($arr);
iSort($arr, $minIndex, $maxIndex);

function iSort($arr, $minIndex, $maxIndex)
{
    $middleIndex = floor($maxIndex - ($maxIndex - $minIndex) / 2);
    if ($minIndex < $middleIndex) {
        iSort($arr, $minIndex, $middleIndex);
        iSort($arr, $middleIndex + 1, $maxIndex);
    }

    merge($arr, $minIndex, $middleIndex, $maxIndex);
}

function merge($arr, $minIndex, $middleIndex, $maxIndex)
{
    $newArr = [];
    $j = $minIndex;
    $m = $middleIndex + 1;

    for ($i = $minIndex; $i < $maxIndex + 1; $i++) {
        $newArr[$i] = $arr[$i];
    }
    
    for ($i = $minIndex; $i < $maxIndex + 1; $i++) {
        if ($j > $middleIndex) {
            $arr[$i] = $newArr[$i];
        } else if ($m > $maxIndex) {
            $arr[$i] = $newArr[$j++];
        } else if ($newArr[$j] > $newArr[$m]) {
            $arr[$i] = $newArr[$m++];
        } else {
            $arr[$i] = $newArr[$j++];
        }
    }
}

sort($arr);

echo '<pre>', print_r($arr), '</pre>';