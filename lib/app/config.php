<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

class YV_ShopConfig {

	public $db_database; 
	public $db_username;
	public $db_password;
	public $db_host;	


	public $seo = ['meta_author'=>'Vakulenko Yura | vakulenkoyura211@gmail.com | https://t.me/yura_v_007'];	
	public $uri_shop_media = [];	

	public $template_content = [];
	public $social_accounts = [];

	//	
	public $shop_template;
	public $default_lang = 'ru_RU';
	public $available_lang = [];	

	//
	public $product_attributes = [];

	public $default_currency ='';
	public $available_currencies = [];
	public $main_currency;
	public $excanges_rates = [];
	public $price_round = [];
	public $currency_codes = [];

	//
	public $shipping_methods = [];
	public $shipping_prices = [];
	//
	public $payment_methods = [];
	public $payment_taxes = [];	
	//
	public $order_statuses = [];
	public $order_colors = [];
	

	public function __construct($lang = null){
		
		if (is_null($lang)) {
			require_once(LIB_DIR.DS.'lang'.DS.$this->default_lang.'.php');
		} else {
			require_once(LIB_DIR.DS.'lang'.DS.$lang.'.php');
		}

		require(LIB_DIR.DS.'set_config.php');

		if (file_exists(LIB_DIR.DS.'set_config_'.$this->shop_template.'.php')) {
			require_once(LIB_DIR.DS.'set_config_'.$this->shop_template.'.php');
		}
	 	
	
	}

	public function __destruct() {

	}

}


 ?>