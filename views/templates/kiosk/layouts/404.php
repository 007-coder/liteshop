<?php defined('YV_LiteShop') or die ('Restricted Access!');?>

<?php //Error 404 Area Start  ?>
<div class="kiosk-error-area ptb-100">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="error-wrapper text-center">
					<div class="error-text">
						<h1>404</h1>
						<h2><?php echo TXT_404_MAIN_TEXT ?></h2>
						<p><?php echo TXT_404_DESCR_TEXT ?><a href="<?php echo $data['uri_base'] ?>"><?php echo TXT_404_DESCR_LINK_TEXT ?></a><?php echo TXT_404_DESCR_TEXT2 ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php //Error 404 Area End  ?>