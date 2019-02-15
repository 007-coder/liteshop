<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

class Lua {

	protected $i18n = [];

	public function __construct($locale = 'ru_RU', $area = 'site') {
		if ($area == 'admin') {
			require(__DIR__.DS.$area.DS.$locale.'.php');	
		} else {
			require(__DIR__.DS.$locale.'.php');
		}
		
	}


	public function text($str) {
		return $this->i18n[$str];
	}

	public function t($str) {
		return $this->i18n[$str];
	}


}


 ?>