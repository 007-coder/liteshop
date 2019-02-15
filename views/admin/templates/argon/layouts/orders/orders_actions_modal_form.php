<?php defined('YV_LiteShop') or die ('Restricted Access!'); ?>

<?php // ACTIONS MAIN FORM  ?>
<form action="<?php echo build_admin_link(['type'=>'orders']) ?>" method="post" enctype="multipart/form-data">

  <?php // modal body ?>
  <div class="modal-body">
    <?php

    // delete_order CONTENT
    if ($aModal == 'delete_order') { ?>
    <h2 class="text-center"><?php echo $i18n->t('MSG_ORDERS_CONFIRM_DELETE_ORDER'); ?></h2>
    <?php }

    // change_order_status CONTENT
    else if ($aModal == 'change_order_status') { ?>
    <div class="row text-left">
      <?php // order_status ?>
      <div class="col-sm-12 col-md-5">
        <h4><?php echo $i18n->t('PAGE_ORDERS_ORDER_STATUS') ?></h4>
        <div class="order_statuses">
          <?php 
          $orderStatusesData = [
            'list'=>$orderStatuses,
            'name'=>'order_status',
            'selected'=>$order['order_status'],
            'class'=>'select2',
            'lang'=>$_lang
          ];

          echo buildSelect($orderStatusesData); 
          ?>
        </div>
      </div>

      <?php // order_payment_status ?>
      <div class="col-sm-12 col-md-5">
        <h4><?php echo $i18n->t('PAGE_ORDERS_PAYMENT_STATUS') ?></h4>
        <div class="order_payment_statuses">
          <?php 
          $orderPaymentStatusesData = [
            'list'=>$orderPaymentStatuses,
            'name'=>'order_payment_status',
            'selected'=>$order['order_payment_status'],
            'class'=>'select2',
            'lang'=>$_lang
          ];

          echo buildSelect($orderPaymentStatusesData); 
          ?>
        </div>
      </div>


    </div>                                
    <?php } ?>
  </div>


  <?php // modal footer ?>                          
  <div class="modal-footer">                         
    <button type="submit" class="btn btn-primary"><?php echo $submButtText ?></button>
    <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal"><?php echo $i18n->t('OTHER_CANCEL') ?></button> 
  </div>                            



  <input type="hidden" name="order_number" value="<?php echo $order['order_number'] ?>">
  <input type="hidden" name="area" value="orders">
  <input type="hidden" name="action" value="<?php echo $formAction ?>">
</form>
<?php // ACTIONS MAIN FORM END ?>