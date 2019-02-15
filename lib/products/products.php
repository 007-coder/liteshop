<?php 
defined('YV_LiteShop') or die ('Restricted Access!');
$shop_products = []; // не трогать!

/*
В этом файле содержатся все товары вашего магазина!
Это каталог товаров. Здесь вы можете управлять всеми вашими товарами. 
 */


$prod_id = 1; //id товара - Целое число больше 0. Менять обязательно при добавлении нового товара. Не должно повторятся!
$shop_products[$prod_id] = [
	'product_id'=>$prod_id, // Не менять! Это id товара

	// Старт Правок
	'published'=>true, // Опубликвывно. true | false
	'in_stock'=>true, // В магазине и доступно для продажи. true | false
	'items_left'=>'unlim', // кол-во товара для продажи 'unlim' | 0-99999999999	
	'for_homepage'=>true, // true | false	
	'name'=>[
		'ru_RU'=>'Пленка защитная для IPhone', // Название товара
		'uk_UA'=>'',
	],
	'mark'=>[
		'ru_RU'=>'Белая', // Название товара
		'uk_UA'=>'',
	],
	//
	'short_descr'=>[
		'ru_RU'=>'Краткое описание товара. Показывается после цены.',
		'uk_UA'=>'',
	],
	'full_descr'=>[
		'ru_RU'=>'',
		'uk_UA'=>'',
	],
	'meta_desc'=>[
		'ru_RU'=>'мЕТА ОПИСАНИЕ ТОВАРА', // Название товара
		'uk_UA'=>'',
	],
	'meta_keywords'=>[
		'ru_RU'=>'МЕТА КЛЮЧ СЛОВА', // Название товара
		'uk_UA'=>'',
	],
	'product_code'=>'xfd5675', // Код товара (в вашем магазине)
	'product_code2'=>'', // Дополнит Код товара (в магазине где вы закупали товар)
	//
	'price_no_tax'=>15, // Цена в ОСНОВНОЙ ВАЛЮТЕ без НАЦЕНКИ в формате 1 | 1.1234
	'tax'=>0.1, // наценка процент. Если 0%=0, 5%=0.05, 10%=0.1, 15%=0.15, 20%=0.2, 100%=1 т.д.
	'discount'=>0, // Скидка процент в Основной валюте ,

	// Цена при заказе большого кол-ва. Если не требуется, оставьте пустым  
	'qty_price'=>[ 
		'5-25'=> [  
			'start'=>5, 
			'end'=>25,
			'discount'=>0.1 // Скидка в процентах  			 
		],
		'26-50'=>[
			'start'=>26,
			'end'=>50,
			'discount'=>0.2		
		],
		'51-100'=>[
			'start'=>51,
			'end'=>100,
			'discount'=>0.7			
		]
	],

	/* Аттрибуты - это такие опции, модификации, модели товара, 
	которые должен выбрать пользователь и вы ему должны отправить товар
	именно в той комплектации которую заказали. 
	Аттрибуты так же могут влиять на конечную стоимость товара. */
	'attributes'=>[
		'color'=>[
			'options'=>[
				'color_1' =>[
					'color_hex'=>'#ddd',
					'img'=>'attr_img.jpg',
					'tax'=>0
				],
				'color_3' =>[
					'tax'=>0.25
				]
			]			
		],
		'size'=>[
			'options'=>[
				'size_1'=>[
					'tax'=>0.05
				],
				'size_2'=>[
					'tax'=>0.15
				],
				'size_15'=>[
					'tax'=>0.15
				]
			]
			
		]
	],

	'promo_period'=>[
		'start'=>'25.12.2018 22:00:00', //25.12.2018 22:00:00
		'end'=>'28.12.2018 22:00:00' //25.12.2018 22:00:00
	],	
	'images'=>[],
	'main_img'=>'',
	'label'=>[
		// метка 1
		'l1'=>[
			'text'=>[
				'ru_RU'=>'Черная метка',
				'uk_UA'=>'',
			],
			'img'=>''
		]
	],
	'video'=>[],
	'files'=>[],
	'related_products'=>[2]	
];

$prod_id = 2; //id товара - Целое число больше 0. Менять обязательно при добавлении нового товара. Не должно повторятся!
$shop_products[$prod_id] = [
	'product_id'=>$prod_id, // Не менять! Это id товара

	// Старт Правок
	'published'=>true, // Опубликвывно. true | false
	'in_stock'=>true, // В магазине и доступно для продажи. true | false
	'items_left'=>'unlim', // кол-во товара для продажи 'unlim' | 0-99999999999		
	'for_homepage'=>true, // true | false	
	'name'=>[
		'ru_RU'=>'Мега мобильный телнфон', // Название товара
		'uk_UA'=>'',
	],
	'mark'=>[
		'ru_RU'=>'Крутейший', // Название товара
		'uk_UA'=>'',
	],
	//
	'short_descr'=>[
		'ru_RU'=>'Краткое описание товара. Показывается после цены.',
		'uk_UA'=>'',
	],
	'full_descr'=>[
		'ru_RU'=>'Полное описание товара . МОжно испольщовать HTML',
		'uk_UA'=>'',
	],
	'meta_desc'=>[
		'ru_RU'=>'мЕТА ОПИСАНИЕ ТОВАРА', // Название товара
		'uk_UA'=>'',
	],
	'meta_keywords'=>[
		'ru_RU'=>'МЕТА КЛЮЧ СЛОВА', // Название товара
		'uk_UA'=>'',
	],
	'product_code'=>'dsf56464', // Код товара (в вашем магазине)
	'product_code2'=>'', // Дополнит Код товара (в магазине где вы закупали товар)
	//
	'price_no_tax'=>125, // Цена в ОСНОВНОЙ ВАЛЮТЕ без НАЦЕНКИ в формате 1 | 1.1234
	'tax'=>0.1, // наценка процент. Если 0%=0, 5%=0.05, 10%=0.1, 15%=0.15, 20%=0.2, 100%=1 т.д.
	'discount'=>0.06, // Скидка процент в Основной валюте ,
	
	// Цена при заказе большого кол-ва. Если не требуется, оставьте пустым  
	'qty_price'=>[ 
		'5-25'=> [  
			'start'=>5, 
			'end'=>25,
			'discount'=>0.1 // Скидка в процентах  			 
		],
		'26-50'=>[
			'start'=>26,
			'end'=>50,
			'discount'=>0.2		
		],
		'51-100'=>[
			'start'=>51,
			'end'=>100,
			'discount'=>0.7			
		]
	],
	'specifications'=>[
		[
			'name'=>[
				'ru_RU'=>'Характеристика 1',
				'uk_UA'=>''
			],
			'val'=>[
				'ru_RU'=>'Значение 1',
				'uk_UA'=>''
			]
		],
		[
			'name'=>[
				'ru_RU'=>'Характеристика 2',
				'uk_UA'=>''
			],
			'val'=>[
				'ru_RU'=>'Значение 2',
				'uk_UA'=>''
			]
		],
		[
			'name'=>[
				'ru_RU'=>'Характеристика 3',
				'uk_UA'=>''
			],
			'val'=>[
				'ru_RU'=>'Значение 3',
				'uk_UA'=>''
			]
		]
	],

	/* Аттрибуты - это такие опции, модификации, модели товара, 
	которые должен выбрать пользователь и вы ему должны отправить товар
	именно в той комплектации которую заказали. 
	Аттрибуты так же могут влиять на конечную стоимость товара. */
	'attributes'=>[],

	'promo_period'=>[
		'start'=>'25.12.2018 22:00:00', //25.12.2018 22:00:00
		'end'=>'28.12.2018 22:00:00' //25.12.2018 22:00:00
	],	
	'images'=>['img1.jpg','img2.jpg','img3.jpg','img4.jpg'],
	'main_img'=>'img1.jpg',
	'label'=>[
		// метка 1
		'l1'=>[
			'text'=>[
				'ru_RU'=>'Черная метка',
				'uk_UA'=>'',
			],
			'img'=>''
		]
	],
	'video'=>['ghjgjgj','dfdsfdsf','dfdsfdsf'],
	'files'=>[
		[
			'file'=>'file.pdf',
			'name'=>[
				'ru_RU'=>'Файл 1',
				'uk_UA'=>'',
			]
		],
		[
			'file'=>'file.jpg',
			'name'=>[
				'ru_RU'=>'Файл 2',
				'uk_UA'=>'',
			]
		],
		[
			'file'=>'file.zip',
			'name'=>[
				'ru_RU'=>'Файл 3',
				'uk_UA'=>'',
			]
		]
	],
	'related_products'=>[1]
];



 ?>