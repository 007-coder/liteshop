<?php
defined('YV_LiteShop') or die ('Restricted Access!');

// доступные Пост запросы
$valid_post_actions = ['cart_add','cart_remove','cart_update','place_order'/*,'change_lang','change_curr'*/];		
//


if (isset($_POST) && count($_POST) ) {


	//AJAX actions
	if (isset($_POST['engine']) && in_array($_POST['engine'], ['ajax'])) {	

		$this->ajax($_POST);		

	}

	// Regular actions
	else if (in_array($_POST['action'], $valid_post_actions))
	{

		//
		// Группы запроссов
		$actions_groups = [
			'cart'=>['cart_add','cart_remove','cart_update'],		
			'order'=>['place_order']		
		];			

		//
		// ****КОРЗИНА**** ($actions_groups['cart'])
		// ------------------------
		if (in_array($_POST['action'], $actions_groups['cart'])) {
			
			//Валидация старт
			if (in_array($_POST['action'], ['cart_add','cart_update'])) {
				$validation_rules = [
					'product_id'=> 'required|integer|min_numeric,1',
					'quantity'=> 'required|integer|min_numeric,1'
					// Добавить поле attributes				
				];
				$filter_rules = [
					'product_id'=> 'trim|sanitize_string|sanitize_numbers',
					'quantity'=> 'trim|sanitize_string|sanitize_numbers'				
				];
			} else if (in_array($_POST['action'], ['cart_remove'])) {
				$validation_rules = [
					'product_id'=> 'required|integer|min_numeric,1'				
				];
				$filter_rules = [
					'product_id'=> 'trim|sanitize_string|sanitize_numbers'									
				];
			}

			$this->validator->validation_rules($validation_rules);	
			$this->validator->filter_rules($filter_rules);
			$validated_data = $this->validator->run($_POST);
			//Валидация конец

			// Валидация провалена
			if($validated_data === false) {		
				// Сообщение об ошибке!			
				$this->view_data['data']['message'] = [
					'type'=>'error',
					'text'=>MSG_WRONG_DATA,
					'details'=>$this->validator->get_readable_errors(true)
				]; 										
			} else {
				// Валидация успешна					
				$p_cart_data=[
					'action'=>$_POST['action'],
					'product_id'=>(isset($validated_data['product_id'])) ? $validated_data['product_id'] : null,
					'quantity'=>(isset($validated_data['quantity'])) ? $validated_data['quantity'] : null				
				];
				/*wrap_pre($p_cart_data, '$p_cart_data');*/
				$this->process_cart($p_cart_data);				
			}				
			
		} 

		//
		// ****ОБРАБОТКА ЗАКАЗА**** ($actions_groups['order'])
		// ------------------------
		else if (in_array($_POST['action'], $actions_groups['order']) && !empty($this->get_cart())) {
			$order_cart = $this->get_cart();


			//Валидация старт
			$validation_rules = [		
				'first_name'=> 'required|utf8_alpha|min_len,2|max_len,25',
				'second_name'=> 'required|utf8_alpha|min_len,2|max_len,25',
				'email'=> 'required|valid_email|min_len,5|max_len,35',
				'phone'=>'required|phone_number_ext',
				'address'=>'required|address_ext|max_len,65',
				'city'=>'required|utf8_alpha_spase_dash|max_len,40',
				'zipcode'=>'required|integer|max_len,10',
				'order_comment'=>'some_text|max_len,300',
				//
				'payment_method'=>'required|alpha_dash|max_len,25',
				'shipping_method'=>'required|alpha_dash|max_len,25',
				'order_currency'=>'required|alpha|max_len,4',
				'cart_order_subtotal'=>'required|numeric|max_len,7',
				'order_total_for_pay'=>'required|numeric|max_len,7',
				'action'=>'required|contains,place_order|exact_len,11',						
			];
			$filter_rules = [
				'first_name'=> 'trim|sanitize_string',
				'second_name'=> 'trim|sanitize_string',				
				'email'=> 'trim|sanitize_email',				
				'phone'=> 'trim|sanitize_string',				
				'address'=> 'trim|sanitize_string',				
				'city'=> 'trim|sanitize_string',				
				'zipcode'=> 'trim',				
				'order_comment'=> 'trim|sanitize_string',		
				//		
				'payment_method'=> 'trim|sanitize_string|lower_case',				
				'shipping_method'=> 'trim|sanitize_string|lower_case',				
				'order_currency'=> 'trim|sanitize_string|lower_case',				
				'cart_order_subtotal'=> 'trim',				
				'order_total_for_pay'=> 'trim',				
				'action'=> 'trim|sanitize_string|lower_case',				
				
			];

			$this->validator->validation_rules($validation_rules);	
			$this->validator->filter_rules($filter_rules);
			$validated_data = $this->validator->run($_POST);		

			// Валидация провалена 
			// -------------------------
			if($validated_data === false)
			{	
				$errors = $this->validator->get_errors_array();			
				$valid_data = [];

				foreach ($_POST as $kp => $post_val)
				{				
					$valid_data[$kp] = (!array_key_exists($kp, $errors)) ? $post_val : '';
				}						

				$this->view_data['data']['template_content']['checkout_form']['error'] = $errors;
				$this->view_data['data']['template_content']['checkout_form']['valid_data'] = $valid_data;			

				// Сообщение об ошибке!			
				$this->view_data['data']['message'] = [
					'type'=>'error',
					'text'=>MSG_WRONG_DATA,
					'details'=>''
				]; 										
			} else

			// Валидация успешна	
			// -------------------------
			{
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

				$valid_data = [];
				$_ar = ['payment_method','shipping_method','order_currency'];
				foreach ($validated_data as $kp => $post_val)
				{				
					if (!in_array($kp, $_ar)) { $valid_data[$kp] = $post_val;	}
				}

				

				//Проеверяем верны ли методы доставки и оплаты и валюта счета

				// Проеверяем верны ли валюта счета
				if ($validated_data['order_currency'] != $shop_currency )
				{
					// Сообщение об ошибке!			
					$this->view_data['data']['message'] = [
						'type'=>'error',
						'text'=>MSG_WRONG_DATA.'<br><i>'.MSG_WRONG_CURRENCY.'</i>',
						'details'=>''
					]; 

					$this->view_data['data']['template_content']['checkout_form']['valid_data'] = $valid_data;	
				} 

				// Если валюта счета верна проверяем способы доставки и оплаты
				else			
				{
					$chk_shipping_methods = $chk_payment_methods = [];

					foreach ($shipping_methods as $sm_value)
					{
						if ($sm_value['publish']) 
						{
							$chk_shipping_methods[] = $sm_value['code'];
						}
					}
					//
					foreach ($payment_methods as $pm_value)
					{
						if ($pm_value['publish']) 
						{
							$chk_payment_methods[] = $pm_value['code'];
						}
					}

					$valid_shipping_method = true;
					$valid_payment_method = true;

					//Проеверяем верны ли метод доставки
					if (!in_array($validated_data['shipping_method'], $chk_shipping_methods))
					{	$valid_shipping_method = false;	}

					//Проеверяем верны ли метод оплаты 
					if (!in_array($validated_data['payment_method'], $chk_payment_methods))
					{	$valid_payment_method = false; }


					// Если не верны способ доставки и метод оплаты	
					if ($valid_shipping_method === false && $valid_payment_method === false )
					{
						// Сообщение об ошибке!			
						$this->view_data['data']['message'] = [
							'type'=>'error',
							'text'=>MSG_WRONG_DATA.'<br><i>'.MSG_WRONG_PAYMENT_AND_SHIPPING_METHODS.'</i>',
							'details'=>''
						];
						$this->view_data['data']['template_content']['checkout_form']['valid_data'] = $valid_data;	

					}

					// Если не верны способ доставки
					else if ($valid_shipping_method === false && $valid_payment_method ===true)				
					{
						// Сообщение об ошибке!			
						$this->view_data['data']['message'] = [
							'type'=>'error',
							'text'=>MSG_WRONG_DATA.'<br><i>'.MSG_WRONG_SHIPPING_METHOD.'</i>',
							'details'=>''
						];
						$this->view_data['data']['template_content']['checkout_form']['valid_data'] = $valid_data;	

					} 

					// Если не верны способ оплаты
					else if ($valid_payment_method === false && $valid_shipping_method === true)				
					{
						// Сообщение об ошибке!			
						$this->view_data['data']['message'] = [
							'type'=>'error',
							'text'=>MSG_WRONG_DATA.'<br><i>'.MSG_WRONG_PAYMENT_METHOD.'</i>',
							'details'=>''
						];

						$this->view_data['data']['template_content']['checkout_form']['valid_data'] = $valid_data;	
					}


					// ----------------------
					//ЕСЛИ ВЕРНЫ метод ОПЛАТЫ И ДОСТАВКИ ФОРМИРУЕМ ЗАКАЗ
					// ---------------------- 
					if ($valid_shipping_method === true && $valid_payment_method === true)
					{	
						
						$order_currency_rates = $this->get_excanges_rates();
						$order_summ = [];

						$currency_codes = $this->get_currency_codes();

						// Формируем сумму к оплате для заказа с учетом
						// метода доставки и метода оплаты
						foreach ($this->get_available_currencies() as $v_curr) {
							$order_shipping_price = $shipping_prices[$validated_data['shipping_method']]*$order_currency_rates[$v_curr];

							$order_payment_price = $payment_taxes[$validated_data['payment_method']]*$order_currency_rates[$v_curr];
							
							$order_summ_val = (float)$order_cart['cart_subtotal'][$v_curr]['val']+(float)$order_shipping_price+(float)$order_payment_price;

							$order_summ[$v_curr] = [
								'val'=>round($order_summ_val,$price_round['precision'],$round_method),
								'shipping_price'=>round($order_shipping_price,$price_round['precision'],$round_method),
								'payment_price'=>round($order_payment_price,$price_round['precision'],$round_method),
								'currency_code'=>$currency_codes[$v_curr]['text']
							];
						}


						$data_process_new_order =[
							'order_cart'=>json_encode($order_cart,JSON_HEX_QUOT|JSON_UNESCAPED_UNICODE),
							'order_shipping'=>$validated_data['shipping_method'],
							'order_payment'=>$validated_data['payment_method'],
							'order_currency'=>$validated_data['order_currency'],
							//
							'order_currency_rates'=>json_encode($order_currency_rates, JSON_HEX_QUOT|JSON_UNESCAPED_UNICODE),
							'order_summ'=>json_encode($order_summ, JSON_HEX_QUOT|JSON_UNESCAPED_UNICODE),
							//
							'created_date'=>date("Y-m-d H:i:s"),
							'customer_order_comment' =>$validated_data['order_comment'],
							//
							'billing_info' => json_encode(
								[
									'first_name'=>$validated_data['first_name'],
									'second_name'=>$validated_data['second_name'],
									'email'=>$validated_data['email'],
									'phone'=>$validated_data['phone'],
									'address'=>$validated_data['address'],
									'city'=>$validated_data['city'],
									'zipcode'=>$validated_data['zipcode']							
								],
								JSON_HEX_QUOT|JSON_UNESCAPED_UNICODE
							)
						];


						$this->process_new_order($data_process_new_order);

					}
					// ---------------------- 
					//ФОРМИРУЕМ ЗАКАЗ Конец
					// ---------------------- 
					



				}




						
			}	

			//wrap_pre($order_cart,'$order_cart');

			
		}

	}

	



}



  ?>