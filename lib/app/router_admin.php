<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

// НАЧИНАЕМ ОБРАБОТКУ $_GET и утсновку layout

// доступные страницы для админ панели &page=
$valid_pages_admin = $this->getValidPages('admin');


// доступные разделы ?section=
$valid_sections = ['admin-panel'];

if (isset($_GET) && count($_GET)) {

	if (isset($_GET['section']) && in_array($_GET['section'], $valid_sections) ) {


		if (count($_GET) == 1) {

			$renderData['template_content']['topnav_page_title'] = $this->i18n->t('MLT_HOMEPAGE');
			$renderData['meta_title'] = $this->i18n->t('PT_ADMIN_HOMEPAGE');
			$renderData['main_menu']['homepage']['is_active'] = true;

			$this->render('homepage',$renderData,'admin');


		} else {			
			$urlQuery = parseUrlQuery( get_actual_url() );

			//wrap_pre($urlQuery,'$urlQuery','y');


			if ($urlQuery['positions']['section'] === 1 && $urlQuery['query']['other']['count'] === 0 && in_array($urlQuery['query']['section'], $valid_sections) ) {

				if (isset($urlQuery['query']['page']) && in_array($urlQuery['query']['page'], $valid_pages_admin) && $urlQuery['positions']['page'] === 2 ) {

					switch ($urlQuery['query']['page']) {

						//orders
						case 'orders':

							$renderData['template_content']['topnav_page_title'] = $this->i18n->t('MLT_ORDERS');
							$renderData['meta_title'] = $this->i18n->t('PT_ADMIN_ORDERS');
							$renderData['main_menu']['orders']['is_active'] = true;
							$renderData['template_content']['assets_css'] = ['cart.css'];

							// orders			
							$orPageNum = (isset($urlQuery['query']['page_num']) && (int)$urlQuery['query']['page_num'] > 0 ) ? $urlQuery['query']['page_num'] : 1;

							$orRecordsPerPage = $this->getRecordsPerPage('admin','orders');

							$orFilters = $this->getFilters('admin','orders');							

							$t_ipp = 2;

							$renderData['template_content']['orders'] = $this->main_model_admin->getOrders( $orPageNum, /*$t_ipp*/$orRecordsPerPage, $orFilters );

							$renderData['template_content']['CountOrders'] = $this->main_model_admin->getCountOrders($orFilters);

							//orders actions
							$renderData['template_content']['OrderActions'] = [
								'change_order_status'=>[									
									'name'=>$this->i18n->t('ORDER_ACTION_CHANGE_STATUSES'),
									'icon' =>''
								],
								'delete_order'=>[									
									'name'=>$this->i18n->t('ORDER_ACTION_DELETE'),
									'icon' =>''
								]
							];
							$renderData['template_content']['orderStatuses']	= $this->config->order_statuses;	
							$renderData['template_content']['orderPaymentStatuses']	= $this->config->order_payment_statuses;	
							$renderData['template_content']['shippingMethods']	= $this->get_shipping_methods();	
							$renderData['template_content']['paymentMethods']	= $this->get_payment_methods();
							$renderData['template_content']['orderFilters']	= $orFilters;


							// Records PER page list Start
							$recPerPageList = [];
							foreach ($this->config->records_per_page as $rnum => $rval) {
								foreach ($this->configAdmin->admin_available_lang as $lang => $langData) {
									$recPerPageList[$rnum]['name'][$lang] = (is_string($rval) && $rval == 'all') ? $this->i18n->t('REC_PER_PAGE_ALL') : $rval;
								}								
							}
							$renderData['template_content']['recordsPerPage']	= [
								'list'=>$recPerPageList,
								'selected' => $orRecordsPerPage
							];	
							// Records PER page list End


							//pagination
							$renderData['template_content']['pagination'] = $this->pagination(
								[
									'items_per_page' => /*$t_ipp */$orRecordsPerPage, //++
									'baseUri' => URI_BASE,
									'total_items' => $renderData['template_content']['CountOrders'],
									'page' => (isset($urlQuery['query']['page_num']) && (int)$urlQuery['query']['page_num'] > 0 ) ? $urlQuery['query']['page_num'] : 1, // ++
									'extraLinks' => [
										'section'=>'admin-panel',
										'page'=>'orders'
									]

								]
							);	

							$this->render('orders',$renderData,'admin');
							break;

						//call-me
						case 'call-me':

							$renderData['template_content']['topnav_page_title'] = $this->i18n->t('MLT_CALL_ME');
							$renderData['meta_title'] = $this->i18n->t('PT_ADMIN_CALL_ME');
							$renderData['main_menu']['call-me']['is_active'] = true;
							$renderData['template_content']['calls'] = $this->main_model_admin->getCalls();
							$renderData['template_content']['CountCalls'] = $this->main_model_admin->getCountCalls();

							$this->render('call-me',$renderData,'admin');							
							break;

						//docs
						case 'docs':

							$renderData['template_content']['topnav_page_title'] = $this->i18n->t('DLT_DOCUMENTATION');
							$renderData['meta_title'] = $this->i18n->t('PT_ADMIN_DOCS');
							$renderData['document_menu']['docs']['is_active'] = true;

							$this->render('docs',$renderData,'admin');							
							break;

						// 404
						case '404':

							$renderData['template_content']['topnav_page_title'] = $this->i18n->t('MLT_404');
							$renderData['meta_title'] = $this->i18n->t('PT_ADMIN_404');

							$this->render('404',$renderData,'admin');															
							break;

						//homepage
						case 'homepage':
							$this->redirect(build_admin_link(['type'=>'homepage']));
							break;					
					} // end switch

				} // end if (isset($urlQuery['query']['page'])




			} else {
				$this->redirect(build_admin_link(['type'=>'404']));
			}


		} //end if (count(_GET)==1)



			
		
	} // end if isset($_GET['section'])
	else {
		$this->redirect(build_admin_link(['type'=>'404']));
	}



}
 ?>