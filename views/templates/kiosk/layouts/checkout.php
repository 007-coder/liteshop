<?php defined('YV_LiteShop') or die ('Restricted Access!');
$cart = $data['cart'];
$shipping_methods =$data['template_content']['shipping_methods'];
$shipping_prices =$data['template_content']['shipping_prices'];
$payment_methods =$data['template_content']['payment_methods'];
$payment_taxes =$data['template_content']['payment_taxes'];


$cht_form = (isset($data['template_content']['checkout_form'])) ? $data['template_content']['checkout_form'] : null;


?>
<script type="text/javascript">	
	var shipping_methods = {};
	var payment_methods = {};

	
(function ($) {
	$( document ).ready(function() { 

		var shippingPrice_span = $('.product-total span.amount.order_shipping_val');
		var paymentPrice_span = $('.product-total span.amount.order_payment_val');
		var totalToPayPrice_span = $('.product-total span.amount.order_total_to_pay');
		var cartOrderSubtotalPrice_span = $('.product-total span.amount.cart_order_subtotal');
		var cartOrderSubtotalPrice = parseFloat($('.product-total span.amount.cart_order_subtotal').text());

		//hidden inputa
		var hi_totalForPay = $('input#order_total_for_pay');
		var hi_shippingMethod = $('input#hi_shipping_method');
		/*var hi_shippingPrice = $('input#hi_shipping_price');*/
		var hi_paymentMethod = $('input#hi_payment_method');
		/*var hi_paymentPrice = $('input#hi_payment_price');*/


		// -------------- // 
		$('label.sm_label.shipping_method').each(function(){
			$(this).click(function() {
				var shippingCode = $( this ).attr('data-shipping-code');
				var shippingPrice = $( this ).attr('data-shipping-price');
				var paymentPrice = parseFloat(paymentPrice_span.text());
				var totalToPay = parseFloat(paymentPrice)+parseFloat(shippingPrice)+cartOrderSubtotalPrice;
				
				shippingPrice_span.text(parseFloat(shippingPrice));
				totalToPayPrice_span.text(totalToPay);
				//
				hi_shippingMethod.val(shippingCode);
				/*hi_shippingPrice.val(parseFloat(shippingPrice));*/
				hi_totalForPay.val(totalToPay);
				
			});
			
		});
		//
		// -------------- // 
		$('label.pm_label.payment_method').each(function(){
			$(this).click(function() {
				var paymentCode = $( this ).attr('data-payment-code');
				var paymentPrice = $( this ).attr('data-payment-price');
				var shippingPrice = parseFloat(shippingPrice_span.text());
				var totalToPay = parseFloat(paymentPrice)+shippingPrice+cartOrderSubtotalPrice;

				paymentPrice_span.text(parseFloat(paymentPrice));
				totalToPayPrice_span.text(totalToPay);
				//
				hi_paymentMethod.val(paymentCode);
				/*hi_paymentPrice.val(parseFloat(paymentPrice));*/
				hi_totalForPay.val(totalToPay);
			
			});
			
		});


	});	

})(jQuery);

</script>



<?php //kiosk-checkout-area start  ?>
<div class="kiosk-checkout-area ptb-70">
	<div class="container">

			
		
			<?php if (empty($cart)) { ?>
				<h3 class="text-center"><?php echo CKOUT_CANNOT_PROCESS_CHECKOUT ?></h3>
				<h4 class="text-center mt-15"><i class="fa fa-shopping-cart pr-15"></i><?php echo CKOUT_EMPTY_CART ?></h4>
			<?php } else { ?>
				<form action="<?php echo build_shop_link(['type'=>'checkout']);?>" method="POST">			
					<div class="row">

							<?php // billing details ?>
							<div class="col-lg-6 col-md-6">
								<div class="kiosk-checkbox-form">

									<h3><?php echo CKOUT_BILLING_DETAILS ?></h3>
									<div class="row">

										<div class="col-md-12 mb-30">											
											<p><?php echo CKOUT_CUSTOMER_DETAILS_DESCR ?></p>				
										</div>

										<div class="col-md-6">
											<?php
											$i_name = 'first_name';
											$err_class = $tooltip = $i_post_val = '';
											$err_class = (isset($cht_form['error'][$i_name])) ? ' error' : '';
											$tooltip = ($err_class !='') ? '<i class="fas fa-info-circle fs-110 tp_tooltip" data-tippy="'.$cht_form['error'][$i_name].'" ></i>' : '';
											$i_post_val = (isset($cht_form['valid_data'][$i_name]) && $cht_form['valid_data'][$i_name] !='') ? $cht_form['valid_data'][$i_name] : '';
											?>
											<div class="checkout-form-list <?php echo $err_class ?>">
												<label><?php echo CKOUT_FIRST_NAME?> <span class="required">*</span><?php echo $tooltip ?></label>
												<input type="text" name="<?php echo $i_name ?>" placeholder="<?php echo CKOUT_FIRST_NAME ?>" required maxlength="15" minlength="1" value="<?php echo $i_post_val ?>" />
											</div>
										</div>
										<div class="col-md-6">
											<?php
											$i_name = 'second_name';
											$err_class = $tooltip = $i_post_val = '';
											$err_class = (isset($cht_form['error'][$i_name])) ? ' error' : '';
											$tooltip = ($err_class !='') ? '<i class="fas fa-info-circle fs-110 tp_tooltip" data-tippy="'.$cht_form['error'][$i_name].'" ></i>' : '';
											$i_post_val = (isset($cht_form['valid_data'][$i_name]) && $cht_form['valid_data'][$i_name] !='') ? $cht_form['valid_data'][$i_name] : '';
											?>
											<div class="checkout-form-list mb-30 <?php echo $err_class ?>">
												<label><?php echo CKOUT_SECOND_NAME ?> <span class="required">*</span><?php echo $tooltip ?></label>
												<input type="text" name="<?php echo $i_name ?>" placeholder="<?php echo CKOUT_SECOND_NAME ?>" required maxlength="15" minlength="1" value="<?php echo $i_post_val ?>" />
											</div>
										</div>
										<?php /* ?>
										<div class="col-md-12">
											<div class="checkout-form-list mb-30">
												<label>Company Name</label>
												<input type="text" placeholder="" />
											</div>
										</div>
										<?php */ ?>
										<div class="col-md-6">
											<?php
											$i_name = 'email';
											$err_class = $tooltip = $i_post_val = '';
											$err_class = (isset($cht_form['error'][$i_name])) ? ' error' : '';
											$tooltip = ($err_class !='') ? '<i class="fas fa-info-circle fs-110 tp_tooltip" data-tippy="'.$cht_form['error'][$i_name].'" ></i>' : '';
											$i_post_val = (isset($cht_form['valid_data'][$i_name]) && $cht_form['valid_data'][$i_name] !='') ? $cht_form['valid_data'][$i_name] : '';
											?>
											<div class="checkout-form-list mb-30 <?php echo $err_class ?>">
												<label><?php echo CKOUT_EMAIL ?> <span class="required">*</span><?php echo $tooltip ?></label>
												<input type="email" name="<?php echo $i_name ?>" placeholder="<?php echo 'e-mail@mail.com' ?>" required maxlength="30" minlength="5" value="<?php echo $i_post_val ?>" />
											</div>
										</div>
										<div class="col-md-6">
											<?php
											$i_name = 'phone';
											$err_class = $tooltip = $i_post_val = '';
											$err_class = (isset($cht_form['error'][$i_name])) ? ' error' : '';
											$tooltip = ($err_class !='') ? '<i class="fas fa-info-circle fs-110 tp_tooltip" data-tippy="'.$cht_form['error'][$i_name].'" ></i>' : '';
											$i_post_val = (isset($cht_form['valid_data'][$i_name]) && $cht_form['valid_data'][$i_name] !='') ? $cht_form['valid_data'][$i_name] : '';
											?>
											<div class="checkout-form-list mb-30 <?php echo $err_class  ?>">
												<label><?php echo CKOUT_PHONE ?> <span class="required">*</span><?php echo $tooltip; ?></label>
												<input type="text" name="<?php echo $i_name  ?>" placeholder="<?php echo CKOUT_PHONE ?>" required maxlength="19" minlength="5" value="<?php echo $i_post_val ?>" />
											</div>
										</div>

										<?php /* ?>
										<div class="col-md-12">
											<div class="country-select mb-30">
												<label>Country <span class="required">*</span></label>
												<select>
													<option value="volvo">Bangladesh</option>
													<option value="saab">German</option>
													<option value="mercedes">USA</option>
													<option value="audi">Norway</option>
													<option value="audi2">Panama</option>
													<option value="audi3">Brazil</option>
													<option value="audi4">Colombia</option>
												</select>
											</div>
										</div>
										<?php */ ?>

										<div class="col-md-12">
											<?php
											$i_name = 'address';
											$err_class = $tooltip = $i_post_val = '';
											$err_class = (isset($cht_form['error'][$i_name])) ? ' error' : '';
											$tooltip = ($err_class !='') ? '<i class="fas fa-info-circle fs-110 tp_tooltip" data-tippy="'.$cht_form['error'][$i_name].'" ></i>' : '';
											$i_post_val = (isset($cht_form['valid_data'][$i_name]) && $cht_form['valid_data'][$i_name] !='') ? $cht_form['valid_data'][$i_name] : '';
											?>
											<div class="checkout-form-list mb-30 <?php echo $err_class ?>">
												<label><?php echo CKOUT_SHIPPING_ADRESS ?> <span class="required">*</span><?php echo $tooltip  ?></label>
												<input type="text" name="<?php echo $i_name ?>" placeholder="<?php echo CKOUT_SHIPPING_ADRESS_PLACEHOLDER ?>" required maxlength="60" minlength="8" value="<?php echo $i_post_val ?>" />
											</div>
										</div>
										<div class="col-md-6">
											<?php
											$i_name = 'city';
											$err_class = $tooltip = $i_post_val = '';
											$err_class = (isset($cht_form['error'][$i_name])) ? ' error' : '';
											$tooltip = ($err_class !='') ? '<i class="fas fa-info-circle fs-110 tp_tooltip" data-tippy="'.$cht_form['error'][$i_name].'" ></i>' : '';
											$i_post_val = (isset($cht_form['valid_data'][$i_name]) && $cht_form['valid_data'][$i_name] !='') ? $cht_form['valid_data'][$i_name] : '';
											?>
											<div class="checkout-form-list mb-30 <?php echo $err_class ?>">
												<label><?php echo CKOUT_CITY ?> <span class="required">*</span><?php echo $tooltip ?></label>
												<input type="text" name="<?php echo $i_name ?>" placeholder="<?php echo CKOUT_CITY ?>" required maxlength="35" minlength="2" value="<?php echo $i_post_val ?>" />
											</div>
										</div>
										<div class="col-md-6">
											<?php
											$i_name = 'zipcode';
											$err_class = $tooltip = $i_post_val = '';
											$err_class = (isset($cht_form['error'][$i_name])) ? ' error' : '';
											$tooltip = ($err_class !='') ? '<i class="fas fa-info-circle fs-110 tp_tooltip" data-tippy="'.$cht_form['error'][$i_name].'" ></i>' : '';
											$i_post_val = (isset($cht_form['valid_data'][$i_name]) && $cht_form['valid_data'][$i_name] !='') ? $cht_form['valid_data'][$i_name] : '';
											?>
											<div class="checkout-form-list mb-30 <?php echo $err_class ?>">
												<label><?php echo CKOUT_ZIPCODE ?> <?php echo $tooltip ?> </label>
												<input type="text" name="<?php echo $i_name ?>" placeholder="<?php echo CKOUT_ZIPCODE ?>" maxlength="8" minlength="2" value="<?php echo $i_post_val ?>"/>
											</div>
										</div>
									</div>

									<?php /* ?>
									<div class="different-address">
										<div class="ship-different-title">
											<h3>
												<label>Ship to a different address?</label>
												<input id="ship-box" type="checkbox" />
											</h3>
										</div>
										<div id="ship-box-info">
											<div class="row">
												<div class="col-md-6">
													<div class="checkout-form-list">
														<label>First Name <span class="required">*</span></label>
														<input type="text" placeholder="" />
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list mb-30">
														<label>Last Name <span class="required">*</span></label>
														<input type="text" placeholder="" />
													</div>
												</div>
												<div class="col-md-12">
													<div class="checkout-form-list mb-30">
														<label>Company Name</label>
														<input type="text" placeholder="" />
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list mb-30">
														<label>Email Address <span class="required">*</span></label>
														<input type="email" placeholder="" />
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list mb-30">
														<label>Phone  <span class="required">*</span></label>
														<input type="text" placeholder="phone" />
													</div>
												</div>
												<div class="col-md-12">
													<div class="country-select mb-30">
														<label>Country <span class="required">*</span></label>
														<select>
															<option value="volvo">Bangladesh</option>
															<option value="saab">German</option>
															<option value="mercedes">USA</option>
															<option value="audi">Norway</option>
															<option value="audi2">Panama</option>
															<option value="audi3">Brazil</option>
															<option value="audi4">Colombia</option>
														</select>
													</div>
												</div>
												<div class="col-md-12">
													<div class="checkout-form-list mb-30">
														<label>Address <span class="required">*</span></label>
														<input type="text" placeholder="Street address" />
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list mb-30">
														<label>City <span class="required">*</span></label>
														<input type="text" placeholder="" />
													</div>
												</div>
												<div class="col-md-6">
													<div class="checkout-form-list mb-30">
														<label>Zipcode <span class="required">*</span></label>
														<input type="text" placeholder="Postcode / Zipcode" />
													</div>
												</div>
											</div>
										</div>										
									</div>
									<?php */ ?>
									<div class="order-notes">
										<?php
											$i_name = 'order_comment';
											$err_class = $tooltip = $i_post_val = '';
											$err_class = (isset($cht_form['error'][$i_name])) ? ' error' : '';
											$tooltip = ($err_class !='') ? '<i class="fas fa-info-circle fs-110 tp_tooltip" data-tippy="'.$cht_form['error'][$i_name].'" ></i>' : '';
											$i_post_val = (isset($cht_form['valid_data'][$i_name]) && $cht_form['valid_data'][$i_name] !='') ? $cht_form['valid_data'][$i_name] : '';
											?>
										<div class="checkout-form-list <?php echo $err_class ?>">
											<label><?php echo CKOUT_COMMENTS ?><?php echo $tooltip ?></label>
											<textarea id="checkout-mess" cols="30" rows="10" placeholder="<?php echo CKOUT_COMMENTS ?>" name="<?php echo $i_name ?>"><?php echo $i_post_val ?></textarea>
										</div>
									</div>
								</div>
							</div>



							<?php // order_products, payments, shipping ?>
							<div class="col-lg-6 col-md-6">
								<div class="kiosk-checkbox-form">
									<h3><?php echo CKOUT_YOUR_ORDER ?></h3>
								</div>
								<div class="kiosk-order">
									<div class="kiosk-order-table table-responsive">
										<table>
											<tbody>
												<?php foreach ($cart['products'] as $cp_groupe => $c_product) {
													foreach ($c_product as $cproduct) { ?>
														<tr class="cart_item">
															<?php // ?>
															<td class="product_img">
																<?php 
																$cp_img = ($cproduct['main_img'] !== false) ? $data['uri_media_img_products'].$cproduct['product_id'].'/'.$cproduct['main_img'] : URI_NOIMG_PRODUCT;
																$cp_safe_name = (isset($cproduct['mark'][$_lang]) && $cproduct['mark'][$_lang] !='') ? $cproduct['safe_name'][$_lang].' '.$cproduct['mark'][$_lang] : $cproduct['safe_name'][$_lang]; ?>
																<img src="<?php echo $cp_img ?>" alt="<?php echo $cp_safe_name ?>">	
																<?php if ($cproduct['discount']>0) { ?>	
																	<span class="sticker-new sticker-discount"><?php echo '-'.(100*$cproduct['discount']).' %'; ?></span>				
																<?php } ?>								 
															</td>
															<td class="product-name">
																<?php if (isset($cproduct['product_code']) && $cproduct['product_code'] !='') { ?>
																	<p class="p_ean"><?php echo PC_PRODUCT_EAN.': <i>'.$cproduct['product_code'].'</i>' ?></p>
																<?php } ?>																
																<p class="p_link">
																	<?php
																	$cp_safe_name = (isset($cproduct['mark'][$_lang]) && $cproduct['mark'][$_lang] !='') ? $cproduct['safe_name'][$_lang].' '.$cproduct['mark'][$_lang] : $cproduct['safe_name'][$_lang]; ?>
																	<a href="<?php echo $cproduct['link'] ?>" target="_blank" title="<?php echo $cp_safe_name  ?>" class="fs-110"><?php echo $cp_safe_name ?></a>
																</p>
																<p class="p_quantity">
																	<i>
																		<?php echo $cproduct['quantity'].' * '.$cproduct['item_price'][$_currency]['val'].' '.$cproduct['item_price'][$_currency]['currency_code'] ?>
																	</i>																	
																</p>
																<?php // Добавить аттрибуты ?>	
																<?php if (isset($cproduct['attribute']) && count($cproduct['attribute'])) {  ?>
																	<p class="p_attributes">attributes</p>
																<?php } ?>																
															</td>
															<?php // ?>
															<td class="product-total">
																<span class="amount"><b><i><?php echo $cproduct['total_price'][$_currency]['val'].' '.$cproduct['total_price'][$_currency]['currency_code']  ?></i></b></span>
															</td>
														</tr>
													<?php }
												} ?>																							
											</tbody>
											
											<?php /* ?>
											<tfoot>												
												<tr class="cart-subtotal">
													<th>Cart Subtotal</th>
													<td class="product-total">
														<span class="amount">$546.00</span>
													</td>
												</tr>												
											</tfoot>
											<?php */ ?>
										</table>
									</div>

									<div class="kiosk-order-table table-responsive">
										<table>
											<tr class="order-total">
												<td class="h"><?php echo CART_SUBTOTAL ?></td>
												<td class="product-total">
													<i><strong><span class="amount cart_order_subtotal"><?php echo $cart['cart_subtotal'][$_currency]['val'] ?></span></strong>
													<?php echo $cart['cart_subtotal'][$_currency]['currency_code'] ?></i>
												</td>
											</tr>
										</table>
									</div>

									<?php //payment ?>
									<div class="kiosk-payment">
										<div class="payment-accordion">
											<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

												<?php //PAYMENT_METHOD ?>
												<div class="panel panel-default">
													<div class="panel-heading" role="tab" id="headingOne">
														<h4 class="panel-title">
															<i class="far fa-credit-card mr-10"></i>
															<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><?php echo CKOUT_PAYMENT_METHOD ?></a>
														</h4>
													</div>
													<div id="collapseOne" class="panel-collapse collapse  in show" role="tabpanel" aria-labelledby="headingOne">
														<div class="panel-body">
															<p class="mb-10"><?php echo CKOUT_PAYMENT_METHOD_DESCR ?></p>
															<?php echo build_payments_list_html(); ?>
														</div>
													</div>
												</div>

												<?php //SHIPPING_METHOD ?>
												<div class="panel panel-default">
													<div class="panel-heading" role="tab" id="headingTwo">
														<h4 class="panel-title">
															<i class="fas fa-shipping-fast mr-10"></i>
															<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><?php echo CKOUT_SHIPPING_METHOD ?></a>
														</h4>
													</div>
													<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
														<div class="panel-body">
															<p class="mb-10"><?php echo CKOUT_SHIPPING_METHOD_DESCR ?></p>
															<?php echo build_shippings_list_html(); ?>
														</div>
													</div>
												</div>												
											</div>

											<?php // order total table ?>
											<?php
											$f1st_shipping_method = get_1st_shipping_method(); 
											$f1st_payment_method = get_1st_payment_method();
											$round_method='';
											switch ($_price_round['method']) {
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
											$order_total_to_pay = round( ($f1st_shipping_method['price']+$f1st_payment_method['price']+$cart['cart_subtotal'][$_currency]['val']), $_price_round['precision'],$round_method ); 				
											?>
											
											<div class="kiosk-order-table total_to_pay table-responsive mt-20">
												<table>
													<tbody>
														<?php // ?>
														<tr class="cart_item">
															<th><?php echo ORDER_TOTAL_SHIPPING ?></th>
															<td class="product-total">										
																<i><strong><span class="amount order_shipping_val"><?php echo $f1st_shipping_method['price']; ?></span></strong>
																<?php echo $cart['cart_subtotal'][$_currency]['currency_code'] ?></i>
															</td>
														</tr>
														<?php // ?>
														<tr class="cart_item">
															<th><?php echo ORDER_TOTAL_PAYMENT ?></th>
															<td class="product-total">										
																<i><strong><span class="amount order_payment_val"><?php echo $f1st_payment_method['price'] ?></span></strong>
																<?php echo $cart['cart_subtotal'][$_currency]['currency_code'] ?></i>
															</td>
														</tr>
														<?php // ?>
														<tr class="order-total">
															<th><?php echo ORDER_TOTAL ?></th>
															<td class="product-total">
																<i><strong><span class="amount order_total_to_pay"><?php echo $order_total_to_pay; ?></span></strong>
																<?php echo $cart['cart_subtotal'][$_currency]['currency_code'] ?></i>
															</td>
														</tr>

													</tbody>
												</table>
											</div>
											

											<?php // SUBMIT ?>
											<div class="kiosk-payment-btn">
												<input type="submit" value="<?php echo CKOUT_PLACE_ORDER  ?>" />
											</div>

										</div>
									</div>
								</div>
							</div>
							 
					</div>

					<input type="hidden" name="order_currency" value="<?php echo $_currency ?>">
					<input type="hidden" name="cart_order_subtotal" value="<?php echo $cart['cart_subtotal'][$_currency]['val'] ?>">
					<input type="hidden" name="order_total_for_pay" id="order_total_for_pay" value="<?php echo $order_total_to_pay ?>">					
					<input type="hidden" name="action" value="place_order">
		 		</form> 

			<?php } ?>				 
	</div>
</div>


<?php //kiosk-checkout-area end ?>

