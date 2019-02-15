<?php 
defined('YV_LiteShop') or die ('Restricted Access!');
?>

<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
  <div class="container-fluid">

    <?php //Toggler ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    
    <?php // logo ?>
    <a class="navbar-brand pt-0" href="<?php echo $data['uri_base'] ?>">
      <img src="<?php echo $data['logo'] ?>" class="navbar-brand-img" alt="...">
    </a>    


		<?php // mobile user_menu ?>    
    <ul class="nav align-items-center d-md-none">
    	<?php /* ?>
      <li class="nav-item dropdown">
        <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="ni ni-bell-55"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <?php */ ?>
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
              <img alt="Image placeholder" src="<?php echo $data['uri_assets_img'].'theme/'.$data['user_info']['icon']?>">
            </span>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
          <div class=" dropdown-header noti-title">
            <h6 class="text-overflow m-0"><?php echo $i18n->t('OTHER_WELCOME_TEXT') ?></h6>
          </div>
          <?php foreach ($data['user_menu'] as $k => $UMval) { ?>
          	<?php if ($k == 'logout') { ?>
          		<div class="dropdown-divider"></div>
          	<?php } ?>
          	<a href="<?php echo $UMval['link'] ?>" class="dropdown-item">
	            <?php echo $UMval['icon'] ?>
	            <span><?php echo $UMval['name'] ?></span>
	          </a>
          <?php } ?>				
        </div>
      </li>
    </ul>
    <?php ?>

    
    <?php // Sedebar main_menu ?>
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
      <!-- Collapse header -->
      <div class="navbar-collapse-header d-md-none">
        <div class="row">
          <div class="col-6 collapse-brand">
            <a href="<?php echo $data['uri_base'] ?>">
              <img src="<?php echo $data['logo'] ?>">
            </a>
          </div>
          <div class="col-6 collapse-close">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>

			<?php /* ?>
      <!-- Form -->
      <form class="mt-4 mb-3 d-md-none">
        <div class="input-group input-group-rounded input-group-merge">
          <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <span class="fa fa-search"></span>
            </div>
          </div>
        </div>
      </form>
      <?php */ ?>

      
      <?php //Navigation ?>
      <ul class="navbar-nav">  	

      	<?php foreach ($data['main_menu'] as $k => $menuItem) { ?>
      		<?php if ($menuItem['publish']) { ?>
      		<li class="nav-item <?php echo ($menuItem['is_active']) ? ' active' : '' ?>">
	          <a class="nav-link" href="<?php echo $menuItem['link'] ?>">
	            <?php echo $menuItem['icon'].' '.$menuItem['name'] ?>
	          </a>
	        </li>
	        <?php } ?>
      	<?php } ?>
      </ul>
			

			<?php // Document navigation ?>
			<?php if (isset($data['document_menu']) && count($data['document_menu'])) { ?>			
	      <hr class="my-3">	    
	      <?php //Heading ?>
	      <h6 class="navbar-heading text-muted"><?php echo $i18n->t('DLT_DOCUMENTATION') ?></h6>
	      
	      <?php //Navigation ?>
	      <ul class="navbar-nav mb-md-3">
	      	<?php foreach ($data['document_menu'] as $dMenuItem) {?>
	      		<li class="nav-item <?php echo ($dMenuItem['is_active']) ? ' active' : '' ?>">
		          <a class="nav-link" href="<?php echo $dMenuItem['link']  ?>">
		             <?php echo $dMenuItem['icon'].' '.$dMenuItem['name'] ?>
		          </a>
		        </li>
	      	<?php } ?>	      
	      </ul>
			<?php } ?>
      

    </div>


  </div>
</nav>