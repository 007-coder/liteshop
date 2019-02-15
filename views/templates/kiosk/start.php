<?php 
defined('YV_LiteShop') or die ('Restricted Access!');
$shopConfig = $data['config'];
$layouts_path = VIEWS_TEMPLATES_DIR.DS.$shopConfig['template'].DS.'layouts'.DS;

$_available_languages = $shopConfig['available_languages'];
$_lang = $shopConfig['interface_lang'];

$_available_currencies = $shopConfig['available_currencies'];
$_excanges_rates = $shopConfig['excanges_rates'];
$_currency_codes = $shopConfig['currency_codes'];
$_currency = $shopConfig['shop_currency'];
$_currency_rate = $shopConfig['shop_currency_rate'];
$_main_currency = $shopConfig['main_currency'];
$_price_round = $shopConfig['price_round'];
//
$is_homepage = ($data['page'] == 'homepage') ? true : false;


$tmpl_content = $data['template_content'];


 ?>

<!doctype html>
<html class="no-js" lang="<?php echo $data['lang_iso_code'] ?>">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title><?php echo $data['meta_title'] ?></title>
		<meta name="description" content="<?php echo $data['meta_desc'] ?>">
		<meta name="keywords" content="<?php echo $data['meta_keywords'] ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="<?php echo $data['meta_author'] ?>">
		
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $data['uri_assets_img'].'icon/favicon.png'?>">

		<?php require_once($layouts_path.'head_assets.php'); ?>
	</head>

	<body>

		<script type="text/javascript">	
			var currency_rate = <?php echo $_currency_rate ?>;
			var currency = '<?php echo $_currency ?>';
			var price_round = {
				'precision' : <?php echo $_price_round['precision'] ?>,
				'method' : '<?php echo $_price_round['method'] ?>'
			};

			function round(value, decimals) {
 				return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
			}			
		</script>		

		<?php //Wrapper Start ?>
		<div class="<?php echo ($is_homepage) ? 'wrapper kiosk-home' : 'wrapper' ?>">
		
		<?php require_once($layouts_path.'header.php'); ?>


		<?php

		switch ($data['page']) {
			case 'homepage':
				require_once($layouts_path.DS.'homepage.php');			
				break;
			case 'product':
				require_once($layouts_path.'breadcrumbs.php');
				require_once($layouts_path.'message.php');
				require_once($layouts_path.'product.php');			
				break;
			case 'show_order':
				require_once($layouts_path.'breadcrumbs.php');
				require_once($layouts_path.'message.php');
				require_once($layouts_path.'show_order.php');			
				break;
			case 'cart':
				require_once($layouts_path.'breadcrumbs.php');
				require_once($layouts_path.'message.php');
				require_once($layouts_path.'cart.php');			
				break;
			case 'checkout':
				require_once($layouts_path.'breadcrumbs.php');
				require_once($layouts_path.'message.php');
				require_once($layouts_path.'checkout.php');			
				break;	
			case '404':
				require_once($layouts_path.'404.php');			
				break;
			
		} ?>
	

		<?php require_once($layouts_path.'footer.php'); ?>
		

		</div>
		<?php //Wrapper End  ?>

	


		<?php require_once($layouts_path.'body_bottom_assets.php'); ?>
		</body>
</html>
