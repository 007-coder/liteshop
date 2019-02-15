<?php defined('YV_LiteShop') or die ('Restricted Access!');
$orProdsSubtotal = $order['order_cart']['cart_subtotal']; 

$JSON_orderProducts = json_encode($products, JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);
$JSON_orProdsSubtotal = json_encode($orProdsSubtotal, JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);		
$JSON_orSumm = json_encode($order['order_summ'], JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);		

//wrap_pre($products, 'products');

?>
<?php if (count($products)) { ?>

<form action="<?php echo build_admin_link(['type'=>'orders']) ?>" method="post" >

	<?php // контент товары ?>
	<div class="modal-body in_order_products">

		<div class="<?php echo $shopTemplate.'-products-cart' ?> table-content table-responsive">
			<?php //wrap_pre($order['order_cart'], '$order[\'order_cart\']'); ?>
			<table>
				<thead>
					<tr>
						<th class="kiosk-product-thumb"><?php echo CART_IMAGE ?></th>
						<th class="product-name"><?php echo CART_PRODUCT ?></th>
						<th class="product-price"><?php echo CART_PRICE ?></th>
						<th class="product-quantity"><?php echo CART_QUANTITY ?></th>
						<th class="product-total"><?php echo CART_TOTAL ?></th>
						<th class="kiosk-product-remove"><?php echo CART_REMOVE ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($products as $prod_groupe => $prod_groupe_value) { ?>
						<?php foreach ($prod_groupe_value as $prod_id => $cart_product) { ?>
							<tr class="<?php echo 'orderCart_prow_pgroupe-'.$prod_groupe.'_pid'.$cart_product['product_id'] ?>" data-order="<?php echo $order['order_number'] ?>" data-product-id="<?php echo $cart_product['product_id']  ?>" data-product-groupe="<?php echo $prod_groupe ?>" data-quantity="<?php echo $cart_product['quantity'] ?>">

								<?php // IMAGE ?>
								<td class="kiosk-product-thumb">
									<div class="kiosk-product-img">
										<?php
										$cp_img = ($cart_product['main_img'] !== false) ? $data['uri_media_img_products'].$cart_product['product_id'].'/'.$cart_product['main_img'] : URI_NOIMG_PRODUCT;
										$cp_safe_name = (isset($cart_product['mark'][$_lang]) && $cart_product['mark'][$_lang] !='') ? $cart_product['safe_name'][$_lang].' '.$cart_product['mark'][$_lang] : $cart_product['safe_name'][$_lang];
										  ?>
										<a href="<?php echo $cart_product['link'] ?>" target="_blank"><img src="<?php echo $cp_img ?>" alt="<?php echo $cp_safe_name ?>" /></a>
									</div>

									<?php // стикеры ?>
									<?php
									$showLabels = ( (isset($cart_product['discount']) && $cart_product['discount'] > 0) || (isset($cart_product['label']) && count($cart_product['label'])) ) ? true : false;

									if ($showLabels) { ?>
										<div class="stickers_wrap">
											<ul class="inner_wrap">
												<?php if ($cart_product['discount']>0) { ?>
												<li class="">
													<span class="sticker-new sticker-discount"><?php echo '-'.(100*$cart_product['discount']).' %'; ?></span>
												</li>
												<?php }
												if (isset($cart_product['label']) && count($cart_product['label'])) {
													foreach ($cart_product['label'] as $cpLabel) { ?>
														<li class="">
															<span class="sticker-new label mb-10">
																<?php if ($cpLabel['img'] !='') { ?>
																<?php } else { 
																	echo $cpLabel['text'][$_lang];  
																} ?>
															</span>											
														</li>
													<?php }
												}
												?>
											</ul>
										</div>
									<?php } ?>
									
								</td>
								<?php // product-name ?>
								<td class="product-name">
									<?php if ($cart_product['product_code'] !='') { ?>
									<p class="prod_ean fs-95"><?php echo PC_PRODUCT_EAN.': <i>'.$cart_product['product_code'].'</i>';  ?></p>
									<?php } ?>
									<a href="<?php echo $cart_product['link'] ?>" class="fs-110"><?php echo $cp_safe_name ?></a>
									<?php if (isset($cart_product['attribute']) && count($cart_product['attribute'])) {  ?>
									<div class="attributes">
										<p><?php echo PC_PRODUCT_ATTRIBUTES.': ' ?></p>
									</div>
									<?php } ?>
								</td>
								<?php 
								//


								//product pcs price ?>
								<td class="product-price">
									<p class="item_price">
										<?php if (isset($cart_product['item_price'][$_currency]['1unit_price']) && $cart_product['item_price'][$_currency]['1unit_price'] > 0 ) { ?>
										<span class="amount_cart_price old 1unit"><?php echo $cart_product['item_price'][$_currency]['1unit_price'].' '.$cart_product['item_price'][$_currency]['currency_code']  ?>														
										</span><br>
										<?php } else if (isset($cart_product['item_price'][$_currency]['old_price']) && $cart_product['item_price'][$_currency]['old_price'] > 0 ) { ?>
										<span class="amount_cart_price old"><?php echo $cart_product['item_price'][$_currency]['old_price'].' '.$cart_product['item_price'][$_currency]['currency_code']  ?>														
										</span><br>													
										<?php } ?>

																							
										<span class="amount_cart_price" id="<?php echo 'prod_item_price_pid'.$cart_product['product_id'].'_order'.$order['order_number'] ?>"><i class="val"><?php echo $cart_product['item_price'][$_currency]['val']?></i><?php echo ' '.$cart_product['item_price'][$_currency]['currency_code']  ?>														
										</span>
									</p>
									
									<?php if (isset($cart_product['qty_price']) && count($cart_product['qty_price'])) { ?>										
									<p class="qty_item_text">
										<?php foreach ($cart_product['qty_price'] as $cpq_data) {
												if ($cart_product['quantity'] >= $cpq_data['start'] && $cart_product['quantity']<=$cpq_data['end']) { 
														echo CART_QTY_FROM.' '.$cpq_data['start'].' '.CART_QTY_UNIT.' '.CART_QTY_TO.' '.$cpq_data['end'].' '.CART_QTY_UNIT; ?>
											
												<?php }
										} ?>
									</p>
									<?php } ?>
									</td>
								

								<?php 
								//product-quantity ?>	
								<td class="product-quantity">									
									<input value="<?php echo $cart_product['quantity'] ?>" id="<?php echo 'quantity_pid'.$cart_product['product_id'].'_order'.$order['order_number'] ?>" type="number" class="quantity_input" data-order="<?php echo $order['order_number'] ?>" data-product-id="<?php echo $cart_product['product_id'] ?>" data-product-groupe="<?php echo $prod_groupe ?>" data-order-currency="<?php echo $order['order_currency'] ?>">
								</td>


								<?php //
								//product-total ?>	
								<td class="product-total text-center"><span id="<?php echo 'prod_total_pid'.$cart_product['product_id'].'_order'.$order['order_number'] ?>" class="amount_cart_price total"><i class="val"><?php echo $cart_product['total_price'][$_currency]['val']?></i><?php echo ' '.$cart_product['total_price'][$_currency]['currency_code']?></span>
								</td>

								
								<?php //
								//product-remove from cart ?>
								<td class="product-add-to-cart">									
									<button type="button" class="prod_removeBtn" title="<?php echo CART_REMOVE ?>" data-order="<?php echo $order['order_number'] ?>" data-product-id="<?php echo $cart_product['product_id'] ?>" data-product-groupe="<?php echo $prod_groupe ?>" data-order-currency="<?php echo $order['order_currency'] ?>"><i class="far fa-minus-square fa-2x"></i></button>													
								</td>
								
							</tr>
						<?php } ?>
						
					<?php } ?>								
				</tbody>
			</table>



			<div class="subtotal_wrap pt-5 pb-3">
				<div class="container">
					<div class="row justify-content-end">
						<div class="col-4 col-md-3">
							<h2 class="text-right"><?php echo CART_SUBTOTAL_PAY.': ' ?>
								<span id="<?php echo 'order_summ_order'.$order['order_number'] ?>"><?php echo $orProdsSubtotal[$_currency]['val'] ?></span>
								<span class="currency_code"><?php echo $orProdsSubtotal[$_currency]['currency_code']?></span>
							</h2>					
						</div>
					</div>
				</div>
			</div>

			

			</div>

	</div>



	<div class="modal-footer">
	  <button type="submit" class="btn btn-primary"><?php echo $i18n->t('FBT_SAVE') ?></button>
	  <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal"><?php echo $i18n->t('FBT_CLOSE') ?></button> 
	</div>


	<input type="hidden" name="order_number" value="<?php echo $order['order_number'] ?>">
	<input type="hidden" name="area" value="orders">
	<input type="hidden" name="action" value="update_order_products">
	


	<textarea name="order_cart" class="disp_none" id="<?php echo 'txtAr_orderCart'.$order['order_number'] ?>" cols="30" rows="10"><?php echo $JSON_orderProducts ?></textarea> 	

	<textarea name="order_summ" class="disp_none" id="<?php echo 'txtAr_orderSupSumm_'.$order['order_number'] ?>" cols="30" rows="10"><?php echo $JSON_orSumm ?></textarea>
	<input type="hidden" id="<?php echo 'orderModifiedDate_'.$order['order_number'] ?>" name="modified_date" value="<?php echo time()?>">
	
</form>

<?php }?>
