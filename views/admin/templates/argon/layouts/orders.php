<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

$orders = $data['template_content']['orders'];
$CountOrders = $data['template_content']['CountOrders'];
$OrderActions = $data['template_content']['OrderActions'];
$orderStatuses = $data['template_content']['orderStatuses'];
$orderPaymentStatuses = $data['template_content']['orderPaymentStatuses'];
$shippingMethods = $data['template_content']['shippingMethods'];
$paymentMethods = $data['template_content']['paymentMethods'];
$pagination = $data['template_content']['pagination'];

$recordsPerPage = $data['template_content']['recordsPerPage'];
$orFilters = $data['template_content']['orderFilters'];

$sTmp = [];
foreach ($shippingMethods as $sMethod) { 
  $sTmp[$sMethod['code']] = $sMethod;
}
$shippingMethods = $sTmp;

$pTmp = [];
foreach ($paymentMethods as $pMethod) { 
  $pTmp[$pMethod['code']] = $pMethod;
}
$paymentMethods = $pTmp; 

?>

<?php 
// Orders js манипуляции с товарами заказа
require_once($layouts_path.DS.'orders_js.php');

?>


<div class="orders_wrap">
  
  <div class="row">
    <div class="col">
      <div class="card shadow">
        

        <div class="card-header border-0">
          <div class="row">

            <?php // Title ?>   
            <div class="col-md-10 col-sm-9">
              <h3 class="mb-0"><?php echo $i18n->t('MLT_ORDERS'); echo ($CountOrders) ? ' - '.$CountOrders.' '.$i18n->t('OTHER_PCS') : ''; ?></h3>
            </div>   

            <?php // records per page ?>   
            <div class="col-md-2 col-sm-3 text-right">
              <form action="<?php echo build_admin_link(['type'=>'orders']); ?>" method="post" id="countOrdersPerPage">
                <?php 
                  $ProdPerPageData = [
                    'list'=>$recordsPerPage['list'],
                    'name'=>'rpp_value',
                    'selected'=>$recordsPerPage['selected'],
                    'class'=>'select2',
                    'id'=>'Select2_countOrdersPerPage',
                    'lang'=>$_lang
                  ];

                  echo buildSelect($ProdPerPageData); 
                  ?>       


                  <input type="hidden" name="area" value="orders">
                  <input type="hidden" name="action" value="change_records_per_page">
                </form>              
            </div>

          </div>         

          <?php require_once($layouts_path.DS.'orders'.DS.'orders_filters.php'); ?>

        </div>


        
        <?php //pagination ?>
        <?php if ($CountOrders>0) {
          echo $pagination;
        }?>          
          

        

        <div class="table-responsive <?php echo (!$CountOrders) ? 'no_orders' : '' ?>">

          <?php //Таблица с заказами ?>
          <?php if ($CountOrders>0) { ?>


          <table class="table align-items-center table-flush orders_table">

            <thead class="thead-light">
              <tr>
                <?php // Номер заказа, статус заказа, статус оплаты, дата заказа, ссылка для клиента, валюта счета ?>
                <th scope="col" width="27%" ><?php echo $i18n->t('PAGE_ORDERS_ORDER')?></th>
                <?php // Сумма, в том числе стоимость доставки и оплаты, способы доставки и оплаты ?>
                <th scope="col" width="13%"><?php echo $i18n->t('PAGE_ORDERS_ORDER_SUMM')?></th>
                <?php // Биллинг ?>
                <th scope="col" width="40%"><?php echo $i18n->t('PAGE_ORDERS_ORDER_BILLING')?></th>
                <?php // Товары ?>
                <th scope="col" width="10%"><?php echo $i18n->t('PAGE_ORDERS_ORDER_PRODUCTS')?></th>
                           
                <?php // Действия ?>
                <th scope="col" width="10%"><?php echo $i18n->t('PAGE_ORDERS_ORDER_ACTIONS')?></th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($orders as $order) {

                //wrap_pre($order,'$order');


                $billData = $order['billing_info'];
                $modalHeaderLine1 = ' # <span class="text-orange">'.format_order_number($order['order_number'],[4,'-']).'</span> <span class="mOrder_date text-light pl-1">'.$i18n->t('OTHER_FROM').' '.$order['created_date'].'</span>';
                $modalHeaderLine2 = $billData['first_name'].' '.$billData['second_name'].' ('. $billData['phone'].' | '.$billData['email'].')';
              ?>




                <tr>
                  <?php // Номер заказа, статус заказа, статус оплаты, дата заказа, ссылка для клиента, валюта счета ?>
                  <td>                    
                    <?php // Order main data ?>
                    <p class="order_main_data">
                      <a href="#" name="<?php echo 'order_'.$order['order_number']  ?>"></a>
                      <span class="order_number text-orange"><i><b><?php echo '# '.format_order_number($order['order_number'],[4,'-']); ?></b></i></span><br>                                          
                      <span class="order_date"><?php echo $i18n->t('OTHER_FROM').' <i>'.$order['created_date'].'</i>'  ?></span>
                      <br>
                      <span class="order_currency"><?php echo $i18n->t('PAGE_ORDERS_ORDER_CURRENCY').': <b>'.$order['order_currency'].'</b>'?></span><br>        
                      <span class="payment_method">
                        <?php echo $i18n->t('PAGE_ORDERS_PAYMENT_METHOD').': <b>'.$paymentMethods[$order['order_payment']]['name'][$_lang].'</b>';?>
                      </span>
                                  
                    </p>

                    <?php // Client order statuses ?>
                    <p class="order_statuses">
                      <span class="<?php echo 'os '.$order['order_status'] ?>" style="<?php echo 'background: '.$orderStatuses[$order['order_status']]['color'].'; color: '.$orderStatuses[$order['order_status']]['text_color'].';'  ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $i18n->t('PAGE_ORDERS_ORDER_STATUS') ?>"><?php echo $orderStatuses[$order['order_status']]['name'][$_lang] ?></span>
                      <span class="<?php echo 'osp '.$order['order_payment_status'] ?>" style="<?php echo 'background: '.$orderPaymentStatuses[$order['order_payment_status']]['color'].'; color: '.$orderPaymentStatuses[$order['order_payment_status']]['text_color'].';'  ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $i18n->t('PAGE_ORDERS_PAYMENT_STATUS') ?>"><?php echo $orderPaymentStatuses[$order['order_payment_status']]['name'][$_lang] ?></span>
                    </p>
                    
                    <?php // Client order comment ?>
                    <?php if ($order['customer_order_comment'] !='') { ?>
                    <p class="client_order_comment">
                      <div class="dropdown">
                        <a class=" text-pink" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $i18n->t('PAGE_ORDERS_ORDER_CLIENT_COMMENT')?></a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <p class="dropdown-item">
                            <?php echo $order['customer_order_comment'] ?>
                          </p>
                        </div>
                      </div>
                    </p>
                    <?php } ?>

                    <?php // Order client link ?>
                    <p class="order_client_link">
                      <a href="<?php echo build_shop_link(['type'=>'show_order','k'=>$order['order_key'], 'p'=>$order['order_pin']]); ?>" target="_balnk" data-toggle="tooltip" data-placement="bottom" title="<?php echo $i18n->t('PAGE_ORDERS_ORDER_CLIENT_LINK_TOOLTIP') ?>"><?php echo $i18n->t('PAGE_ORDERS_ORDER_CLIENT_LINK')?></a>
                    </p>                  
                  </td>

                  <?php // Сумма, в том числе стоимость доставки и оплаты, способы доставки и оплаты ?>
                  <td>    
                    <div>
                      <p id="<?php echo 'SupSumm_order'.$order['order_number'] ?>"><?php echo '<b class="val">'.$order['order_summ'][$_currency]['val'].'</b> <span class="currency_code">'.$order['order_summ'][$_currency]['currency_code'].'</span>' ?></p>
                    </div>                                                     
                    <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <p class="dropdown-item">
                          <?php echo $i18n->t('PAGE_ORDERS_INCLUDING') ?>
                          <br>
                          <?php echo $i18n->t('PAGE_ORDERS_SHIPPING_PRICE').': '.$order['order_summ'][$_currency]['shipping_price'].' <span class="currency_code">'.$order['order_summ'][$_currency]['currency_code'].'</span>'; ?>
                          <br>
                          <?php echo $i18n->t('PAGE_ORDERS_PAYMENT_PRICE').': '.$order['order_summ'][$_currency]['payment_price'].' <span class="currency_code">'.$order['order_summ'][$_currency]['currency_code'].'</span>'; ?>
                        </p>
                      </div>
                    </div>
                  </td>

                  <?php // Биллинг ?>
                  <td>
                    
                    <div class="shipping_details">
                      <ul class="">
                        <?php // name ?>
                        <li class="shipping_name">
                          <span class="label"><?php echo $i18n->t('PAGE_ORDERS_SHIPPING_NAME').': '?></span>
                          <span class="value"><?php echo $billData['first_name'].' '.$billData['second_name']  ?></span>
                        </li>

                        <?php // e-mail ?>
                        <li class="shipping_name">
                          <span class="label"><?php echo $i18n->t('PAGE_ORDERS_SHIPPING_EMAIL').': '?></span>
                          <span class="value"><?php echo $billData['email'] ?></span>
                        </li>

                        <?php // Телефон ?>
                        <li class="shipping_name">
                          <span class="label"><?php echo $i18n->t('PAGE_ORDERS_SHIPPING_PHONE').': '?></span>
                          <span class="value"><?php echo $billData['phone'] ?></span>
                        </li>

                        <?php // Адрес доставки ?>
                        <li class="shipping_name">
                          <span class="label"><?php echo $i18n->t('PAGE_ORDERS_SHIPPING_ADDRESS').': '?></span>
                          <span class="value"><?php echo $billData['city'].', '.$billData['address'].', '.$i18n->t('PAGE_ORDERS_SHIPPING_ZIPCODE').': '.$billData['zipcode'] ?></span>
                        </li>

                        <?php // Способ доставки ?>
                        <li class="shipping_method">
                          <span class="label"><?php echo $i18n->t('PAGE_ORDERS_SHIPPING_METHOD').': '?></span>
                          <span class="value"><?php echo $shippingMethods[$order['order_shipping']]['name'][$_lang]?></span>    
                        </li>                      
                      </ul>

                      <p>
                        <a href="" class="" data-toggle="modal" data-target="#modal-billing-<?php echo $order['order_number']?>">
                        <?php echo $i18n->t('ORDER_ACTION_EDIT'); ?></a>
                      </p>
                      
                      <?php // Modal EDIT BILLING Start ?>
                      <div class="modal order_billing fade" id="modal-billing-<?php echo $order['order_number']?>" tabindex="-1" role="dialog" aria-labelledby="modal-billing-<?php echo $order['order_number']?>" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h2 class="modal-title" id="<?php echo 'modal-title-billing-'.$order['order_number']?>"><?php echo $i18n->t('PAGE_ORDERS_CHANGE_BILLING_MODAL_TITLE').$modalHeaderLine1; ?>
                                <p class="billing_name"><?php echo $modalHeaderLine2 ?></p>
                              </h2>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div> 

                            <?php require($layouts_path.DS.'orders'.DS.'order_edit_billing_form.php'); ?>                           


                          </div>
                        </div>
                      </div>
                      <?php // Modal EDIT BILLING End ?>

                    </div>
                    
                  </td>

                  <?php // Товары ?>
                  <td>   
                    <div class="order_products">
                      <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-products-<?php echo $order['order_number']?>"><i class="ni ni-bag-17"></i></button>

                      <div class="modal fade" id="modal-products-<?php echo $order['order_number']?>" tabindex="-1" role="dialog" aria-labelledby="modal-products-<?php echo $order['order_number']?>" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h2 class="modal-title" id="<?php echo 'modal-title-products-'.$order['order_number']?>"><?php echo $i18n->t('PAGE_ORDERS_ORDER_PRODUCTS_MODAL_TITLE').$modalHeaderLine1; ?>
                                <p class="billing_name"><?php echo $modalHeaderLine2;  ?></p>
                              </h2>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            
                            <?php                                
                            $products = $order['order_cart']['products'];        
                            require($layouts_path.DS.'orders'.DS.'order_product_cart.php');
                            ?>




                          </div>
                        </div>
                      </div> <?php // #modal-products END ?>


                    </div>
                  </td>

                  <?php // Действия ?>
                  <td class="text-right">
                    <div class="dropdown">
                      <button type="button" class="btn btn-outline-warning" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>

                     
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <?php foreach ($OrderActions as $ak => $action) { 
                          //
                          $actionsModals = ['change_order_status','delete_order'];
                          //
                          $aModalDef = (in_array($ak, $actionsModals)) ? 'data-toggle="modal" data-target="#modal-'.$ak.'-'.$order['order_number'].'"' : '';
                        ?>
                          <a class="dropdown-item" href="<?php echo (!in_array($ak, $actionsModals)) ? build_admin_link(['type'=>$ak, 'order'=>$order['order_number'], 'return_url'=>base64_encode(get_actual_url())]) : '#' ?>" <?php echo $aModalDef ?> ><?php echo $action['icon'].' '.$action['name'] ?></a>  
                        <?php } ?>                      
                      </div>
                    </div>


                    <?php // modals ACTIONS containers START ?>
                    <?php foreach ($actionsModals as $aModal) { ?>              
                      <div class="modal fade order_actions" id="modal-<?php echo $aModal.'-'.$order['order_number'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-<?php echo $aModal.'-'.$order['order_number'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                          <div class="modal-content">                            
                            <?php                            
                            switch ($aModal) {
                              case 'change_order_status':
                                $modalTitle = $i18n->t('PAGE_ORDERS_CHANGE_STATUSES_MODAL_TITLE'); 
                                $formAction = 'change_order_status';
                                $submButtText = $i18n->t('FBT_SAVE');
                                break;
                              case 'delete_order':
                                $modalTitle = $i18n->t('PAGE_ORDERS_DELETE_ORDER_MODAL_TITLE'); 
                                $formAction = 'delete_order';
                                $submButtText = $i18n->t('FBT_REMOVE');
                                break;
                            }
                            ?>

                            <?php // modal header ?>
                            <div class="modal-header">
                              <h2 class="modal-title text-left" id="modal-title-<?php echo $aModal.'-'.$order['order_number'] ?>"><?php echo $modalTitle.$modalHeaderLine1;?>
                                <p class="billing_name"><?php echo  $modalHeaderLine2  ?></p>
                              </h2>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                           
                            <?php require_once($layouts_path.DS.'orders'.DS.'orders_actions_modal_form.php'); ?>
                            

                          </div>
                        </div>
                      </div>
                    <?php } ?>
                    <?php // modals ACTIONS containers END ?>

                    
                  </td>                
                </tr>
              <?php } ?>             
             

            </tbody>
          </table>
          <?php }

          //Если нет заказов в БД
          else { ?>

            <div class="row mr-2 ml-2 align-items-center justify-content-center">
              <div class="col-5">
                <h1 class="text-center"><i class="ni ni-bag-17 text-orange mr-2"></i><?php echo $i18n->t('PAGE_ORDERS_NO_ORDERS') ?></h1>
              </div>          
            </div>
          <?php } ?>

        </div>
        


        <?php //pagination ?>
        <?php if ($CountOrders>0) {
          echo $pagination;
        } ?>
        

        <?php //wrap_pre($orders, '$orders'); ?>

      </div>
    </div>
  </div>


</div> <?php //div.orders_wrap end  ?>



