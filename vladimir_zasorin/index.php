<?php

function connect()
{
    $link = mysqli_connect(
        'localhost',
        'root',
        '',
        'closure'
    ) or die(mysqli_error($link));
    return $link;
}

function getAll($sql)
{
    $link = connect();
    $response = mysqli_query($link, $sql);
    $menu = [];
    while ($row = mysqli_fetch_assoc($response)) {
        $menu[$row['level']][$row['parent_id']][$row['child_id']] = $row;
    }
    
    return $menu;
}

function build_menu($menu, $level, $parent_id)
{
    if ($menu[$level]) {
        $tree = "<ul>";
        foreach ($menu[$level][$parent_id] as $menu_row){
            $tree .= "<li>" . $menu_row['category_name'];
            $tree .= build_menu($menu, $menu_row['level'] + 1, $menu_row['child_id']);
            $tree .= "</li>";
        }
        $tree .= "</ul>";
    }

    return $tree;
}

$sqlDistinct = "SELECT * FROM `categories`
    INNER JOIN `connections`
    ON `categories`.`id_category` = `connections`.`child_id`";
    
$result = getAll($sqlDistinct);

echo build_menu($result, 0, 1);