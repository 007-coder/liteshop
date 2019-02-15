<?php defined('YV_LiteShop') or die ('Restricted Access!');
$cart = $data['cart'];
//wrap_pre($cart);

$_cart = json_encode($cart, JSON_HEX_QUOT|JSON_UNESCAPED_UNICODE);


?>

<?php  //Cart Main Area Start ?>
<div class="kiosk-products-cart ptb-70 pb-sm-50">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<?php if (empty($cart) ) { ?>
					
					<h3 class="empty_cart_text text-center"><i class="fa fa-shopping-cart pr-15"></i><?php echo EMPTY_CART ?></h3>

				<?php } else { ?>								
					<div class="table-content table-responsive">
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
								<?php foreach ($cart['products'] as $prod_groupe => $prod_groupe_value) { ?>
									<?php foreach ($prod_groupe_value as $prod_id => $cart_product) { ?>
										<tr>
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
																										
													<span class="amount_cart_price"><?php echo $cart_product['item_price'][$_currency]['val'].' '.$cart_product['item_price'][$_currency]['currency_code']  ?>														
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
											<?php //
											//product-quantity ?>	
											<td class="product-quantity">
												<form action="<?php echo build_shop_link(['type'=>'cart']) ?>" method="POST">
													<input value="<?php echo $cart_product['quantity'] ?>" name="quantity" type="number">													
													<input type="hidden" name="product_id" value="<?php echo $cart_product['product_id'] ?>">
													<input type="hidden" name="action" value="cart_update">			
													<button type="submit" title="<?php echo CART_UPDATE ?>"><i class="fas fa-cart-arrow-down fa-2x"></i></button>	
												
													
												</form>


											</td>
											<?php //
											//product-total ?>	
											<td class="product-total text-center"><span class="amount_cart_price total"><?php echo $cart_product['total_price'][$_currency]['val'].' '.$cart_product['total_price'][$_currency]['currency_code']?></span>
											</td>
											<?php //
											//product-remove from cart ?>
											<td class="product-add-to-cart">
												<form action="<?php echo build_shop_link(['type'=>'cart']) ?>" method="POST">																	
													<input type="hidden" name="product_id" value="<?php echo $cart_product['product_id'] ?>">
													<input type="hidden" name="action" value="cart_remove">
													<button type="submit" title="<?php echo CART_REMOVE ?>"><i class="far fa-minus-square fa-2x"></i></button>
												</form>												
											</td>
											
										</tr>
									<?php } ?>
									
								<?php } ?>								
							</tbody>
						</table>

						<div class="subtotal_wrap ptb-40 ">
							<div class="container">
  							<div class="row justify-content-end">
  								<div class="col-4 col-md-3">
  									<h4><?php echo CART_SUBTOTAL_PAY.': ' ?>
  										<span class="f-right"><i><b><?php echo $cart['cart_subtotal'][$_currency]['val'].' '.$cart['cart_subtotal'][$_currency]['currency_code'];?></b></i></span>
  									</h4>
  									<div class="pt-10">
  										<div class="kiosk-cart-button">
  											<a class="button slider-btn" href="<?php echo build_shop_link(['type'=>'checkout'])?>"><?php echo CKOUT_VIEW_CHECKOUT ?></a>	
  										</div>  										
  									</div>
  								</div>
  							</div>
  						</div>
						</div>

					</div>					
				<?php } ?>

			</div>
		</div>
		<?php //Row End ?>
		 
	</div>
</div>
<?php  //Cart Main Area End ?>



