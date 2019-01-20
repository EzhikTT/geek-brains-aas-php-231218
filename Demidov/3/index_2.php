<?php

$text = 'topot';

function Palindrome($str)
{
	if ((strlen($str) == 1) || (strlen($str) == 0)) {
		return true;
	} else {
		if (substr($str, 0, 1) == substr($str, (strlen($str) - 1), 1)) {
			return Palindrome(substr($str, 1, strlen($str) - 2));
		} else {
			return false;
		}
	}
}

if (Palindrome($text)) {
	echo "$text - Это палиндром";
}else {
	echo "$text - Это НЕ палиндром";
}
