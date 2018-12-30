<?php

function explorer($pathName) {
    $dir = new DirectoryIterator($pathName);

    while ($dir->valid()) {
        $el = $dir->current();

        echo "<ul>";
        if (!$dir->isDot()) {
            if ($dir->isDir()) {
                //если директория, то пишем её назание и рекурсия
                echo "<li> Directory: $el";
                $newPathName = "$pathName/$el";
                explorer($newPathName);
            } elseif ($dir->isFile()) {
                //если файл, то пишем его название
                echo "<li> File: $el";
            }
            echo "</li>";
        }
        echo "</ul>";

        $dir->next();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DirectoryIterator</title>
</head>
<body>
    <?php explorer('files'); ?>
</body>
</html>