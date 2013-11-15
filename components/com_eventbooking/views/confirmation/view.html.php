<?php
/**
 * @version		1.4.4
 * @package		Joomla
 * @subpackage	Event Booking
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2010 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */
// no direct access
defined( '_JEXEC' ) or die ;

jimport( 'joomla.application.component.view');
/**
 * HTML View class for the Event Booking component
 *
 * @static
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.0
 */
class EventBookingViewConfirmation extends JView
{
	/**
	 * Display confirmation page to user
	 *
	 * @param string $tpl
	 */
	function display($tpl = null)
	{	
		if ($this->getLayout() == 'cart') {
			$this->_displayCheckoutConfirmation($tpl) ;
			return ;
		}
		$db = & JFactory::getDBO() ;		
		$document = & JFactory::getDocument() ;		
		$eventId = JRequest::getInt('event_id', 0) ;
		if (!$eventId) {
			$menus = & JSite::getMenu();
			$menu = $menus->getActive();
			if (is_object($menu)) {
				$params = new JParameter($menu->params) ;
				$eventId = (int)$params->get('event_id', 0) ;
			}
		}
		if (!EventBookingHelper::acceptRegistration($eventId)) {
			$mainframe = & JFactory::getApplication() ;
			$Itemid = JRequest::getInt('Itemid');
			$url = JRoute::_('index.php?option=com_eventbooking&Itemid='.$eventId.'&Itemid='.$Itemid, false) ;
			$mainframe->redirect($url, JText::_('EB_ERROR_REGISTRATION'));					
		}
		JRequest::setVar('event_id', $eventId) ;
		$sql = 'SELECT title FROM #__eb_events WHERE id='.$eventId ;
		$db->setQuery($sql) ;
		$eventTitle = $db->loadResult();		
		$pageTitle = JText::_('EB_EVENT_REGISTRATION') ;
		$pageTitle = str_replace('[EVENT_TITLE]', $eventTitle, $pageTitle) ;
		$document->setTitle($pageTitle);
						
		$layout = $this->getLayout();
		if ($layout == 'group') {
			$this->_displayGroupConfirmation($tpl);			
		} else {
			$this->_displayIndividualConfirmation($tpl);		
		}
	}
	/**
	 * Confirmation page for individual registration
	 *
	 * @param $tpl template
	 */
	function _displayIndividualConfirmation($tpl) {		
		$Itemid = JRequest::getInt('Itemid');
		$db = & JFactory::getDBO() ;		
		//First user information
		$config = EventBookingHelper::getConfig() ;		
		$firstName = JRequest::getVar('first_name', '', 'post') ;
		$lastName = JRequest::getVar('last_name', '', 'post') ;
		$organization  = JRequest::getVar('organization', '', 'post') ;
		$address =  JRequest::getVar('address', '', 'post') ;
		$address2 = JRequest::getVar('address2', '', 'post') ;
		$city = JRequest::getVar('city', '', 'post') ;
		$state = JRequest::getVar('state', '', 'post') ;
		$zip = JRequest::getVar('zip', '', 'post') ;
		$phone =  JRequest::getVar('phone', '', 'post') ;
		$fax = JRequest::getVar('fax', '', 'post') ;
		$email = JRequest::getVar('email', '', 'post') ;
		$country = JRequest::getVar('country', '') ;
		$comment = JRequest::setVar('comment', '') ;
		$paymentMethod =  JRequest::getVar('payment_method', os_payments::getDefautPaymentMethod()) ;
		$x_card_num = JRequest::getVar('x_card_num', '', 'post');
		$expMonth =  JRequest::getVar('exp_month', date('m'), 'post') ;				
		$expYear = JRequest::getVar('exp_year', date('Y'), 'post') ;		
		$x_card_code = JRequest::getVar('x_card_code', '', 'post');
		$cardHolderName = JRequest::getVar('card_holder_name', '', 'post') ;
		$cardType =  JRequest::getVar('card_type', '') ;
		
		$username = JRequest::getVar('username', '', 'post');
		$password = JRequest::getVar('password', '', 'post');
				
		$eventId = JRequest::getInt('event_id', 0) ;
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId;
		$db->setQuery($sql) ;
		$event = $db->loadObject();					
		$feeAmount = JCFields::calculateFee($eventId, 0) ;
		$totalAmount = $event->individual_price +  $feeAmount ;
										
		$params = new JParameter($event->params) ;
		$keys = array('s_lastname', 'r_lastname', 's_organization', 'r_organization', 's_address', 'r_address', 's_address2', 'r_address2', 's_city', 'r_city', 's_state', 'r_state', 's_zip', 'r_zip', 's_country', 'r_country', 's_phone', 'r_phone', 's_fax', 'r_fax', 's_comment', 'r_comment');
		foreach ($keys as $key) {
			$config->$key = $params->get($key, 0) ;
		}						
		//Get discount
		$discount = 0 ;
		$user = & JFactory::getUser() ;
		if ($user->get('id')) {						
			if ($event->discount > 0) {
				if ($event->discount_type == 1) {
					$discount = $totalAmount*$event->discount/100 ;						
				} else {
					$discount = $event->discount ;
				}
			} 
		}
		if (isset($_SESSION['coupon_id'])) {
			$sql = 'SELECT * FROM #__eb_coupons WHERE id='.(int)$_SESSION['coupon_id'];
			$db->setQuery($sql) ;
			$coupon = $db->loadObject();
			if ($coupon) {
				if ($coupon->coupon_type == 0) {
					$discount = $discount + $totalAmount*$coupon->discount/100 ; 
				} else {
					$discount = $discount + $coupon->discount ;
				}
			}
		}				
		//Early bird discount
		$sql = 'SELECT COUNT(id) FROM #__eb_events WHERE id='.$eventId.' AND DATEDIFF(early_bird_discount_date, NOW()) >= 0';
		$db->setQuery($sql);				
		$total = $db->loadResult();			
		if ($total) {
			$earlyBirdDiscountAmount =  $event->early_bird_discount_amount ;
			if ($earlyBirdDiscountAmount > 0) {
				if ($event->early_bird_discount_type == 1) {
					$discount = $discount + $totalAmount*$event->early_bird_discount_amount/100 ;						
				} else {
					$discount = $discount + $event->early_bird_discount_amount ;
				}
			}
		}						
		if ($discount > $totalAmount)
			$discount = $totalAmount ;
		$amount = $totalAmount - $discount ;

	    #Tax, added from 1.4.3	    
		if ($config->enable_tax && ($amount > 0)) {
		    $taxAmount = round($amount*$config->tax_rate/100, 2) ;
		} else {
		    $taxAmount = 0 ;
		}				
		//Custom fields
		$jcFields = new JCFields($eventId, false, 0) ;
		if ($jcFields->getTotal()) {
			$customField = true ;
			$fields = $jcFields->renderConfirmation() ;
			$hidden = $jcFields->renderHiddenFields() ;
			$this->assignRef('fields', $fields) ;
			$this->assignRef('hidden', $hidden) ;
		} else {
			$customField = false ;
		}
		$url = EventBookingHelper::getURL();				
		if ($config->use_https) {
			$url = str_replace('http:', 'https:', $url) ;				
		}
		$method = os_payments::getPaymentMethod($paymentMethod) ;		
		$bankId = JRequest::getVar('bank_id');		
		if (($config->enable_captcha == 3) || (($config->enable_captcha == 2) && ($event->individual_price > 0)) || (($config->enable_captcha == 1) && ($event->individual_price == 0))) {
			$showCaptcha = 1 ;
		} else {
			$showCaptcha = 0 ;
		}		
		$captchaInvalid = JRequest::getInt('captcha_invalid', 0);		
		$couponCode = JRequest::getVar('coupon_code', '');

		#Added support for deposit payment
	    $paymentType = JRequest::getInt('payment_type', 0) ;				
		if ($config->activate_deposit_feature && $event->deposit_amount > 0 && $paymentType == 1) {
			if ($event->deposit_type == 2) {
				$depositAmount = $event->deposit_amount ;		
			} else {
				$depositAmount = $event->deposit_amount*($totalAmount-$discount + $taxAmount)/100 ;
			}
		} else {
			$depositAmount = 0 ; 
		}							
		$this->assignRef('config', $config) ;						
		$this->assignRef('firstName', $firstName);
		$this->assignRef('lastName', $lastName);
		$this->assignRef('organization', $organization);
		$this->assignRef('address', $address);
		$this->assignRef('address2', $address2);
		$this->assignRef('city', $city);
		$this->assignRef('state', $state);
		$this->assignRef('zip', $zip);		
		$this->assignRef('phone', $phone);
		$this->assignRef('fax', $fax);
		$this->assignRef('country', $country) ;
		$this->assignRef('email', $email);
		$this->assignRef('comment', $comment);
		$this->assignRef('paymentMethod', $paymentMethod);
		$this->assignRef('x_card_num', $x_card_num) ;
		$this->assignRef('x_card_code', $x_card_code) ;		
		$this->assignRef('cardHolderName', $cardHolderName) ;
		$this->assignRef('expMonth', $expMonth) ;
		$this->assignRef('expYear', $expYear) ;												
		$this->assignRef('event', $event) ;	
		$this->assignRef('totalAmount', $totalAmount) ;
		$this->assignRef('feeAmount', $feeAmount) ;
		$this->assignRef('customField', $customField) ;	
		$this->assignRef('Itemid', $Itemid) ;
		$this->assignRef('url', $url) ;
		$this->assignRef('method', $method) ;		
		$this->assignRef('cardType', $cardType) ;
		$this->assignRef('discount', $discount) ;
		$this->assignRef('amount', $amount) ;
		$this->assignRef('username', $username) ;
		$this->assignRef('password', $password) ;
		$this->assignRef('couponCode', $couponCode) ;
		$this->assignRef('bankId', $bankId) ;
		$this->assignRef('showCaptcha', $showCaptcha) ;
		$this->assignRef('captchaInvalid', $captchaInvalid) ;
		$this->assignRef('paymentType', $paymentType) ;
		$this->assignRef('depositAmount', $depositAmount) ;
		$this->assignRef('taxAmount', $taxAmount) ;
		parent::display($tpl) ;
	}
	/**
	 * Display confirmation page for group registration	 
	 *
	 * @param string $tpl
	 */
	function _displayGroupConfirmation($tpl) {
		$Itemid = JRequest::getInt('Itemid');
		$db = & JFactory::getDBO() ;
		$eventId = JRequest::getInt('event_id', 0) ;
		$groupId = JRequest::getInt('group_id', 0) ;		
		$config = EventBookingHelper::getConfig() ;		
		$firstName = JRequest::getVar('first_name', '', 'post') ;
		$lastName = JRequest::getVar('last_name', '', 'post') ;
		$organization  = JRequest::getVar('organization', '', 'post') ;
		$address =  JRequest::getVar('address', '', 'post') ;
		$address2 = JRequest::getVar('address2', '', 'post') ;
		$city = JRequest::getVar('city', '', 'post') ;
		$state = JRequest::getVar('state', '', 'post') ;
		$zip = JRequest::getVar('zip', '', 'post') ;
		$phone =  JRequest::getVar('phone', '', 'post') ;
		$fax = JRequest::getVar('fax', '', 'post') ;
		$email = JRequest::getVar('email', '', 'post') ;
		$country = JRequest::getVar('country', '') ;
		$comment = JRequest::setVar('comment', '') ;
		$paymentMethod =  JRequest::getVar('payment_method', os_payments::getDefautPaymentMethod()) ;
		$x_card_num = JRequest::getVar('x_card_num', '', 'post');
		$expMonth =  JRequest::getVar('exp_month', date('m'), 'post') ;				
		$expYear = JRequest::getVar('exp_year', date('Y'), 'post') ;		
		$x_card_code = JRequest::getVar('x_card_code', '', 'post');
		$cardHolderName = JRequest::getVar('card_holder_name', '', 'post') ;
		$cardType =  JRequest::getVar('card_type', '') ;
		
		$username = JRequest::getVar('username', '', 'post');
		$password = JRequest::getVar('password', '', 'post');
		
		$sql = 'SELECT COUNT(*) FROM #__eb_registrants WHERE group_id='.$groupId;		
		$db->setQuery($sql) ;		
		$numberRegistrants = $db->loadResult();									
		$url = EventBookingHelper::getURL();		
		$sql = 'SELECT * FROM #__eb_registrants WHERE group_id='.$groupId ;
		$db->setQuery($sql) ;
		$rowMembers = $db->loadObjectList();		
		//Override the configuration		
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId ;
		$db->setQuery($sql) ;		
		$event = $db->loadObject();
		$params = new JParameter($event->params) ;
		$keys = array('s_lastname', 'r_lastname', 's_organization', 'r_organization', 's_address', 'r_address', 's_address2', 'r_address2', 's_city', 'r_city', 's_state', 'r_state', 's_zip', 'r_zip', 's_country', 'r_country', 's_phone', 'r_phone', 's_fax', 'r_fax', 's_comment', 'r_comment');				
		foreach ($keys as $key) {
			$config->$key = $params->get($key, 0) ;
		}		
		$keys = array('gr_lastname', 'gr_lastname', 'gs_organization', 'gr_organization', 'gs_address', 'gr_address', 'gs_address2', 'gr_address2', 'gs_city', 'gr_city', 'gs_state', 'gr_state', 'gs_zip', 'gr_zip', 'gs_country', 'gr_country', 'gs_phone', 'gr_phone', 'gs_fax', 'gr_fax', 'gs_email', 'gr_email', 'gs_comment', 'gr_comment');
		foreach ($keys as $key) {
			$config->$key = $params->get($key, 0) ;
		}		
		//Custom fields
		$jcFields =  new JCFields($eventId, true, 1) ;
		if ($jcFields->getTotal()) {
			$customFields = true ;
			$fields = $jcFields->renderConfirmation() ;
			$hidden = $jcFields->renderHiddenFields() ;
			$this->assignRef('fields', $fields) ;
			$this->assignRef('hidden', $hidden) ;
		} else {
			$customFields = false ;
		}		
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId ;
		$db->setQuery($sql) ;
		$event = $db->loadObject();
		
		//Store member total amount and discount		
		
		
		$rate = EventBookingHelper::getRegistrationRate($eventId, $numberRegistrants) ;
		$feeFields = new JCFields($eventId, false, 2) ;
		$extraFee = $feeFields->canculateGroupFee($groupId) + JCFields::calculateFee($eventId, 1) ;					
		$totalAmount = $rate*$numberRegistrants + $extraFee ;
		
		if ($config->collect_member_information) {
			$memberIds = array() ;
			$memberDiscounts = array() ;			
			$memberTotals = array() ;

			for ($i = 0 , $n = count($rowMembers) ; $i < $n ; $i++) {
				$memberId = $rowMembers[$i]->id ;
				$memberIds[] = $memberId ;
				$memberTotals[] = $rate + JCFields::getMemberFee($memberId, $eventId);
				$memberDiscounts[] = 0 ;
			}			
		}		
		//Get discount
		$discount = 0 ;
		$user = & JFactory::getUser() ;
		if ($user->get('id')) {			
			if ($event->discount > 0) {
				if ($event->discount_type == 1) {
					$discount = $totalAmount*$event->discount/100 ;
					if ($config->collect_member_information) {
						for ($i = 0 , $n = count($memberTotals) ; $i < $n ; $i++) {
							$memberDiscounts[$i] += $memberTotals[$i]*$event->discount/100 ;
						}
					}						
				} else {
					$discount = $numberRegistrants*$event->discount ;					
					if ($config->collect_member_information) {
						for ($i = 0 , $n = count($memberTotals) ; $i < $n ; $i++) {
							$memberDiscounts[$i] += $event->discount ;
						}
					}					
				}
			} 
		}							
		if (isset($_SESSION['coupon_id'])) {
			$sql = 'SELECT * FROM #__eb_coupons WHERE id='.(int)$_SESSION['coupon_id'];
			$db->setQuery($sql) ;
			$coupon = $db->loadObject();
			if ($coupon) {
				if ($coupon->coupon_type == 0) {
					$discount = $discount + $totalAmount*$coupon->discount/100 ;
					if ($config->collect_member_information) {
						for ($i = 0 , $n = count($memberTotals) ; $i < $n ; $i++) {
							$memberDiscounts[$i] += $memberTotals[$i]*$coupon->discount/100 ;
						}
					} 
				} else {
					if ($config->collect_member_information) {
						for ($i = 0 , $n = count($memberTotals) ; $i < $n ; $i++) {
							$memberDiscounts[$i] += $coupon->discount ;
						}
					}					
					$discount = $discount + $numberRegistrants*$coupon->discount ;
				}
			}
		}								
		//Early bird discount
		$sql = 'SELECT COUNT(id) FROM #__eb_events WHERE id='.$eventId.' AND DATEDIFF(early_bird_discount_date, NOW()) >= 0';
		$db->setQuery($sql);
		$total = $db->loadResult();
		if ($total) {
			$earlyBirdDiscountAmount =  $event->early_bird_discount_amount ;
			if ($earlyBirdDiscountAmount > 0) {
				if ($event->early_bird_discount_type == 1) {					
					$discount = $discount + $totalAmount*$event->early_bird_discount_amount/100 ;					
					if ($config->collect_member_information) {
						for ($i = 0 , $n = count($memberTotals) ; $i < $n ; $i++) {
							$memberDiscounts[$i] += $memberTotals[$i]*$event->early_bird_discount_amount/100 ;
						}
					}										
				} else {					
					$discount = $discount + $numberRegistrants*$event->early_bird_discount_amount ;
					if ($config->collect_member_information) {
						for ($i = 0 , $n = count($memberTotals) ; $i < $n ; $i++) {
							$memberDiscounts[$i] += $event->early_bird_discount_amount ;
						}
					}
				}
			}
		}				
		if ($discount > $totalAmount)
			$discount = $totalAmount ;
		$amount = $totalAmount - $discount ;	

		#Tax, added from 1.4.3
		if ($config->enable_tax && ($amount > 0)) {
		    $taxAmount = round($amount*$config->tax_rate/100, 2) ;
		} else {
		    $taxAmount = 0 ;
		}
				
		$method = os_payments::getPaymentMethod($paymentMethod) ;	
		$couponCode =  JRequest::getVar('coupon_code', '');			
		$bankId = JRequest::getVar('bank_id');						
		if (($config->enable_captcha == 3) || (($config->enable_captcha == 2) && ($event->individual_price > 0)) || (($config->enable_captcha == 1) && ($event->individual_price == 0))) {
			$showCaptcha = 1 ;
		} else {
			$showCaptcha = 0 ;
		}		
		$captchaInvalid = JRequest::getInt('captcha_invalid', 0);						
	    #Added support for deposit payment
	    $paymentType = JRequest::getInt('payment_type', 0) ;	    			
		if ($config->activate_deposit_feature && $event->deposit_amount > 0 && $paymentType == 1) {
			if ($event->deposit_type == 2) {
				$depositAmount = $numberRegistrants*$event->deposit_amount ;		
			} else {			    			   
				$depositAmount = $event->deposit_amount*($totalAmount-$discount+$taxAmount)/100 ;
			}
		} else {
			$depositAmount = 0 ; 
		}
				
		//Store member information in group registration first
		if ($config->collect_member_information) {
			for ($i = 0 , $n = count($memberIds) ; $i < $n ; $i++) {
				$memberId = $memberIds[$i] ;
				$memberTotal = $memberTotals[$i] ;
				$memberDiscount = $memberDiscounts[$i] ;
				$memberAmount = $memberTotal - $memberDiscount ;

				$sql = "UPDATE #__eb_registrants SET total_amount='$memberTotal', discount_amount='$memberDiscount', amount='$memberAmount', number_registrants=1 WHERE id='$memberId'";
				$db->setQuery($sql);
				$db->query();
			}	
		}

		
		//Basic member registrations		
		$this->assignRef('config', $config) ;					
		$this->assignRef('firstName', $firstName);
		$this->assignRef('lastName', $lastName);
		$this->assignRef('organization', $organization);
		$this->assignRef('address', $address);
		$this->assignRef('address2', $address2);
		$this->assignRef('city', $city);
		$this->assignRef('state', $state);
		$this->assignRef('zip', $zip);		
		$this->assignRef('phone', $phone);
		$this->assignRef('fax', $fax);
		$this->assignRef('country', $country) ;
		$this->assignRef('email', $email);
		$this->assignRef('comment', $comment);
		$this->assignRef('paymentMethod', $paymentMethod);
		$this->assignRef('x_card_num', $x_card_num) ;
		$this->assignRef('x_card_code', $x_card_code) ;		
		$this->assignRef('cardHolderName', $cardHolderName) ;
		$this->assignRef('expMonth', $expMonth) ;
		$this->assignRef('expYear', $expYear) ;		
		$this->assignRef('numberRegistrants', $numberRegistrants) ;
		$this->assignRef('rowMembers', $rowMembers) ;				
		$this->assignRef('groupId', $groupId) ;						
		$this->assignRef('url', $url) ;				
		$this->assignRef('Itemid', $Itemid) ;
		$this->assignRef('customFields', $customFields) ;
		$this->assignRef('totalAmount', $totalAmount) ;
		$this->assignRef('amount', $amount) ;		
		$this->assignRef('event', $event) ;
		$this->assignRef('extraFee', $extraFee) ;		
		$this->assignRef('method', $method) ;
		$this->assignRef('cardType', $cardType) ;
		$this->assignRef('discount', $discount) ;	
		$this->assignRef('amount', $amount) ;	
		$this->assignRef('username', $username) ;
		$this->assignRef('password', $password) ;
		$this->assignRef('couponCode', $couponCode) ;
		$this->assignRef('bankId', $bankId) ;
		$this->assignRef('showCaptcha', $showCaptcha) ;
		$this->assignRef('captchaInvalid', $captchaInvalid) ;
		$this->assignRef('paymentType', $paymentType) ;
		$this->assignRef('depositAmount', $depositAmount) ;	
		$this->assignRef('taxAmount', $taxAmount) ;	
		parent::display($tpl) ;		
	}
	/**
	 * Display checkout confirmation	 
	 * @param string $tpl
	 */		
	function _displayCheckoutConfirmation($tpl) {
	    $Itemid = JRequest::getInt('Itemid');
		$db = & JFactory::getDBO() ;		
		//First user information
		$config = EventBookingHelper::getConfig() ;		
		$firstName = JRequest::getVar('first_name', '', 'post') ;
		$lastName = JRequest::getVar('last_name', '', 'post') ;
		$organization  = JRequest::getVar('organization', '', 'post') ;
		$address =  JRequest::getVar('address', '', 'post') ;
		$address2 = JRequest::getVar('address2', '', 'post') ;
		$city = JRequest::getVar('city', '', 'post') ;
		$state = JRequest::getVar('state', '', 'post') ;
		$zip = JRequest::getVar('zip', '', 'post') ;
		$phone =  JRequest::getVar('phone', '', 'post') ;
		$fax = JRequest::getVar('fax', '', 'post') ;
		$email = JRequest::getVar('email', '', 'post') ;
		$country = JRequest::getVar('country', '') ;
		$comment = JRequest::setVar('comment', '') ;
		$paymentMethod =  JRequest::getVar('payment_method', os_payments::getDefautPaymentMethod()) ;
		$x_card_num = JRequest::getVar('x_card_num', '', 'post');
		$expMonth =  JRequest::getVar('exp_month', date('m'), 'post') ;				
		$expYear = JRequest::getVar('exp_year', date('Y'), 'post') ;		
		$x_card_code = JRequest::getVar('x_card_code', '', 'post');
		$cardHolderName = JRequest::getVar('card_holder_name', '', 'post') ;
		$cardType =  JRequest::getVar('card_type', '') ;	
		$username = JRequest::getVar('username', '', 'post');
		$password = JRequest::getVar('password', '', 'post');																														
		//Get discount
		$discount = 0 ;
		$user = & JFactory::getUser() ;		
		require_once JPATH_COMPONENT.DS.'helper'.DS.'os_cart.php';		
		$cart = new EBCart() ;		
		$items = $cart->getItems();
		$feeAmount = JCFields::calculateCartFee($items) ;
		$rowEvents = $cart->getEvents();			
		$totalAmount = $cart->calculateTotal() + $feeAmount ;								
		$discount = $cart->calculateTotalDiscount() ;																								
		if ($discount > $totalAmount)
			$discount = $totalAmount ;
		$amount = $totalAmount - $discount ;
		if ($config->enable_tax && $config->tax_rate > 0) {
		    $taxAmount = round($amount*$config->tax_rate/100, 2) ;
		} else {
		    $taxAmount = 0 ;
		}			
		$customField = false ;
		$url = EventBookingHelper::getURL();
		$method = os_payments::getPaymentMethod($paymentMethod) ;		
		$bankId = JRequest::getVar('bank_id');
		if ($config->enable_captcha != 0) {
			$showCaptcha = 1 ;
		} else {
			$showCaptcha = 0 ;
		}
		$captchaInvalid = JRequest::getInt('captcha_invalid', 0);
		$couponCode = JRequest::getVar('coupon_code', '');				
		$sql = 'SELECT title FROM #__eb_events WHERE id IN ('.implode(',', $items).') ORDER BY FIND_IN_SET(id, "'.implode(',', $items).'")';
		$db->setQuery($sql) ;
		$eventTitles = $db->loadResultArray() ;
		$eventTitle = implode(', ', $eventTitles);		
				
		//Support custom fields for multiple booking
		$jcFields = new JCFields(0, false, 4) ;
		if ($jcFields->getTotal()) {
			$customField = true ;
			$fields = $jcFields->renderConfirmation() ;
			$hidden = $jcFields->renderHiddenFields() ;
			$this->assignRef('fields', $fields) ;
			$this->assignRef('hidden', $hidden) ;
		} else {
			$customField = false ;
		}
			    								
		$this->assignRef('config', $config) ;						
		$this->assignRef('firstName', $firstName);
		$this->assignRef('lastName', $lastName);
		$this->assignRef('organization', $organization);
		$this->assignRef('address', $address);
		$this->assignRef('address2', $address2);
		$this->assignRef('city', $city);
		$this->assignRef('state', $state);
		$this->assignRef('zip', $zip);		
		$this->assignRef('phone', $phone);
		$this->assignRef('fax', $fax);
		$this->assignRef('country', $country) ;
		$this->assignRef('email', $email);
		$this->assignRef('comment', $comment);
		$this->assignRef('paymentMethod', $paymentMethod);
		$this->assignRef('x_card_num', $x_card_num) ;
		$this->assignRef('x_card_code', $x_card_code) ;		
		$this->assignRef('cardHolderName', $cardHolderName) ;
		$this->assignRef('expMonth', $expMonth) ;
		$this->assignRef('expYear', $expYear) ;														
		$this->assignRef('totalAmount', $totalAmount) ;		
		$this->assignRef('customField', $customField) ;	
		$this->assignRef('Itemid', $Itemid) ;
		$this->assignRef('url', $url) ;
		$this->assignRef('method', $method) ;		
		$this->assignRef('cardType', $cardType) ;
		$this->assignRef('discount', $discount) ;
		$this->assignRef('amount', $amount) ;
		$this->assignRef('username', $username) ;
		$this->assignRef('password', $password) ;
		$this->assignRef('couponCode', $couponCode) ;
		$this->assignRef('bankId', $bankId) ;
		$this->assignRef('items', $rowEvents) ;
		$this->assignRef('showCaptcha', $showCaptcha) ;
		$this->assignRef('captchaInvalid', $captchaInvalid) ;
		$this->assignRef('eventTitle', $eventTitle) ;
		$this->assignRef('customField', $customField) ;		
		$this->assignRef('feeAmount', $feeAmount) ;	
		$this->assignRef('taxAmount', $taxAmount) ;
		parent::display($tpl) ;
	}	
}