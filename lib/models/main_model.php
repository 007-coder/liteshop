<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

class YV_ShopMainModel {
	protected $_db;
	protected $_config;

	public function __construct($db, $config) {
		$this->_db = $db;
		$this->_config = $config;
	}

	public function get_orders(){
		$q="SELECT * FROM orders WHERE 1=1";
		$ret = $this->_db->rawQuery($q);
		return $ret;
	}

	// получаем данные о заказе
	public function get_order($order_key, $order_pin){		
		$row = [];
		$query="
		SELECT o.*,	oc.comment as seller_comment 
		FROM `orders` AS o
		LEFT JOIN `order_comments` AS oc
		ON o.order_number  = oc.order_number 
		WHERE o.order_key= '".$order_key."' AND o.order_pin= '".$order_pin."'";		

		$row = $this->_db->rawQueryOne($query);
		if (count($row)) {
			$json_decode = ['order_summ','order_currency_rates','billing_info','order_cart'];			
			foreach ($json_decode as $index) {				
				$row[$index] = json_decode(htmlspecialchars_decode($row[$index]),true);				
			}
		}

		return $row;		
	}


	public function insert_new_order($data){	
		$query="
		INSERT INTO orders (order_number, order_key, order_pin, order_status, order_payment_status, order_summ, order_currency, order_currency_rates, billing_info, order_cart, order_shipping, order_payment, customer_order_comment, created_date)
		VALUES ('".$data['order_meta']['order_number']."', '".$data['order_meta']['order_key']."', '".$data['order_meta']['order_pin']."', '".$data['order_status']."', '".$data['order_payment_status']."', '".$data['order_summ']."', '".$data['order_currency']."', '".$data['order_currency_rates']."', '".$data['billing_info']."', '".$data['order_cart']."', '".$data['order_shipping']."', '".$data['order_payment']."', '".$data['customer_order_comment']."', '".$data['created_date']."' )";

		try {
			$this->_db->rawQuery($query);		
			return true;		

		} catch (Exception $e) {
		
			return false;
			//echo '<b>'.$e->getMessage().'</b><br>';
		}

	}



	
	
}


 ?>