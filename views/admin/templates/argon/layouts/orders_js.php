<?php defined('YV_LiteShop') or die ('Restricted Access!'); ?>

<?php 
$jsOrders = [];
if ($CountOrders) {
  foreach ($orders as $_order) { 
    $jsOrders[$_order['order_number']] = [
      'order_summ' => $_order['order_summ'], 
      'order_currency' => $_order['order_currency'], 
      'order_cart' => $_order['order_cart'],
      /*
      'order_shipping' => [
        'method' => $_order['order_shipping'],
        'price' =>[]
      ],
      'order_payment' => [
        'method' => $_order['order_payment'],
        'price' =>[]
      ],*/
      'modified_date' => $_order['modified_date']
    ];

    /*foreach ($_order['order_summ'] as $orCurr => $orSumm) {
      $jsOrders[$_order['order_number']]['order_shipping']['price'][$orCurr]['val'] = $orSumm['shipping_price'];

      $jsOrders[$_order['order_number']]['order_payment']['price'][$orCurr]['val'] = $orSumm['payment_price'];
    }*/


  }
}



?>

<script type="text/javascript"> 

  // ORDERS object
  var orders = <?php echo json_encode($jsOrders, JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) ?>;


  $(document).ready(function() {

      // является ли переменная обьектом.
      function isObject(obj) {
        return obj === Object(obj);
      }

      // ф-ция Округления 
      function round(value, decimals) {
        return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
      } 

      /*function isObject(val) {
        if (val === null) { return false;}
        return ( (typeof val === 'function') || (typeof val === 'object') );
      }*/


      /* Кол-во заказов на 1 страницу */
      $('#Select2_countOrdersPerPage').on('select2:select', function (e) {
          $('#countOrdersPerPage').submit();
      });
      /* Кол-во заказов на 1 страницу конец */

      //Раскрываем блок с фильтрами
      $('.filters_wrap h4').click(function(event) {
        $( ".filters_wrap .filters_content" ).slideToggle( "fast");
      });




      // Изменяем кол-во товаров в заказе
      var qtyChanged = false;
      $('.in_order_products .product-quantity .quantity_input').each(function(index, el) { 

        $(this).on('change', function(e) {
          
          qtyChanged = true;  

          // Основные параметры
          var quantity = parseInt($(this).val());
          if (isNaN(quantity)) { quantity = 1; }                  

          var order = $(this).attr('data-order');
          var prodId = $(this).attr('data-product-id');
          var prodGroupe = $(this).attr('data-product-groupe'); 
          var orderCurrency = $(this).attr('data-order-currency'); 
          var roundPrecision = 2;
          var qtyDiscount = 0;


          // HTML elements
          var HTMLprodItemPrice = $('#prod_item_price_pid'+prodId+'_order'+order+' > .val');
          var HTMLprodTotalPrice = $('#prod_total_pid'+prodId+'_order'+order+' > .val');
          var HTMLorderSumm = $('#order_summ_order'+order);
          var HTMLorderSupSumm = $('#SupSumm_order'+order+' > .val');

          var HTMLorderModifiedTime = $('#orderModifiedDate_'+order);
          // HTML elements order textareas
          var HTMLtxtAreaOrderCart = $('#txtAr_orderCart'+order);
          var HTMLtxtAreaOrderSupSumm = $('#txtAr_orderSupSumm_'+order);          
        

          
          orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['quantity'] = quantity;


          // Устанавливаем скидку в зависимости от кол-ва          
          if (isObject(orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['qty_price'])) {
            $.each(orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['qty_price'], function(i, qt) {
               if (quantity >= qt.start && quantity <= qt.end) {
                qtyDiscount = qt.discount;
                return false;
               }
            });
          }



          // Общая стоимость товара в заказе (c учетом 
          // кол-ва и обьемной скидки qtyDiscount ) 
          // ---------------------------------
          $.each(orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['item_price'], function(i, v) { 

              orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['item_price'][i]['val'] = parseFloat( round( ( parseFloat(v['1unit_price']) - (parseFloat(v['1unit_price'])*qtyDiscount) ) ,roundPrecision) );

              if (qtyDiscount > 0 ) {
                orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['item_price'][i]['old_price'] = v['1unit_price'];
              }

              var pSummInCurrency = quantity * orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['item_price'][i]['val']; 

             pSummInCurrency = round(pSummInCurrency,roundPrecision);

             orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['total_price'][i]['val'] = pSummInCurrency; 

          });
          // ---------------------------------



          // Сумма заказа 
          // --------------------------------
          //Формируем пустой обьект с суммой заказа           
          var orSumm = {};
          $.each(orders[order]['order_summ'], function(currency, subtotal) {
            orSumm = Object.assign(orSumm, { [currency] : { "val" : 0 } });
          });

          // Рассчитываем сумму всех товаров в корзине
          // и сохраняем ее в orSumm
          $.each(orders[order]['order_cart']['products'], function(pg, pgProds) {

            $.each(pgProds, function(pid) {
              $.each(pgProds[pid]['total_price'], function(curr, price) {

                 orSumm[curr]['val'] = parseFloat(orSumm[curr]['val'])  + parseFloat(price['val']);

              });  

            });

          });
          // --------------------------------


          // Модифицируем общую стоимость товаров в корзине
          // В глобальном обьекте orders
          // -------------------------------
          $.each(orders[order]['order_cart']['cart_subtotal'], function(currency, subtotal) {
            orders[order]['order_cart']['cart_subtotal'][currency]['val'] = round(orSumm[currency]['val'], roundPrecision);
          });
          // -------------------------------

          
          // Модифицируем общую стоимость заказа, в том числе 
          // стоим доставки и оплаты В глобальном обьекте orders
          // -------------------------------
          $.each(orders[order]['order_summ'], function(currency, subtotal) {
            orders[order]['order_summ'][currency]['val'] = round( parseFloat(orSumm[currency]['val'] + orders[order]['order_summ'][currency]['shipping_price'] + orders[order]['order_summ'][currency]['payment_price']), roundPrecision);
          });
          // -------------------------------




          //--------- changing values in HTML ------------         
          
          HTMLprodItemPrice.text( orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['item_price'][orderCurrency]['val'] );

          HTMLprodTotalPrice.text( orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['total_price'][orderCurrency]['val'] );

          HTMLorderSumm.text(orders[order]['order_cart']['cart_subtotal'][orderCurrency]['val']);

          HTMLorderSupSumm.text(orders[order]['order_summ'][orderCurrency]['val']);
          //
          HTMLtxtAreaOrderCart.text(JSON.stringify(orders[order]['order_cart']));
          HTMLtxtAreaOrderSupSumm.text(JSON.stringify(orders[order]['order_summ']));
          HTMLorderModifiedTime.val( Math.floor(Date.now() / 1000) );
          //-------- changing values in HTML ------------



          

          <?php /* ?>
          console.log('-----------------------------------------------' );
          console.log('change index: '+index+', quantity:'+quantity+', order : '+order+', prodId: '+prodId+', prodGroupe: '+prodGroupe); 
         
          //
          console.log('product: '+JSON.stringify(orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]) );   
          //      
          console.log('productItemPrice: '+JSON.stringify(orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['item_price']) );

          console.log('productTotalPrice: '+JSON.stringify(orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['total_price']) ); 

          console.log('productQtyPrice: '+JSON.stringify(orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['qty_price']) );
                
          console.log('quantity: '+JSON.stringify(orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['quantity']) );  

          console.log('qtyDiscount: '+qtyDiscount+', orProdItemPrice_txt: '+orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId]['item_price'][orderCurrency]['val'] );

           console.log('CartsSubtotal[order]: '+JSON.stringify(orders[order]['order_cart']['cart_subtotal']) ); 

          console.log('OrderSumm[order]: '+JSON.stringify(orders[order]['order_summ']) );
                  
          console.log('-----------------------------------------------' );
          <?php */ ?>         
                   

        });



        if (qtyChanged) { return false; }        

        
        
      });
      // *******************************    



      // Удаляем товар из заказа
      $('.in_order_products .prod_removeBtn').each(function(index, el) {

        $(this).on('click', function(e) {           

          var order = $(this).attr('data-order');
          var prodId = $(this).attr('data-product-id');
          var prodGroupe = $(this).attr('data-product-groupe'); 
          var orderCurrency = $(this).attr('data-order-currency'); 
          var roundPrecision = 2;


          var HTMLorderSumm = $('#order_summ_order'+order);
          var HTMLorderSupSumm = $('#SupSumm_order'+order+' > .val');

          var HTMLorderModifiedTime = $('#orderModifiedDate_'+order);
          // HTML elements order textareas
          var HTMLtxtAreaOrderCart = $('#txtAr_orderCart'+order);
          var HTMLtxtAreaOrderSupSumm = $('#txtAr_orderSupSumm_'+order);

          var HTMLprodCartRow = $('.in_order_products tr.orderCart_prow_pgroupe-'+prodGroupe+'_pid'+prodId);

          delete orders[order]['order_cart']['products'][prodGroupe]['pid_'+prodId];

          // Сумма заказа 
          // --------------------------------
          //Формируем пустой обьект с суммой заказа           
          var orSumm = {};
          $.each(orders[order]['order_summ'], function(currency, subtotal) {
            orSumm = Object.assign(orSumm, { [currency] : { "val" : 0 } });
          });

          // Рассчитываем сумму всех товаров в корзине
          // и сохраняем ее в orSumm
          $.each(orders[order]['order_cart']['products'], function(pg, pgProds) {

            $.each(pgProds, function(pid) {
              $.each(pgProds[pid]['total_price'], function(curr, price) {

                 orSumm[curr]['val'] = parseFloat(orSumm[curr]['val'])  + parseFloat(price['val']);

              });  

            });


          });
          // --------------------------------

          // Модифицируем общую стоимость товаров в корзине
          // В глобальном обьекте orders
          // -------------------------------
          $.each(orders[order]['order_cart']['cart_subtotal'], function(currency, subtotal) {
            orders[order]['order_cart']['cart_subtotal'][currency]['val'] = round(orSumm[currency]['val'], roundPrecision);
          });
          // -------------------------------

          
          // Модифицируем общую стоимость заказа, в том числе 
          // стоим доставки и оплаты В глобальном обьекте orders
          // -------------------------------
          $.each(orders[order]['order_summ'], function(currency, subtotal) {
            orders[order]['order_summ'][currency]['val'] = round( parseFloat(orSumm[currency]['val'] + orders[order]['order_summ'][currency]['shipping_price'] + orders[order]['order_summ'][currency]['payment_price']), roundPrecision);
          });
          // -------------------------------

          HTMLprodCartRow.remove();

          HTMLorderSumm.text(orders[order]['order_cart']['cart_subtotal'][orderCurrency]['val']);

          HTMLorderSupSumm.text(orders[order]['order_summ'][orderCurrency]['val']);


          //
          HTMLtxtAreaOrderCart.text(JSON.stringify(orders[order]['order_cart']));
          HTMLtxtAreaOrderSupSumm.text(JSON.stringify(orders[order]['order_summ']));
          HTMLorderModifiedTime.val( Math.floor(Date.now() / 1000) );
          

          console.log(' order : '+order+', prodId: '+prodId+', prodGroupe: '+prodGroupe + ', orderCurrency: '+orderCurrency); 

          console.log(' orSumm : '+ JSON.stringify(orSumm)); 
          console.log(' order_summ : '+ JSON.stringify(orders[order]['order_summ'])); 


        });

      });


      






    });

</script>