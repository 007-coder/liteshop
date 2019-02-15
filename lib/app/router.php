<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

// доступные страницы для фронтенда ?page=
$valid_pages = ['product','cart','checkout', 'order_finish', 'show_order', '404'];
// доступные страницы для админ панели ?page=
$valid_pages_admin = ['orders','call-me'];
// доступные разделы ?section=
$valid_sections = ['admin-panel','site'];

// доступные обработчики ?engine=
$valid_engines = ['ajax'];

$valid_actions_site = ['change_lang','change_curr'];
$valid_actions_admin = [];

$admin_GET = $ajax_GET = [];



// НАЧИНАЕМ ОБРАБОТКУ $_GET и утсновку layout
if (isset($_GET) && count($_GET)) {

	$G_val = [];	


	// Админ роутинг доделать. ?section=admin-panel
	if (isset($_GET['section']) && in_array($_GET['section'], $valid_sections) ) {

		$G_val = array_values($_GET);
		//wrap_pre($G_val);

		$pos_GETsection = false;
		foreach ($valid_sections as $v_section) {
			$pos_GETsection = array_search($v_section, $G_val);		
			if ($pos_GETsection === 0) {break;}
		}	

		if ($pos_GETsection === 0) {

			switch ($_GET['section']) {
				//admin-panel
				case 'admin-panel':
					$this->run_admin = true;					
					break;
				

				//site
				case 'site':
				if (isset($_GET['action']) && in_array($_GET['action'], $valid_actions_site )) {

					$G_val = array_values($_GET);
					//wrap_pre($G_val);

					$pos_GETsite_actions = false;
					$_GETsite_val = [
						'section'=>'site',
						'action'=>['change_lang','change_curr'],
						'return_url'=>''
					];
					if ($_GET['action'] == 'change_lang') {
						$_GETsite_val['lang']=$this->shopConfig->available_lang;
					} else if ($_GET['action'] == 'change_curr') {
						$_GETsite_val['curr']=$this->shopConfig->available_currencies;
					}
					//ДОДЕЛАТЬ
					/*foreach ($_GETsite_val as $v_action) {
						$pos_GETsite = array_search($v_section, $G_val);		
						
					}	*/
					switch ($_GET['action']) {
						case 'change_lang':
							if (isset($_GET['lang']) && in_array($_GET['lang'], $this->config->available_lang)) {
								if (isset($_GET['return_url']) && is_string($_GET['return_url']) && $_GET['return_url'] !='') {
									$this->set_interface_lang($_GET['lang']);
									$this->redirect(base64_decode($_GET['return_url']));
								}
							}
							break;

						case 'change_curr':
							if (isset($_GET['curr']) && in_array($_GET['curr'], $this->shopConfig->available_currencies)) {
								if (isset($_GET['return_url']) && is_string($_GET['return_url']) && $_GET['return_url'] !='') {
									$this->set_shop_currency($_GET['curr']);
									$this->redirect(base64_decode($_GET['return_url']));
								}
							}
							break;						
					}

				} else {
					$this->view_data['data']['page'] = '404';	
				} 
					
					break;
			}	//end SWITCH		


			
		} else {
			$this->view_data['data']['page'] = '404';			
		}		
		
	}


	// Ajax интерфейс ?engine=ajax
	else if (isset($_GET['engine']) && in_array($_GET['engine'], $valid_engines)) {
		$G_val = array_values($_GET);

		$pos_GETengine = array_search('ajax', $G_val);	
		if ($pos_GETengine === 0) {
			$this->run_ajax = true;		
			// доделать. Порядок переменных в $_GET
			$ajax_GET = $_GET; 
		} else {
			$this->view_data['data']['page'] = '404';			
		}
	} 





	// Если в запросе нету $_GET['section'] || $_GET['engine'].. т.е. ни админ, ни аякс интерфейс
	else if ( !isset($_GET['section']) && !isset($_GET['engine']) && isset($_GET['page']) && $_GET['page'] !='' && in_array($_GET['page'], $valid_pages)) {		

		switch ($_GET['page']) {

			// product Доделать правильность проверки алиаса
			case 'product':
				if ( count($_GET) == 3 && isset($_GET['product_id']) && isset($_GET['alias']) && $_GET['alias'] !='') {

					$G_val = array_values($_GET); 				

					if ((int)$_GET['product_id']>0) {
												
						$pos_product = array_search('product', $G_val);
						$pos_product_id = array_search((int)$_GET['product_id'], $G_val);
						$pos_alias = array_search($_GET['alias'], $G_val);

						if ($pos_product === 0 && $pos_product_id === 1 && $pos_alias ===2) {
							$this->get_products();

							if (isset( $this->products[(int)$_GET['product_id']] ) && $this->products[(int)$_GET['product_id']]['published']) {
								$this->view_data['data']['page'] = 'product';								
							} else {
								$this->view_data['data']['page'] = '404';			
							}
							
						} else {
							$this->view_data['data']['page'] = '404';		
						}							

					} else {

						$this->view_data['data']['page'] = '404';	
					}
						
				} else {
					$this->view_data['data']['page'] = '404';	
				}				
				break;
			

			// cart
			case 'cart':
				if (count($_GET) == 1) {
					$this->view_data['data']['page'] = 'cart';	
				} else {
					$this->view_data['data']['page'] = '404';	
				}				
				break;


			// checkout
			case 'checkout':
				if (count($_GET) == 1) {
					$this->view_data['data']['page'] = 'checkout';
				} else {
					$this->view_data['data']['page'] = '404';	
				}					
				break;

			// show_order
			case 'show_order':
				if (count($_GET) == 3 && (isset($_GET['k']) && $_GET['k'] !='') && (isset($_GET['p']) && $_GET['p'] !='') ) {

					$G_val = array_values($_GET); 
					$pos_show_order = array_search('show_order', $G_val);					

					if ($pos_show_order === 0) {						
						$this->view_data['data']['page'] = 'show_order';		
					} else {
						$this->view_data['data']['page'] = '404';		
					}	
					
				} else {
					$this->view_data['data']['page'] = '404';	
				}				
				break;	

			// 404
			case '404':				
				$this->view_data['data']['page'] = '404';							
				break;	
	}

	}	else {
		$this->view_data['data']['page'] = '404';	
	}




	// ****** Установки данных ********
	// для шаблонизатора НАЧАЛО
	switch ($this->view_data['data']['page']) {
		// product
		case 'product':
			$validData = [];
			$d = [
				'product_id'=>$_GET['product_id'],
				'alias'=>$_GET['alias']
			];
			$vParams = [
				'validationRules'=>[
					'product_id'=>'required|integer',
					'alias'=>'required|alpha_dash|max_len,185'
				],
				'filterRules'=>[
					'product_id'=>'trim|sanitize_string',
					'alias'=>'trim|sanitize_string'
				]
			];
			$validData = $this->validate($d,$vParams);			

			if ($validData['allValid'] === false ) {
				$this->redirect(build_shop_link(['type'=>'404']));
			} else {				
				$d_pid = $validData['validatedData']['product_id'];
				$product = $this->get_product_by_id($d_pid);			
				//
				if ($validData['validatedData']['alias'] !== url_slug($product['name'][$this->config->interface_lang]) ) {
					//
					$this->redirect(build_shop_link(['type'=>'404']));
				} else {					 
					$this->view_data['data']['product_id'] = $d_pid;
					$this->view_data['data']['template_content']['product_page_content'] = $this->products[$d_pid];		
					$calcProductPrice = [
						'price_no_tax'=>$product['price_no_tax'],
						'tax'=>$product['tax'],
						'discount'=>$product['discount'],
						'quantity'=>1,
						'qty_price'=>$product['qty_price'],		
						'price_round'=>$this->config->price_round,					
						'currency'=>[
							'available_currencies'=>$this->get_available_currencies(),
							'excanges_rates'=>$this->get_excanges_rates(),
							'currency_codes'=>$this->get_currency_codes()					
						]			
					];
					$this->view_data['data']['template_content']['product_page_content']['product_price'] = calc_product_price($calcProductPrice);
					//
					$this->view_data['data']['template_content']['product_page_content']['related_products'] = $this->get_related_products($d_pid);					


					//установка аттрибутов
					if (isset($product['attributes']) && count($product['attributes'])) {
						$available_attributes = $this->get_available_attributes();
						$product_attributes = $product['attributes'];
						//
						$attributes = build_product_attributes($available_attributes, $product_attributes);
						$this->view_data['data']['template_content']['product_page_content']['attributes'] = $attributes;				
					}


					$n_last = (isset($product['mark'][$this->config->interface_lang])) ? ' <span class="mark_name">'.$product['mark'][$this->config->interface_lang].'</span>' : '';
					$t_last = (isset($product['mark'][$this->config->interface_lang])) ? ' '.$product['mark'][$this->config->interface_lang] : '';
					
					$this->view_data['data']['template_content']['breadcrumbs'] = [
						'first'=>PAGE_PRODUCT,
						'last'=>$product['name'][$this->config->interface_lang].$n_last
					];
					$this->view_data['data']['meta_title'] = PAGE_PRODUCT.' '.$product['name'][$this->config->interface_lang].$t_last.'. '.$this->config->seo['site_name'];
					$this->view_data['data']['meta_desc'] = $product['meta_desc'][$this->config->interface_lang];
					$this->view_data['data']['meta_keywords'] = $product['meta_keywords'][$this->config->interface_lang];
				}

				

			}			
			break;



		// cart
		case 'cart':
			$this->view_data['data']['cart'] = $this->get_cart();
			$this->view_data['data']['template_content']['breadcrumbs'] = [				
				'last'=>PAGE_CART
			];
			$this->view_data['data']['meta_title'] = PAGE_CART.'. '.$this->config->seo['site_name'];
			$this->view_data['data']['meta_desc'] = PAGE_CART.'. '.$this->config->seo['site_name'];
			$this->view_data['data']['meta_keywords'] = '';			
			break;

		// checkout
		case 'checkout':
			$this->view_data['data']['cart'] = $this->get_cart();
			$this->view_data['data']['template_content']['breadcrumbs'] = [				
				'last'=>PAGE_CHECKOUT
			];
			$this->view_data['data']['meta_title'] = PAGE_CHECKOUT.'. '.$this->config->seo['site_name'];
			$this->view_data['data']['meta_desc'] = PAGE_CHECKOUT.'. '.$this->config->seo['site_name'];
			$this->view_data['data']['meta_keywords'] = '';
			$this->view_data['data']['template_content']['shipping_methods'] = $this->get_shipping_methods();
			$this->view_data['data']['template_content']['shipping_prices'] = $this->get_shipping_prices();
			$this->view_data['data']['template_content']['payment_methods'] = $this->get_payment_methods();
			$this->view_data['data']['template_content']['payment_taxes'] = $this->get_payment_taxes();
			break;		

		// show_order
		case 'show_order':
			$d = [
				'k'=>$_GET['k'],
				'p'=>$_GET['p']
			];
			$vParams = [
				'validationRules'=>[
					'k'=>'required|alpha_numeric|max_len,16',
					'p'=>'required|numeric|max_len,8'
				],
				'filterRules'=>[
					'k'=>'trim|sanitize_string',
					'p'=>'trim|sanitize_string'
				]
			];
			$validData = $this->validate($d,$vParams);

			$order_data = ($validData['allValid']) ? $this->main_model->get_order($validData['validatedData']['k'], $validData['validatedData']['p']) : '';				
			if (empty($order_data) || $validData['allValid'] === false ) {
				$this->redirect(build_shop_link(['type'=>'404']));
			} else {
				$this->view_data['data']['template_content']['breadcrumbs'] = [				
					'last'=>PAGE_SHOW_ORDER
				];
				$this->view_data['data']['meta_title'] = PAGE_SHOW_ORDER.'. '.$this->config->seo['site_name'];
				$this->view_data['data']['meta_desc'] = PAGE_SHOW_ORDER.'. '.$this->config->seo['site_name'];
				$this->view_data['data']['meta_keywords'] = '';		
				$this->view_data['data']['template_content']['order']	= $order_data;	
				$this->view_data['data']['template_content']['order_statuses']	= $this->config->order_statuses;	
				$this->view_data['data']['template_content']['orderPaymentStatuses']	= $this->config->order_payment_statuses;	
				$this->view_data['data']['template_content']['shippingMethods']	= $this->get_shipping_methods();	
				$this->view_data['data']['template_content']['paymentMethods']	= $this->get_payment_methods();	
			}
			

			break;

		// 404
		case '404':
			$this->view_data['data']['meta_title'] = PAGE_ERROR_404.'. '.$this->config->seo['site_name'];
			$this->view_data['data']['meta_desc'] = PAGE_ERROR_404.'. '.$this->config->seo['site_name'];
			$this->view_data['data']['meta_keywords'] = '';
			break;
	}
	// Установки данных КОНЕЦ

	
}







?>
