<?php defined('YV_LiteShop') or die ('Restricted Access!');
$uri_ajs = $data['uri_assets_js'];
$uri_avndr = $data['uri_assets_vendor'];
 ?>

<?php //Core ?>


<script src="<?php echo $uri_avndr . 'bootstrap/dist/js/bootstrap.bundle.min.js'?>" async></script>

<?php if ($data['page'] != 'login') { ?>
<?php //Optional JS  ?>
<script src="<?php echo $uri_avndr . 'chart.js/dist/Chart.min.js'?>" async></script>
<script src="<?php echo $uri_avndr . 'chart.js/dist/Chart.extension.js'?>" async></script>
<script src="<?php echo $uri_avndr . 'select2/select2.full.min.js'?>" async></script>
<?php } ?>

<?php //Argon JS ?>
<script src="<?php echo $uri_ajs . 'argon.js?v=1.0.0'?>" async></script>