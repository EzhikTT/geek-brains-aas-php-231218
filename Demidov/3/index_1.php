<?php
// КОНСТАНТЫ
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "alg_1");

//соединени с базой данных
function db($host, $user, $pass, $database)
{
	$link = mysqli_connect($host, $user, $pass, $database);

	if (!$link) {
		exit('Ошибка при подключении к базе данных');
	}

	mysqli_query($link, 'SET NAMES utf8');

	return $link;
}

//Функция получения массива каталога
function get_cat($link)
{
 //запрос к базе данных
	$sql = "SELECT * FROM category";

	$result = mysqli_query($link, $sql);

	if (!$result) {
		return null;
	}

	$arr_cat = array();

	if (mysqli_num_rows($result) != 0) {
  	//В цикле формируем массив
		for ($i = 0; $i < mysqli_num_rows($result); $i++) {
			$row = mysqli_fetch_assoc($result);

			$arr_cat[$row['id_category']] = $row['category_name'];
		}
  	//возвращаем массив
		return $arr_cat;
	}
}

//Функция получения массива связей
function get_links($link)
{
 //запрос к базе данных
	$sql = "SELECT * FROM category_links";
	$result = mysqli_query($link, $sql);

	if (!$result) {
		return null;
	}

	$arr_links = array();

	if (mysqli_num_rows($result) != 0) {
  	//В цикле формируем массив
		for ($i = 0; $i < mysqli_num_rows($result); $i++) {
			$row = mysqli_fetch_assoc($result);

			//$arr_links[$row['id_category']] = $row['category_name'];
			$arr_links[$i]["parent_id"] = $row["parent_id"];
			$arr_links[$i]["child_id"] = $row["child_id"];
			$arr_links[$i]["level"] = $row["level"];
		}
  	//возвращаем массив
		return $arr_links;
	}
}

// СБОРКА МЕНЮ
function getTree($arrCategory, $arrLinks)
{
	$arrResult = mergeArray($arrCategory, $arrLinks);

	return buildTree($arrResult);
}

function mergeArray($arrCategory, $arrLinks)
{
	$arrLinksSort = [];
	$arrResult = [];
	$pid = -1;

	foreach ($arrCategory as $id => $name) {
		foreach ($arrLinks as $key) {
			if ($key['child_id'] == $id) {
				if ($key['level'] == 0) {
					$pid = 0;
					break;
				}
				if ($pid < $key['parent_id'] && $id > $key['parent_id']) {
					$pid = (int)$key['parent_id'];
				}
			}
		}

		$arrResult[] = [
			'id' => $id,
			'name' => $name,
			'pid' => $pid,
		];

		$pid = -1;
	}

	$arrResult = rebuildArray($arrResult);

	return $arrResult;
}

function rebuildArray($categories)
{
	$resut = [];

	foreach ($categories as $item) {
		if (!isset($result[$item['pid']]))
			$result[$item['pid']] = [];

		$result[$item['pid']][] = $item;
	}

	return $result;
}

function buildTree($categories, $cat = 0)
{
	$html = "<ul>";

	foreach ($categories[$cat] as $item) {
		$html .= "<li>" . $item["name"];

		if (isset($categories[$item["id"]])) {
			$html .= "<ul>";
			$html .= buildTree($categories, $item["id"]);
			$html .= "</ul>";
		}

		$html .= "</li>";
	}

	$html .= "</ul>";

	return $html;
}

//соединение с базой данных
$link = db(HOST, USER, PASS, DB);

//получаем массив каталога
$arrCategory = get_cat($link);
$arrLinks = get_links($link);

// ВЫВОД МЕНЮ
echo getTree($arrCategory, $arrLinks);
