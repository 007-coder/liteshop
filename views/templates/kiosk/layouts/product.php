<?php 
defined('YV_LiteShop') or die ('Restricted Access!');
$product = $tmpl_content['product_page_content'];
$_cart = $data['cart'];

$is_for_sale = (($product['in_stock'] && $product['items_left'] == 'unlim') || ( (int)$product['items_left']>0 && $product['in_stock'] ) ) ? true : false;


//https://getbootstrap.com/docs/4.0/components/input-group/

 ?>

<?php  //Product Thumbnail Start ?>
<div class="kiosk-product-details ptb-70">
	<div class="container">
		<div class="row">
		<?php // Изменение цены товара в зависимости от кол-ва ?>
		<script type="text/javascript">			

			//var shopCurrency = '<?php echo $_currency ?>';
			var product_qty_price = [];
			var onePcsPrice = {				
				<?php foreach ($product['product_price'] as $pCurr => $pValues) { ?>
					"<?php echo $pCurr ?>" : {
						"val" : parseFloat(<?php echo  $pValues['val']; ?>),						
						<?php if (isset($pValues['old_price'])) { ?>
							"old_price" : parseFloat(<?php echo  $pValues['old_price']; ?>),
						<?php } ?>						
						"currency_code" : '<?php echo  $pValues['currency_code']; ?>'
					},
				<? } ?>
			};


			<?php if (count($product['qty_price'])) { ?>
				var product_id = <?php echo $product['product_id'] ?>;								
				<?php
				$pi = 0;
				foreach ($product['qty_price'] as $q_price) { ?>	
					product_qty_price[<?php echo $pi ?>] = <?php echo 
						'	{	
								"start" : '.$q_price['start'].',
								"end" : '.$q_price['end'].',
								"discount" : '.$q_price['discount'].'
							};';														
					$pi++;
				 } ?>
				
			<?php } ?>


			$(document).ready(function() {

				$('#product_quantity').on('change', function(e) {
					var quantity = parseInt($(this).val());					
					var discount = 0;

					/*var pcsPrice = onePcsPrice.<?php // echo $_currency ?>.val;*/

					var qtyPrice = 0;
					var qtyPriceOld = 0;
					var roundPrecision = 2;
					var priceBlock = $('.kiosk-product-description .pro-price h3 .val');
					var pcsPriceBlock = $('.kiosk-product-description .pro-price .prod_pcs_price .val');
					var oldPriceBlock = $('.kiosk-product-description .pro-price .oldPrice .val');
					

					// если установлены цены в зависимости от кол-ва
					if (product_qty_price.length) {
						for (var i = 0; i < product_qty_price.length; i++) {
							var qt = product_qty_price[i];
							if (quantity >= qt.start && quantity <= qt.end) {								
								discount = parseFloat(qt.discount);		
								/*pcsPrice = onePcsPrice.<?php echo $_currency ?>.val - (parseFloat(onePcsPrice.<?php echo $_currency ?>.val*discount));	
								pcsPrice = round(pcsPrice,roundPrecision);*/
								break;
							}							
						}						
					}					

					var pcsQtyPrice = onePcsPrice.<?php echo $_currency ?>.val - (parseFloat(onePcsPrice.<?php echo $_currency ?>.val*discount));	
					pcsQtyPrice = round(pcsQtyPrice,roundPrecision);

					if (product_qty_price.length) {
						if (pcsQtyPrice != parseFloat(pcsPriceBlock.text())) {
							pcsPriceBlock.html(pcsQtyPrice);
						} 
					}	

					qtyPrice = round(parseFloat(pcsQtyPrice * quantity),roundPrecision);
					
					//  
					priceBlock.html(qtyPrice);

					// ---------- //
					if (onePcsPrice.<?php echo $_currency ?>.old_price !='undefined') {

						var pcsQtyPriceOld = onePcsPrice.<?php echo $_currency ?>.old_price - (parseFloat(onePcsPrice.<?php echo $_currency ?>.old_price*discount));

						pcsQtyPriceOld = round(pcsQtyPriceOld, roundPrecision);	

						qtyPriceOld = round(parseFloat(pcsQtyPriceOld * quantity), roundPrecision); 
						//
						oldPriceBlock.html(qtyPriceOld); 
					} 

					
					/*console.log(quantity);
					console.log('discount: '+ discount);
					//console.log('pcsPrice: '+ pcsPrice);
					console.log('pcsQtyPrice: '+ pcsQtyPrice);
					console.log('pcsQtyPriceOld: '+ pcsQtyPriceOld);
					console.log('qtyPrice: '+ qtyPrice);
					console.log('qtyPriceOld: '+ qtyPriceOld);*/

				}); 


						

				



			});
		
		</script>
			

			<?php //Main Thumbnail Image Start ?>
			<div class="col-lg-5 prod_media">
				<?php				
				$main_img = (!empty($product['main_img']) ) ? $data['uri_media_img_products'].$product['product_id'].'/'.$product['main_img'] : URI_NOIMG_PRODUCT;
				$_safe_name = (isset($product['mark'][$_lang]) && $product['mark'][$_lang] !='') ? trim(htmlspecialchars($product['name'][$_lang].' '.$product['mark'][$_lang])) : trim(htmlspecialchars($product['name'][$_lang]));
				?>			

				
				<?php //Thumbnail Large Image start ?>
				<div class="tab-content img_large">

					<?php // Если у товара несколько изображний  ?>
					<?php if (count($product['images']) > 1) { ?>					
					<?php for ($i=0; $i<count($product['images']); $i++) { 
						$fAbsPath  = $data['abs_path_img_products'].$product['product_id'].'/'.$product['images'][$i];
						$f_path  = $data['uri_media_img_products'].$product['product_id'].'/'.$product['images'][$i];
						$file_img = (file_exists($fAbsPath)) ? $f_path : URI_NOIMG_PRODUCT;
					?>
						<div id="<?php echo 'thumb'.$i ?>" class="tab-pane <?php echo ($i==0) ? 'active' : '' ?>">
							<a data-fancybox="images" href="<?php echo $file_img ?>" data-title="<?php echo $_safe_name ?>" title="<?php echo $_safe_name ?>"><img src="<?php echo $file_img?>" alt="<?php echo $_safe_name ?>" title="<?php echo $_safe_name ?>"></a>
						</div>
					<?php } ?>

					<?php // Если у товара только одно изображение ?>
					<?php } else if (count($product['images']) == 1 || (!count($product['images']) && empty($product['main_img']) ) ) { ?>
						<div id="thumb1" class="tab-pane active">
							<?php if (!empty($product['main_img'])) { ?>
								<a data-fancybox="images" href="<?php echo $main_img ?>" data-title="<?php echo $_safe_name ?>" title="<?php echo $_safe_name ?>">
							<?php } ?>
								<img src="<?php echo $main_img ?>" alt="<?php echo $_safe_name  ?>" title="<?php echo $_safe_name ?>">
							<?php if (!empty($product['main_img'])) {  ?>
								</a>
							<?php } ?>							
						</div>

					<?php } ?>				

					<?php
					//бадже со скидкой и лейблы
					$showLabels = ( (isset($product['discount']) && $product['discount'] > 0) || (isset($product['label']) && count($product['label'])) ) ? true : false;

					if ($showLabels){ ?>
						<div class="stickers_wrap">
							<ul class="inner_wrap">
								<?php
								//Скидка
								if (isset($product['discount']) && $product['discount'] > 0 ) { ?>
									<li class="mb-10">
										<span class="sticker-new sticker-discount mb-10"><?php echo '-'.round(($product['discount']*100),1).' %'; ?></span>
									</li>
								<?php }

								//Леблы
								if (isset($product['label']) && count($product['label'])) { 
									foreach ($product['label'] as $pLabel) { ?>
										<li class="mb-10">
											<span class="sticker-new label mb-10">
												<?php if ($pLabel['img'] !='') { ?>
												<?php } else { 
													echo $pLabel['text'][$_lang];  
												} ?>
											</span>											
										</li>
								<?php }
								}?>
							</ul>							
						</div>
					<?php } ?>
				</div>
				<?php //Thumbnail Large Image End ?>


				
				<?php //Thumbnails Image START ?>
				<?php if (count($product['images']) > 1) { ?>
				<div class="kiosk-product-thumb">
					<div class="thumb-menu nav">
						<?php for ($i=0; $i<count($product['images']); $i++) { 
							$fAbsPath  = $data['abs_path_img_products'].$product['product_id'].'/'.$product['images'][$i];
							$f_path  = $data['uri_media_img_products'].$product['product_id'].'/'.$product['images'][$i];
							$file_img = (file_exists($fAbsPath)) ? $f_path : URI_NOIMG_PRODUCT;
						?>					
							<a class="<?php echo ($i==0) ? 'active' : '' ?>" data-toggle="tab" href="<?php echo '#thumb'.$i ?>" title="<?php echo $_safe_name ?>"> <img src="<?php echo $file_img ?>" alt="<?php echo $_safe_name ?>" title="<?php echo $_safe_name ?>"></a>					
						<?php } ?>							
					</div>
				</div>
				<?php } ?>
				<?php // Thumbnail image end ?>		


				<?php //Product Videos START ?>	
				<?php if (count($product['video'])) { ?>
				<div class="kiosk-product-thumb videos mt-20">
					<h6><?php echo PC_PRODUCT_VIDEOS.': ' ?></h6>
					<div class="thumb-menu nav mt-10">						
						<?php foreach ($product['video'] as $pVideo) { ?>					
							<a data-fancybox class="" href="<?php echo $pVideo ?>" title="<?php echo $_safe_name ?>"><i class="fas fa-video fa-2x"></i></a>					
						<?php } ?>							
					</div>
				</div>
				<?php } ?>
				<?php //Product Videos END ?>	


			</div>
			<?php //Main Thumbnail Image End ?>	

			<?php 
			// Добавить рассчет цены в зависимости от аттрибута		
		
			$item_price = $product['product_price'];			

			$mark_name = (isset($product['mark'][$_lang])) ? '<span class="mark_name">'.$product['mark'][$_lang].'</span>' : '';

			 ?>
			<div class="col-lg-7">
				<div class="kiosk-product-description fix">
					<?php // название товара ?>
					<h1 class="product-header head-h3"><?php echo $product['name'][$_lang].' '.$mark_name?></h1>
					<?php if (isset($product['product_code']) && $product['product_code'] !='' ) { ?>
					<p class="product_ean"><span class="label"><?php echo PC_PRODUCT_EAN.': ' ?></span><?php echo '<i>'.$product['product_code'].'</i>' ?></p>
					<?php } ?>
					
					<div class="row">
						<div class="col-3 col-md-6">

							<?php // цена товара старт ?>
							<div class="pro-price mb-10 mt-30">
								<?php if ((isset($product['discount']) && $product['discount']>0) && isset($item_price[$_currency]['old_price']) && $item_price[$_currency]['old_price']) { ?>
									<p class="oldPrice"><?php echo '<span class="val">'.$item_price[$_currency]['old_price'].'</span> '.$item_price[$_currency]['currency_code'] ?></p>
								<?php } ?>

								<h3><?php echo '<span class="val">'.$item_price[$_currency]['val'].'</span> '.$item_price[$_currency]['currency_code'] ?></h3>

								<h6 class="prod_pcs_price mt-10">
									<?php echo '<span class="val">'.$item_price[$_currency]['val'].'</span> '.$item_price[$_currency]['currency_code'] .' / '.PC_QTY_UNIT; ?>
								</h6>
							</div>
							<?php // цена товара конец ?>

						</div>

						<?php // ?>
						<div class="col-9 col-md-6">
							<div class="pro-ref mb-10 mt-30">
								<p><span class="<?php echo ($is_for_sale) ? 'sku_available' : 'sku_out_stock'  ?>"><?php echo ($is_for_sale) ? PC_IN_STOCK : PC_OUT_OF_STOCK; ?></span></p>
							</div>
						</div>
					</div>

					<?php //Цена в зависимости от кол-ва НАЧАЛО ?>
					<div class="row">
						<div class="col-12">
							<?php // цена от кол0ва старт ?>
							<?php if (isset($product['qty_price']) && count($product['qty_price'])) { ?>
							<h5 class="pt-20"><?php echo PC_QTY_PRICE_LABEL.': '?></h5>
							
							<div class="row qty_prices_table">
								<?php
								$qty_unit_price = [];
								foreach ($product['qty_price'] as $qty_k => $qty_val) {
									foreach ($item_price as $iCurr => $iPrice) {
										$qty_unit_price[$iCurr]['val'] = $iPrice['val'] - ($iPrice['val']*$qty_val['discount']);
										$qty_unit_price[$iCurr]['currency_code'] = $iPrice['currency_code'];
									}
								?>
									<div class="col col-sm">
										<div class="headQvalues ptb-10 fs-110">
											<?php echo '<i>'.$qty_val['start'].'</i> - <i>'.$qty_val['end'].' '.PC_QTY_UNIT.'</i> ';  ?>
										</div>
										<div class="unit_price fs-130">
											<i>
												<?php echo round($qty_unit_price[$_currency]['val'],$_price_round['precision']).' '.$qty_unit_price[$_currency]['currency_code']; ?>
											</i>
										</div>
									</div>
								<?php } ?>
							</div>

							<?php } ?>
							<?php // цена от кол0-ва конец ?>
						</div>
					</div>
					<?php //Цена в зависимости от кол-ва КОНЕЦ ?>
					


					<?php //Краткое описание ?>
					<p class="pb-20 pt-30 border-bottom"><?php echo $product['short_descr'][$_lang]?></p>
					

					<?php //Форма покупки НАЧАЛО ?>
					<?php if ($is_for_sale) { ?>
					<form action="<?php echo build_shop_link(['product_id'=>$product['product_id'],'alias'=>url_slug($product['name'][$_lang]) ]);?>" method="POST">
						<div class="row mtb-20">
							<div class="col-3 col-md-6 pl-0">
								<div class="box-quantity">							
									<label for=""><?php echo PC_QUANTITY ?></label>
									<input class="number" id="product_quantity" name="quantity" type="number" min="1" value="1"> <?php echo PC_QTY_UNIT  ?>							
								</div>
							</div>

							<div class="col-9 col-md-6">							
								<div class="product-link">
									<ul class="list-inline">
										<li class="kiosk-addtocart-btn"><button type="submit"><?php echo PC_ADD_TO_CART  ?></button></li>								
									</ul>
								</div>
							</div>

						</div>

						<input type="hidden" name="action" value="cart_add">
						<input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">	
						<?php
						// Добавить поле attributes	
						if (isset( $product['attributes']) && count($product['attributes'])) 
							{?>
						
						<?php } ?>
					</form>
					<?php } ?>
					<?php //Форма покупки КОНЕЦ ?>


					

					<?php /* ?>
					<div class="pro-ref mb-15">
						<p><span class="in-stock">Categories:</span><span class="sku">Cloth, Shoes, Perfume</span></p>
					</div>
					<div class="pro-ref mb-15">
						<p><span class="in-stock">Model:</span><span class="sku">2mr30</span></p>
					</div>
					<?php */ ?>

					



				</div>
			</div>
			<?php //Thumbnail Description End ?>


		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</div>
<?php  //Product Thumbnail End ?>


<?php  //Product TABS Start ?>
<div class="kiosk-thumbnail-area pb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<?php
				$cTabs = [];		
				if ($product['full_descr'][$_lang] !='') {
					$cTabs['description'] = [					
						'id'=>'tab1',
						'name'=>PC_TAB_DESCRIPTION,
						'active'=>true						
					];	
				}
				if (isset($product['specifications']) && count($product['specifications']) !='') {
					$cTabs['specifications'] = [
						'id'=>'tab2',
						'name'=>PC_TAB_SPECIFICATIONS,
						'active'=>false	
					];	
				}
				$cTabs['payment'] = [
					'id'=>'tab3',
					'name'=>PC_TAB_PAYMENT,
					'active'=>false
				];	
				$cTabs['shipping'] = [
					'id'=>'tab4',
					'name'=>PC_TAB_SHIPPING,
					'active'=>false		
				];
				if (count($product['files'])) {
					$cTabs['files'] = [
						'id'=>'tab5',
						'name'=>PC_TAB_FILES,
						'active'=>false		
					];
				}
				?>

				<?php if (count($cTabs)) { ?>
				<ul class="kiosk-thumb-header nav">
				<?php				
				foreach ($cTabs as $ctKey => $ctValue) { ?>
					<li>
						<a class="<?php echo ($ctValue['active']) ? 'active' : '' ?>" data-toggle="tab" href="<?php echo '#'.$ctValue['id'] ?>"><?php echo $ctValue['name'] ?></a>
					</li>
				<?php } ?>
				</ul>
				
				<?php //Tab Content Start ?>
				<div class="tab-content thumb-content border-default">
					<?php foreach ($cTabs as $ctKey => $ctValue) { ?>
						<div class="<?php echo ($ctValue['active']) ? 'tab-pane in active' : 'tab-pane' ?>" id="<?php echo $ctValue['id'] ?>">

							<?php // Контент ВКЛАДКИ Описание ?>
							<?php if ($ctKey=='description' ) {?>
								<h4><?php echo PC_TAB_DESCRIPTION ?></h4>
								<div class="t_content mt-20">
									<?php echo $product['full_descr'][$_lang]; ?>	
								</div>
								

							<?php // Контент ВКЛАДКИ Характеристики ?>
							<?php } else if ($ctKey=='specifications') { ?>
								<h4><?php echo PC_TAB_SPECIFICATIONS ?></h4>
								<div class="t_content mt-20">
									<ul>
									<?php foreach ($product['specifications'] as $pSpec) { ?>
										<li class="mt-10">
											<div class="container">
												<div class="row">
													<div class="col-lg-3 col-sm-12">
														<i><?php echo $pSpec['name'][$_lang] ?></i>
													</div>
													<div class="col-lg-9 col-sm-12">
														<?php echo $pSpec['val'][$_lang] ?>
													</div>
												</div>
											</div>											
										</li>
									<?php } ?>
									</ul>
								</div>


							<?php // Контент ВКЛАДКИ Способы оплаты ?>
							<?php } else if ($ctKey=='payment') { ?>
								<h4><?php echo PC_TAB_PAYMENT ?></h4>
								<div class="t_content mt-20"></div>

							<?php // Контент ВКЛАДКИ Способы достаки ?>
							<?php } else if ($ctKey=='shipping') { ?>
								<h4><?php echo PC_TAB_SHIPPING ?></h4>
								<div class="t_content mt-20"></div>

							<?php // Контент ВКЛАДКИ Файлы ?>
							<?php } else if ($ctKey=='files') { ?>
								<h4><?php echo PC_TAB_FILES ?></h4>
								<div class="t_content mt-20">									
									<ul>
									<?php foreach ($product['files'] as $fi => $pFile) {
										$fComa = (count($product['files']) == ($fi+1)) ? '' : ',';
										//
										$file = ($pFile['file'] !='') ? $data['abs_path_files_products'].$product['product_id'].DS.$pFile['file'] : false;
										$file_uri = ($file !== false) ? $data['uri_media_files_products'].$product['product_id'].'/'.$pFile['file'] : false;
										if ($file !== false) {
									?>
										<li class="inline-block mr-20">											
											<a href="<?php echo $file_uri?>" class="" target="_blank"><i class="far fa-file mr-10"></i> <?php echo ($pFile['name'][$_lang] !='') ? $pFile['name'][$_lang] : $pFile['file'] ?></a><?php echo $fComa ?>
											
										</li>
									<?php
										}
									} ?>
									</ul>
								</div>
							<?php } ?>
							
						</div>
					<?php } ?>


					<?php /* ?>
					<div id="dtail" class="tab-pane in active">
						<p class="pb-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque cumque consequuntur beatae temporibus voluptates voluptas sint architecto incidunt omnis iste tempora placeat sequi, illum, iure ullam similique modi veritatis quia!</p>
						<p class="pb-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque cumque consequuntur beatae temporibus voluptates voluptas sint architecto incidunt omnis iste tempora placeat sequi, illum, iure ullam similique modi veritatis quia!</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque cumque consequuntur beatae temporibus voluptates voluptas sint architecto incidunt omnis iste tempora placeat sequi, illum, iure ullam similique modi veritatis quia!</p>
					</div>

					<div id="review" class="tab-pane">
						<!-- Reviews Start -->
						<div class="review">
							<h4 class="review-mini-title">Review by koisk</h4>
							<ul class="review-list">
								<!-- Single Review List Start -->
								<li>
									<span>Quality:</span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
								<!-- Single Review List End -->
								<!-- Single Review List Start -->
								<li>
									<span>Price:</span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</li>
								<!-- Single Review List End -->
								<!-- Single Review List Start -->
								<li>
									<span>Value:</span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</li>
								<!-- Single Review List End -->
							</ul>
						</div>
						<!-- Reviews End -->
						<!-- Reviews Start -->
						<div class="review mt-30">
							<!-- Reviews Field Start -->
							<div class="riview-field">
								<h6 class="pb-15">Write A Review</h6>
								<form autocomplete="off" action="product.html#">
									<div class="form-group">
										<label class="req" for="sure-name">Name</label>
										<input type="text" class="form-control" id="sure-name" required="required">
									</div>
									<div class="form-group">
										<label class="req" for="subject">Summary</label>
										<input type="text" class="form-control" id="subject" required="required">
									</div>
									<div class="form-group">
										<label class="req" for="comments">Review</label>
										<textarea class="form-control" rows="4" id="comments" required="required"></textarea>
									</div>
									<button type="submit" class="btn-submit">Submit</button>
								</form>
							</div>
							<!-- Reviews Field Start -->
						</div>
						<!-- Reviews End -->
					</div>
					<?php */ ?>

				</div>
				<?php //Tab Content End ?>
				
				<?php } ?>


			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</div>
<?php  //Product TABS End ?>



<?php  //Realted Product Start ?>
<?php
$relatedProducts = $product['related_products'];  
if (count($relatedProducts)) { ?>
	<div class="related-product pb-30 product-area">
		<div class="container">
			<div class="related-box">
				<div class="group-title">
					<h2><?php echo PC_RELATED_PRODUCTS ?></h2>
				</div>
				
				<?php // Realted Product Activation Start?>				
				<div class="kiosk-related-product owl-carousel">
					<?php
					$owlData = [
						'products'=>$relatedProducts,
						'uri_media_img_products'=>$data['uri_media_img_products'],
						'abs_path_img_products' =>$data['abs_path_img_products'],
						'_lang' => $_lang,
						'_currency' => $_currency
					];					
					echo build_owlSingleProducts($owlData);
					?>
					<?php /* ?>
					<div class="single-product">
						<!-- Product Image Start -->
						<div class="kiosk-product-img">
							<a href="product.html">
								<img class="first-img" src="<?php echo $data['uri_assets_img']?>products/5.jpg" alt="single-product">
								<img class="second-img" src="<?php echo $data['uri_assets_img']?>products/6.jpg" alt="single-product">
							</a>
						</div>
						<!-- Product Image End -->
						<!-- Product Content Start -->
						<div class="kiosk-product-content">
							<p><span class="price">$330.00</span></p>                               
							<h4><a href="product.html">Blue Shirt</a></h4>
							<div class="kiosk-product-action">
								<div class="kiosk-action-content">
									<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
									<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
									<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
								</div>
							</div>
						</div>
						<!-- Product Content End -->
						<span class="sticker-new">-30%</span>
					</div>

					<!-- Single Product Start -->                    
					<div class="single-product">
						<!-- Product Image Start -->
						<div class="kiosk-product-img">
							<a href="product.html">
								<img class="first-img" src="<?php echo $data['uri_assets_img']?>products/10.jpg" alt="single-product">
								<img class="second-img" src="<?php echo $data['uri_assets_img']?>products/11.jpg" alt="single-product">
							</a>
						</div>
						<!-- Product Image End -->
						<!-- Product Content Start -->
						<div class="kiosk-product-content">
							<p><span class="price">$220.00</span></p>                               
							<h4><a href="product.html">Standard Shoes</a></h4>
							<div class="kiosk-product-action">
								<div class="kiosk-action-content">
									<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
									<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
									<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
								</div>
							</div>
						</div>
						<!-- Product Content End -->
					</div>
					<!-- Single Product End -->

					<!-- Single Product Start -->                    
					<div class="single-product">
						<!-- Product Image Start -->
						<div class="kiosk-product-img">
							<a href="product.html">
								<img class="first-img" src="<?php echo $data['uri_assets_img']?>products/1.jpg" alt="single-product">
								<img class="second-img" src="<?php echo $data['uri_assets_img']?>products/2.jpg" alt="single-product">
							</a>
						</div>
						<!-- Product Image End -->
						<!-- Product Content Start -->
						<div class="kiosk-product-content">
							<p><span class="price">$40.00</span><del class="prev-price">$82.00</del></p>                               
							<h4><a href="product.html">Caring bag</a></h4>
							<div class="kiosk-product-action">
								<div class="kiosk-action-content">
									<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
									<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
									<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
								</div>
							</div>
						</div>
						<!-- Product Content End -->
						<span class="sticker-new">sale</span>
					</div>
					<!-- Single Product End -->

					<!-- Single Product Start -->                    
					<div class="single-product">
						<!-- Product Image Start -->
						<div class="kiosk-product-img">
							<a href="product.html">
								<img class="first-img" src="<?php echo $data['uri_assets_img']?>products/3.jpg" alt="single-product">
								<img class="second-img" src="<?php echo $data['uri_assets_img']?>products/4.jpg" alt="single-product">
							</a>
						</div>
						<!-- Product Image End -->
						<!-- Product Content Start -->
						<div class="kiosk-product-content">
							<p><span class="price">$90.00</span></p>                               
							<h4><a href="product.html">Standard Shoes</a></h4>
							<div class="kiosk-product-action">
								<div class="kiosk-action-content">
									<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
									<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
									<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
								</div>
							</div>
						</div>
						<!-- Product Content End -->
					</div>
					<!-- Single Product End -->

					<!-- Single Product Start -->                    
					<div class="single-product">
						<!-- Product Image Start -->
						<div class="kiosk-product-img">
							<a href="product.html">
								<img class="first-img" src="<?php echo $data['uri_assets_img']?>products/15.jpg" alt="single-product">
								<img class="second-img" src="<?php echo $data['uri_assets_img']?>products/16.jpg" alt="single-product">
							</a>
						</div>
						<!-- Product Image End -->
						<!-- Product Content Start -->
						<div class="kiosk-product-content">
							<p><span class="price">$20.00</span><del class="prev-price">$38.00</del></p>                               
							<h4><a href="product.html">Standard Shoes</a></h4>
							<div class="kiosk-product-action">
								<div class="kiosk-action-content">
									<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
									<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
									<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
								</div>
							</div>
						</div>
						<!-- Product Content End -->
						<span class="sticker-new">-10%</span>
					</div>
					<!-- Single Product End --> 
					<?php */ ?>
				</div>
				<?php // Realted Product Activation End ?>				
			</div>
		</div>
	</div>
<?php } ?>
<?php  //Realted Product End  ?>

