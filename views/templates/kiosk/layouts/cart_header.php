<?php defined('YV_LiteShop') or die ('Restricted Access!');?>

<?php if (empty($data['cart']['products'])) { ?>
	<div class="single-kiosk-cart">
		<p class="empty_cart"><?php echo EMPTY_CART ?></p>
	</div>
<?php } else { ?>
	<?php foreach ($data['cart']['products'] as $has_attr => $cart_products) { 
			if (count($cart_products)) {
				foreach ($cart_products as $cp_id => $cart_product) { ?>
				<?php // Cart Box Start ?>				

				<div class="single-kiosk-cart <?php echo $has_attr ?>">
					<div class="cart-img">
						<a href="<?php echo $cart_product['link'] ?>">
							<?php
							$cp_img = ($cart_product['main_img'] !== false) ? $data['uri_media_img_products'].$cart_product['product_id'].'/'.$cart_product['main_img'] : URI_NOIMG_PRODUCT;
							$cp_safe_name = (isset($cart_product['mark'][$_lang]) && $cart_product['mark'][$_lang] !='') ? $cart_product['safe_name'][$_lang].' '.$cart_product['mark'][$_lang] : $cart_product['safe_name'][$_lang];

							 ?>
							<img src="<?php echo $cp_img ?>" alt="<?php echo $cp_safe_name ?>">
						</a>

						<?php if (isset($cart_product['discount']) && $cart_product['discount'] > 0) { ?>
							<span class="sticker-new sticker-discount"><?php echo '-'.(100*$cart_product['discount']).' %'; ?></span>
						<?php } ?>

					</div>
					<div class="cart-content">
						<h6><a href="<?php echo $cart_product['link'] ?>" target="_blank"><?php echo $cp_safe_name ?></a></h6>
						<span class="cart_prod_price"><?php echo $cart_product['item_price'][$_currency]['val'].' '.$cart_product['item_price'][$_currency]['currency_code'] ?></span>
					</div>
					<div class="clear"></div>
					<div class="qty_subtotal">
						<span class="qty_text"><?php echo CART_QTY.': <i>'.$cart_product['quantity'].'</i>' ?></span> * <span><i><?php echo $cart_product['item_price'][$_currency]['val'] ?></i></span> = <span class="qty_subtotal_val"><b><i><?php echo  $cart_product['total_price'][$_currency]['val'].' '.$cart_product['total_price'][$_currency]['currency_code']   ?></i></b></span>
					</div>													
				</div>
				<?php // Cart Box End ?>
			<?php } ?>
<?php }
} ?>
	
	<?php // Cart Footer Inner Start ?>										
	<div class="cart-footer fix">											
		<h5><?php echo CART_SUBTOTAL ?><span class="f-right"><b><?php echo $data['cart']['cart_subtotal'][$_currency]['val'].' '.$data['cart']['cart_subtotal'][$_currency]['currency_code'];?></b></span></h5>

		<div class="kiosk-cart-button">			

			<?php if (!in_array($data['page'], ['cart','checkout'])) { ?>			

				<a class="button slider-btn" href="<?php echo build_shop_link(['type'=>'cart']); ?>"><?php echo CART_VIEW_CART ?></a>			
				<a class="button slider-btn f-right mr-0" href="<?php echo build_shop_link(['type'=>'checkout'])?>"><?php echo CKOUT_VIEW_CHECKOUT ?></a>			

			<?php } else { 

				if ($data['page'] =='checkout') { 
					$bHCartHref = build_shop_link(['type'=>'cart']);
					$bHCartName = CART_VIEW_CART;
				} else if ($data['page'] =='cart') {
					$bHCartHref = build_shop_link(['type'=>'checkout']);
					$bHCartName = CKOUT_VIEW_CHECKOUT;
				}
			?>
				<a class="button slider-btn f-right mr-0" href="<?php echo $bHCartHref?>"><?php echo $bHCartName ?></a>

			<?php } ?>
		</div>
	</div>
	<?php // Cart Footer Inner End ?>
<?php } ?>