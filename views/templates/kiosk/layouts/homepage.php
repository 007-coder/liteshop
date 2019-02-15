<?php defined('YV_LiteShop') or die ('Restricted Access!');
$homepage_slides = $tmpl_content['homepage_slides'];
$uri_img_slides = $data['uri_media_img_slides'];
$homepage_services = $tmpl_content['homepage_services'];
//wrap_pre($homepage_slides, 'homepage_slides');

// Paper User kit 2
 ?>


<?php //Slider Area Start ?>
<?php if (count($homepage_slides)) { ?>
<div class="slider-area kiosk-slider home2-slider">
	<div class="slider-wrapper theme-default">

		<div id="slider" class="nivoSlider">
			<?php foreach ($homepage_slides as $si => $hp_slide) {
				$s_text1 = (isset($hp_slide['content']['text1'][$_lang])) ? $hp_slide['content']['text1'][$_lang] : '';
				$s_text2 = (isset($hp_slide['content']['text2'][$_lang])) ? $hp_slide['content']['text2'][$_lang] : '';

				$i_alt = (isset($hp_slide['alt'][$_lang])) ? $hp_slide['alt'][$_lang].' - '.$data['site_name'] : $data['site_name'];
				$i_link = (isset($hp_slide['link']) && $hp_slide['link'] !='') ? $hp_slide['link'] : '#';
				$i_title = ( isset($hp_slide['content']) && ( $s_text1 !='' || $s_text2 !='' ) ) ? '#slider-1-caption'.($si+1) : '';
			?>
				<a href="<?php echo $i_link ?>"> <img src="<?php echo $uri_img_slides.$hp_slide['img']['file']?>" <?php /* ?>data-thumb="<?php echo $data['uri_assets_img']?>slider/1.jpg" <?php */ ?> alt="<?php echo $i_alt ?>" title="<?php echo $i_title ?>"/></a>			

			<?php } ?>
		</div>

		<?php foreach ($homepage_slides as $si_1 => $hp_slide1) { 
			$s_text1_1 = (isset($hp_slide1['content']['text1'][$_lang])) ? $hp_slide1['content']['text1'][$_lang] : '';
			$s_text2_1 = (isset($hp_slide1['content']['text2'][$_lang])) ? $hp_slide1['content']['text2'][$_lang] : '';
			$i_title_1 = ( isset($hp_slide1['content']) && ( $s_text1_1 !='' || $s_text2_1 !='' ) ) ? '#slider-1-caption'.($si+1) : '';
			$i_link_1 = (isset($hp_slide1['link']) && $hp_slide1['link'] !='') ? $hp_slide1['link'] : '#';

		?>
		<?php //slider caption ?>
				<?php if ($i_title_1 !='') { ?>
				<div id="<?php echo 'slider-1-caption'.($si_1+1) ?>" class="nivo-html-caption nivo-caption">
					<div class="text-content-wrapper">
						<div class="container">
							<div class="text-content">

								<?php if ($s_text2_1 !='') { ?>
									<h4 class="title2 wow fadeInUp mb-16" data-wow-duration="2s" data-wow-delay="0s"><?php echo $s_text2_1 ?></h4>
								<?php } ?>

								<?php if ($s_text1_1 !='') { ?>
									<h1 class="title1 wow fadeInUp mb-16" data-wow-duration="2s" data-wow-delay="1s"><?php echo $s_text1_1 ?></h1>
								<?php } ?>

								<?php if ($i_link_1 !='#') { ?>
								<div class="banner-readmore wow fadeInUp mt-35" data-wow-duration="2s" data-wow-delay="2s">
									<a class="button slider-btn" href="<?php echo $i_link_1 ?>"><?php echo TXT_READMORE ?></a>   
								</div>
								<?php } ?>

							</div>
						</div>
					</div>					
				</div>
				<?php } ?>
		<?php } ?>
	</div>
</div>
<?php } ?>
<?php //Slider Area End ?>




<?php //Service Start ?>
<?php if (count($homepage_services)) { ?>
<div class="kiosk-services ptb-70">
	<div class="container">
		<div class="row">
			<?php foreach ($homepage_services as $hp_service) {
				$sfa_icon = (isset($hp_service['icon_class']) && $hp_service['icon_class'] !='') ? $hp_service['icon_class'] : '';
				$s_title =  (isset($hp_service['title'][$_lang]) && $hp_service['title'][$_lang] !='') ? $hp_service['title'][$_lang] : '';
				$s_descr =  (isset($hp_service['descr'][$_lang]) && $hp_service['descr'][$_lang] !='') ? $hp_service['descr'][$_lang] : '';
			?>
				<?php //Single Service Start ?>	
				<div class="col-lg-3 col-sm-6">
					<div class="single-service">
						<div class="service-content">
							<i class="<?php echo 'fa '.$sfa_icon ?>"></i>
							<?php if ($s_title !='') { ?>
								<h3><?php echo $s_title ?></h3>
							<?php } ?>		
							<?php if ($s_descr !='') { ?>
								<p><?php echo $s_descr ?></p>
							<?php } ?>						
						</div>
					</div>
				</div>
				<?php //Single Service End ?>	

			<?php } ?>

		</div>
	</div>
</div>
<?php } ?>
<?php //Service End ?>




<!-- Product Area Start -->
<div class="kiosk-top-product ptb-70">
	<div class="container">
		<!-- Best Product Activation Start -->
		<div class="kiosk-top-active owl-carousel home1-product">
			<!-- Single Product Start -->
			<div class="single-product">
				<!-- Product Image Start -->
				<div class="kiosk-product-img">
					<a href="product.html">
						<img class="first-img rounded-circle" src="<?php echo $data['uri_assets_img']?>products/7.jpg" alt="single-product">
						<img class="second-img rounded-circle" src="<?php echo $data['uri_assets_img']?>products/8.jpg" alt="single-product">
					</a>
				</div>
				<!-- Product Image End -->
				<!-- Product Content Start -->
				<div class="kiosk-product-content">
					<div class="kiosk-product-action">
						<div class="kiosk-action-content">
							<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
							<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
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
						<img class="first-img rounded-circle" src="<?php echo $data['uri_assets_img']?>products/5.jpg" alt="single-product">
						<img class="second-img rounded-circle" src="<?php echo $data['uri_assets_img']?>products/6.jpg" alt="single-product">
					</a>
				</div>
				<!-- Product Image End -->
				<!-- Product Content Start -->
				<div class="kiosk-product-content"> 
					<div class="kiosk-product-action">
						<div class="kiosk-action-content">
							<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
							<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
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
						<img class="first-img rounded-circle" src="<?php echo $data['uri_assets_img']?>products/4.jpg" alt="single-product">
						<img class="second-img rounded-circle" src="<?php echo $data['uri_assets_img']?>products/3.jpg" alt="single-product">
					</a>
				</div>
				<!-- Product Image End -->
				<!-- Product Content Start -->
				<div class="kiosk-product-content">  
					<div class="kiosk-product-action">
						<div class="kiosk-action-content">
							<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
							<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
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
						<img class="first-img rounded-circle" src="<?php echo $data['uri_assets_img']?>products/1.jpg" alt="single-product">
						<img class="second-img rounded-circle" src="<?php echo $data['uri_assets_img']?>products/2.jpg" alt="single-product">
					</a>
				</div>
				<!-- Product Image End -->
				<!-- Product Content Start -->
				<div class="kiosk-product-content">  
					<div class="kiosk-product-action">
						<div class="kiosk-action-content">
							<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
							<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
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
						<img class="first-img rounded-circle" src="<?php echo $data['uri_assets_img']?>products/13.jpg" alt="single-product">
						<img class="second-img rounded-circle" src="<?php echo $data['uri_assets_img']?>products/14.jpg" alt="single-product">
					</a>
				</div>
				<!-- Product Image End -->
				<!-- Product Content Start -->
				<div class="kiosk-product-content">
					<div class="kiosk-product-action">
						<div class="kiosk-action-content">
							<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
							<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
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
						<img class="first-img rounded-circle" src="<?php echo $data['uri_assets_img']?>products/15.jpg" alt="single-product">
						<img class="second-img rounded-circle" src="<?php echo $data['uri_assets_img']?>products/16.jpg" alt="single-product">
					</a>
				</div>
				<!-- Product Image End -->
				<!-- Product Content Start -->
				<div class="kiosk-product-content"> 
					<div class="kiosk-product-action">
						<div class="kiosk-action-content">
							<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
							<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
						</div>
					</div>
				</div>
				<!-- Product Content End -->
			</div>                                         
			<!-- Single Product End -->
		</div>
		<!-- Best Product Activation End -->
	</div>
	<!-- Container End -->
</div>
<!-- Product Area End --> 


<!-- Product Area Start -->
<div class="product-area ptb-70">
	<div class="container">
		<div class="row">
			<div class="section-title col-lg-12">
				<h2>Featured Products <i class="fa fa-shopping-cart"></i></h2>
			</div>
		</div>
		<div class="row">
			<!-- Single Product Start -->                    
			<div class="col-lg-3 col-sm-6">
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
						<p><span class="price">$300.00</span></p>
						<h4><a href="product.html">Lorem ipsum solet</a></h4>
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
			</div>
			<!-- Single Product End -->
			<!-- Single Product Start -->                    
			<div class="col-lg-3 col-sm-6">
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
						<p><span class="price">$330.00</span><del class="prev-price">$362.00</del></p>                               
						<h4><a href="product.html">Lorem ipsum solet</a></h4>
						<div class="kiosk-product-action">
							<div class="kiosk-action-content">
								<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
								<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
								<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
							</div>
						</div>
					</div>
					<span class="sticker-new">-10%</span>
					<!-- Product Content End -->
				</div>
			</div>
			<!-- Single Product End -->
			<!-- Single Product Start -->  
			<div class="col-lg-3 col-sm-6">
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
						<p><span class="price">$900.00</span></p>                               
						<h4><a href="product.html">Lorem ipsum solet</a></h4>
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
			</div>
			<!-- Single Product End -->
			<!-- Single Product Start -->   
			<div class="col-lg-3 col-sm-6">
				<div class="single-product">
					<!-- Product Image Start -->
					<div class="kiosk-product-img">
						<a href="product.html">
							<img class="first-img" src="<?php echo $data['uri_assets_img']?>products/7.jpg" alt="single-product">
							<img class="second-img" src="<?php echo $data['uri_assets_img']?>products/8.jpg" alt="single-product">
						</a>
					</div>
					<!-- Product Image End -->
					<!-- Product Content Start -->
					<div class="kiosk-product-content">
						<p><span class="price">$430.00</span><del class="prev-price">$432.00</del></p>                               
						<h4><a href="product.html">Lorem ipsum solet</a></h4>
						<div class="kiosk-product-action">
							<div class="kiosk-action-content">
								<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
								<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
								<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
							</div>
						</div>
					</div>
					<span class="sticker-new">sale</span>
					<!-- Product Content End -->
				</div>
			</div>
			<!-- Single Product End --> 
			<!-- Single Product Start -->                    
			<div class="col-lg-3 col-sm-6">
				<div class="single-product">
					<!-- Product Image Start -->
					<div class="kiosk-product-img">
						<a href="product.html">
							<img class="first-img" src="<?php echo $data['uri_assets_img']?>products/9.jpg" alt="single-product">
							<img class="second-img" src="<?php echo $data['uri_assets_img']?>products/10.jpg" alt="single-product">
						</a>
					</div>
					<!-- Product Image End -->
					<!-- Product Content Start -->
					<div class="kiosk-product-content">
						<p><span class="price">$70.00</span></p>                               
						<h4><a href="product.html">Lorem ipsum solet</a></h4>
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
			</div>
			<!-- Single Product End -->
			<!-- Single Product Start -->                    
			<div class="col-lg-3 col-sm-6">
				<div class="single-product">
					<!-- Product Image Start -->
					<div class="kiosk-product-img">
						<a href="product.html">
							<img class="first-img" src="<?php echo $data['uri_assets_img']?>products/11.jpg" alt="single-product">
							<img class="second-img" src="<?php echo $data['uri_assets_img']?>products/12.jpg" alt="single-product">
						</a>
					</div>
					<!-- Product Image End -->
					<!-- Product Content Start -->
					<div class="kiosk-product-content">
						<p><span class="price">$20.00</span><del class="prev-price">$92.00</del></p>                               
						<h4><a href="product.html">Lorem ipsum solet</a></h4>
						<div class="kiosk-product-action">
							<div class="kiosk-action-content">
								<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
								<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
								<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
							</div>
						</div>
					</div>
					<span class="sticker-new">-20%</span>
					<!-- Product Content End -->
				</div>
			</div>
			<!-- Single Product End -->
			<!-- Single Product Start -->  
			<div class="col-lg-3 col-sm-6">
				<div class="single-product">
					<!-- Product Image Start -->
					<div class="kiosk-product-img">
						<a href="product.html">
							<img class="first-img" src="<?php echo $data['uri_assets_img']?>products/13.jpg" alt="single-product">
							<img class="second-img" src="<?php echo $data['uri_assets_img']?>products/14.jpg" alt="single-product">
						</a>
					</div>
					<!-- Product Image End -->
					<!-- Product Content Start -->
					<div class="kiosk-product-content">
						<p><span class="price">$100.00</span></p>                               
						<h4><a href="product.html">Lorem ipsum solet</a></h4>
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
			</div>
			<!-- Single Product End -->
			<!-- Single Product Start -->   
			<div class="col-lg-3 col-sm-6">
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
						<p><span class="price">$710.00</span></p>                               
						<h4><a href="product.html">Lorem ipsum solet</a></h4>
						<div class="kiosk-product-action">
							<div class="kiosk-action-content">
								<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
								<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
								<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
							</div>
						</div>
					</div>
					<span class="sticker-new">sale</span>
					<!-- Product Content End -->
				</div>
			</div>
			<!-- Single Product End -->                    
		</div>
	</div>
</div>
<!-- Parallax Area End -->


<div class="parallax-area pb-60">
	<div class="container-fluid">
	   <div class="row">
		   <!-- Single Banner Start -->
		   <div class="col-md-6">
				<div class="parallax-left parallax-bg" data-stellar-background-ratio="0.6">
				</div>
			</div>
		   <!-- Single Banner End -->
			<!-- Single Banner Start -->
		   <div class="col-md-6">
				<div class="parallax-right">
					<div class="parallax-content">
						<h3>Unlimited Offer</h3>
						<p>Lorem ipsum dolor sit, amet conse ctetur adip isicing elit. Et deleniti iure voluptates eaque cumque suscipit aliquid dolorem expedita iste voluptatum conse ctetur volupt atum</p>
						<a class="button slider-btn" href="index-2.html#">Shop Now</a>
					</div>
				</div>
			</div>
		   <!-- Single Banner End -->
	   </div>
	   <!-- Row End -->
	</div>
	<!-- Container End -->
</div> 

<?php //Our Collections ?>
<div class="new-products ptb-70">
	<div class="container">
		<div class="row">
			<div class="section-title col-lg-12 mb-50">
				<h2>Our Collections <i class="fa fa-shopping-cart"></i></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12 col-lg-12 ">
				<!-- New Pro Content End -->
				<div class="new-kiosk-product-content">
					<div class="kiosk-tab-header tab-bg">
						<!-- Featured Product List Item Start -->
						<ul class="nav product-list product-tab-list">
							<li><a  class="active" data-toggle="tab" href="#new-arrival">New Arrivals</a></li>
							<li><a data-toggle="tab" href="#toprated">Best Sale</a></li>
							<li><a data-toggle="tab" href="#new-arrival">Top Rated</a></li>
						</ul>
						<!-- Featured Product List Item End -->
					</div>
					<div class="tab-content product-tab-content jump mt-30">
						<div id="new-arrival" class="tab-pane active">
							<!-- New Products Activation Start -->
							<div class="kiosk-collection owl-carousel">
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
										<p><span class="price">$320.00</span></p>             
										<h4><a href="product.html">Lorem ipsum solet</a></h4>
										<div class="kiosk-product-action">
											<div class="kiosk-action-content">
												<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
												<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
												<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
											</div>
										</div>
									</div>
									<span class="sticker-new">sale</span>
									<!-- Product Content End -->
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
										<p><span class="price">$370.00</span></p>             
										<h4><a href="product.html">Lorem ipsum solet</a></h4>
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
											<img class="first-img" src="<?php echo $data['uri_assets_img']?>products/5.jpg" alt="single-product">
											<img class="second-img" src="<?php echo $data['uri_assets_img']?>products/6.jpg" alt="single-product">
										</a>
									</div>
									<!-- Product Image End -->
									<!-- Product Content Start -->
									<div class="kiosk-product-content">  
										<p><span class="price">$730.00</span><del class="prev-price">$785.00</del></p>             
										<h4><a href="product.html">Lorem ipsum solet</a></h4>
										<div class="kiosk-product-action">
											<div class="kiosk-action-content">
												<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
												<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
												<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
											</div>
										</div>
									</div>
									<span class="sticker-new">-30%</span>
									<!-- Product Content End -->
								</div>                                        
								<!-- Single Product End -->
								<!-- Single Product Start -->
								<div class="single-product">
									<!-- Product Image Start -->
									<div class="kiosk-product-img">
										<a href="product.html">
											<img class="first-img" src="<?php echo $data['uri_assets_img']?>products/11.jpg" alt="single-product">
											<img class="second-img" src="<?php echo $data['uri_assets_img']?>products/12.jpg" alt="single-product">
										</a>
									</div>
									<!-- Product Image End -->
									<!-- Product Content Start -->
									<div class="kiosk-product-content">  
										<p><span class="price">$370.00</span></p>             
										<h4><a href="product.html">Lorem ipsum solet</a></h4>
										<div class="kiosk-product-action">
											<div class="kiosk-action-content">
												<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
												<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
												<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
											</div>
										</div>
									</div>
									<span class="sticker-new">-10%</span>
									<!-- Product Content End -->
								</div>                                       
								<!-- Single Product End -->
								<!-- Single Product Start -->
								<div class="single-product">
									<!-- Product Image Start -->
									<div class="kiosk-product-img">
										<a href="product.html">
											<img class="first-img" src="<?php echo $data['uri_assets_img']?>products/13.jpg" alt="single-product">
											<img class="second-img" src="<?php echo $data['uri_assets_img']?>products/14.jpg" alt="single-product">
										</a>
									</div>
									<!-- Product Image End -->
									<!-- Product Content Start -->
									<div class="kiosk-product-content">  
										<p><span class="price">$130.00</span></p>             
										<h4><a href="product.html">Lorem ipsum solet</a></h4>
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
										<p><span class="price">$330.00</span><del class="prev-price">$352.00</del></p>             
										<h4><a href="product.html">Lorem ipsum solet</a></h4>
										<div class="kiosk-product-action">
											<div class="kiosk-action-content">
												<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
												<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
												<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
											</div>
										</div>
									</div>
									<span class="sticker-new">-30%</span>
									<!-- Product Content End -->
								</div>                                        
								<!-- Single Product End -->
							</div>
							<!-- New Products Activation End -->
						</div>
						<!-- New Products End -->
						<div id="toprated" class="tab-pane">
							<!-- New Products Activation Start -->
							<div class="kiosk-collection owl-carousel">
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
										<p><span class="price">$890.00</span></p>             
										<h4><a href="product.html">Lorem ipsum solet</a></h4>
										<div class="kiosk-product-action">
											<div class="kiosk-action-content">
												<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
												<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
												<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
											</div>
										</div>
									</div>
									<span class="sticker-new">-30%</span>
									<!-- Product Content End -->
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
										<p><span class="price">$470.00</span></p>             
										<h4><a href="product.html">Lorem ipsum solet</a></h4>
										<div class="kiosk-product-action">
											<div class="kiosk-action-content">
												<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
												<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
												<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
											</div>
										</div>
									</div>
									<span class="sticker-new">-30%</span>
									<!-- Product Content End -->
								</div>                                        
								<!-- Single Product End -->
								<!-- Single Product Start -->
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
										<p><span class="price">$310.00</span><del class="prev-price">$312.00</del></p>             
										<h4><a href="product.html">Lorem ipsum solet</a></h4>
										<div class="kiosk-product-action">
											<div class="kiosk-action-content">
												<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
												<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
												<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
											</div>
										</div>
									</div>
									<span class="sticker-new">-30%</span>
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
										<p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>             
										<h4><a href="product.html">Lorem ipsum solet</a></h4>
										<div class="kiosk-product-action">
											<div class="kiosk-action-content">
												<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
												<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
												<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
											</div>
										</div>
									</div>
									<span class="sticker-new">-30%</span>
									<!-- Product Content End -->
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
										<p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>             
										<h4><a href="product.html">Lorem ipsum solet</a></h4>
										<div class="kiosk-product-action">
											<div class="kiosk-action-content">
												<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
												<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
												<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
											</div>
										</div>
									</div>
									<span class="sticker-new">-30%</span>
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
										<p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>             
										<h4><a href="product.html">Lorem ipsum solet</a></h4>
										<div class="kiosk-product-action">
											<div class="kiosk-action-content">
												<a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
												<a href="cart.html" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
												<a href="product.html" data-toggle="tooltip" title="Product Details"><i class="fa fa-link"></i></a>
											</div>
										</div>
									</div>
									<span class="sticker-new">-30%</span>
									<!-- Product Content End -->
								</div>                                        
								<!-- Single Product End -->
							</div>
							<!-- New Products Activation End -->
						</div>
					</div>
					<!-- Tab-Content End -->
				</div>
				<!-- New Pro Content End -->                        
			</div>
		</div>

	</div>
	<!-- Container End -->
</div>



<?php //This Weekend 30% Discount ?>
<div class="purchase-area parallax-bg2" data-stellar-background-ratio="0.6">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 ptb-100 col-lg-12 text-center">
				<h2 class="mb-40">This Weekend 30% Discount </h2>
				<a class="button slider-btn" href="index-2.html#">Purchsase Now</a>
			</div>
		</div>
	</div>
</div>


<?php /*/Blog Page Start  ?>
<div class="blog-area ptb-70 padding-small">
	<div class="container">
		<div class="row">
			<div class="section-title col-lg-12 mb-50">
				<h2>Our Blogs <i class="fa fa-shopping-cart"></i></h2>
			</div>
		</div>
		 <!-- Popular Categorie Activation Start -->
		 <div class="kiosk-blog owl-carousel">
			<!-- Single Blog Start -->
			<div class="single-blog">
				<div class="blog-img">
					<a href="blog-details.html"><img src="<?php echo $data['uri_assets_img']?>blog/1.jpg" alt="blog-image"></a>
				</div>
				<div class="blog-content">
					<h4 class="blog-title"><a href="blog-details.html">A Grand Opening Program</a></h4>
					<div class="blog-meta">
						<ul>
							<li><span>By</span> <a href="index-2.html#">Kavin </a></li>
							<li><a href="index-2.html#">12 Feb, 2018</a></li>
							<li><a href="index-2.html#">comments(2)</a></li>
						</ul>
					</div>
					<p>Lorem ipsum dolor sit amet adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magn a aliqua. Ut enim ad minim veniam.</p>
					<div class="readmore">
						<a href="blog-details.html">Read More</a>
					</div>
				</div>
			</div>
			<!-- Single Blog End -->
			<!-- Single Blog Start -->
			<div class="single-blog">
				<div class="blog-img">
					<a href="blog-details.html"><img src="<?php echo $data['uri_assets_img']?>blog/2.jpg" alt="blog-image"></a>
				</div>
				<div class="blog-content">
					<h4 class="blog-title"><a href="blog-details.html">Women Fashion 2018</a></h4>
					<div class="blog-meta">
						<ul>
							<li><span>By</span> <a href="index-2.html#">Jone doe </a></li>
							<li><a href="index-2.html#">12 Feb, 2018</a></li>
							<li><a href="index-2.html#">comments(2)</a></li>
						</ul>
					</div>
					<p>Lorem ipsum dolor sit amet adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magn a aliqua. Ut enim ad minim veniam.</p>
					<div class="readmore">
						<a href="blog-details.html">Read More</a>
					</div>
				</div>
			</div>
			<!-- Single Blog End -->
			<!-- Single Blog Start -->
			<div class="single-blog">
				<div class="blog-img">
					<a href="blog-details.html"><img src="<?php echo $data['uri_assets_img']?>blog/3.jpg" alt="blog-image"></a>
				</div>
				<div class="blog-content">
					<h4 class="blog-title"><a href="blog-details.html">Celebrating 27th anniversary</a></h4>
					<div class="blog-meta">
						<ul>
							<li><span>By</span> <a href="index-2.html#">Riya </a></li>
							<li><a href="index-2.html#">12 Feb, 2018</a></li>
							<li><a href="index-2.html#">comments(2)</a></li>
						</ul>
					</div>
					<p>Lorem ipsum dolor sit amet adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magn a aliqua. Ut enim ad minim veniam.</p>
					<div class="readmore">
						<a href="blog-details.html">Read More</a>
					</div>
				</div>
			</div>
			<!-- Single Blog End -->
			<!-- Single Blog Start -->
			<div class="single-blog">
				<div class="blog-img">
					<a href="blog-details.html"><img src="<?php echo $data['uri_assets_img']?>blog/1.jpg" alt="blog-image"></a>
				</div>
				<div class="blog-content">
					<h4 class="blog-title"><a href="blog-details.html">Women Fashion 2018</a></h4>
					<div class="blog-meta">
						<ul>
							<li><span>By</span> <a href="index-2.html#">Sonjib </a></li>
							<li><a href="index-2.html#">12 Feb, 2018</a></li>
							<li><a href="index-2.html#">comments(2)</a></li>
						</ul>
					</div>
					<p>Lorem ipsum dolor sit amet adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magn a aliqua. Ut enim ad minim veniam.</p>
					<div class="readmore">
						<a href="blog-details.html">Read More</a>
					</div>
				</div>
			</div>
			<!-- Single Blog End -->
			<!-- Single Blog Start -->
			<div class="single-blog">
				<div class="blog-img">
					<a href="blog-details.html"><img src="<?php echo $data['uri_assets_img']?>blog/2.jpg" alt="blog-image"></a>
				</div>
				<div class="blog-content">
					<h4 class="blog-title"><a href="blog-details.html">A Grand Opening Ceremony</a></h4>
					<div class="blog-meta">
						<ul>
							<li><span>By</span> <a href="index-2.html#">Sadika </a></li>
							<li><a href="index-2.html#">12 Feb, 2018</a></li>
							<li><a href="index-2.html#">comments(2)</a></li>
						</ul>
					</div>
					<p>Lorem ipsum dolor sit amet adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magn a aliqua. Ut enim ad minim veniam.</p>
					<div class="readmore">
						<a href="blog-details.html">Read More</a>
					</div>
				</div>
			</div>
			<!-- Single Blog End -->
			<!-- Single Blog Start -->
			<div class="single-blog">
				<div class="blog-img">
					<a href="blog-details.html"><img src="<?php echo $data['uri_assets_img']?>blog/3.jpg" alt="blog-image"></a>
				</div>
				<div class="blog-content">
					<h4 class="blog-title"><a href="blog-details.html">Women Fashion 2018</a></h4>
					<div class="blog-meta">
						<ul>
							<li><span>By</span> <a href="index-2.html#">Sohel </a></li>
							<li><a href="index-2.html#">12 Feb, 2018</a></li>
							<li><a href="index-2.html#">comments(2)</a></li>
						</ul>
					</div>
					<p>Lorem ipsum dolor sit amet adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magn a aliqua. Ut enim ad minim veniam.</p>
					<div class="readmore">
						<a href="blog-details.html">Read More</a>
					</div>
				</div>
			</div>
			<!-- Single Blog End -->
		 </div>
		 <!-- Popular Categorie Activation End -->
	</div>
	<!-- Container End -->
</div>
<?php //Blog Page End */ ?>


<?php //newsletter Start  ?>
<div class="kiosk-newsletter-area ptb-70">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mr-auto ml-auto">
				<div class="newsletter text-center">
					<div class="main-news-desc">
						<div class="news-desc">
							<h3>Sign Up To Newsletter</h3>
						</div>
					</div>
					<div class="kiosk-subscribe">
						<form action="index-2.html#">
							<input class="subscribe" placeholder="Enter your email address" name="email" id="subscribe" type="text">
							<button type="submit" class="submit">subscribe</button>
						</form>
					</div>
				</div>                            
			</div>
		</div>          
	</div>
</div>
<?php //newsletter end  ?>
