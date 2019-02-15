<?php 
defined('YV_LiteShop') or die ('Restricted Access!');
?>

<div class="main-content">	
		
		<?php /* ?>
		<nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="../index.html">
          <img src="../assets/img/brand/white.png" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.html">
                  <img src="../assets/img/brand/blue.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="../index.html">
                <i class="ni ni-planet"></i>
                <span class="nav-link-inner--text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="../examples/register.html">
                <i class="ni ni-circle-08"></i>
                <span class="nav-link-inner--text">Register</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="../examples/login.html">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-inner--text">Login</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="../examples/profile.html">
                <i class="ni ni-single-02"></i>
                <span class="nav-link-inner--text">Profile</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <?php */ ?>   
    
    <?php //Header ?>
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white"><?php echo $i18n->text('LOGIN_PAGE') ?></h1>
              <p class="text-lead text-light"><?php echo $data['site_name'] ?></p>
            </div>
          </div>

          <?php if (!empty($data['message'])) { ?>            
	          <div class="row justify-content-center t-4">
	            <div class="col-lg-5 col-md-6">
	            	<h3 class="text-lead text-light"><?php echo $data['message']['text'] ?></h3>
	            </div>
	          </div>
          <?php } ?>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    
    <?php //Page content ?>
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">						

            <div class="card-body px-lg-5 py-lg-5">

            	<?php //LOGIN FORM ?>            
              <form role="form" action="<?php echo get_actual_url(); ?>" method="POST">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                    </div>
                    <input class="form-control" placeholder="<?php echo $i18n->t('LOGIN') ?>" type="text" name="login">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="<?php echo $i18n->t('PASSWORD') ?>" type="password" name="password">
                  </div>
                </div>                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4"><?php echo $i18n->t('LOGIN_FORM_SUBMIT') ?></button>
                </div>

                <input type="hidden" name="action" value="admin_login">
              </form>
              <?php //LOGIN FORM END ?>
            </div>
          </div>

          <div class="row mt-4 justify-content-center">
          	<div class="col-5 text-center"><a href="<?php echo $data['uri_base'] ?>"><i class="ni ni-cart"></i> <?php echo $i18n->text('TO_HOMEPAGE') ?></a></div>            
          </div>

        </div>
      </div>
    </div>

  </div>
  
  
  <?php //Footer ?>
  <footer class="py-5">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; <?php echo date('Y'); ?> <a href="<?php echo $data['uri_base'] ?>" class="font-weight-bold ml-1" target="_blank"><?php echo $data['site_name'] ?></a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">           
            <li class="nav-item">
            	<?php echo $adminConfig['dev_copyrights'][$_lang]; ?>
            	<?php /* ?>
              <a href="" class="nav-link" target="_blank"></a>
              <?php */ ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>