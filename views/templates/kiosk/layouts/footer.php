<?php defined('YV_LiteShop') or die ('Restricted Access!'); 
$content_footer = $tmpl_content['footer'];

// ЛОГОТИП В ФУТЕРЕ.
// иконки СОЦ СЕТЕЙ В ФУТЕРЕ 4я колонка


?>


<?php //Footer Start ?>	
<footer class="black-bg">


	<?php //Footer Top Start ?>	
	<div class="footer-top ptb-60">
		<div class="container">           
			<div class="row">

				
				<?php //Single Footer Start ?>	
				<?php
				foreach ($content_footer as $fc_i => $fcol) {
					if (in_array($fc_i, ['col1','col2','col3','col4'])) { 

					$b_c = '';	
					switch ($fc_i) {
						case 'col1':
							$b_c = 'col-lg-4  col-md-4 col-sm-6';
							break;
						case 'col2':
							$b_c = 'col-lg-2  col-md-2 col-sm-6 footer-full';
							break;
						case 'col3':
							$b_c = 'col-lg-3 col-md-3  col-sm-6 footer-full';
							break;
						case 'col4':
							$b_c = 'col-lg-3 col-md-3 col-sm-6 footer-full';
							break;					
					}
					?>
						<div class="<?php echo $b_c ?>">
							<div class="single-footer">
								<?php if (isset($fcol['heading'][$_lang])) { ?>
									<h3 class="footer-title"><?php echo $fcol['heading'][$_lang] ?></h3>
								<?php } ?>

								<?php if (isset($fcol['content']) && count($fcol['content'])) { ?>
									<div class="footer-content">
										<?php //text  ?>
										<?php if (isset($fcol['content']['text'][$_lang])) { ?>
											<p><?php echo $fcol['content']['text'][$_lang] ?></p>	
										<?php } ?>

										<?php //menu  ?>
										<?php if (isset($fcol['content']['menu']) && count($fcol['content']['menu'])) { ?>
											<ul class="footer-list">
												<?php foreach ($fcol['content']['menu'] as $fmenu) { ?>
													<li><a href="<?php echo $fmenu['link'] ?>" target="_blank"><?php echo $fmenu['name'][$_lang]?></a></li>
												<? } ?>
											</ul>
										<?php } ?>

										<?php //contacts_list  ?>
										<?php if (isset($fcol['content']['contacts_list']) && count($fcol['content']['contacts_list'])) { ?>
											<div class="kiosk-contact-address">
												<?php foreach ($fcol['content']['contacts_list'] as $cgroup => $contacts) { 

													switch ($cgroup) {
														case 'phones':
															$fa_icon = ' fa-phone';
															break;
														case 'emails':
															$fa_icon = ' fa-envelope-o';
															break;
														case 'locations':
															$fa_icon = ' fa-map-marker';
															break;
														case 'social_accounts':														
															$fa_icon = '';
															break;														
													}
													foreach ($contacts as $ctype => $contact) {
														// Добавить формир иконок для соц аккаунтов.
														if ($cgroup !='social_accounts') { ?>
														<?php if ($contact !='') { ?>
															<span>
																<i class="<?php echo 'fa '.$fa_icon ?>"></i>
																<?php echo $contact ?>
															</span>
														<?php } ?>
														<?php }
													}

												}	?>

												<?php /* ?>
												
												<span><i class="fa fa-facebook"></i>kiosk.facebook</span>
												<span><i class="fa fa-youtube"></i>kiosk.youtube</span>
												<?php */ ?>

											</div>
										<?php } ?>

										<?php //social  ?>
										<?php if (isset($fcol['content']['social']) && count($fcol['content']['social'])) { ?>
											<div class="kiosk-footer-social">
												<ul class="kiosk-footer-list footer-top-social">
													<?php foreach ($fcol['content']['social'] as $f_soc => $f_soc_link) { ?>
														<li>
															<a href="<?php echo $f_soc_link ?>" target="_blank"><i class="<?php echo 'fa fa-'.$f_soc ?>"></i></a>
														</li>
													<?php } ?>
												</ul>
											</div>
										<?php } ?>

									</div>
								<?php } ?>
							</div>
						</div>
					<?php }					
				} ?>				
				<?php //Single Footer END ?>	

			</div>
			<!-- Row End -->
		</div>
		<!-- Container End -->
	</div>
	<?php //Footer Top End ?>	




	<?php //Footer Bottom Start ?>	
	<div class="footer-bottom">
		<div class="container">
			<div class="footer-bottom-content">
				<p class="copy-right-text"><?php echo $content_footer['footer_copyrights'][$_lang].DEV_CR?></p>
				<div class="kiosk-footer-social hidden-content">
					<?php if (count($content_footer['footer_bottom_right']['icons'])) { ?>
					<ul class="kiosk-footer-list">
						<?php foreach ($content_footer['footer_bottom_right']['icons'] as $fbr_icon) { ?>
							<li><img src="<?php echo $data['uri_assets_img'].'footer/'.$fbr_icon?>" alt=""></li>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php //Container End?>	
	</div>
	<?php //Footer Bottom End ?>	



</footer>
<?php //Footer End ?>	


