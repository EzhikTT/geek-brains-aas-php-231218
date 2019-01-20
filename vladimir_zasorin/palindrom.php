<?php

function str_reverse_array($string)
{
    $split = str_split($string);
    $reverse = array_reverse($split);
    return [$split, $reverse];
}

function isPalindron($string1, $string2, $index, $count)
{
    if ($count > 0) {
        if ($string1[$index] === $string2[$index]) {
            isPalindron($string1, $string2, $index + 1, $count - 1);
        } else {
            echo 'Слово - не палиндром!';
        }
    } else {
        echo 'Слово - палиндром!';
    }
}

$string = 'ststs';
$strings = str_reverse_array($string);
$count = count($strings[0]);
isPalindron($strings[0], $strings[1], 0, $count);