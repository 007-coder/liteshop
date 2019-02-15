<?php 
//
$this->admins = [
	'admin'=>[
		'login'=>'admin',
		'password'=>'admin',		
		'group_politics' =>'grand' // 'grand' | 'manager' | 'administrator'
	]
];

// язык по умолчанию
$this->admin_available_lang = [
	'ru_RU'=>[
		'text'=>'Русский',
		'iso_code'=>'ru',
		'symbol'=>'',
	],
	'uk_UA' =>[
		'text'=>'Украинська',
		'iso_code'=>'ua',
		'symbol'=>'',
	]
];
$this->admin_default_lang ='ru_RU';

$this->admin_records_per_page = 25;	

$this->admin_template ='argon';
$this->admin_template_content = [];


?>