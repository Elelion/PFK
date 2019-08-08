<?php
// function render($name, $data) {
//   ob_start();
//   $filePath = 'src' . DIRECTORY_SEPARATOR . $name . '.html';

//   if (is_file($filePath)) {
//     require $filePath;
//   } else {
//     echo "Не указан исходный файл для рендеринга";
//     echo "См. print(render('<имя файла>', [... -> ...]))";
//   }
// }

function RedirectNotSupportBrowser()
{
	$browser = 'Undefined';
	$user_agent = $_SERVER["HTTP_USER_AGENT"];

	if (strpos($user_agent, 'Firefox') !== false) $browser = 'Firefox';
	else if (strpos($user_agent, 'Opera') !== false) $browser = 'Opera';
	else if (strpos($user_agent, 'Chrome') !== false) $browser = 'Chrome';
	else if (strpos($user_agent, 'MSIE') !== false) $browser = 'InternetExplorer';
	else if (strpos($user_agent, 'Safari') !== false) $browser = 'Safari';
	else $browser = 'Undefined';

	if ($browser === 'Safari' || $browser === 'Undefined') {
		header( "Location: ./not-support.php" );
	}
}

function elapsedTime($format = '%H Ч : %M M')
{
	// NOTE: tomorrow - означает, полночть
	$ts_midnight = strtotime('tomorrow');

	$secToMidnight = $ts_midnight - time();
	$result = gmstrftime($format, $secToMidnight);
	return $result;
}

// **

function connectDB()
{
	// FIXME: for build
	// $link = mysqli_connect(
	// 	"localhost",
	// 	"proffurkom",
	// 	"sm*d2*3kDK9s*",
	// 	"proffurkom"
	// );

	// FIXME: for debug
	$link = mysqli_connect(
		"127.0.0.1",
		"root",
		"",
		"proffurkom"
	);

	mysqli_set_charset($link, 'utf8');

	if (!$link) {
		echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
		echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}

	return $link;
}

// **

function Error404()
{
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	exit();
}
?>