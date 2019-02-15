<?php defined('YV_LiteShop') or die ('Restricted Access!');?>

<form action="<?php echo build_admin_link(['type'=>'orders']).'#'.$order['order_number'] ?>" method="post" >

  <?php // контент Биллинг ?>
  <div class="modal-body">   

    <h4><?php echo $i18n->t('PAGE_ORDERS_SHIPPING_NAME')?></h4>
    <div class="row">      
      <div class="col-md-6 col-sm-12">
        <div class="form-group">
          <input type="text" name="first_name" class="form-control"  id="bill_first_name" placeholder="<?php echo $i18n->t('FIT_NAME') ?>" required minlength="2" maxlength="30" value="<?php echo $billData['first_name'] ?>">
        </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <div class="form-group">
         <input type="text" name="second_name" class="form-control" id="bill_second_name" placeholder="<?php echo $i18n->t('FIT_SECOND_NAME') ?>" required minlength="2" maxlength="30" value="<?php echo $billData['second_name'] ?>">
        </div>
      </div>
    </div>

    <h4><?php echo $i18n->t('PAGE_ORDERS_SHIPPING_EMAIL_PHONE')?></h4>
    <div class="row">      
      <div class="col-md-6 col-sm-12">
        <div class="form-group">
          <input type="email" name="email" class="form-control"  id="bill_email" placeholder="<?php echo $i18n->t('FIT_EMAIL') ?>" required minlength="2" maxlength="40" value="<?php echo $billData['email'] ?>">
        </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <div class="form-group">
         <input type="text" name="phone" class="form-control" id="bill_phone" placeholder="<?php echo $i18n->t('FIT_PHONE') ?>" required minlength="2" maxlength="30" value="<?php echo $billData['phone'] ?>">
        </div>
      </div>
    </div>

    <h4><?php echo $i18n->t('PAGE_ORDERS_SHIPPING_ADDRESS_CYTY')?></h4>
    <div class="row">      
      <div class="col-md-6 col-sm-12">
        <div class="form-group">
          <input type="text" name="address" class="form-control"  id="bill_address" placeholder="<?php echo $i18n->t('FIT_ADDRESS') ?>" required minlength="2" maxlength="40" value="<?php echo $billData['address'] ?>">
        </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <div class="form-group">
         <input type="text" name="city" class="form-control" id="bill_city" placeholder="<?php echo $i18n->t('FIT_CITY') ?>" required minlength="2" maxlength="30" value="<?php echo $billData['city'] ?>">
        </div>
      </div>
    </div>

    <h4><?php echo $i18n->t('PAGE_ORDERS_SHIPPING_ZIP_SHIPPING_METHOD')?></h4>
    <div class="row">      
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <input type="text" name="zipcode" class="form-control"  id="bill_zipcode" placeholder="<?php echo $i18n->t('FIT_ZIP') ?>" required minlength="2" maxlength="10" value="<?php echo $billData['zipcode'] ?>">
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="form-group">        
         <?php
         $shippingData = [
          'list'=>$shippingMethods,
          'name'=>'order_shipping',
          'selected'=>$order['order_shipping'],
          'class'=>'select2',
          'lang'=>$_lang
         ];
         echo buildSelect($shippingData); ?>
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
         <?php
         $paymentData = [
          'list'=>$paymentMethods,
          'name'=>'order_payment',
          'selected'=>$order['order_payment'],
          'class'=>'select2',
          'lang'=>$_lang
         ];
         echo buildSelect($paymentData); ?>
        </div>
      </div>
    </div>





  </div>                              

  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><?php echo $i18n->t('FBT_SAVE') ?></button>
    <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal"><?php echo $i18n->t('FBT_CLOSE') ?></button> 
  </div>

  <input type="hidden" name="order_number" value="<?php echo $order['order_number'] ?>">
  <input type="hidden" name="area" value="orders">
  <input type="hidden" name="action" value="update_order_billing">  
</form>