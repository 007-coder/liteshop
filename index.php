<?php
if (!defined('DS')) { define('DS',DIRECTORY_SEPARATOR); }
if (!defined('YV_LiteShop')) { define('YV_LiteShop',1); }

if (version_compare(phpversion(), '7.1', '>=')) {
	ini_set( 'serialize_precision', -1 );
} else if (version_compare(phpversion(), '5.4', '>=')) {
	ini_set( 'precision', -1 );
	ini_set( 'serialize_precision', -1 );
}

$st = microtime(true);


define('BASE_DIR', __DIR__);
define('LIB_DIR', BASE_DIR.DS.'lib');
define('APP_DIR', LIB_DIR.DS.'app');

define('VIEWS_DIR', BASE_DIR.DS.'views');
define('VIEWS_TEMPLATES_DIR', VIEWS_DIR.DS.'templates');
/*define('VIEWS_LAYOUTS_DIR', VIEWS_DIR.DS.'layouts');*/
define('CACHE_DIR', BASE_DIR.DS.'cache');


require_once(BASE_DIR.DS.'lib'.DS.'app'.DS.'defines.php');

session_start();

require_once(BASE_DIR.DS.'vendor'.DS.'autoload.php');

// Yura Vakulenko LiteShop Class
$liteShop_main_file = BASE_DIR.DS.'lib'.DS.'lite_shop.php';
if (file_exists($liteShop_main_file)) {
	require_once($liteShop_main_file);	
} else {
	echo '<center><h1>Магазин "LiteShop" не найден!</h1>';
	echo '<h3>Свяжитесь с разработчиком.</h3></center>';
	die();
}


$shop = new YV_LiteShop();

//Запускаем магазин
$shop->run();



$end = microtime(true);

//echo $end - $st;
?>