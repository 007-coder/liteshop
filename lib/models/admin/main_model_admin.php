<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

class YV_AdminMainModel extends YV_ShopMainModel {

	public function __construct($db, $config){
		parent::__construct($db, $config);
	}


	public function getOrders($page = 1, $limit = 25, $filters = []){

		$limit = ((int)$limit > 0 && is_numeric($limit)) ? $limit : 25;
		$offset = ((int)$page > 1 && is_numeric($page)) ? ($page - 1) * $limit : 0;

		$orders = [];

		$filters['order_by']['column'] = (isset($filters['order_by']['column'])) ? $filters['order_by']['column'] : 'created_date';
		$filters['order_by']['direction'] = (isset($filters['order_by']['direction'])) ? $filters['order_by']['direction'] : 'DESC';

		$WHERE_filters = [];
		foreach ($filters as $fk => $fval) {
			if ($fk != 'order_by') {
				$WHERE_filters[$fk] = $fval;
			}
		}

		//wrap_pre($WHERE_filters, '$WHERE_filters', 'y');

		$SQL_WHERE = $AND = "";
		if (count($WHERE_filters)) {

			$SQL_WHERE = ' WHERE ';
			$AND = (count($WHERE_filters) > 1) ? ' AND ' : '';		 			
			
			$t=0;
			foreach ($WHERE_filters as $wfKey => $wfVal) {
				$t++;
				$_AND = ( $t == count($WHERE_filters) ) ? '' : $AND;
				$SQL_WHERE .= " o.".$wfKey." = '".$wfVal."' ".$_AND;
			}	
		}

		//wrap_pre($SQL_WHERE, '$SQL_WHERE', 'y');


		$query="
		SELECT o.*,	oc.comment as seller_comment 
		FROM `orders` AS o
		LEFT JOIN `order_comments` AS oc
		ON o.order_number  = oc.order_number "
		.$SQL_WHERE.
		" ORDER BY o.".$filters['order_by']['column'] ." ".$filters['order_by']['direction']."		
		LIMIT ".$limit." OFFSET ".$offset."";

		//wrap_pre($query, '$query','y');

		$rows = $this->_db->rawQuery($query);		

		if (count($rows)) {
			$json_decode = ['order_summ','order_currency_rates','billing_info','order_cart'];		
			foreach ($rows as $r => $order) {				
				foreach ($json_decode as $index) {		
					$tmp = json_decode(htmlspecialchars_decode($order[$index]),true);

						
					$order[$index] = (json_last_error_msg() =='No error') ? $tmp : $order[$index];	
					/*
					if (json_last_error_msg() !='No error') {
						$JSONerror = 'order['.$r.']['.$index.'] - '.json_last_error_msg(); 
						wrap_pre($JSONerror);				
					}*/
					
				}
				$orders[] = $order;			
			}		
			
		}

		//wrap_pre($orders, '$orders');

		return $orders;	

	}


   public function getCountOrders($filters = []) {
      $SQL_WHERE = $AND = "";

		if (count($filters)) {

         $WHERE_filters = [];
         foreach ($filters as $fk => $fval) {
            if ($fk != 'order_by') {
               $WHERE_filters[$fk] = $fval;
            }
         }

         //wrap_pre($WHERE_filters, '$WHERE_filters', 'y');
         //
         if (count($WHERE_filters)) {

            $SQL_WHERE = ' WHERE ';
            $AND = (count($WHERE_filters) > 1) ? ' AND ' : '';

            $t=0;
            foreach ($WHERE_filters as $wfKey => $wfVal) {
               $t++;
               $_AND = ( $t == count($WHERE_filters) ) ? '' : $AND;
               $SQL_WHERE .= " `".$wfKey."` = '".$wfVal."' ".$_AND;
            }
         }

         //wrap_pre($SQL_WHERE, '$SQL_WHERE', 'y');



		} 

		$query = "SELECT COUNT(*) as count FROM `orders` ".$SQL_WHERE;
		$row = $this->_db->rawQueryOne($query);
		return $row['count'];
	}

	public function getCalls ($offset = 0, $limit = 25, $filters = []) {
		$orders = [];

		return $orders;

	}

	public function getCountCalls(){	

	}

	public function getOrderSumm($order_number) {
		$query = "
		SELECT order_summ FROM `orders`
		WHERE order_number = '".$order_number."'";

		return $this->_db->rawQueryOne($query);

	}

	public function updateOrderStatuses($data) {
		$query = "
		UPDATE `orders`
		SET order_status = '".$data['order_status']."', order_payment_status = '".$data['order_payment_status']."'
		WHERE order_number = '".$data['order_number']."'
		";

		try {
			$this->_db->rawQuery($query);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}


	public function updateOrderBilling($data) {

		$order_summ = $this->getOrderSumm($data['order_number']);
		$order_summ = json_decode($order_summ['order_summ'],true);
	

		$orderSumm = '';
		if (count($order_summ)) {
			$orderSummUpdate = [];
			foreach ($order_summ as $curr_code => $summ) {

				$_val = (float)$summ['val'] - (float)$summ['shipping_price'] - (float)$summ['payment_price']; 

				$orderSummUpdate[$curr_code] = [
					'val'=>$_val + (float)$data['order_summ'][$curr_code]['shipping_price'] + (float)$data['order_summ'][$curr_code]['payment_price'],
					'shipping_price'=>$data['order_summ'][$curr_code]['shipping_price'],
					'payment_price'=>$data['order_summ'][$curr_code]['payment_price'],
					'currency_code'=>$summ['currency_code']
				];

			}

			$orderSumm = json_encode($orderSummUpdate, JSON_HEX_QUOT|JSON_UNESCAPED_UNICODE);
		}

		$orderBilling = json_encode(
			[
				'first_name'=>$data['first_name'],
				'second_name'=>$data['second_name'],
				'email'=>$data['email'],
				'phone'=>$data['phone'],
				'address'=>$data['address'],
				'city'=>$data['city'],
				'zipcode'=>$data['zipcode']			
			],
			JSON_HEX_QUOT|JSON_UNESCAPED_UNICODE
		);		

		$query = "
		UPDATE `orders`
		SET billing_info = '".$orderBilling."', order_summ='".$orderSumm."', order_shipping='".$data['order_shipping']."', order_payment='".$data['order_payment']."'
		WHERE order_number = '".$data['order_number']."'";
				
		try {
			$this->_db->rawQuery($query);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}


	public function updateOrderProducts($data) {

		$modefDate = (isset($date['modified_date']) && is_string($date['modified_date'])) ? $date['modified_date'] : date("Y-m-d H:i:s");

		$query = "
		UPDATE `orders`
		SET order_summ  = '".$data['order_summ']."', order_cart ='".$data['order_cart']."', modified_date='".$modefDate."'
		WHERE order_number = '".$data['order_number']."'";
				
		try {
			$this->_db->rawQuery($query);
			return true;
		} catch (Exception $e) {
			return false;
		}

	}

	public function deleteOrder($order_number) {

		$query = "DELETE FROM orders WHERE order_number='".$order_number."'";
				
		try {
			$this->_db->rawQuery($query);
			return true;
		} catch (Exception $e) {
			return false;
		}

	}

	
}
?>