<?php 
defined('YV_LiteShop') or die ('Restricted Access!');



// Группы запроссов
$actions_groups = [
	'login'=>['admin_login'],
	'orders'=>['update_order_billing','update_order_products','change_order_status','delete_order','filter_orders','reset_filters','change_records_per_page'],
	'call_me'=>['save_call_me']
];	

$valid_post_actions = [];
foreach ($actions_groups as $actions) {
	$valid_post_actions = array_merge($valid_post_actions, $actions);
}


if (isset($_POST) && count($_POST) && in_array($_POST['action'], $valid_post_actions)) {

	// ****ЛОГИН**** ($actions_groups['login'])
	// ------------------------
	if (in_array($_POST['action'], $actions_groups['login'])) {
		$this->loginAdmin($_POST);
	}

	


	if (isset($_POST['area']) && is_string($_POST['area']) && array_key_exists($_POST['area'], $actions_groups)) {

		// ---- $actions_groups['orders']  START -----	
		if ($_POST['area'] == 'orders' && in_array($_POST['action'], $actions_groups['orders'])) {
			
			
			switch ($_POST['action']) {

				// ****Изменяем товары заказа****				
				// ------------------------
				case 'update_order_products':					
					$this->updateOrderProducts($_POST);
					break;

				// ****Изменяем биллинг заказа****				
				// ------------------------
				case 'update_order_billing':					
					$this->updateOrderBilling($_POST);
					break;

				// ****Изменяем статус заказа****				
				// ------------------------
				case 'change_order_status':					
					$this->updateOrderStatuses($_POST);
					break;

				// ****Удаляем заказ****				
				// ------------------------
				case 'delete_order':					
					$this->deleteOrder($_POST);
					break;

				// ****Фильтр заказов****				
				// ------------------------
				case 'filter_orders':					
					$this->setFilters($_POST);
					break;

				// ****Сбросить Фильтр заказов****				
				// ------------------------
				case 'reset_filters':					
					$this->resetFilters($_POST);
					break;

				// ***Кол-во заказов на странице****				
				// ------------------------
				case 'change_records_per_page':					
					$this->setRecordsPerPage($_POST);
					break;
				
				
			}

		}		
		// ---- $actions_groups['orders']  END -----

	}

	
	
	
}

?>