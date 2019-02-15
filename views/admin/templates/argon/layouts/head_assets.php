<?php 
defined('YV_LiteShop') or die ('Restricted Access!');
$uri_avndr = $data['uri_assets_vendor'];

?>  

<?php // Fonts?>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<?php // Icons?>
<link href="<?php echo $data['uri_assets_vendor'] . 'nucleo/css/nucleo.css'?>" rel="stylesheet">
<link href="<?php echo $data['uri_assets_vendor'] . '@fortawesome/fontawesome-free/css/all.min.css'?>" rel="stylesheet">

<?php // Argon CSS?>
<link type="text/css" href="<?php echo $data['uri_assets_css'] . 'argon.css'?>" rel="stylesheet">

<?php // Select2 CSS?>
<link type="text/css" href="<?php echo $data['uri_assets_css'] . 'select2.min.css'?>" rel="stylesheet">

<?php //extra css based on frontend template ?>
<?php if (isset($tmpl_content['assets_css']) && count($tmpl_content['assets_css'])) { 
	foreach ($tmpl_content['assets_css'] as $extraCss) { ?>
		<link type="text/css" href="<?php echo $data['uri_assets_css'] . 'tmpl_'.$shopTemplate.'/'.$extraCss?>" rel="stylesheet">
	<?php } 
} ?>

<?php // Custom CSS?>
<link type="text/css" href="<?php echo $data['uri_assets_css'] . 'custom.css'?>" rel="stylesheet">

<script src="<?php echo $uri_avndr . 'jquery/dist/jquery.min.js'?>" ></script>