<?php defined('YV_LiteShop') or die ('Restricted Access!');
$breadcrumb = $tmpl_content['breadcrumbs']; ?>


<?php //Breadcrumb Start ?>
<div class="breadcrumb-area ptb-60 ptb-sm-30">
		<div class="container">
				<div class="breadcrumb">
						<ul>
								<li><a href="<?php echo $data['uri_base'] ?>"><?php echo TXT_HP_HOMEPAGE ?></a></li>
								<?php if (isset($breadcrumb['first']) && $breadcrumb['first'] !='') { ?>
								<li><a><?php echo $breadcrumb['first'] ?></a></li>
								<?php } ?>
								<?php if (isset($breadcrumb['last']) && $breadcrumb['last'] !='') { ?>
								<li class="active"><a><?php echo $breadcrumb['last'] ?></a></li>
								<?php } ?>
						</ul>
				</div>
		</div>
		<!-- Container End -->
</div>
<?php //Breadcrumb End ?>
