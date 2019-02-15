<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

$adminConfig = $data['config'];
$layouts_path = VIEWS_DIR.DS.'admin'.DS.'templates'.DS.$adminConfig['template'].DS.'layouts'.DS;
$shopTemplate = $adminConfig['shop_template'];

$_available_languages = $adminConfig['available_languages'];
$_lang = $adminConfig['interface_lang'];

$_available_currencies = $adminConfig['available_currencies'];
$_excanges_rates = $adminConfig['excanges_rates'];
$_currency_codes = $adminConfig['currency_codes'];
$_currency = $adminConfig['shop_currency'];
$_currency_rate = $adminConfig['shop_currency_rate'];
$_main_currency = $adminConfig['main_currency'];
$_price_round = $adminConfig['price_round'];
//
$is_homepage = ($data['page'] == 'homepage') ? true : false;

$tmpl_content = $data['template_content'];

$message = $data['message'];

$i18n = $data['i18n'];

//https://demos.creative-tim.com/argon-dashboard/docs/components/forms.html
?>

<!DOCTYPE html>
<html lang="<?php echo $data['lang_iso_code'] ?>">

	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
	  <meta name="author" content="<?php echo $data['meta_author'] ?>">
	  <title><?php echo $data['meta_title'].' - '.$data['site_name'] ?></title>
	  <link href="<?php echo $data['uri_assets_img']. 'brand/favicon.png'?>" rel="icon" type="image/png">

	  <?php require_once($layouts_path.'head_assets.php'); ?>

	</head>

	<body class="<?php echo ($data['page'] == 'login') ? 'bg-default' : ''; ?>" >
		
		<?php if ($data['page'] == 'login') {

			require_once($layouts_path.DS.'login.php');	

		} else {

			//Sidenav
			require_once($layouts_path.DS.'sidenav.php');	

		?>

	  <!-- Main content -->
	  <div class="main-content admin">

	  	<?php 
	  	//Top navbar
			require_once($layouts_path.DS.'topnav.php');

			//Header
			require_once($layouts_path.DS.'header.php');
	  	?>

	  
	    <?php // Page content ?>
	    <div class="container-fluid mt--7">

	      <?php 
	      //messages
	      if (count($message)) {
	      	require_once($layouts_path.DS.'message.php');
	      }
	      	

	      switch ($data['page']) {
					case 'homepage':
						require_once($layouts_path.DS.'homepage.php');			
						break;
					case 'orders':						
						require_once($layouts_path.'orders.php');			
						break;
					case 'call-me':						
						require_once($layouts_path.'call_me.php');			
						break;	
					case 'docs':						
						require_once($layouts_path.'docs.php');			
						break;				
					case '404':
						require_once($layouts_path.'404.php');			
						break;					
				}

	      //footer
				require_once($layouts_path.DS.'footer.php');?>



	    </div> <?php // .container-fluid  end ?>

	    
	  </div> <?php // .main-content end ?>


		<?php }?>		

		
	

	<?php require_once($layouts_path.'body_bottom_assets.php'); ?>
	</body>


</html>