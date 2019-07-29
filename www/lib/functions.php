<?php
function render($name, $data)
{
	ob_start();
	$filePath = 'src' . DIRECTORY_SEPARATOR . $name . '.html';

	if (is_file($filePath))
	{
		require $filePath;
	}

	$content = ob_get_contents();
	ob_clean();

	return $content;
}

function getPathToScript($file)
{
	$path = $file . '.php';
	return $path;
}

function elapsedTime($format = "%H Ч : %M M")
{
	// NOTE: tomorrow - означает, полночть
	$ts_midnight = strtotime('tomorrow');

	$secToMidnight = $ts_midnight - time();
	$result = gmstrftime($format, $secToMidnight);
	return $result;
}

function connectDB()
{
	// NOTE: данные для подключения должны всегда храниться в файле
	$link = mysqli_connect("127.0.0.1", "root", "", "yeticave");
	mysqli_set_charset($link, "utf8");

	if (!$link)
	{
		echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
		echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}

	return $link;
}

function Error404()
{
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>