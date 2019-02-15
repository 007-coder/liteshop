<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

if (!defined('DS')) { define('DS',DIRECTORY_SEPARATOR); }

class AdminLua {

	protected $i18n = [];

	public function __construct($locale = 'ru_RU', $area = 'site') {
		require(__DIR__.DS.$locale.'.php');
	}


	public function text($str) {
		return $this->i18n[$str];
	}

	public function t($str) {
		return $this->i18n[$str];
	}

}


?>