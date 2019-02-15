<?php 
defined('YV_LiteShop') or die ('Restricted Access!');
?>

<footer class="footer">
  <div class="row align-items-center justify-content-xl-between">
    <div class="col-xl-6">
      <div class="copyright text-center text-xl-left text-muted">
        &copy; <?php echo date('Y') ?> <a href="<?php echo $data['uri_base'] ?>" class="font-weight-bold ml-1" target="_blank"><?php echo $data['site_name'] ?></a>
      </div>
    </div>
    <div class="col-xl-6">
      <ul class="nav nav-footer justify-content-center justify-content-xl-end">
        <li class="nav-item">
          <?php echo $adminConfig['dev_copyrights'][$_lang]; ?>
        </li>       
        <?php /* ?>
        <li class="nav-item">
          <a href="" class="nav-link" target="_blank"></a>
        </li>
        <?php */ ?>
      </ul>
    </div>
  </div>
</footer>