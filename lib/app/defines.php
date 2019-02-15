<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

// Настройки папок для Изображений товаров, слайдов для главной, изображний меток товаров, файлов товаров
//Корневая папка для изображений и файлов
define('PATH_SHOP_MEDIA', __DIR__.DS.'shop_media'.DS); 
//Изображения товаров
define('PATH_IMG_PRODUCTS', PATH_SHOP_MEDIA.DS.'img_products'.DS);
//изображния меток
define('PATH_IMG_LABELS', PATH_SHOP_MEDIA.DS.'img_labels'.DS);
//Изображения слайдов для главной
define('PATH_IMG_SLIDES', PATH_SHOP_MEDIA.DS.'img_slides'.DS);
//Файлы товаров
define('PATH_FILES_PRODUCTS', PATH_SHOP_MEDIA.DS.'files_products'.DS);


 ?>