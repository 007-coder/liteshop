<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

class YV_AdminConfig extends YV_ShopConfig {

	public $admins = [];	
	public $template_content_admin = [];
	public $admin_template;
	public $admin_default_lang = 'ru_RU';
	public $admin_available_lang = [];	


	public function __construct($lang = null) {

		parent::__construct($lang = null);		

		require(LIB_DIR.DS.'set_config_admin.php');

		if (file_exists(LIB_DIR.DS.'set_config_'.$this->admin_template.'.php')) {
			require_once(LIB_DIR.DS.'set_config_'.$this->admin_template.'.php');
		}
	}



}

?>