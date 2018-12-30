<?php

$path = __DIR__ . "/../../..";

function ScanSubDir(string $pathDir, int $count = 0)
{
	$prefix = "";
	// подготавливаем вывод
	for ($i = 0; $i < $count; $i++) { 
		$prefix .= "--";
	}
	// Создаем новый объект DirectoryIterator
	$dir = new DirectoryIterator($pathDir);
	// Цикл по содержанию директории
	foreach ($dir as $item) {
		if (!$item->isDot()) {
			// если это папка
			if ($item->getType() === "dir") {
				echo "<b>" . $prefix . $item . "</b><br>";
				// сканируем подиректории
				ScanSubDir($item->getPathName(), $count+1);
			} else {
				echo $prefix . $item . "<br>";
			}
		}
	}
}

ScanSubDir($path);
