<?php 
use Jenssegers\Blade\Blade;

if (!defined('DS')) { define('DS',DIRECTORY_SEPARATOR); }
defined('YV_LiteShop') or die ('Restricted Access!');

require_once(APP_DIR.DS.'config.php');
require_once(APP_DIR.DS.'config_admin.php');
require_once(APP_DIR.DS.'functions.php');


class YV_LiteShop {
	
	protected $config=null;	
	protected $configAdmin=null;		

	protected $shopConfig = null;
	protected $db = null; 
	protected $main_model=null;
	protected $main_model_admin=null;

	protected $cryptor=null;
	protected $blade=null;	
	protected $i18n=null;	

	protected $enable_admin=false;	
	protected $run_admin=false;	
	protected $run_ajax=false;	

	protected $products = [];	
	protected $cart = [];	
	protected $orders = [];

	protected $view_data = [];
	protected $view_data_admin = [];
	protected $validPages = [];

	protected $is_auth = false;	
	protected $is_auth_admin = false;	

	public $validator=null;	

	public $product_categories;	
	public $product_collections;	
	public $homepage_slides;	



	public function __construct() {
		$this->config = new stdClass;		

		$this->config->available_lang=['ru_RU','uk_UA'];
		$this->config->available_lang_admin=['ru_RU','uk_UA'];
		$this->config->default_lang='ru_RU';

		//Установки языка
		if (isset($_SESSION['shop_language']) && in_array($_SESSION['shop_language'], $this->config->available_lang)) {
			$this->config->interface_lang = $_SESSION['shop_language'];
		} else {
			$_SESSION['shop_language'] = $this->config->default_lang;
			$this->config->interface_lang = $this->config->default_lang;
		}	

		//Установки языка Админ панели
 		if (isset($_SESSION['admin_language']) && in_array($_SESSION['admin_language'], $this->config->available_lang_admin)) {
			$this->config->interface_lang_admin = $_SESSION['admin_language'];
		} else {
			$_SESSION['admin_language'] = $this->config->default_lang;
			$this->config->interface_lang_admin = $this->config->default_lang;
		}	
	
		$this->shopConfig = new YV_ShopConfig($this->config->interface_lang);
		//
		$this->configAdmin = new YV_AdminConfig($this->config->interface_lang_admin);


		$this->blade = new Blade(VIEWS_DIR, CACHE_DIR);

		require_once(APP_DIR.DS.'MysqliDb.php');
		//инициализация соединения с БД
		$this->db = new MysqliDb(
			$this->shopConfig->db_host,
			$this->shopConfig->db_username,
			$this->shopConfig->db_password,
			$this->shopConfig->db_database
		);

		//Криптор
		require_once(APP_DIR.DS.'encription_class.php');
		$this->cryptor = new encryption_class();

		
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = [];
		}		



		//Установки валют
		if (isset($_SESSION['shop_currency']) && in_array($_SESSION['shop_currency'], $this->shopConfig->available_currencies)) {
			$this->config->shop_currency = $_SESSION['shop_currency'];
		} else {
			$_SESSION['shop_currency'] = $this->shopConfig->default_currency;
			$this->config->shop_currency = $this->shopConfig->default_currency;
		}
		$this->config->shop_currency_rate = $this->shopConfig->excanges_rates[$this->config->shop_currency];
		$this->config->shop_currency_code = $this->shopConfig->currency_codes[$this->config->shop_currency];
		$this->config->default_currency = $this->shopConfig->default_currency;
		$this->config->main_currency = $this->shopConfig->main_currency;
		$this->config->price_round = $this->shopConfig->price_round;

		// Остальные усановки
		$this->config->shop_template = $this->shopConfig->shop_template;
		$this->config->seo = $this->shopConfig->seo;
		$this->config->uri_shop_media = $this->shopConfig->uri_shop_media;
		$this->config->template_content = $this->shopConfig->template_content;


		//Статусы ордеров		
		$this->config->order_statuses = [
			'new'=>[
				'name'=>[
					'ru_RU'=>'Новый',
					'uk_UA'=>''
				],
				'color'=>'#7DA9EE',
				'text_color'=>'#fff'
			],
			'processing' => [
				'name'=>[
					'ru_RU'=>'В обработке',
					'uk_UA'=>''
				],
				'color'=>'#7DA9EE',
				'text_color'=>'#fff'
			],
			'completed' => [
				'name'=>[
					'ru_RU'=>'Завершен',
					'uk_UA'=>''
				],
				'color'=>'#67DF9F',
				'text_color'=>'#fff'
			],
			'cancelled' => [
				'name'=>[
					'ru_RU'=>'Отменен',
					'uk_UA'=>''
				],
				'color'=>'#7DA9EE',
				'text_color'=>'#fff'
			],
			'refunded' => [
				'name'=>[
					'ru_RU'=>'Возврат средств',
					'uk_UA'=>''
				],
				'color'=>'#7DA9EE',
				'text_color'=>'#fff'
			],
			'packing' => [
				'name'=>[
					'ru_RU'=>'Упаковывается',
					'uk_UA'=>''
				],
				'color'=>'#7DA9EE',
				'text_color'=>'#fff'
			],
			'dispatched' => [
				'name'=>[
					'ru_RU'=>'Доставлен перевозчику',
					'uk_UA'=>''
				],
				'color'=>'#7DA9EE',
				'text_color'=>'#fff'
			]
		];
		//Статусы оплаты	
		$this->config->order_payment_statuses = [
			'no_pay'=>[
				'name'=>[
					'ru_RU'=>'Не оплачен',
					'uk_UA'=>''
				],
				'color'=>'#777',
				'text_color'=>'#fff'
			],
			'payed'=>[
				'name'=>[
					'ru_RU'=>'Оплачен',
					'uk_UA'=>''
				],
				'color'=>'',
				'text_color'=>''
			]
		];

		$this->config->new_order_status = 'new';
		$this->config->new_order_payment_status = 'no_pay';				
		//Статусы ордеров конец


		$this->config->shipping_methods = $this->shopConfig->shipping_methods;		
		$this->config->shipping_prices = $this->shopConfig->shipping_prices;		
		$this->config->payment_methods = $this->shopConfig->payment_methods;		
		$this->config->payment_taxes = $this->shopConfig->payment_taxes;

		$this->config->records_per_page = ['5'=>5,'10'=>10,'15'=>15,'25'=>25,'50'=>50,'75'=>75,'100'=>100,'125'=>125,'150'=>150,'200'=>200,'250'=>250,'500'=>500, 9999999=>'all'];

		//Валидные страницы
		$this->validPages['admin'] = ['orders','call-me','homepage','404','docs'];
		$this->validPages['site'] = [];

		// Установки для АДМИН ПАНЕЛИ СТАРТ		

		// Установки для АДМИН ПАНЕЛИ КОНЕЦ

		if(!defined('URI_BASE')) {
			define('URI_BASE',$this->config->seo['uri_base'].'/');
		}		
		if(!defined('URI_ASSETS')) {
			define('URI_ASSETS', URI_BASE.'assets/' ); 	
		}		

		$dev_cr_text = [
			'ru_RU'=>' Разработка и поддержка: Вакуленко Юрий.',
			'uk_UA'=>'',
			'en_EN'=>'',
		];
		$this->config->dev_copyrights = $dev_cr_text;

		if(!defined('DEV_CR')) {
			define('DEV_CR',$dev_cr_text[$this->config->interface_lang]);	
		}
		

		// Подключаем дополнит константы
		require_once(BASE_DIR.DS.'lib'.DS.'app'.DS.'defines_other.php');

		// Подключаем Спецефические функции для установленого ШАБЛОНА
		if (file_exists(APP_DIR.DS.'functions_'.$this->config->shop_template.'.php')) {
			require_once(APP_DIR.DS.'functions_'.$this->config->shop_template.'.php');
		}

		//инициализация основной модели
		require_once(LIB_DIR.DS.'models'.DS.'main_model.php');
		$this->main_model = new YV_ShopMainModel($this->db, $this->config);		

		// подключаем валидатор GUMP
		require_once(APP_DIR.DS.'gump'.DS.'gump.class.php');
		$this->validator  = new GUMP(iso6391_lang_code($this->config->interface_lang ));


		
		/*// Получаем категории товаров
		require_once(LIB_DIR.DS.'products'.DS.'categories.php');
		$this->product_categories = $product_categories;
		// Получаем коллекции товаров
		require_once(LIB_DIR.DS.'products'.DS.'collections.php');
		$this->product_collections = $product_collections;		*/
		
	}

	//Хренов диструктор
	function __destruct() { }


	// Запускаем магазин!
	public function run() {

		// подключаем файлы языка (новое)
		require_once(LIB_DIR.DS.'lang'.DS.'lua.php');		

		$template_config = [
			'template'=>$this->config->shop_template,
			'interface_lang'=>$this->config->interface_lang,
			'available_languages'=>$this->shopConfig->lang_codes,
			'available_currencies'=>$this->shopConfig->available_currencies,			
			'excanges_rates'=>$this->shopConfig->excanges_rates,
			'currency_codes'=>$this->shopConfig->currency_codes,
			'shop_currency'=>$this->config->shop_currency,
			'shop_currency_rate'=>$this->config->shop_currency_rate,
			'shop_currency_code'=>$this->config->shop_currency_code,
			'default_currency'=>$this->config->default_currency,
			'price_round'=>$this->config->price_round,
			'main_currency'=>$this->config->main_currency,
			'order_statuses'=>$this->config->order_statuses,			
			'shipping_methods'=>$this->config->shipping_methods,
			'shipping_prices'=>$this->config->shipping_prices,
			'payment_methods'=>$this->config->payment_methods,
			'payment_taxes'=>$this->config->payment_taxes
		];

		$this->view_data = [
			'data'=>[
				'config' => $template_config,
				'page'=>'homepage', // product | cart | checkout | order_finish | show_order | 404
				'lang_iso_code'=>iso6391_lang_code($this->config->interface_lang,'_'),
				'site_name' => $this->config->seo['site_name'],
				'meta_title' => $this->config->seo['meta_title'],
				'meta_desc' => $this->config->seo['meta_desc'],
				'meta_keywords' => $this->config->seo['meta_keywords'],
				'meta_author' => $this->config->seo['meta_author'],
				'uri_base'=> URI_BASE,
				'uri_assets'=> URI_ASSETS.$this->config->shop_template.'/',
				'uri_assets_js'=> URI_ASSETS.$this->config->shop_template.'/js/',
				'uri_assets_css'=> URI_ASSETS.$this->config->shop_template.'/css/',
				'uri_assets_img'=> URI_ASSETS.$this->config->shop_template.'/img/',
				'uri_assets_fonts'=> URI_ASSETS.$this->config->shop_template.'/fonts/',
				'uri_media'=> $this->config->uri_shop_media['media'],
				'uri_media_img_products'=> $this->config->uri_shop_media['img_products'],
				'uri_media_img_slides'=> $this->config->uri_shop_media['img_slides'],	
				'uri_media_img_labels'=> $this->config->uri_shop_media['img_labels'],	
				'uri_media_files_products'=> $this->config->uri_shop_media['files_products'],
				'abs_path_media'=> $this->shopConfig->absPath_shop_media['media'],	
				'abs_path_img_products'=> $this->shopConfig->absPath_shop_media['img_products'],
				'abs_path_img_slides'=> $this->shopConfig->absPath_shop_media['img_slides'],
				'abs_path_img_labels'=> $this->shopConfig->absPath_shop_media['img_labels'],
				'abs_path_files_products'=> $this->shopConfig->absPath_shop_media['files_products'],


				'template_content'=>$this->config->template_content,
				'message'=>[],
				'cart'=>$this->get_cart() 			
			]			
		];


		//роутер
		require_once(APP_DIR.DS.'router.php');

		// *****Обработка $_POST******	
		require_once(APP_DIR.DS.'process_post.php');	


		// Инициализайия языка интрефейса
		$this->i18n = ($this->run_admin) ? new Lua($this->config->interface_lang_admin, 'admin') : '';/*new Lua($this->config->interface_lang)*/	


		


		// Запуск представления
		if ($this->run_admin) {
			$this->run_admin();
		} else if ($this->run_ajax) {
			$this->ajax($ajax_GET);
		}	else {

			echo $this->blade->make('templates/'.$this->config->shop_template.'/start', $this->view_data);	
		}

		
	}


	// Запускаем админ-панель
	public function run_admin() {		
		$this->config->configAdmin = $this->configAdmin;	

		//Установки для админ пользователей панели упр.		
		if (!isset($_SESSION['is_auth_admin'])) {
			$_SESSION['is_auth_admin'] = [
				'auth'=>false,
				'data'=>[
					'login'=>'',
					'icon'=>''
				]
			];
		}

		if ($_SESSION['is_auth_admin']['auth']) {
			$this->is_auth_admin = true;
		}

		if (!isset($_SESSION['recordsPerPage'])) {
			$_SESSION['recordsPerPage'] = [
				'global' => (isset($this->configAdmin->admin_records_per_page) && $this->configAdmin->admin_records_per_page > 0) ? $this->configAdmin->admin_records_per_page : 25,
				'admin' => []
			];
		}

		
		


		$_SESSION['filters'] = (isset($_SESSION['filters']) && count($_SESSION['filters'])) ? $_SESSION['filters'] : [];


		

		//инициализация основной модели
		require_once(LIB_DIR.DS.'models'.DS.'admin'.DS.'main_model_admin.php');	
		$this->main_model_admin = new YV_AdminMainModel($this->db, $this->config);	


		$admin_template_config = [
			'template'=>$this->configAdmin->admin_template,
			'shop_template'=>$this->config->shop_template,
			//
			'interface_lang'=>$this->config->interface_lang_admin,
			'available_languages'=>$this->configAdmin->admin_available_lang,
			//
			'available_currencies'=>$this->shopConfig->available_currencies,			
			'main_currency'=>$this->config->main_currency,
			'excanges_rates'=>$this->shopConfig->excanges_rates,
			'currency_codes'=>$this->shopConfig->currency_codes,
			'shop_currency'=>$this->config->shop_currency,
			'shop_currency_rate'=>$this->config->shop_currency_rate,
			'shop_currency_code'=>$this->config->shop_currency_code,
			'default_currency'=>$this->config->default_currency,
			//
			'price_round'=>$this->config->price_round,
			//
			'order_statuses'=>$this->config->order_statuses,			
			//
			'shipping_methods'=>$this->config->shipping_methods,
			'shipping_prices'=>$this->config->shipping_prices,
			//
			'payment_methods'=>$this->config->payment_methods,
			'payment_taxes'=>$this->config->payment_taxes,			
			//
			'dev_copyrights'=>$this->config->dev_copyrights
		];

		// main menu
		$main_menu = [
			'homepage'=>[				
				'name'=>$this->i18n->t('MLT_HOMEPAGE'),
				'link'=>build_admin_link(['type'=>'homepage']),
				'publish'=>true,
				'is_active'=>false,
				'icon'=>'<i class="ni ni-tv-2 text-primary"></i>',
				'submenu'=>[]
			],
			'orders'=>[
				'name'=>$this->i18n->t('MLT_ORDERS'),
				'link'=>build_admin_link(['type'=>'orders']),
				'publish'=>true,
				'is_active'=>false,
				'icon'=>'<i class="ni ni-bag-17 text-orange"></i>',
				'submenu'=>[]
			],
			'call-me'=>[
				'name'=>$this->i18n->t('MLT_CALL_ME'),
				'link'=>build_admin_link(['type'=>'call-me']),
				'publish'=>true,
				'is_active'=>false,
				'icon'=>'<i class="ni ni-mobile-button text-red"></i>',
				'submenu'=>[]
			]
		];

		// user_menu
		$user_menu = [
			'logout'=>[				
				'name'=>$this->i18n->t('ULT_LOGOUT'),
				'link'=>build_admin_link(['type'=>'logout']),
				'publish'=>true,				
				'icon'=>'<i class="ni ni-user-run"></i>',
				'submenu'=>[]
			]
		];

		// document_menu
		$document_menu = [
			'docs'=>[				
				'name'=>$this->i18n->t('DLT_DOCUMENTATION'),
				'link'=>build_admin_link(['type'=>'docs']),
				'publish'=>true,				
				'icon'=>'<i class="ni ni-spaceship"></i>',
				'submenu'=>[]
			]
		];
		


		$this->view_data_admin = [
			'data'=>[
				'config' => $admin_template_config,
				'i18n' => $this->i18n,
				'page'=>'homepage', // orders | call-me | login | 404
				'lang_iso_code'=>iso6391_lang_code($this->config->interface_lang_admin,'_'),
				'site_name' => $this->config->seo['site_name'],
				'meta_title' => $this->i18n->t('PT_ADMIN_HOMEPAGE'),
				'meta_author' => $this->config->seo['meta_author'],	
				'logo'=>URI_ASSETS.$this->config->shop_template.'/img/logo/logo.png',
				//
				'main_menu'=>$main_menu,
				'user_menu'=>$user_menu,
				'document_menu'=>$document_menu,
				//
				'user_info'=>$_SESSION['is_auth_admin']['data'],
				//			
				'uri_base'=> URI_BASE,
				'uri_assets'=> URI_ASSETS.'admin/'.$this->configAdmin->admin_template.'/',
				'uri_assets_js'=> URI_ASSETS.'admin/'.$this->configAdmin->admin_template.'/js/',
				'uri_assets_css'=> URI_ASSETS.'admin/'.$this->configAdmin->admin_template.'/css/',
				'uri_assets_img'=> URI_ASSETS.'admin/'.$this->configAdmin->admin_template.'/img/',
				'uri_assets_fonts'=> URI_ASSETS.'admin/'.$this->configAdmin->admin_template.'/fonts/',
				'uri_assets_vendor'=> URI_ASSETS.'admin/'.$this->configAdmin->admin_template.'/vendor/',
				'uri_media'=> $this->config->uri_shop_media['media'],
				'uri_media_img_products'=> $this->config->uri_shop_media['img_products'],
				'uri_media_img_slides'=> $this->config->uri_shop_media['img_slides'],	
				'uri_media_img_labels'=> $this->config->uri_shop_media['img_labels'],	
				'uri_media_files_products'=> $this->config->uri_shop_media['files_products'],
				//
				'abs_path_media'=> $this->shopConfig->absPath_shop_media['media'],	
				'abs_path_img_products'=> $this->shopConfig->absPath_shop_media['img_products'],
				'abs_path_img_slides'=> $this->shopConfig->absPath_shop_media['img_slides'],
				'abs_path_img_labels'=> $this->shopConfig->absPath_shop_media['img_labels'],
				'abs_path_files_products'=> $this->shopConfig->absPath_shop_media['files_products'],
				//
				'template_content'=>$this->configAdmin->admin_template_content,
				'message'=>[]						
			]			
		];

		// *****Обработка $_POST******	
		require_once(APP_DIR.DS.'process_post_admin.php');

		//роутер
		require_once(APP_DIR.DS.'router_admin.php');
			

		if ($this->is_auth_admin === false) {
			$this->view_data_admin['data']['page'] = 'login';
			$this->view_data_admin['data']['meta_title'] = $this->i18n->t('META_LOGIN_PAGE_TITLE');
		}

		// запускаем представление		
		echo $this->blade->make('admin/templates/'.$this->configAdmin->admin_template.'/start', $this->view_data_admin);	
		
	}


	// Ajax интерфейс
	public function ajax($post) {

		$valid_actions = [
			'site'=>['call_me'],
			'admin'=>[]
		];

		$section = (isset($post['section']) && in_array($post['section'], ['admin','site'])) ? $post['section'] : 'site';		

		switch ($section) {
			case 'site':
				require_once(APP_DIR.DS.'post_actions'.DS.'ajax.php');
				$_ajax = new AjaxPostActions();					
				break;
			case 'admin':
				require_once(APP_DIR.DS.'post_actions'.DS.'ajax_admin.php');
				$_ajax = new AjaxAdminPostActions();					
				break;				
		}	

		$ajaxResponce = '';
		if (isset($post['action']) && in_array($post['action'], $valid_actions[$section])) {

			switch ($post['action']) {
				case 'call_me':
					$ajaxResponce = $_ajax->callMe($post);
					break;				
			}	

		}

		echo $ajaxResponce;
		die();

	}


	public function getAdmins() {
		return $this->configAdmin->admins;
	}

	public function loginAdmin($post) {
		$valid_admins = $this->getAdmins();

		$validData = [];
			$d = [
				'login'=>$post['login'],
				'password'=>$post['password'],
				'action'=>$post['action']
			];
			$vParams = [
				'validationRules'=>[
					'login'=>'required|max_len,35',
					'password'=>'required|max_len,35',
					'action'=>'required|exact_len,11|contains,admin_login'
				],
				'filterRules'=>[
					'login'=>'trim|sanitize_string',
					'password'=>'trim|sanitize_string'
				]
			];
			$validData = $this->validate($d,$vParams);

			if ($validData['allValid'] === false) {
				$this->view_data_admin['data']['message'] = [
					'type'=>'error',
					'text'=>$this->i18n->t('MSG_LOGIN_ERROR')
				];

			} else {

				if (array_key_exists($validData['validatedData']['login'], $valid_admins) && $validData['validatedData']['password'] == $valid_admins[$validData['validatedData']['login']]['password'] ){

					$this->is_auth_admin = true;

					$_SESSION['is_auth_admin']['auth'] = true;
					$_SESSION['is_auth_admin']['data'] = [
						'login'=>$validData['validatedData']['login'],
						'icon'=>'team-4-800x800.jpg'
					];

					$this->view_data_admin['data']['user_info'] = $_SESSION['is_auth_admin']['data'];
					

				} else {
					$this->view_data_admin['data']['message'] = [
						'type'=>'error',
						'text'=>$this->i18n->t('MSG_LOGIN_ERROR')
					];
				}
				
			}

	}


	public function getValidPages($section = 'site') {
		return $this->validPages[$section];
	}

	public function pagination($data) {
		// max. num of items to disp per page
		$NUMPERPAGE = (isset($data['items_per_page']) && $data['items_per_page'] > 0) ? $data['items_per_page'] : 20; 

		//url 
		$this_page = $data['baseUri'];		

		// count total items
		$num_results = $data['total_items'];

		/*$data = range(1, 150); // data array to be paginated*/

		$page = (isset($data['page']) && intval($data['page'])>0) ? $data['page'] : 1;


		// ------------------
		// build the navigation links:

		// extra variables to append to navigation links (optional)
		$linkextra = (isset($data['extraLinks']) && is_array($data['extraLinks'])) ? $data['extraLinks'] : [];
		$tml_lExtra = [];

		if (count($data['extraLinks'])) {			
			foreach ($data['extraLinks'] as $query => $value) {
				$tml_lExtra[] = $query.'='.$value;
			}
		}
		
		$tml_lExtra = implode("&amp;", $tml_lExtra);
		if($linkextra) $linkextra = $tml_lExtra."&amp;";		



		// ------------------
		// build HTML:
		$html = '';

		require_once(VIEWS_DIR.DS.'admin'.DS.'templates'.DS.$this->configAdmin->admin_template.DS.'layouts'.DS.'pagination.php');		

		return $html;

	}


	
	public function render($page, $data, $section = 'site') {		
		$section = (in_array($section, ['site','admin'])) ? $section : 'site';
		$valid_pages = $this->getValidPages($section);
		//
		$viewData = ($section == 'site') ? $this->view_data['data'] : $this->view_data_admin['data'];

		$viewData['page'] = (is_string($page) && in_array($page, $valid_pages)) ? $page : 'homepage';

		if (count($data) && is_array($data)) {
			$viewData = array_replace_recursive($viewData, $data);	

			switch ($section) {
				case 'site':
					$this->view_data['data'] = $viewData;
					break;

				case 'admin':
					$this->view_data_admin['data'] = $viewData;
					break;				
			} 	

		}

	}


	public function validate($data, $params) {
		$return  = [
			'allValid'=>false,
			'errors'=>[
				'values'=>[],
				'valid'=>[]
			],
			'validatedData'=>[]
		];

		$validationRules = $params['validationRules'];
		$filterRules = $params['filterRules'];

		$this->validator->validation_rules($validationRules);	
		$this->validator->filter_rules($filterRules);
		$validatedData = $this->validator->run($data);	

		// Валидация провалена
		if($validatedData === false)
		{	
			$return['errors']['values'] = $this->validator->get_errors_array();			
			$valid_data = [];

			foreach ($data as $kp => $_val)
			{				
				$return['errors']['valid'][$kp] = (!array_key_exists($kp, $return['errors']['values'])) ? $_val : ''; 				
			}
		} 
		//Валидация успешна
		else 
		{
				$return['allValid'] = true;
				$return['validatedData'] = $validatedData;
		}


		return $return;

	}


	// Дабавляет, удаляет, обновляет товары в корзине
	public function process_cart($data) {
		$prod_id = (int)$data['product_id'];		
		$cart = $this->get_cart();
		$products = $this->get_products();
		$product = $products[$prod_id];
		$cart_product_groupe = (isset($data['attribute']) && count($data['attribute']) ) ? 'with_attributes' : 'without_attributes';
		
		if (isset($data['attribute']) && count($data['attribute'])) {



		} else if (!isset($data['attribute'])) {
			//wrap_pre($cart, '$cart');

			// ---------------------------
			// если ДОБАВЛЯЮТ ТОВАР БЕЗ АТРИБУТА
			//----------------------------

			// ****если товар в корзине****
			if ( isset($cart['products'][$cart_product_groupe]['pid_'.$prod_id]) ) {	

				// cart_update, cart_add 	
				if (in_array($data['action'], ['cart_update','cart_add'])) {
					$new_quantity = ($this->view_data['data']['page'] == 'cart') ? (int)$data['quantity'] : (int)$data['quantity']+(int)$cart['products'][$cart_product_groupe]['pid_'.$prod_id]['quantity'];

					// Добавить рассчет цены в зависимости от аттрибута
					$data_calc_price = [
						'price_no_tax'=>$product['price_no_tax'],
						'tax'=>$product['tax'],
						'discount'=>$product['discount'],
						'quantity'=>$new_quantity,
						'qty_price'=>$product['qty_price'],	
						'price_round'=>$this->config->price_round,								
						'currency'=>[
							'available_currencies'=>$this->shopConfig->available_currencies,
							'excanges_rates'=>$this->shopConfig->excanges_rates,
							'currency_codes'=>$this->shopConfig->currency_codes			
						]								
					];
					$item_price = calc_product_price($data_calc_price);

					//цена 1 ед товара
					$item_1unit_price = [];
					if (isset($product['qty_price']) && count($product['qty_price']) && $new_quantity > 1) {
						foreach ($product['qty_price'] as $qp_value) {
							if ($new_quantity >= $qp_value['start'] && $new_quantity <= $qp_value['end'] ) {
								$item_1unit_price = calc_product_price(array_merge($data_calc_price,['1unit_price'=>true]));
								break;		
							}
						}
						
					}
					

					$total_price = [];
					foreach ($item_price as $curr => $i_price) {
						$total_price[$curr] = [
							'val'=>$new_quantity*$i_price['val'],
							'currency_code'=>$i_price['currency_code']						
						];
						if (isset($i_price['old_price']) && $i_price['old_price'] > 0) {
							$total_price[$curr]['old_price'] = $i_price['old_price'];
						}		

						//цена 1 ед товара
						if (count($item_1unit_price)) {
							$item_price[$curr]['1unit_price'] = $item_1unit_price[$curr]['val'];
						}				
					}

					$_SESSION['cart']['products'][$cart_product_groupe]['pid_'.$prod_id]['quantity'] = $new_quantity;
					$_SESSION['cart']['products'][$cart_product_groupe]['pid_'.$prod_id]['item_price'] = $item_price;
					$_SESSION['cart']['products'][$cart_product_groupe]['pid_'.$prod_id]['total_price'] = $total_price;


					$this->view_data['data']['cart'] = $_SESSION['cart'];				

					// Сообщение. Успех товар обновлен в корзине
					$this->view_data['data']['message'] = [
						'type'=>'ok',
						'text'=>MSG_CART_REFRESH					
					];	


				//cart_remove
				} else if ($data['action'] == 'cart_remove') {
					unset($_SESSION['cart']['products'][$cart_product_groupe]['pid_'.$prod_id]);
					if (!count($_SESSION['cart']['products'][$cart_product_groupe])) {
						unset($_SESSION['cart']['products'][$cart_product_groupe]);
					}
					if (!count($_SESSION['cart']['products'])) {
						$_SESSION['cart']=[];
					}
					

					$this->view_data['data']['cart'] = $_SESSION['cart'];

					// Сообщение. Успех товар удален из корзины
					$this->view_data['data']['message'] = [
						'type'=>'ok',
						'text'=>MSG_CART_PRODUCT_REMOVED					
					];	
				}


			// ---------------------------
			// ****если товара нет в корзине****
			} else {				
				if ($data['action'] == 'cart_add') {
					if ($product['published']) {
						if ($product['in_stock']) {
							if ($product['items_left'] =='unlim' || $product['items_left'] > 0){
								// Успех. Добавл товар в корзину

								// Добавить рассчет цены в зависимости от аттрибута
								$data_calc_price = [
									'price_no_tax'=>$product['price_no_tax'],
									'tax'=>(isset($product['tax']) && $product['tax'] > 0) ? $product['tax'] : 0,
									'discount'=>(isset($product['discount']) && $product['discount'] > 0) ? $product['discount'] : 0,
									'quantity'=>(isset($data['quantity']) && $data['quantity'] > 1) ? $data['quantity'] : 1,
									'qty_price'=>(isset($product['qty_price']) && count($product['qty_price'])) ? $product['qty_price'] : [],	
									'price_round'=>$this->config->price_round,								
									'currency'=>[
										'available_currencies'=>$this->shopConfig->available_currencies,
										'excanges_rates'=>$this->shopConfig->excanges_rates,
										'currency_codes'=>$this->shopConfig->currency_codes			
									]								
								];
								$item_price = calc_product_price($data_calc_price);

								//цена 1 ед товара
								$item_1unit_price = [];
								if (isset($product['qty_price']) && count($product['qty_price']) && $data['quantity'] > 1) {
									foreach ($product['qty_price'] as $qp_value) {
										if ($data['quantity'] >= $qp_value['start'] && $data['quantity'] <= $qp_value['end'] ) {
											$item_1unit_price = calc_product_price(array_merge($data_calc_price,['1unit_price'=>true]));
											break;		
										}
									}
									
								}								

								$total_price = [];
								foreach ($item_price as $curr => $i_price) {
									$total_price[$curr] = [
										'val'=>$data['quantity']*$i_price['val'],
										'currency_code'=>$i_price['currency_code']									
									];
									if (isset($i_price['old_price']) && $i_price['old_price'] > 0) {
										$total_price[$curr]['old_price'] = $i_price['old_price'];
									}
									//цена 1 ед товара
									if (count($item_1unit_price)) {
										$item_price[$curr]['1unit_price'] = $item_1unit_price[$curr]['val'];
									}									
								}

								$cp_name = $cp_name_safe = $cp_mark_val = [];
								foreach ($this->shopConfig->available_lang as $s_lang) {
									$cp_mark = (isset($product['mark'][$s_lang])) ? ' '.$product['mark'][$s_lang] : '';
									$_name = (isset($product['name'][$s_lang])) ? $product['name'][$s_lang] : '';
									$cp_name[$s_lang] = $_name.$cp_mark;
									$cp_name_safe[$s_lang] = $_name;
									$cp_mark_val[$s_lang] = (isset($product['mark'][$s_lang])) ? $product['mark'][$s_lang] : '';
								}
								//
								$_SESSION['cart']['products'][$cart_product_groupe]['pid_'.$prod_id] = [
									'product_id'=>$prod_id,
									'name'=>$cp_name,
									'safe_name'=>$cp_name_safe,
									'mark'=>$cp_mark_val,
									'link'=>build_shop_link(['product_id'=>$prod_id,'alias'=>url_slug($product['name'][$this->config->interface_lang])]),
									'quantity'=>(isset($data['quantity']) && $data['quantity'] > 1) ? $data['quantity'] : 1,
									'item_price'=>$item_price,
									'total_price'=>$total_price,
									'discount'=> (isset($product['discount']) && $product['discount'] > 0) ? $product['discount'] : 0, 
									'product_code'=>(isset($product['product_code'])) ? $product['product_code'] : '',
									'main_img'=>(isset($product['main_img']) && $product['main_img'] !='') ? $product['main_img'] : false,									
									'label'=>(isset($product['label']) && count($product['label'])) ? $product['label'] : false,
									'qty_price'=>(isset($product['qty_price']) && count($product['qty_price'])) ? $product['qty_price'] : [],
									'cart_product_groupe'=>$cart_product_groupe
								];	

								if ($cart_product_groupe == 'with_attributes') {
									$_SESSION['cart']['products'][$cart_product_groupe]['pid_'.$prod_id]['attribute'] = (isset($data['attribute']) && count($data['attribute'])) ? $data['attribute'] : ''; 
								}					


								$this->view_data['data']['cart'] = $_SESSION['cart'];

								// Сообщение. Успех товар добавлен в корзину
								$this->view_data['data']['message'] = [
									'type'=>'ok',
									'text'=>MSG_CART_PRODUCT_ADDED					
								];

							} else {
								// Ошибка. товара нет в магазине
								$this->view_data['data']['message'] = [
									'type'=>'error',
									'text'=>MSG_CART_ERROR_PRODUCT_OUT_STOCK,
									'details'=>$data
								];	
							}

						} else {
							// Ошибка. товара нет в магазине
							$this->view_data['data']['message'] = [
								'type'=>'error',
								'text'=>MSG_CART_ERROR_PRODUCT_OUT_STOCK,
								'details'=>$data
							];	
						} 
					}	else {
						// Ошибка. товар не опубликован
						$this->view_data['data']['message'] = [
							'type'=>'error',
							'text'=>MSG_CART_ERROR_PRODUCT_UNPUBLISHED,
							'details'=>$data
						];
					}			
				}


			}	


		}

		// подсчитываем общую цену в корзине
		if (isset($_SESSION['cart']['products']) && count($_SESSION['cart']['products'])) {
			$cart_subtotal = [];
			$currency_codes = $this->get_currency_codes();

			foreach ($this->get_available_currencies() as $v_curr) {
				$cart_subtotal[$v_curr] = [
					'val'=>0,
					'currency_code'=>$currency_codes[$v_curr]['text']
				];
			}

			foreach ($_SESSION['cart']['products'] as $cp_groupe => $c_product) {				
				foreach ($c_product as $cp_id => $cp_value) {		
					/*echo '--------<br>';*/
					foreach ($cp_value['total_price'] as $tp_curr => $tp_value) {					
						$cart_subtotal[$tp_curr]['val'] += $tp_value['val'];
						/*echo $tp_curr. ': '.$tp_value['val'].' <br>';*/
					}			

				}
			}

			$_SESSION['cart']['cart_subtotal'] = $cart_subtotal;			

		} /*else {
			$_SESSION['cart'] = [];
		}*/

		$this->view_data['data']['cart'] = $_SESSION['cart'];

			
		
	}


	// Обрабатываем новый заказ
	public function process_new_order($data) {		
		$data['order_status'] = $this->config->new_order_status;	
		$data['order_payment_status'] = $this->config->new_order_payment_status;

		$inserted = false; $attempts = 100;

		for ($i=1; $i <= $attempts ; $i++) { 
			//echo 'attempt: <b>'.$i.'</b><br>';

			$order_number = build_order_number();
			$data['order_meta'] = $order_number;

			if ($this->main_model->insert_new_order($data)) {
				$inserted = true;
			} 
			if ($inserted === true) {
				break;
			}
		}

		if ($inserted == true)
		{
			// Успех. Заказ сохранен в БД
			$_SESSION['cart'] = [];
			$this->view_data['data']['cart'] = $_SESSION['cart'];

			$redirect_data = [
				'type'=>'show_order',
				'k'=>$order_number['order_key'],
				'p'=>$order_number['order_pin']
			];

			$this->redirect(build_shop_link($redirect_data));
		}
		
	}


	// Admin ORDERS Actions START
	public function updateOrderProducts($post) {				

		$filterKeys = ['order_number','area','action','order_cart','order_summ','modified_date'];

		$d =[];
		foreach ($post as $kp => $postData) {
			if (!in_array($kp, $filterKeys)) {
				unset($post[$kp]);
			} else {
				$d[$kp] = $postData;
			} 
		}
		
		$vParams = [
			'validationRules'=>[
				'order_number'=>'required|numeric|max_len,16',
				'area'=>'required|exact_len,6|contains,orders',
				'action'=>'required|exact_len,21|contains,update_order_products',
				//
				'order_cart'=>'required|valid_json_string', 
				'order_summ'=>'required|valid_json_string',
				'modified_date'=>'required|numeric|max_len,16'				
			],
			'filterRules'=>[
				'order_number'=>'trim',			
				//
				'order_cart'=>'trim',
				'order_summ'=>'trim',
				'modified_date'=>'trim|sanitize_string'			
			]
		];
		
		$validData = [];
		$validData = $this->validate($d,$vParams);


		// Если валидация провалена
		if ($validData['allValid'] === false) {

			$this->view_data_admin['data']['message'] = [
				'type'=>'error',
				'text'=>$this->i18n->t('MSG_ORDER').' <b>'.format_order_number($validData['validatedData']['order_number'],[4,'-']).'</b> '.$this->i18n->t('MSG_ERROR')
			];

		}

		// Если валидация успешна 
		else {

			$validData['validatedData']['modified_date'] = date("Y-m-d H:i:s",$validData['validatedData']['modified_date']);

			if ($this->main_model_admin->updateOrderProducts($validData['validatedData'])) {

				$this->view_data_admin['data']['message'] = [
					'type'=>'ok',
					'text'=>$this->i18n->t('MSG_ORDER').' <b>'.format_order_number($validData['validatedData']['order_number'],[4,'-']).'</b>. '.$this->i18n->t('MSG_ORDER_PRODUCTS_UPDATED')
				];

			}
			else {

				$this->view_data_admin['data']['message'] = [
					'type'=>'error',
					'text'=>$this->i18n->t('MSG_ORDER').' <b>'.format_order_number($validData['validatedData']['order_number'],[4,'-']).'</b> '.$this->i18n->t('MSG_ERROR')
				];

			}	


		} // End else for if ($validData['allValid'] === false) 

	}


	public function updateOrderBilling($post) {
		$filterKeys = ['order_number','area','action','first_name','second_name','email','phone','address','city','zipcode','order_shipping','order_payment'];

		$d =[];
		foreach ($post as $kp => $postData) {
			if (!in_array($kp, $filterKeys)) {
				unset($post[$kp]);
			} else {
				$d[$kp] = $postData;
			} 
		}
		
		$vParams = [
			'validationRules'=>[
				'order_number'=>'required|numeric|max_len,16',
				'area'=>'required|exact_len,6|contains,orders',
				'action'=>'required|exact_len,20|contains,update_order_billing',
				//
				'first_name'=>'required|utf8_alpha_spase_dash|max_len,35', 
				'second_name'=>'required|utf8_alpha_spase_dash|max_len,40',
				'email'=>'required|valid_email|max_len,60',
				'phone'=>'required|phone_number_ext|max_len,100',
				'address'=>'required|address_ext|max_len,150',
				'city'=>'required|utf8_alpha_spase_dash|max_len,50',
				'zipcode'=>'required|numeric|max_len,8',
				'order_shipping'=>'required|alpha_dash|max_len,35',
				'order_payment'=>'required|alpha_dash|max_len,35'
			],
			'filterRules'=>[
				'order_number'=>'trim',					
				'order_status'=>'trim|sanitize_string',
				//
				'first_name'=>'trim|sanitize_string',
				'second_name'=>'trim|sanitize_string',
				'email'=>'trim|sanitize_string',
				'phone'=>'trim|sanitize_string',
				'address'=>'trim|sanitize_string',
				'city'=>'trim|sanitize_string',
				'zipcode'=>'trim|sanitize_string',
				'order_shipping'=>'trim|sanitize_string',
				'order_payment'=>'trim|sanitize_string'
			]
		];
		
		$validData = [];
		$validData = $this->validate($d,$vParams);

		// Если валидация провалена
		if ($validData['allValid'] === false) {
			$this->view_data_admin['data']['message'] = [
				'type'=>'error',
				'text'=>$this->i18n->t('MSG_WRONG_DATA')
			];

		} 

		// Если валидация пройдена
		else {

			$shipping_methods = $this->get_shipping_methods();
			$shipping_prices = $this->get_shipping_prices();
			//
			$payment_methods = $this->get_payment_methods(); 
			$payment_taxes = $this->get_payment_taxes();			

			$shop_currency = $this->config->shop_currency;  
			$shop_currency_code = $this->config->shop_currency_code;  
			$shop_currency_rate = $this->config->shop_currency_rate;  
			$price_round = $this->config->price_round; 
			$lang = $this->config->interface_lang;
			$order_currency_rates = $this->get_excanges_rates();

			$round_method='';
			switch ($price_round['method']) {
				case 'up':
					$round_method = PHP_ROUND_HALF_UP;
					break;
				case 'down':
					$round_method = PHP_ROUND_HALF_DOWN;
					break;
				case 'even':
					$round_method = PHP_ROUND_HALF_EVEN;
					break;
				case 'odd':
					$round_method = PHP_ROUND_HALF_ODD;
					break;

				default:
					$round_method = PHP_ROUND_HALF_UP;
					break;
			}

			// Формируем сумму к оплате для метода доставки и метода оплаты
			$validated_data = $validData['validatedData'];
			$order_summ = [];

			foreach ($this->get_available_currencies() as $v_curr) {
				$order_shipping_price = $shipping_prices[$validated_data['order_shipping']]*$order_currency_rates[$v_curr];

				$order_payment_price = $payment_taxes[$validated_data['order_payment']]*$order_currency_rates[$v_curr];						

				$order_summ[$v_curr] = [							
					'shipping_price'=>round($order_shipping_price,$price_round['precision'],$round_method),
					'payment_price'=>round($order_payment_price,$price_round['precision'],$round_method)							
				];
			}		

			$updateOrderBillingData = array_merge($validated_data, ['order_summ'=>$order_summ]);

			if ($this->main_model_admin->updateOrderBilling($updateOrderBillingData)) {

				$this->view_data_admin['data']['message'] = [
					'type'=>'ok',
					'text'=>$this->i18n->t('MSG_ORDER').' <b>'.format_order_number($validData['validatedData']['order_number'],[4,'-']).'</b>. '.$this->i18n->t('MSG_ORDER_BILLING_UPDATED')
				];						

			} else {

				$this->view_data_admin['data']['message'] = [
					'type'=>'error',
					'text'=>$this->i18n->t('MSG_ORDER').' <b>'.format_order_number($validData['validatedData']['order_number'],[4,'-']).'</b> '.$this->i18n->t('MSG_ERROR')
				];	

			}	
			
		}
		
	}


	public function updateOrderStatuses($post) {	
		$filterKeys = ['order_number','area','action','order_status','order_payment_status'];

		$d =[];
		foreach ($post as $kp => $postData) {
			if (!in_array($kp, $filterKeys)) {
				unset($post[$kp]);
			} else {
				$d[$kp] = $postData;
			} 
		}
		
		$vParams = [
			'validationRules'=>[
				'order_number'=>'required|numeric|max_len,16',
				'area'=>'required|exact_len,6|contains,orders',
				'action'=>'required|exact_len,19|contains,change_order_status',
				'order_status'=>'required|alpha|max_len,12', 
				'order_payment_status'=>'required|alpha_dash|max_len,12'
			],
			'filterRules'=>[
				'order_number'=>'trim',					
				'order_status'=>'trim|sanitize_string',
				'order_payment_status'=>'trim|sanitize_string'
			]
		];

		$validData = [];
		$validData = $this->validate($d,$vParams);

		// Если валидация провалена
		if ($validData['allValid'] === false) {
			$this->view_data_admin['data']['message'] = [
				'type'=>'error',
				'text'=>$this->i18n->t('MSG_WRONG_DATA')
			];

		} 

		// Если валидация пройдена
		else {

			if ($this->main_model_admin->updateOrderStatuses($validData['validatedData'])) {

				$this->view_data_admin['data']['message'] = [
					'type'=>'ok',
					'text'=>$this->i18n->t('MSG_ORDER').' <b>'.format_order_number($validData['validatedData']['order_number'],[4,'-']).'</b> '.$this->i18n->t('MSG_ORDER_UPDATED')
				];						

			} else {

				$this->view_data_admin['data']['message'] = [
					'type'=>'error',
					'text'=>$this->i18n->t('MSG_ORDER').' <b>'.format_order_number($validData['validatedData']['order_number'],[4,'-']).'</b> '.$this->i18n->t('MSG_ERROR')
				];	

			}			

			
		}
		
	}

	public function deleteOrder($post) {

		$filterKeys = ['order_number','area','action'];

		$d =[];
		foreach ($post as $kp => $postData) {
			if (!in_array($kp, $filterKeys)) {
				unset($post[$kp]);
			} else {
				$d[$kp] = $postData;
			} 
		}
		
		$vParams = [
			'validationRules'=>[				
				'order_number'=>'required|numeric|max_len,16',
				'area'=>'required|exact_len,6|contains,orders',
				'action'=>'required|exact_len,12|contains,delete_order'				
			],
			'filterRules'=>[]
		];

		$validData = [];
		$validData = $this->validate($d,$vParams);		

		// Если валидация провалена
		if ($validData['allValid'] === false) {
			$this->view_data_admin['data']['message'] = [
				'type'=>'error',
				'text'=>$this->i18n->t('MSG_WRONG_DATA')
			];

		} 

		// Если валидация пройдена
		else {

			if ($this->main_model_admin->deleteOrder($validData['validatedData']['order_number'])) {

				$this->view_data_admin['data']['message'] = [
					'type'=>'ok',
					'text'=>$this->i18n->t('MSG_ORDER').' <b>'.format_order_number($validData['validatedData']['order_number'],[4,'-']).'</b>. '.$this->i18n->t('MSG_ORDER_DELETED')
				];

			}
			else {

				$this->view_data_admin['data']['message'] = [
					'type'=>'error',
					'text'=>$this->i18n->t('MSG_ORDER').' <b>'.format_order_number($validData['validatedData']['order_number'],[4,'-']).'</b> '.$this->i18n->t('MSG_ERROR')
				];

			}	
			


		}
		
	}



	public function getFilters($area = 'admin', $page = '', $global = false) {
		$return = $_SESSION['filters'];

		if (!$global) {
			if (is_string($area) && !empty($area) && is_string($page) && !empty($page)) {
				$return = isset($_SESSION['filters'][$area][$page]) ? $_SESSION['filters'][$area][$page] : [];	
			}

			if (is_string($area) && !empty($area) && empty($page) ) {
				$return = isset($_SESSION['filters'][$area]) ? $_SESSION['filters'][$area] : [];		
			}
		}	

		return $return;		
	}

	public function setFilters($post) {		

		$filterKeys = ['area','action','order_number','section','order_status','order_payment_status'];

		$d =[];
		foreach ($post as $kp => $postData) {
			if (!in_array($kp, $filterKeys)) {
				unset($post[$kp]);
			} else {
				$d[$kp] = $postData;
			} 
		}
		
		$vParams = [
			'validationRules'=>[				
				'area'=>'required|exact_len,6|contains,orders',
				'action'=>'required|exact_len,13|contains,filter_orders',
				'section'=>'required|max_len,5|contains,admin',
				'order_number'=>'alpha_dash|max_len,20',				
				'order_status'=>'required|alpha_dash|max_len,35',
				'order_payment_status'=>'required|alpha_dash|max_len,35'
			],
			'filterRules'=>[
				'order_number'=>'trim'
			]
		];

		$validData = [];
		$validData = $this->validate($d,$vParams);		

		// Если валидация провалена
		if ($validData['allValid'] === false) {
			$this->view_data_admin['data']['message'] = [
				'type'=>'error',
				'text'=>$this->i18n->t('MSG_WRONG_DATA')
			];

		} 

		// Если валидация пройдена
		else {
			$section = $validData['validatedData']['section'];
			$area = $validData['validatedData']['area'];
			$orderNumber = '';

			if (strpos($validData['validatedData']['order_number'], '-') === false) {
				$orderNumber = $validData['validatedData']['order_number'];
			} else {
				foreach (explode('-', $validData['validatedData']['order_number']) as $substrOrderNum) {
				 	$orderNumber .= $substrOrderNum;
				}				
			}

			$filters = [];
			$filters[$section][$area] = [
				'order_number' => $orderNumber,
				'order_status' =>$validData['validatedData']['order_status'],
				'order_payment_status' =>$validData['validatedData']['order_payment_status']
			];

			foreach ($filters[$section][$area] as $fk => $fval) {
				if (empty($fval)) {
					unset($filters[$section][$area][$fk]);
				}
			}

			$_SESSION['filters'] = array_replace_recursive($_SESSION['filters'], $filters);			

		}
	}


	public function resetFilters($post) {		
		$filterKeys = ['area','action','section'];

		$d =[];
		foreach ($post as $kp => $postData) {
			if (!in_array($kp, $filterKeys)) {
				unset($post[$kp]);
			} else {
				$d[$kp] = $postData;
			} 
		}
		
		$vParams = [
			'validationRules'=>[				
				'area'=>'required|exact_len,6|contains,orders',
				'action'=>'required|exact_len,13|contains,reset_filters',
				'section'=>'required|max_len,5|contains,admin'				
			],
			'filterRules'=>[]
		];

		$validData = [];
		$validData = $this->validate($d,$vParams);		

		// Если валидация провалена
		if ($validData['allValid'] === false) {
			$this->view_data_admin['data']['message'] = [
				'type'=>'error',
				'text'=>$this->i18n->t('MSG_WRONG_DATA')
			];

		} 

		// Если валидация пройдена
		else {
			$section = $validData['validatedData']['section'];
			$area = $validData['validatedData']['area'];

			$_SESSION['filters'][$section][$area] = [];						

		}
	}



	public function getRecordsPerPage($area = 'admin', $page = '') {

		if (empty($area) && empty($area) || empty($area) || empty($page)) {

			return $_SESSION['recordsPerPage']['global'];

		} 
		else if (!empty($area) && !empty($page)) {

			return (isset($_SESSION['recordsPerPage'][$area][$page]) && $_SESSION['recordsPerPage'][$area][$page] > 0 ) ? $_SESSION['recordsPerPage'][$area][$page] : $_SESSION['recordsPerPage']['global'];	
		}
		
	}

	public function setRecordsPerPage($post) {
		$filterKeys = ['area','action','rpp_value'];

		$d =[];
		foreach ($post as $kp => $postData) {
			if (!in_array($kp, $filterKeys)) {
				unset($post[$kp]);
			} else {
				$d[$kp] = $postData;
			} 
		}
		
		$vParams = [
			'validationRules'=>[				
				'area'=>'required|exact_len,6|contains,orders',
				'action'=>'required|exact_len,23|contains,change_records_per_page',
				'rpp_value'=>'required|numeric|max_len,9'				
			],
			'filterRules'=>[
				'rpp_value'=>'trim'
			]
		];

		$validData = [];
		$validData = $this->validate($d,$vParams);

		// Если валидация провалена
		if ($validData['allValid'] === false) {
			$this->view_data_admin['data']['message'] = [
				'type'=>'error',
				'text'=>$this->i18n->t('MSG_WRONG_DATA')
			];

		} 

		// Если валидация пройдена
		else {
				$_SESSION['recordsPerPage']['admin'][$validData['validatedData']['area']] = $validData['validatedData']['rpp_value'];			
		}
	}

	// Admin ORDERS Actions END






	public function get_cryptor() {
		return $this->cryptor;
	}

	public function get_products() {
		// Получаем товары
		require(LIB_DIR.DS.'products'.DS.'products.php');
		$this->products = $shop_products;
		return $this->products;
	}

	public function get_product_by_id($product_id) {	
		return $this->products[$product_id];
	}

	public function get_related_products($product_id) {
		$relProducts = [];
		$product = $this->get_product_by_id($product_id);
		$relProductsIds = $product['related_products'];
		if (count($relProductsIds)) {
			foreach ($relProductsIds as $rProduct) {
				$_rProduct = $this->get_product_by_id($rProduct);
				//
				if ($_rProduct['published']) {
					$_rProduct['link'] = build_shop_link(
						[
							'product_id'=>$_rProduct['product_id'],
							'alias'=>url_slug($_rProduct['name'][$this->config->interface_lang])
						]
					);
					$calcProductPrice = [
						'price_no_tax'=>$_rProduct['price_no_tax'],
						'tax'=>$_rProduct['tax'],
						'discount'=>$_rProduct['discount'],
						'quantity'=>1,
						'qty_price'=>$_rProduct['qty_price'],		
						'price_round'=>$this->config->price_round,					
						'currency'=>[
							'available_currencies'=>$this->get_available_currencies(),
							'excanges_rates'=>$this->get_excanges_rates(),
							'currency_codes'=>$this->get_currency_codes()					
						]			
					];
					$_rProduct['price'] = calc_product_price($calcProductPrice);
					$relProducts[$rProduct] = $_rProduct;	
				}

			}
		}

		
		return $relProducts;
	}

	public function get_homepage_slides() {
		return $this->homepage_slides;
	}

	public function get_product_collections() {
		return $this->product_collections;
	}

	public function get_product_categories() {
		return $this->product_categories;
	}


	// Отзывы о товарах
	public function get_product_reviews() {
		
	}








	public function get_config() {
		return $this->config;
	}

	public function get_cart() {
		return $_SESSION['cart'];
	}

	public function get_orders() {
		return $this->orders;
	}

	public function get_finished_order() {
		return $_SESSION['finished_orders'];
	}

	public function get_order_info($order_key) {
		return 'YV_LiteShop::get_order_info('.$order_key.')';
	}

	// shipping_methods
	public function get_shipping_methods() {
		return $this->config->shipping_methods;
	}

	// shipping_prices
	public function get_shipping_prices() {
		return $this->config->shipping_prices;
	}

	// payment_methods
	public function get_payment_methods() {
		return $this->config->payment_methods;
	}

	// payment_taxes
	public function get_payment_taxes() {
		return $this->config->payment_taxes;
	}

	// order_statuses
	public function get_order_statuses() {
		return $this->config->order_statuses;
	}

	// payment_taxes
	public function get_order_colors() {
		return $this->config->order_colors;
	}

	// shop_currency
	public function get_shop_currency() {
		return $this->config->shop_currency;
	}

	// shop_currency_rate
	public function get_shop_currency_rate() {
		return $this->config->shop_currency_rate;
	}

	// shop_currency_code
	public function get_shop_currency_code() {
		return $this->config->shop_currency_code;
	}

	// default_currency
	public function get_default_currency() {
		return $this->config->default_currency;
	}

	// main_currency
	public function get_main_currency() {
		return $this->config->main_currency;
	}

	// available_currencies
	public function get_available_currencies() {
		return $this->shopConfig->available_currencies;
	}	

	// excanges_rates
	public function get_excanges_rates() {
		return $this->shopConfig->excanges_rates;
	}

	// currency_codes
	public function get_currency_codes() {
		return $this->shopConfig->currency_codes;
	}

	// product_attributes
	public function get_available_attributes() {
		return $this->shopConfig->product_attributes;
	}	

	public function set_interface_lang($lang) {
		$_SESSION['shop_language'] = $lang;
		$this->config->interface_lang = $lang;
	}

	public function set_shop_currency($curr) {
		$_SESSION['shop_currency'] = $curr;
		$this->config->shop_currency = $curr;		
	}

	public function redirect($url,$permanent = false) {
		if (headers_sent() === false) {
        header('Location: ' . $url, true);
        exit();
    }  
	}




}

 ?>