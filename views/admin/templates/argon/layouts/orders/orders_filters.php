<?php defined('YV_LiteShop') or die ('Restricted Access!'); ?>


<div class="filters_wrap mt-2 mb-2">
  <h4 class="text-primary"><?php echo $i18n->t('FILTERS_TITLE');?> <span class="icon"></span></h4>

  <div class="filters_content">

    <div class="row">

      <div class="col-md-10 col-sm-10">
        <form action="<?php echo build_admin_link(['type'=>'orders']) ?>" method="post" >
          <div class="row">
            <div class="col-sm-4 col-md-4">
              <h4><?php echo $i18n->t('FILTERS_ORDER_NUMBER') ?></h4>
              <div class="form-group">
                <input type="text" name="order_number" class="form-control"   placeholder="<?php echo $i18n->t('FILTERS_ORDER_NUMBER') ?>" minlength="2" maxlength="20" value="<?php echo ( isset($orFilters['order_number']) && !empty($orFilters['order_number']) ) ? $orFilters['order_number'] : '' ?>">
              </div>
            </div>

            <div class="col-sm-4 col-md-4">

              <h4><?php echo $i18n->t('PAGE_ORDERS_ORDER_STATUS') ?></h4>
              <div class="order_statuses form-group">
                <?php                 

                echo buildSelect([
                  'list'=>$orderStatuses,
                  'name'=>'order_status',
                  'selected'=>isset($orFilters['order_status']) && !empty($orFilters['order_status']) ? $orFilters['order_status'] : '',
                  'class'=>'select2 order_filters order_status',
                  'id'=>'Select2_FiltersOrderStatus',
                  'lang'=>$_lang
                ]); 
                ?>
              </div>       
              
            </div>
            <div class="col-sm-4 col-md-4">
              <h4><?php echo $i18n->t('PAGE_ORDERS_PAYMENT_STATUS') ?></h4>
              <div class="order_payment_statuses">
                <?php
                echo buildSelect([
                  'list'=>$orderPaymentStatuses,
                  'name'=>'order_payment_status',
                  'selected'=>isset($orFilters['order_payment_status']) && !empty($orFilters['order_payment_status']) ? $orFilters['order_payment_status'] : '',
                  'class'=>'select2 order_filters order_payment_status',
                  'id'=>'Select2_FiltersOrderPaymentStatus',
                  'lang'=>$_lang
                ]); 
                ?>
              </div>                        
            </div>
          </div>

          <div class="row mt-1">
            <div class="col-sm-3 col-md-3">
              <button type="submit" class="btn btn-primary"><?php echo $i18n->t('FBT_APPLY') ?></button>
            </div>
          </div>
          
          <input type="hidden" name="area" value="orders">
          <input type="hidden" name="section" value="admin">
          <input type="hidden" name="action" value="filter_orders">
        </form>

      </div>

      <div class="col-md-2 col-sm-2">
        <form action="<?php echo build_admin_link(['type'=>'orders']) ?>" method="post" >

          <button type="submit" class="btn btn-secondary btn-sm"><?php echo $i18n->t('FBT_RESET') ?></button>


          <input type="hidden" name="area" value="orders">
          <input type="hidden" name="section" value="admin">
          <input type="hidden" name="action" value="reset_filters">
        </form>

      </div>

    </div>

  </div>
</div>