<?php 
defined('YV_LiteShop') or die ('Restricted Access!');


function wrap_pre($mixed, $resource_name = '', $navbar='n', $stop = false) {
	if (!empty($mixed)) {
	    if (!is_bool($stop)) $stop = false;
	    if (!is_resource($mixed)) {                 
	        $e_resource_name = ($resource_name !='') ? '<h4><i>-- resource:</i> <b>'.$resource_name.'</b></h4>' : '';
	        $style = ($navbar=='y') ? '<style>.navbar-vertical.navbar-expand-md {position: static!important;}</style>' : ''; 
	        echo $e_resource_name .$style.'<pre>'.print_r($mixed, true).'</pre>';
	        if ($stop) exit();
	        
	    } else echo 'wrap_pre() - WRANG DATA GIVEN! NOTHING TO SHOW!';
	}       
}

function gen_order_pin($num=6){	
	$num = ($num>12) ? 12 : $num;
	switch ($num) {
		case '1':
			$a=9;
			break;
		case '2':
			$a=99;
			break;
		case '3':
			$a=999;
			break;
		case '4':
			$a=9999;
			break;
		case '5':
			$a=99999;
			break;
		case '6':
			$a=999999;
			break;
		case '7':
			$a=9999999;
			break;
		case '8':
			$a=99999999;
			break;
		case '9':
			$a=999999999;
			break;
		case '10':
			$a=9999999999;
			break;
		case '11':
			$a=99999999999;
			break;
		case '12':
			$a=999999999999;
			break;
		

	}
  $pin = str_pad(mt_rand(1,$a),$num,'0',STR_PAD_LEFT);
  return $pin;
}

 /**
   * getRandomWeightedElement()
   * Utility function for getting random values with weighting.
   * Pass in an associative array, such as array('A'=>5, 'B'=>45, 'C'=>50)
   * An array like this means that "A" has a 5% chance of being selected, "B" 45%, and "C" 50%.
   * The return value is the array key, A, B, or C in this case.  Note that the values assigned
   * do not have to be percentages.  The values are simply relative to each other.  If one value
   * weight was 2, and the other weight of 1, the value with the weight of 2 has about a 66%
   * chance of being selected.  Also note that weights should be integers.
   * 
   * @param array $weightedValues
   */
  function getRandomWeightedElement(array $weightedValues) {

  	/*
  	//проверка алгоритма
  	$t = 1; $red = $blue = $yel = $draw = 0; 
		$count_wins = [
			'blue' => 0,
			'red' => 0,							
			'yel' => 0,
			'draw' => 0
		];
		while  ( $t <= 1000000) {
			$win = getRandomWeightedElement(['blue'=>35, 'red'=>30, 'yel'=>20,'draw'=>15]);

			if ($win == 'red') { $count_wins['red']++; }
			else if ($win == 'blue') { $count_wins['blue']++; }
			else if ($win == 'yel') { $count_wins['yel']++; }
			else if ($win == 'draw') { $count_wins['draw']++; }

			//echo $win.'<br>';							
			$t++;
		}*/


    $rand = mt_rand(1, (int) array_sum($weightedValues));

    foreach ($weightedValues as $key => $value) {
      $rand -= $value;
      if ($rand <= 0) {
        return $key;
      }
    }
  }

function setViewDataFromArray($data, $viewArray) {
	$ret = $viewArray;
	foreach ($data as $k => $dValue) {
		if (!is_array($dValue) || !is_object($dValue)) {
			$ret[$k] = $dValue;		

		} else if (is_array($dValue)) {
			$ret[$k] = setViewDataFromArray($dValue,$ret[$k]);
		}
	}

	return $ret;
}

function build_owlSingleProducts($data) {
	$html = '';	
	$_lang = $data['_lang'];
	$_currency = $data['_currency'];

	if (count($data['products'])) {
		foreach ($data['products'] as $product) {
			$parts = [];

			//Product Image START
			$parts['img'] = 
			'<div class="kiosk-product-img">';
			$parts['img'] .= 
				'<a href="'.$product['link'].'" target="_blank">';	

				$main_img = (!empty($product['main_img']) && file_exists($data['abs_path_img_products'].$product['product_id'].'/'.$product['main_img']) ) ? $data['uri_media_img_products'].$product['product_id'].'/'.$product['main_img'] : URI_NOIMG_PRODUCT;
				$_safe_name = (isset($product['mark'][$_lang]) && $product['mark'][$_lang] !='') ? trim(htmlspecialchars($product['name'][$_lang].' '.$product['mark'][$_lang])) : trim(htmlspecialchars($product['name'][$_lang]));

				//
				if (count($product['images']) > 1 && !empty($product['main_img'])) { 
					$_img = (file_exists($data['abs_path_img_products'].$product['product_id'].'/'.$product['images'][1]) ) ? $data['uri_media_img_products'].$product['product_id'].'/'.$product['images'][1] : URI_NOIMG_PRODUCT;

					$parts['img'] .= '<img class="first-img" src="'.$main_img.'" alt="'.$_safe_name.'" title="'.$_safe_name.'">';				
					$parts['img'] .= '<img class="second-img" src="'.$_img.'" alt="'.$_safe_name.'" title="'.$_safe_name.'">';				
				//
				} else if (count($product['images']) == 1 && !empty($product['main_img'])) {
						$_img = (file_exists($data['abs_path_img_products'].$product['product_id'].'/'.$product['images'][0]) ) ? $data['uri_media_img_products'].$product['product_id'].'/'.$product['images'][0] : URI_NOIMG_PRODUCT;

						$parts['img'] .= '<img class="first-img" src="'.$main_img.'" alt="'.$_safe_name.'" title="'.$_safe_name.'">';		
						$parts['img'] .= '<img class="second-img" src="'.$_img.'" alt="'.$_safe_name.'" title="'.$_safe_name.'">';				
								
				//
				} else if (count($product['images']) == 1 && empty($product['main_img'])) {
					$_img = (file_exists($data['abs_path_img_products'].$product['product_id'].'/'.$product['images'][0]) ) ? $data['uri_media_img_products'].$product['product_id'].'/'.$product['images'][0] : URI_NOIMG_PRODUCT;
					$parts['img'] .= '<img class="first-img" src="'.$_img.'" alt="'.$_safe_name.'" title="'.$_safe_name.'">';
				//	
				} else if (empty($product['images']) && empty($product['main_img'])) {
					$parts['img'] .= '<img class="first-img" src="'.URI_NOIMG_PRODUCT.'" alt="'.$_safe_name.'" title="'.$_safe_name.'">';	
				}
			$parts['img'] .= 
				'</a>';

			//бадже со скидкой и лейблы НАЧАЛО
			$showLabels = ( (isset($product['discount']) && $product['discount'] > 0) || (isset($product['label']) && count($product['label'])) ) ? true : false;

			if ($showLabels){
				$parts['img'] .= 
				'<div class="stickers_wrap">
					<ul class="inner_wrap">';
						if (isset($product['discount']) && $product['discount'] > 0 ) {
							$parts['img'] .= 
							'<li class="">
									<span class="sticker-new sticker-discount mb-10">-'.round(($product['discount']*100),1).' %</span>
							</li>';
						}

						if (isset($product['label']) && count($product['label'])) {
							foreach ($product['label'] as $pLabel) {
								$parts['img'] .= 
								'<li class="">
									<span class="sticker-new label">';
									if ($pLabel['img'] !='') {

									} else {
										$parts['img'] .= $pLabel['text'][$_lang];
									}
								$parts['img'] .= 
								'	</span>											
								</li>';
							}
						}

				$parts['img'] .= 
					'</ul>
				</div>';

			}
			//бадже со скидкой и лейблы КОНЕЦ
			

			// Цена товара НАЧАЛО
			$item_price = $product['price'];
			$oldPrice = ((isset($product['discount']) && $product['discount']>0) && isset($item_price[$_currency]['old_price']) && $item_price[$_currency]['old_price']) ? '<del class="prev-price">'.$item_price[$_currency]['old_price'].' '.$item_price[$_currency]['currency_code'].'</del>' : '';
			//			
			$parts['img'] .= 
				'<div class="prod_price">
					<p><span class="price">'.$item_price[$_currency]['val'].' '.$item_price[$_currency]['currency_code'].'</span> '.$oldPrice.'</p>';
			$parts['img'] .= 
				'</div>'; // .prod_price END
			// Цена товара КОНЕЦ

			$parts['img'] .= 
			'</div>';
			//Product Image END


			//Product Content START
			$parts['content'] = '';
			$mark_name = (isset($product['mark'][$_lang])) ? '<span class="mark_name">'.$product['mark'][$_lang].'</span>' : '';		

			$parts['content'] .= 
			'<div class="kiosk-product-content">';				
			//		
			$parts['content'] .= 
				'<h4><a href="'.$product['link'].'">'. $product['name'][$_lang].' '.$mark_name.'</a></h4>';
			//
			$parts['content'] .= 
				'<div class="kiosk-product-action">
					<div class="kiosk-action-content">';
			$parts['content'] .= 				
						'<a href="'.$product['link'].'" title="'.PC_ADD_TO_CART.'"><i class="fa fa-shopping-cart"></i></a>';
			$parts['content'] .= 
					'</div>
				</div>';

			$parts['content'] .= 
			'</div>';
			//Product Content END

			//Product Stickers START
			
			//Product Stickers END


			
			// build final HTML 
			$html .=
			'<div class="single-product">';
			$html .=
				 $parts['img'].$parts['content']; 
			$html .= 
			'</div>';
		}
	}
	

	return $html;
}


function format_order_number($pin, $options=[2,'-']) {	
	$dev = $options[0];
	$delim = $options[1];
	$ci = strlen($pin) / $dev;

	$start = 0; $tmp=[];
	for ($i=0; $i < $ci; $i++) { 
		$tmp[$i] = substr($pin, $start, $dev);
		$start +=$dev;
	}	

	return implode($delim, $tmp);
}


function build_order_number($p = 4) {
	$shop = new YV_LiteShop();
	$cryptor = $shop->get_cryptor();
	$cryptor_key = "ACOMPLETELYRANDOMKEYTHATIHAVEUSED";
	$cryptor_min_length = 8;

	$ret = [];	
	
	$t = number_format((float) microtime(true), $p, '.', '');
	$t_expl = explode('.',$t);
	$tp = implode('',$t_expl);

	//$ret['t']=$t; 
	$ret['order_number']=strrev($tp); 
	//$ret['order_number_len']=strlen(strrev($tp)); 
	$ret['order_pin']=gen_order_pin();
	$ret['order_key'] = $cryptor->encrypt($cryptor_key, strrev($tp), $cryptor_min_length);	

	return $ret;
	
}






/**
 * Create a web friendly URL slug from a string.
 * 
 * Although supported, transliteration is discouraged because
 *     1) most web browsers support UTF-8 characters in URLs
 *     2) transliteration causes a loss of information
 *
 * @author Sean Murphy <sean@iamseanmurphy.com>
 * @copyright Copyright 2012 Sean Murphy. All rights reserved.
 * @license http://creativecommons.org/publicdomain/zero/1.0/
 *
 * @param string $str
 * @param array $options
 * @return string
 */
function url_slug($str, $options = array()) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => '_',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => true,
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	$char_map = array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
		'ß' => 'ss', 
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
		'ÿ' => 'y',

		// Latin symbols
		'©' => '(c)',

		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 

		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',

		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
		'Ž' => 'Z', 
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z', 

		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
		'Ż' => 'Z', 
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',

		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}


function iso6391_lang_code($lang = '', $delim = '_') {
	if (is_string($lang) && $lang !='') {
		$tmp = explode($delim, $lang);
		return $tmp[0];
	}
}

function parseUrlQuery ($url) {
	$valid_queries = ['section','page','start','limit','action','lang','curr','return_url','page_num'];

	$return = [
		'query'=>[
			'other'=>[
				'query'=>'',
				'count'=>0
			]
		],
		'positions'=>[]
	];	

	$parseUrl = parse_url($url);

	if (!empty($parseUrl['query'])) {

		$explUrlQuery = explode('&', $parseUrl['query']);		
		foreach ($explUrlQuery as $ek => $eVal) {
				$tmp = explode('=',$eVal);

				if (count($tmp)==2) {

					$return['query'][$tmp[0]] = $tmp[1];
				
					if (!in_array($tmp[0], $valid_queries)) {										
						$return['query']['other']['query'] .='&'.$eVal;
						$return['query']['other']['count']++;

					}

					if (in_array($tmp[0], $valid_queries)) {
						switch ($tmp[0]) {
							case 'section':
								$return['positions']['section'] = $ek+1;
								break;
							case 'page':
								$return['positions']['page'] = $ek+1;
								break;
							case 'page_num':
								$return['positions']['page_num'] = $ek+1;
								break;
							case 'start':
								$return['positions']['start'] = $ek+1;
								break;
							case 'limit':
								$return['positions']['limit'] = $ek+1;
								break;				
						}	
					}

				} else {
					$return['query']['section'] = 'admin-panel';					
					$return['query']['page'] = '404';					
					$return['positions']['section'] = '1';					
					$return['positions']['page'] = '2';					
				}
								

			}

	}	

	return $return;
}

function buildSelect($data){
	$html = '';
	$s_id = ( isset($data['id']) && is_string($data['id']) && $data['id'] !='') ? ' id="'.$data['id'].'"' :'';

	if (count($data['list'])) {
		$html ='<select class="'.$data['class'].'" '.$s_id.' name="'.$data['name'].'">';

		foreach ($data['list'] as $k => $option) {
			$selected = ($k == $data['selected']) ? 'selected' : '';
			$html .= '<option '.$selected.' value="'.$k.'">'.$option['name'][$data['lang']].'</option>';
		}

		$html .='</select>';
	}

	return $html;
	
}

function get_actual_url() {
	$actual_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	/*$actual_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";*/
	return $actual_url;
}

function build_shop_link($data = []) {
	$data['type'] = (isset($data['type'])) ? $data['type'] : 'product';
	
	switch ($data['type']) {
		case 'product':
			$link = URI_BASE.'?page=product&product_id='.(int)$data['product_id'].'&alias='.$data['alias'];
			break;
		case 'cart':
			$link = URI_BASE.'?page=cart';
			break;
		case 'checkout':
			$link = URI_BASE.'?page=checkout';
			break;
		case 'change_lang':
			$link = URI_BASE.'?section=site&action=change_lang&lang='.$data['lang'].'&return_url='.$data['return_url'];
			break;
		case 'change_curr':
			$link = URI_BASE.'?section=site&action=change_curr&curr='.$data['curr'].'&return_url='.$data['return_url'];
			break;

		case 'show_order':
			$link = URI_BASE.'?page=show_order&k='.$data['k'].'&p='.$data['p'];
			break;

		case '404':
			$link = URI_BASE.'?page=404';
			break;



	}

	return $link;
}

function build_admin_link($data = []) {
	$data['type'] = (isset($data['type'])) ? $data['type'] : 'homepage';

	$link = '';

	switch ($data['type']) {
		case 'homepage':
			$link = URI_BASE.'?section=admin-panel';
			break;
		case 'orders':
			$link = URI_BASE.'?section=admin-panel&page=orders';
			break;
		case 'edit_order':
			$link = URI_BASE.'?section=admin-panel&action=edit_order&order='.$data['order'].'&return_url='.$data['return_url'];
			break;
		case 'delete_order':
			$link = URI_BASE.'?section=admin-panel&action=delete_order&order='.$data['order'].'&return_url='.$data['return_url'];
			break;
		case 'call-me':
			$link = URI_BASE.'?section=admin-panel&page=call-me';
			break;
		case 'change_lang':
			$link = URI_BASE.'?section=admin-panel&action=change_lang&lang='.$data['lang'].'&return_url='.$data['return_url'];
			break;
		case 'change_curr':
			$link = URI_BASE.'?section=admin-panel&action=change_curr&curr='.$data['curr'].'&return_url='.$data['return_url'];
			break;
		case 'docs':
			$link = URI_BASE.'?section=admin-panel&page=docs';
			break;
		case '404':
			$link = URI_BASE.'?section=admin-panel&page=404';
			break;
		case 'logout':
			$link = URI_BASE.'?section=admin-panel&action=logout';
			break;
	}

	return $link;


}


function calc_product_price($data, $show_currency = true) {
	$price = [];
	$tax_value = ($data['tax']>0) ? $data['price_no_tax']*$data['tax'] : 0;
	$price_value = $data['price_no_tax'];
	$discount_value = ( isset($data['discount']) && ( $data['discount']>0 && $data['discount'] <1 ) )  ? $data['discount'] : false;
	$currency_codes = $data['currency']['currency_codes'];

	//установки кол-ва товаров.
	if (isset($data['1unit_price']) && $data['1unit_price'] == true) {
		$qty = 1;
	} else {
		$qty = (isset($data['quantity'])  && $data['quantity']>1 ) ? $data['quantity'] : false;	
	}
	
	$qty_price = (isset($data['qty_price']) && count ($data['qty_price']) ) ? $data['qty_price'] : false;

	
	switch ($data['price_round']['method']) {
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

	// Формирование цены НАЧАЛО
	//добавить формир цены в зависимости от атрибута
	foreach ($data['currency']['available_currencies'] as $currency) {
		$_pv = ($tax_value+$price_value)*$data['currency']['excanges_rates'][$currency];	

		//Цена в зависимости от кол-ва 
		$q_discount_value = false;
		if ($qty_price !==false && $qty !==false ) {
			foreach ($qty_price as $q_discount) {
				$q_disc = (isset($q_discount['discount']) && $q_discount['discount']>0 && $q_discount['discount']<1 ) ? $q_discount['discount'] : false;

				if ($qty >= $q_discount['start'] && $qty <= $q_discount['end']) {
					$q_discount_value = ($q_disc !== false ) ? $q_disc : false;
				}

			}

		}

		//Цена со скидкой без учета цены в зависим от кол-ва 
		$_pv_old = '';
		if ($discount_value !==false && $q_discount_value === false) {
			$_pv_old = $_pv;
			$_pv = $_pv - ($_pv*$discount_value);
		} else if ($discount_value !==false && $q_discount_value !== false) {
			$_pv_old = $_pv;
			$_pv = $_pv - ($_pv*$discount_value);
			$_pv = $_pv - ($_pv*$q_discount_value);
		}	else if ($discount_value ===false && $q_discount_value !== false) {
			$_pv_old = $_pv;
			$_pv = $_pv - ($_pv*$q_discount_value);
		}

		$price[$currency] = [
			'val'=>round($_pv, $data['price_round']['precision'], $round_method),
			'currency_code'=> ($show_currency) ? $currency_codes[$currency]['text'] : ''
		];
		if ($discount_value !==false || $q_discount_value !== false) {
			$price[$currency]['old_price'] = round($_pv_old, $data['price_round']['precision'], $round_method);
		}

	}
	// Формирование цены КОНЕЦ


	return $price;

}


function build_product_attributes ($available_attributes, $product_attributes) {
	$attributes = [];

	foreach ($product_attributes as $pa_group => $pa_group_values) {
	
		foreach ($pa_group_values['options'] as $ag_index => $ag_values) {
			if (array_key_exists($ag_index, $available_attributes[$pa_group]['options'])) {
				$attributes[$pa_group]['name'] = $available_attributes[$pa_group]['name']; 
				$attributes[$pa_group]['options'][$ag_index] = $available_attributes[$pa_group]['options'][$ag_index];	

				foreach ($ag_values as $av_index => $av_value) {
					if (array_key_exists($av_index, $available_attributes[$pa_group]['options'][$ag_index])) {						
						$attributes[$pa_group]['options'][$ag_index][$av_index] = $av_value;

					} else {
						unset($attributes[$pa_group]['options'][$ag_index][$av_index]);
						//$attributes[$pa_group][$ag_index][$av_index] = 'not exists';
					}
				}

			} else {
				unset($attributes[$pa_group]['options'][$ag_index]);
				//$attributes[$pa_group][$ag_index] = null;
			}
			
		}					
	}

	return $attributes; 

}

function build_product_attributes_html ($attributes) {

}

function test_config() {
	$shop = new YV_LiteShop();
	return $shop->get_config();
}

function build_shippings_list_html ($type='radio') {
	$shop = new YV_LiteShop();
	$shopConfig = $shop->get_config();
	$shipping_methods = $shop->get_shipping_methods(); 
	$shipping_prices = $shop->get_shipping_prices();
	$shop_currency = $shopConfig->shop_currency;  
	$shop_currency_code = $shopConfig->shop_currency_code;  
	$shop_currency_rate = $shopConfig->shop_currency_rate;  
	$price_round = $shopConfig->price_round; 
	$lang = $shopConfig->interface_lang;

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

	$html = '';

	if (count($shipping_methods)) {
		$html = '<div class="a_shippings_list">';
		foreach ($shipping_methods as $sm_i => $sm_data) {
			$checked = ($sm_i === 0) ? 'checked="checked"' :'';
			if ($sm_data['publish']) {
				$_price = ($shipping_prices[$sm_data['code']] > 0) ? round($shipping_prices[$sm_data['code']]*$shop_currency_rate, $price_round['precision'], $round_method) : 0;
				//
				$_price_default = round($shipping_prices[$shipping_methods[0]['code']]*$shop_currency_rate, $price_round['precision'], $round_method);

				$html .= '<label class="container_'.$type.'  sm_label shipping_method" data-shipping-price="'.$_price.'" data-shipping-code="'.$sm_data['code'].'">';
					if ($sm_data['icon'] !='') {
						$html .= '<span class="icon">'.$sm_data['icon'].'</span>';	
					}
					$html .= '<span class="name">'.$sm_data['name'][$lang].' <i>(+ '.$_price.' '.$shop_currency_code['text'].')</i></span>';
					$html .= '<input type="'.$type.'" name="shipping_method"  id="hi_shipping_method" value="'.$sm_data['code'].'" '.$checked .'>';
					$html .= '<span class="checkmark"></span>';
				$html .= '</label>';
			}			
		}
		
		/*$html .= '<input type="hidden" name="shipping_price" id="hi_shipping_price" value="'.$_price_default.'">';*/
		$html .= '</div>';

	} 

	

	return $html;
}

function build_payments_list_html ($type='radio') {
	$shop = new YV_LiteShop();
	$shopConfig = $shop->get_config();
	$payment_methods = $shop->get_payment_methods(); 
	$payment_taxes = $shop->get_payment_taxes();
	$shop_currency = $shopConfig->shop_currency;  
	$shop_currency_code = $shopConfig->shop_currency_code;  
	$shop_currency_rate = $shopConfig->shop_currency_rate;  
	$price_round = $shopConfig->price_round; 
	$lang = $shopConfig->interface_lang;

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

	$html = '';

	if (count($payment_methods)) {
		$html = '<div class="a_payments_list">';
		foreach ($payment_methods as $pm_i => $pm_data) {
			$checked = ($pm_i === 0) ? 'checked="checked"' :'';
			if ($pm_data['publish']) {

				$_price = ($payment_taxes[$pm_data['code']] > 0) ? round($payment_taxes[$pm_data['code']]*$shop_currency_rate, $price_round['precision'], $round_method) : 0;
				//
				$_price_default = round($payment_taxes[$payment_methods[0]['code']]*$shop_currency_rate, $price_round['precision'], $round_method);

				$html .= '<label class="container_'.$type.' pm_label payment_method" data-payment-price="'.$_price.'" data-payment-code="'.$pm_data['code'].'" >';
					if ($pm_data['icon'] !='') {
						$html .= '<span class="icon">'.$pm_data['icon'].'</span>';	
					}
					$html .= '<span class="name">'.$pm_data['name'][$lang].' <i>(+ '.$_price.' '.$shop_currency_code['text'].')</i></span>';
					$html .= '<input type="'.$type.'" name="payment_method" id="hi_payment_method" value="'.$pm_data['code'].'" '.$checked .'>';
					$html .= '<span class="checkmark"></span>';
				$html .= '</label>';
			}			
		}
		
		/*$html .= '<input type="hidden" name="payment_price" id="hi_payment_price" value="'.$_price_default.'">';*/
		$html .= '</div>';

	} 



	return $html;
}

function get_1st_shipping_method(){	
	$shop = new YV_LiteShop();
	$shopConfig = $shop->get_config();
	$shipping_methods = $shop->get_shipping_methods(); 
	$ret = ['price'=>0];

	if (count($shipping_methods)) {
		$shipping_prices = $shop->get_shipping_prices();
		$shop_currency = $shopConfig->shop_currency;  
		$shop_currency_code = $shopConfig->shop_currency_code;  
		$shop_currency_rate = $shopConfig->shop_currency_rate;  
		$price_round = $shopConfig->price_round; 

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

		$c = 0;
		foreach ($shipping_methods as $sp_method) {
			if ($c < 1) {
				if ($sp_method['publish']) {
					array_merge($ret,$sp_method);
					$sp_price = ($shipping_prices[$sp_method['code']] > 0) ? $shipping_prices[$sp_method['code']] : 0;
					$ret['price'] = ($sp_price > 0) ? round($sp_price*$shop_currency_rate,$price_round['precision'], $round_method) : 0; 
					$c++;
				}
			} else { break; }
		}
	} 

	

	

	return $ret;
}

function get_1st_payment_method(){	
	$shop = new YV_LiteShop();
	$shopConfig = $shop->get_config();
	$payment_methods = $shop->get_payment_methods(); 
	
	$ret = ['price'=>0];

	if (count($payment_methods)) {
		$payment_taxes = $shop->get_payment_taxes();
		$shop_currency = $shopConfig->shop_currency;  
		$shop_currency_code = $shopConfig->shop_currency_code;  
		$shop_currency_rate = $shopConfig->shop_currency_rate;  
		$price_round = $shopConfig->price_round; 

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

		$c = 0;
		foreach ($payment_methods as $sp_method) {
			if ($c < 1) {
				if ($sp_method['publish']) {
					array_merge($ret,$sp_method);
					$sp_price = ($payment_taxes[$sp_method['code']] > 0) ? $payment_taxes[$sp_method['code']] : 0;
					$ret['price'] = ($sp_price > 0) ? round($sp_price*$shop_currency_rate,$price_round['precision'], $round_method) : 0; 
					$c++;
				}
			} else { break; }
		}
	} 

	

	

	return $ret;
}




 ?>