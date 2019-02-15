<?php defined('YV_LiteShop') or die ('Restricted Access!');

class AjaxPostActions extends YV_LiteShop {

	public function __construct() {
		parent::__construct();
	}

	public function callMe(){
		return 'AjaxPostActions::callMe()';
	}
}