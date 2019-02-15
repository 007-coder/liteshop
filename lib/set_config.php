<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

$this->db_database ='liteshop'; 
$this->db_username ='root';
$this->db_password ='vertrigo';
$this->db_host ='localhost';

//
$this->seo['site_name'] = 'Название сайта.'; 
$this->seo['meta_title'] = 'Название сайта. Главная'; 
$this->seo['meta_desc'] = 'Мета описание главной страницы'; 
$this->seo['meta_keywords'] = 'Мета ключевые слова главной страницы'; 
$this->seo['uri_base'] = 'http://localhost/liteshop';


$this->uri_shop_media['media'] = $this->seo['uri_base'].'/shop_media/';
$this->uri_shop_media['img_products'] = $this->seo['uri_base'].'/shop_media/img_products/';
$this->uri_shop_media['img_slides'] = $this->seo['uri_base'].'/shop_media/img_slides/';
$this->uri_shop_media['img_labels'] = $this->seo['uri_base'].'/shop_media/img_labels/';
$this->uri_shop_media['files_products'] = $this->seo['uri_base'].'/shop_media/files_products/';
$this->absPath_shop_media['media'] = BASE_DIR.DS.'shop_media'.DS;
$this->absPath_shop_media['img_products'] = $this->absPath_shop_media['media'].'img_products'.DS;
$this->absPath_shop_media['img_slides'] = $this->absPath_shop_media['media'].'img_slides'.DS;
$this->absPath_shop_media['img_labels'] = $this->absPath_shop_media['media'].'img_labels'.DS;
$this->absPath_shop_media['files_products'] = $this->absPath_shop_media['media'].'files_products'.DS;


if(!defined('URI_NOIMG_PRODUCT')) {
	define('URI_NOIMG_PRODUCT', $this->uri_shop_media['img_products'].'noimg_product.jpg');
}
if(!defined('URI_NOIMG_CATEGORY')) {
	define('URI_NOIMG_CATEGORY', $this->uri_shop_media['img_products'].'no_img.jpg');
}
if(!defined('URI_NOIMG_MANUFACTURER')) {
	define('URI_NOIMG_MANUFACTURER', $this->uri_shop_media['img_products'].'no_img.jpg');
}




// язык по умолчанию
$this->default_lang ='ru_RU';
$this->available_lang = ['ru_RU','uk_UA'];	
$this->lang_codes = [
	'ru_RU'=>[
		'text'=>LANG_TEXT_RU,
		'iso_code'=>'ru',
		'symbol'=>''
	],
	'uk_UA'=>[
		'text'=>LANG_TEXT_UA,
		'iso_code'=>'ua',
		'symbol'=>''
	]	
];

$this->available_currencies = ['uah','usd','rur'];
$this->default_currency ='uah';
$this->main_currency = 'uah';
$this->excanges_rates = [
	'uah' => 1,
	'usd'=>0.03,
	'rur'=>2.4
];
$this->currency_codes = [
	'uah'=>[
		'text'=>CURRENCY_CODE_TEXT_UAH,
		'symbol'=>''
	],
	'usd'=>[
		'text'=>CURRENCY_CODE_TEXT_USD,
		'symbol'=>''
	],
	'rur'=>[
		'text'=>CURRENCY_CODE_TEXT_RUR,
		'symbol'=>''
	]
];

$this->shipping_methods = [
	[
		'code'=>'sm_nova_posta_office',
		'publish'=>true,
		'name'=>[
			'ru_RU'=>'Новая Почта. Отделение.',
			'uk_UA'=>''
		],
		'icon'=>''
	],
	[
		'code'=>'sm_nova_posta_to_home',
		'publish'=>true,
		'name'=>[
			'ru_RU'=>'Новая Почта. К двери.',
			'uk_UA'=>''
		],
		'icon'=>''
	],			
	[
		'code'=>'sm_ukr_posta_office',
		'publish'=>true,
		'name'=>[
			'ru_RU'=>'УкрПочта. Отделение.',
			'uk_UA'=>''
		],
		'icon'=>''
	],
	[
		'code'=>'sm_ukr_posta_home',
		'publish'=>true,
		'name'=>[
			'ru_RU'=>'УкрПочта. К двери.',
			'uk_UA'=>''
		],
		'icon'=>''
	]			
];
$this->payment_methods = [
	[
		'code'=>'pm_privat24',
		'publish'=>true,
		'name'=>[
			'ru_RU'=>'Приват 24',
			'uk_UA'=>''
		],
		'icon'=>''
	],
	[
		'code'=>'pm_nova_posta_nalogka',
		'publish'=>true,
		'name'=>[
			'ru_RU'=>'Новая Почта. Наложеный платеж.',
			'uk_UA'=>''
		],
		'icon'=>''
	]
];

// Цены на доставку, оплату устанавливаются в основной валюте
$this->shipping_prices = [
	'sm_nova_posta_office'=>30, 
	'sm_nova_posta_to_home'=>30, 
	'sm_ukr_posta_office'=>20, 
	'sm_ukr_posta_home'=>15 
];

$this->payment_taxes = [
	'pm_privat24'=>10, 
	'pm_nova_posta_nalogka'=>25			
];



// Настройки округления цен
$this->price_round = [
	// точность. кол-во десятичных знаков
	'precision'=>2, 
	// Метод округления 
	'method'=>'up' // up|down|even|odd 
];



$this->template_content['social_accounts'] = [
	'twitter'=>'#',
	'google-plus'=>'#',
	'facebook'=>'#',
	'youtube'=>'#'
];


$this->template_content['contacts'] = [
	// Телефоны
	'phones'=>[
		'kyivstar'=>'068-3333-33-22',
		'vodafon'=>'',
		'lifecell'=>'',
		'city'=>'',
		'hotline'=>''
	],
	// Имейлы
	'emails'=>[
		'contacts'=>'contacts@mail.com',
		'support'=>'',
		'sales'=>'',
		'opt_sales'=>''
	],
	// Адреса
	'locations'=>[
		'shop'=>'Адрес магазина, 45',
		'main_office'=>'',
		'add_office'=>'',
		'service_center'=>''
	],
	// Социальные аккаунты. Устанавл автоматич из Настр. СОЦИАЛЬНЫХ АККАУНТОВ
	'social_accounts'=>$this->template_content['social_accounts']
];


/**
----------Настр ГРАФИК РАБОТЫ Старт----------
**/
$this->template_content['working_times'] = [
	'ПН - ПТ:'=> '10:00 - 22:00',
	'СБ - ВС:'=> '15:00 - 20:00'
]; 
/**
----------Настр ГРАФИК РАБОТЫ конец----------
**/




$this->template_content['main_menu'] = [
	[
		'title'=>[
			'ru_RU'=>'Главная',
			'uk_UA'=>''
		],
		'link'=>$this->seo['uri_base'],
		'submenu'=>[]
	],
	//
	[
		'title'=>[
			'ru_RU'=>'Меню 1',
			'uk_UA'=>''
		],
		'link'=>'#',
		'submenu'=>[]
	],
	//
	[
		'title'=>[
			'ru_RU'=>'Меню 2',
			'uk_UA'=>''
		],
		'link'=>'#',
		'submenu'=>[]
	],
	//
	[
		'title'=>[
			'ru_RU'=>'Меню 3',
			'uk_UA'=>''
		],
		'link'=>'#',
		'submenu'=>[]
	],
	//
	[
		'title'=>[
			'ru_RU'=>'Меню 4',
			'uk_UA'=>''
		],
		'link'=>'#',
		'submenu'=>[]
	]
];

$this->template_content['homepage_slides'] = [
	[
		'img'=>[
			'file'=>'slide9.jpg',
			'alt'=>[
				'ru_RU'=>'Альт текст для слайда 1',
				'uk_UA'=>''
			]
		],
		'content' =>[
			'text1'=>[
				'ru_RU'=>'Слайд 1 текст 1',
				'uk_UA'=>''
			],
			'text2'=>[
				'ru_RU'=>'Слайд 1 текст 2',
				'uk_UA'=>''
			]
		],		
		'link'=>'sdfds'
	],
	[
		'img'=>[
			'file'=>'slide8.jpg',
			'alt'=>[
				'ru_RU'=>'Альт текст для слайда 2',
				'uk_UA'=>''
			]
		],
		'content' =>[
			'text1'=>[
				'ru_RU'=>'Слайд 2 текст 1',
				'uk_UA'=>''
			],
			'text2'=>[
				'ru_RU'=>'Слайд 2 текст 2',
				'uk_UA'=>''
			]
		],		
		'link'=>'sdfsdf'
	]
];

$this->template_content['homepage_services'] = [
	[
		'title'=>[
			'ru_RU'=>'Сервис 1',
			'uk_UA'=>''	
		],
		'descr'=>[
			'ru_RU'=>'Сервис 1 Описание',
			'uk_UA'=>''	
		],
		'icon_class'=>'fa-bus'
	],
	[
		'title'=>[
			'ru_RU'=>'Сервис 2',
			'uk_UA'=>''	
		],
		'descr'=>[
			'ru_RU'=>'Сервис 2 Описание',
			'uk_UA'=>''	
		],
		'icon_class'=>'fa-credit-card'
	],
	[
		'title'=>[
			'ru_RU'=>'Сервис 3',
			'uk_UA'=>''	
		],
		'descr'=>[
			'ru_RU'=>'Сервис 3 Описание',
			'uk_UA'=>''	
		],
		'icon_class'=>'fa-phone'
	],
	[
		'title'=>[
			'ru_RU'=>'Сервис 4',
			'uk_UA'=>''	
		],
		'descr'=>[
			'ru_RU'=>'Сервис 4 Описание',
			'uk_UA'=>''	
		],
		'icon_class'=>'fa-briefcase'
	]
];

$this->template_content['after_hp_services_products'] = [1,2,3,4,5];
$this->template_content['hp_featured_products'] = [
	'title'=>[
		'ru_RU'=>'Избранные товары',
		'uk_UA'=>''
	],
	'products'=>[1,2,3,4,5,6,7]
];
$this->template_content['hp_categories_products'] = [
	'title'=>[
		'ru_RU'=>'Наши коллекции',
		'uk_UA'=>''
	],
	'products'=>[
		1=>[1,2,3],
		2=>[3,4,5],
		3=>[6,7,8]
	]	
];



/**
----------Настр ФУТЕРА Старт----------
**/
$this->template_content['footer'] = [

	// Футер верх
	'col1' =>[ // 1я колонка
		'heading'=>[  // Заголовок колонки
			'ru_RU'=>'О нас',  
			'uk_UA'=>''		
		],

		// Контент колонки. 
		// Доступно 5 вида контента logo / text / menu / contacts_list / social
		'content'=>[ 

			'logo'=>[ // Тип контента лого
				'link'=>$this->seo['uri_base']
			],

			'text'=>[ // Тип контента text
				'ru_RU'=>'Мега текст с кратким рассказом кто мы такие и чем мы занимаемся.',
				'uk_UA'=>''			
			],

			'menu'=>[ // Тип контента menu
				[
					'name'=>[
						'ru_RU'=>'Ссылка 1',  
						'uk_UA'=>''	
					],
					'link'=>'#'
				],
				[
					'name'=>[
						'ru_RU'=>'Ссылка 2',  
						'uk_UA'=>''	
					],
					'link'=>'#'
				],
				[
					'name'=>[
						'ru_RU'=>'Ссылка 3',  
						'uk_UA'=>''	
					],
					'link'=>'#'
				]
			], 

			'contacts_list'=>[ // Тип контента contacts_list				
			],	

			'social'=> $this->template_content['social_accounts']
		]		
	],

	// 2я колонка
	'col2'=>[ 
		'heading'=>[  // Заголовок колонки
			'ru_RU'=>'Колонка 2',  
			'uk_UA'=>''		
		],
		'content'=>[  // Контент колонки. Доступно 4 вида контента text / menu / contacts_list / social
			'menu'=>[ // Тип контента menu
				[
					'name'=>[
						'ru_RU'=>'Ссылка 1',  
						'uk_UA'=>''	
					],
					'link'=>'#'
				],
				[
					'name'=>[
						'ru_RU'=>'Ссылка 2',  
						'uk_UA'=>''	
					],
					'link'=>'#'
				],
				[
					'name'=>[
						'ru_RU'=>'Ссылка 3',  
						'uk_UA'=>''	
					],
					'link'=>'#'
				]
			]
		]

	],

	// 3я колонка
	'col3'=>[
		'heading'=>[  // Заголовок колонки
			'ru_RU'=>'Колонка 3',  
			'uk_UA'=>''		
		],
		'content'=>[  // Контент колонки. Доступно 4 вида контента text / menu / contacts_list / social
			'menu'=>[ // Тип контента menu
				[
					'name'=>[
						'ru_RU'=>'Ссылка 1',  
						'uk_UA'=>''	
					],
					'link'=>'#'
				],
				[
					'name'=>[
						'ru_RU'=>'Ссылка 2',  
						'uk_UA'=>''	
					],
					'link'=>'#'
				],
				[
					'name'=>[
						'ru_RU'=>'Ссылка 3',  
						'uk_UA'=>''	
					],
					'link'=>'#'
				]
			]
		]

	],

	// 4я колонка
	'col4'=>[
		'heading'=>[  // Заголовок колонки
			'ru_RU'=>'Колонка 4',  
			'uk_UA'=>''		
		],
		'content'=>[ 
			'contacts_list'=>$this->template_content['contacts']
		]
	],



	// Футер низ
	// Иконки
	'footer_bottom_right'=>[		
		'icons'=>['visa.png','amarcan.png','discover.png','mastercard.png']
	],
	// Авторское право. 
	//Если будет отсутствовать мой копирайт (Разработка и поддержка: Вакуленко Юрий.) не смогу поддерживать ваш сайт в случае возникновения проблем! Присутствие моего копирайта отслеживается. Я узнаю, если он будет убран. Надеюсь, на ваше понимаение. 
	'footer_copyrights'=>	[
		'ru_RU'=>'Авторское право © <a href="'.$this->seo['uri_base'].'">www.site.com</a> Все права защищены.',
		'uk_UA'=>''	
	]
	
];
/**
----------Настр ФУТЕРА Конец----------
**/









// Настройка предустановленных атрибутов
$this->product_attributes = [
	'color'=>[  
		'name'=>[
			'ru_RU'=>'Цвет',
			'uk_UA'=>''	
		],
		'options'=>[
			'color_1'=> [
				'id'=>1,
				'name'=>[
					'ru_RU'=>'Белый',
					'uk_UA'=>''	
				],
				'tax'=>0,
				'color_hex'=>'#fff',
				'img'=>''			
			],
			'color_2'=> [
				'id'=>2,
				'name'=>[
					'ru_RU'=>'Черный',
					'uk_UA'=>''	
				],
				'tax'=>0,
				'color_hex'=>'#000',
				'img'=>''	
			],
			'color_3'=> [
				'id'=>3,
				'name'=>[
					'ru_RU'=>'Зеленый',
					'uk_UA'=>''	
				],
				'tax'=>0,
				'color_hex'=>'#efefef',
				'img'=>''				
			]	
		]			
	],

	'size'=>[
		'name'=>[
			'ru_RU'=>'Размер',
			'uk_UA'=>''	
		],
		'options'=>[
			'size_1'=> [
				'id'=>1,
				'name'=>[
					'ru_RU'=>'5,5"',
					'uk_UA'=>''	
				],
				'tax'=>0,
				'color_hex'=>'',
				'img'=>''			
			],
			'size_2'=> [
				'id'=>2,
				'name'=>[
					'ru_RU'=>'6"',
					'uk_UA'=>''	
				],
				'tax'=>0,
				'color_hex'=>'',
				'img'=>''			
			],
			'size_3'=> [
				'id'=>3,
				'name'=>[
					'ru_RU'=>'M',
					'uk_UA'=>''	
				],
				'tax'=>0,
				'color_hex'=>'',
				'img'=>''			
			],
			'size_4'=> [
				'id'=>4,
				'name'=>[
					'ru_RU'=>'XL',
					'uk_UA'=>''	
				],
				'tax'=>0,
				'color_hex'=>'',
				'img'=>''			
			]	
		]
	]
];











$this->shop_template ='kiosk';

 ?>