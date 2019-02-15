<?php defined('YV_LiteShop') or die ('Restricted Access!');?>


<?php //Header Area Start ?>
<header class="<?php echo ($is_homepage) ? 'home2-header' : ''?>"> 
	
	<?php //Kiosk Header Top Start ?>	
	<div class="kiosk-header-top header-sticky">
	  <div class="container">
	      <div class="row">
	          
	          <?php //Header Top left Start ?>	                     
	          <div class="col-lg-6 col-md-12 d-center">
	              <div class="kiosk-header-top-left">
	                  <i class="fa fa-phone"></i>
	                  <?php echo TXT_CALL_US ?>: (343) 3434 333
	              </div>                        
	          </div>


	          <?php //Header Top Right Start ?>		          

	          <?php /* ?>                                      
	          <div class="col-lg-6 col-md-12">
	              <div class="kiosk-header-top-right">
	                  <div class="search-box-view">
	                      <form action="cart.html#">
	                          <input name="product" class="email" type="text" placeholder="Search Your Product">
	                          <button class="submit" type="submit"></button>
	                      </form>
	                  </div>
	                  <!-- Header-list-menu End -->
	              </div>
	          </div>
	          <?php */ ?>

	          <!-- Header Top Right End -->
	      </div>
	  </div>
	  <!-- Container End -->
	</div>
	<?php //Kiosk Header Top Start ?>	


	<?php //Kiosk Header Bottom Start ?>	
	<div class="kiosk-header-bottom header-sticky">
		<div class="container">			
			<div class="row">

				<?php //Logo start ?>	
				<div class="col-xl-3 col-lg-2 col-sm-5 col-5">
					<div class="logo">
						<a href="<?php echo $data['uri_base'] ?>"><img src="<?php echo $data['uri_assets_img']?>logo/logo.png" title="<?php echo $data['site_name'] ?>" alt="<?php echo $data['site_name'] ?>"></a>
					</div>
				</div>
				<?php //Logo END ?>				

				
				<?php //Main menu start ?>	
				<div class="col-xl-6 col-lg-7 d-none d-lg-block">
					<div class="kiosk-middle-menu pull-right">
						<?php if (count($tmpl_content['main_menu'])) { ?>
						<nav>
							<ul class="kiosk-middle-menu-list">
								<?php foreach ($tmpl_content['main_menu'] as $mainmenu) {?>
									<li>
										<a href="<?php echo $mainmenu['link'] ?>">
											<?php echo $mainmenu['title'][$_lang]; ?>												
										</a>
										<?php if (count($mainmenu['submenu'])) { ?>
											<ul class="kiosk-dropdown home-dropdown">
												<?php foreach ($mainmenu['submenu'] as $sub_mainmenu) { ?>
												<li>
													<a href="<?php echo $sub_mainmenu['link'] ?>"><?php echo $sub_mainmenu['title'][$_lang] ?></a>
												</li>		
												<?php } ?>
											</ul>
										<?php } ?>										
									</li>
								<?php } ?>
							</ul>
						</nav>
						<?php } ?>

						<?php /*  ?>
						<nav>
							<ul class="kiosk-middle-menu-list">

								<li><a href="index.html">home</a>
									<!-- Home Version Dropdown Start -->
									<ul class="kiosk-dropdown home-dropdown">
										<li><a href="index.html">Home Version 1</a></li>
										<li><a href="index-2.html">Home Version 2</a></li>
									</ul>
									<!-- Home Version Dropdown End -->
								</li>
								<li><a href="about.html">about us</a></li>                                        
								<li><a href="shop.html">shop</a>
									<!-- Home Version Dropdown Start -->
									<ul class="kiosk-dropdown">
										<li><a href="shop.html">shop</a></li>
										<li><a href="cart.html">Cart Page</a></li>
										<li><a href="checkout.html">Checkout Page</a></li>
										<li><a href="wishlist.html">Wishlist Page</a></li>
										<li><a href="product.html">product details Page</a></li>
									</ul>
									<!-- Home Version Dropdown End -->
								</li>                                        
								<li><a href="blog.html">Blog</a>
									<!-- Home Version Dropdown Start -->
									<ul class="kiosk-dropdown">
										<li><a href="blog.html">Blog Page</a></li>
										<li><a href="blog-details.html">Blog Details Page</a></li>
									</ul>
									<!-- Home Version Dropdown End -->
								</li>
								<li><a href="index-2.html#">pages</a>
									<!-- Home Version Dropdown Start -->
									<ul class="kiosk-dropdown">
										<li><a href="contact.html">contact us</a></li> 
										<li><a href="about.html">about us</a></li>   
										<li><a href="login.html">Login Page</a></li>
										<li><a href="error.html">404 Page</a></li>
									</ul>
									<!-- Home Version Dropdown End -->
								</li>
								<li><a href="contact.html">contact us</a></li>                                        
							</ul>
						</nav>
						<?php */ ?>


					</div>
				</div>
				<?php //Main menu END ?>	




				
				<?php //Cart Box Start ?>	
				<div class="col-lg-3 col-sm-7 col-7">
					<div class="kiosk-cart text-right">						
						<ul>
							
							<li>
								<a href="#"><i class="fa fa-shopping-cart"></i><span class="cart-counter <?php echo (empty($data['cart']['products'])) ? '' : 'has_products' ?>"><?php echo (empty($data['cart']['products'])) ? 0 : count($data['cart']['products']) ?></span></a>
								<ul class="kiosk-dropdown main-kiosk-cart">
									<li>
										<?php require_once($layouts_path.'cart_header.php'); ?>
									</li>
								</ul>
							</li>

							<li class="header_lang">
								<a href="#"><i class="fas fa-globe-europe"></i> <?php echo strtoupper($data['lang_iso_code']) ?></a>
								<ul class="kiosk-dropdown main-lang">
									<?php foreach ($_available_languages as $lang_code => $lang_val) { ?>
										<li>
											<?php 
											$lang_link_data = [
												'type'=>'change_lang',
												'lang'=>$lang_code,
												'return_url'=>base64_encode(get_actual_url()) 
											]; ?>
											<a href="<?php echo build_shop_link($lang_link_data); ?>" target="_self" title="<?php echo LANG_CHANGE_LANG_TO.' '.strtolower($lang_val['text']) ?>"><?php echo $lang_val['text'].' ('.strtoupper($lang_val['iso_code']).')' ?></a>
										</li>
									<?php } ?>									
								</ul>

							</li>

							<li class="header_curr last">
								<a href="#"><i class="far fa-money-bill-alt"></i> <?php echo $_currency_codes[$_currency]['text']; ?></a>
								<ul class="kiosk-dropdown main-curr">
									<?php foreach ($_currency_codes as $curr_code => $curr_val) { ?>
										<li>
											<?php 
											$curr_link_data = [
												'type'=>'change_curr',
												'curr'=>$curr_code,
												'return_url'=>base64_encode(get_actual_url()) 
											]; ?>
											<a href="<?php echo build_shop_link($curr_link_data) ?>" target="_self" title="<?php echo CURRENCY_CHANGE_CURRENCY_TO.' '.$curr_val['text'] ?>"><?php echo $curr_val['text'] ?></a>
										</li>	
									<?php } ?>
									
								</ul>

							</li>						

							
						</ul>

						<?php /* ?>
						<ul>
							<li><a href="index-2.html#"><i class="fa fa-shopping-cart"></i><span class="cart-counter">2</span></a>
								<ul class="kiosk-dropdown main-kiosk-cart">
									<li>
										<!-- Cart Box Start -->
										<div class="single-kiosk-cart">
											<div class="cart-img">
												<a href="index-2.html#"><img src="<?php echo $data['uri_assets_img']?>products/4.jpg" alt="cart-image"></a>
											</div>
											<div class="cart-content">
												<h6><a href="product.html">lorem Ipsum</a></h6>
												<span>$299.00</span>
											</div>
											<h6 class="kiosk-qty"><b>Qty</b>:03</h6>
										</div>
										<!-- Cart Box End -->
										<!-- Cart Box Start -->
										<div class="single-kiosk-cart">
											<div class="cart-img">
												<a href="index-2.html#"><img src="<?php echo $data['uri_assets_img']?>products/4.jpg" alt="cart-image"></a>
											</div>
											<div class="cart-content">
												<h6><a href="product.html">lorem Ipsum</a></h6>
												<span>$469.00</span>
											</div>
											<h6 class="kiosk-qty"><b>Qty</b>:01</h6>
										</div>
										<!-- Cart Box End -->

										<!-- Cart Footer Inner Start -->
										<div class="cart-footer fix">
											<h5>Discount<span class="f-right">$8.00</span></h5>
											<h5>Shipping<span class="f-right">$18.00</span></h5>
											<h5>Vat<span class="f-right">$6.00</span></h5>
											<h5>Total<span class="f-right"><b>$698.00</b></span></h5>
											<div class="kiosk-cart-button">
												<a class="button slider-btn" href="cart.html">View Cart</a>
												<a class="button slider-btn f-right mr-0" href="checkout.html">Checkout</a>
											</div>
										</div>
										<!-- Cart Footer Inner End -->
									</li>
								</ul>
							</li>
							<li><a href="index-2.html#"><i class="fa fa-heart-o"></i></a></li> 
						</ul>
						<?php */ ?>
					</div>
				</div>
				<?php //Cartt Box End ?>	
				


				<?php //mobile menu START ?>
				<div class="col-sm-12 d-lg-none">
					<div class="mobile-menu">
						<?php if (count($tmpl_content['main_menu'])) { ?>
						<nav>
							<ul>
								<?php foreach ($tmpl_content['main_menu'] as $mobile_mainmenu) {?>
									<li><a href="<?php echo $mobile_mainmenu['link'] ?>"><?php echo $mobile_mainmenu['title'][$_lang] ?></a></li>
									<?php if (count($mobile_mainmenu['submenu'])) { ?>
									<ul>
										<?php foreach ($mobile_mainmenu['submenu'] as $mobile_submenu) { ?>
											<li><a href="<?php echo $mobile_submenu['link'] ?>"><?php echo $mobile_submenu['title'][$_lang] ?></a></li>
										<?php } ?>										
									</ul>
									<?php } ?>
								<?php } ?>
							</ul>
						</nav>
						<?php } ?>

						<?php /* ?>
						<nav>
							<ul>
								<li><a href="index.html">home</a>
									<!-- Home Version Dropdown Start -->
									<ul>
										<li><a href="index.html">Home Version 1</a></li>
										<li><a href="index-2.html">Home Version 2</a></li>
									</ul>
									<!-- Home Version Dropdown End -->
								</li>
								<li><a href="shop.html">shop</a>
									<!-- Mobile Menu Dropdown Start -->
									<ul>
										<li><a href="shop.html">shop</a></li>
										<li><a href="cart.html">Cart Page</a></li>
										<li><a href="checkout.html">Checkout Page</a></li>
										<li><a href="wishlist.html">Wishlist Page</a></li>
										<li><a href="product.html">product details</a></li>
									</ul>
									<!-- Mobile Menu Dropdown End -->
								</li>
								<li><a href="blog.html">Blog</a>
									<!-- Mobile Menu Dropdown Start -->
									<ul>
										<li><a href="blog.html">Blog Page</a></li>
										<li><a href="blog-details.html">Blog Details Page</a></li>
									</ul>
									<!-- Mobile Menu Dropdown End -->
								</li>
								<li><a href="index-2.html#">pages</a>
									<!-- Mobile Menu Dropdown Start -->
									<ul>
										<li><a href="contact.html">contact us</a></li> 
										<li><a href="about.html">about us</a></li>   
										<li><a href="login.html">Login Page</a></li>
										<li><a href="error.html">404 Page</a></li>
									</ul>
									<!-- Mobile Menu Dropdown End -->
								</li>
								<li><a href="about.html">about us</a></li>
								<li><a href="contact.html">contact us</a></li>
							</ul>
						</nav>
						<?php */ ?>

					</div>
				</div>
				<?php //Mobile Menu  End ?>

				                        
			</div>
			<?php //Row End ?>				
		</div>
		<?php //Container End ?>	
		
	</div>	
	<?php //Header Bottom End ?>
	
</header>
<?php //Header Area End ?>
