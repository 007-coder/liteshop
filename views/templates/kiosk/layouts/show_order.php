<?php defined('YV_LiteShop') or die ('Restricted Access!');
$order = $data['template_content']['order'];
$orderStatuses = $data['template_content']['order_statuses'];
$paymentStatuses = $data['template_content']['orderPaymentStatuses'];
$shippingMethods = $data['template_content']['shippingMethods'];
$paymentMethods = $data['template_content']['paymentMethods'];

//http://localhost/liteshop/?page=show_order&k=LT4YNKG0PH902T&p=406480

// Добавить комментарии магазина

?> 

 <?php //kiosk-showorder-area start  ?>

<div class="kiosk-order-area ptb-70">
	<div class="container ">	

	<div class="row justify-content-center pb-30">		
		<div class="col-md-6 col-sm-12">
			<p class="order_status text-center pb-20">
				<?php
				$osName = $orderStatuses[$order['order_status']]['name'][$_lang];
				$ospName = $paymentStatuses[$order['order_payment_status']]['name'][$_lang];
				$osColor = (isset($orderStatuses[$order['order_status']]['color'])) ? 'background: '.$orderStatuses[$order['order_status']]['color'].';' : '';
				$osTextColor = (isset($orderStatuses[$order['order_status']]['text_color'])) ? 'color: '.$orderStatuses[$order['order_status']]['text_color'].';' : '';
				$osStyle = 'style="'.$osColor.$osTextColor.'"';

				$ospColor = (isset($paymentStatuses[$order['order_payment_status']]['color'])) ? 'background: '.$paymentStatuses[$order['order_payment_status']]['color'].';' : '';
				$ospTextColor = (isset($paymentStatuses[$order['order_payment_status']]['text_color'])) ? 'color: '.$paymentStatuses[$order['order_payment_status']]['text_color'].';' : '';

				$ospStyle = 'style="'.$ospColor.$ospTextColor.'"';

				?>
				<span class="<?php echo 'os '.$order['order_status'] ?>" <?php echo $osStyle ?>><?php echo $osName ?></span>
				<span class="<?php echo 'osp '.$order['order_payment_status'] ?>" <?php echo $ospStyle ?>><?php echo $ospName ?></span>
			</p>			
			<h2 class="order_number text-center"><span class="label"><?php echo SHOW_ORDER_ORDER_NUMBER.': ' ?></span> <span class="val"><?php echo format_order_number($order['order_number'], [4,'-']) ?></span>
			</h2>
			<p class="order_date text-center"><?php echo $order['created_date']  ?></p>
			<h3 class="order_summ text-center pt-30">
				<?php echo $order['order_summ'][$_currency]['val']?> <span class="currency_code"><?php echo $order['order_summ'][$_currency]['currency_code'] ?></span>				
			</h3>
		</div>
	</div>


	<?php if ($order['order_status'] == 'new') { ?>
		<div class="row justify-content-center pb-50 pt-30">		
			<div class="col-md-8 col-sm-12">
				<p class="oder_message">
					<h3 class=" text-center"><?php echo SHOW_ORDER_ORDER_STATUS_NEW_MESSAGE_1 ?>						
					</h3>
					<h5 class=" text-center"><?php echo SHOW_ORDER_ORDER_STATUS_NEW_MESSAGE_2 ?>						
					</h5>
				</p>
			</div>
		</div>
	<?php } ?>


	<div class="row pb-20">
		<div class="col-md-6 col-sm-12">
			<h3><?php echo SHOW_ORDER_PRODUCTS?></h3>
		</div>
	</div>

	<?php require_once($layouts_path.'showOrderCart.php');	 ?>

	<div class="row ptb-30">
		<div class="col-md-3 col-sm-6 pb-20">
			<h4><?php echo SHOW_ORDER_BILLING?></h4>
			<div class="billing">
				<?php
				$billingInfo = $order['billing_info'];
				$biLabels = [
					'first_name'=>SHOW_ORDER_FIRST_NAME,
					'second_name'=>SHOW_ORDER_SECOND_NAME,
					'email'=>SHOW_ORDER_EMAIL,
					'phone'=>SHOW_ORDER_PHONE,
					'address'=>SHOW_ORDER_ADDRESS,
					'city'=>SHOW_ORDER_CITY,
					'zipcode'=>SHOW_ORDER_ZIPCODE
				];
				foreach ($billingInfo as $bk => $bv) { 
					if (!in_array($bk, ['customer_order_comment'])) {
				?>
					<p>
						<span class="label"><?php echo $biLabels[$bk].': ' ?></span> <span class="val"><?php echo $bv ?></span>
					</p>
				<? }
				} ?>				
			</div>
		</div>
		<div class="col-md-3 col-sm-6 pb-20">
			<h4><?php echo SHOW_ORDER_SHIPPING_METHOD?></h4>
			<p class="shipping"><?php
			foreach ($shippingMethods as $sm) {
				if ($order['order_shipping'] == $sm['code']) {
					echo $sm['name'][$_lang].'<br><span class="m_price amount_cart_price total">'.$order['order_summ'][$_currency]['shipping_price'].'</span><span class="currency_code">'.$order['order_summ'][$_currency]['currency_code'].'</span>';
				}
			}

			
			?></p>
		</div>
		<div class="col-md-3 col-sm-6 pb-20">
			<h4><?php echo SHOW_ORDER_PAYMENT_METHOD?></h4>
			<p class="payment">
				<?php
				foreach ($paymentMethods as $pm) {
				if ($order['order_payment'] == $pm['code']) {
					echo $pm['name'][$_lang].'<br><span class="m_price amount_cart_price total">'.$order['order_summ'][$_currency]['payment_price'].'</span><span class="currency_code">'.$order['order_summ'][$_currency]['currency_code'].'</span>';
				}
			}

				  ?>
			</p>
		</div>
		<div class="col-md-3 col-sm-6 pb-20">
			<h4><?php echo SHOW_ORDER_COMMENTS?></h4>
			<p class="comments">
				<?php echo (isset($order['customer_order_comment'])) ? $order['customer_order_comment'] : ''; ?>
			</p>
		</div>

	</div>


	</div>
</div>

