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

jimport('joomla.application.component.model');
/**
 * Event Booking Component Cart Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelCart extends JModel
{					
	/**
	 * Constructor function
	 *
	 */
	function __construct() {
		parent::__construct();			
	}
	/**
	 * Add one or multiple events to cart	 
	 * @param string
	 */
	function processAddToCart($data) {
		require_once JPATH_COMPONENT.DS.'helper'.DS.'os_cart.php';
		if (is_array($data['id'])) {
			$eventIds = $data['id'] ;
		} else {
			$eventIds = array($data['id']) ;
		}
		$cart = new EBCart() ;
		$cart->addEvents($eventIds) ;
		return true ;
	}
	/**
	 * Update cart with new quantities	 
	 * @param array $eventIds
	 * @param array $quantities
	 */
	function processUpdateCart($eventIds, $quantities) {
		require_once JPATH_COMPONENT.DS.'helper'.DS.'os_cart.php';
		$cart = new EBCart() ;
		$cart->updateCart($eventIds, $quantities) ;
		return true ;				
	}
	/**
	 * Remove an event from cart
	 * Enter description here ...
	 * @param int $id
	 */
	function removeEvent($id) {
		require_once JPATH_COMPONENT.DS.'helper'.DS.'os_cart.php';
		$cart = new EBCart() ;
		$cart->remove($id) ;
		return true ;	
	}
	/**
	 * Process checkout in case customer using shopping cart feature	 
	 * @param array $data
	 */		
	function processCheckout(&$data) {		
		require_once JPATH_COMPONENT.DS.'helper'.DS.'os_cart.php' ;
		$mainframe = & JFactory::getApplication() ;
		$Itemid = JRequest::getInt('Itemid');		
		jimport('joomla.user.helper');
		$db = & JFactory::getDBO() ;
		$nullDate = $db->getNullDate() ;
		$user = & JFactory::getUser() ;
		$config = EventBookingHelper::getConfig() ;
		$row = & JTable::getInstance('EventBooking', 'Registrant') ;		
		$user = & JFactory::getUser();		
		$data['transaction_id'] = strtoupper(JUserHelper::genRandomPassword());
		$cart = new EBCart() ;
		$items = $cart->getItems() ;
		$quantities = $cart->getQuantities();
		//Check username && password
		if (isset($data['username'])) {
			$username = $data['username'] ;
			$password = $data['password'] ;
			if ($username && $password) {
				$userId = EventBookingHelper::saveRegistration($data) ;
				$data['user_id'] = $userId ;
			} elseif ($username) {
				$sql = 'SELECT id FROM #__users WHERE username = "'.$username.'"';
				$this->_db->setQuery($sql) ;
				$data['user_id'] = $userId ;
			}
		}	
		$totalAmount = 0 ;
		$totalDiscount = 0 ;
		$registrantIds = array() ;
		//Store list of registrants
		for ($i = 0 , $n = count($items) ; $i < $n ; $i++) {
			$eventId = $items[$i] ;
			$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId;
			$db->setQuery($sql) ;
			$event = $db->loadObject() ;
			$quantity = $quantities[$i] ;
			$rate = EventBookingHelper::getRegistrationRate($eventId, $quantity);
			$registrantTotalAmount =  $rate*$quantity ;
			//Canculte discount
			$registrantDiscount = 0 ;
			if ($user->get('id')) {
				if ($event->discount > 0) {
					if ($event->discount_type == 1) {
						$registrantDiscount = $registrantTotalAmount*$event->discount/100 ;						
					} else {
						$registrantDiscount = $event->discount ;
					}
				}
			}					
			//Calculate the coupon discount
			if (isset($_SESSION['coupon_id'])) {
				$sql = 'SELECT * FROM #__eb_coupons WHERE id='.(int)$_SESSION['coupon_id'];
				$db->setQuery($sql) ;
				$coupon = $db->loadObject();
				if ($coupon && ($coupon->event_id == 0 || $coupon->event_id == $eventId)) {
					if ($coupon->coupon_type == 0) {
						$registrantDiscount = $registrantDiscount + $registrantTotalAmount*$coupon->discount/100 ; 
					} else {
						$registrantDiscount = $registrantDiscount + $coupon->discount ;
					}
				}
			}	
			#Early bird discount
			if (($event->early_bird_discount_amount > 0) && ($event->early_bird_discount_date != $nullDate) && (strtotime($event->early_bird_discount_date)>= mktime())) {					
				if ($event->early_bird_discount_type == 1) {
					$registrantDiscount +=  $registrantTotalAmount*$event->early_bird_discount_amount/100 ;						
				} else {
					$registrantDiscount += $event->early_bird_discount_amount ;
				}					
			}
			
			$totalAmount += $registrantTotalAmount ;
			$totalDiscount += $registrantDiscount ;			
			$data['total_amount'] = $registrantTotalAmount ;
			$data['discount_amount'] = $registrantDiscount ;
			$data['amount'] = $registrantTotalAmount - $registrantDiscount ;
			if ($config->enable_tax && $config->tax_rate > 0) {
			    $data['tax_amount'] = round($config->tax_rate*$data['amount']/100, 2); 
			} else {
			    $data['tax_amount'] = 0 ;
			}
			$data['event_id'] = $eventId ;
			$row->bind($data);
			$row->group_id = 0 ;
			$row->published = 0;
			$row->register_date =  date('Y-m-d H:i:s');
			if (isset($data['user_id']))
				$row->user_id = $data['user_id'] ;
			else	
				$row->user_id = $user->get('id');
			$row->number_registrants = $quantity ;
			$row->event_id = $eventId ;
			if ($i == 0) {
				$row->cart_id = 0 ;								
				//Store registration code
				while(true) {
					$registrationCode = JUserHelper::genRandomPassword(10) ;
					$sql = 'SELECT COUNT(*) FROM #__eb_registrants WHERE registration_code="'.$registrationCode.'"';
					$db->setQuery($sql) ;
					$total = $db->loadResult();
					if (!$total)
						break ;
				}
				$row->registration_code = $registrationCode ;
				#end store registration code
			} else {
				$row->cart_id = $registrantIds[0] ;
			}								
			$row->id = 0 ;							
			$row->store() ;			
			$jcFields =  new JCFields($row->event_id, false, 0) ;
			$jcFields->saveFieldValues($row->id) ;			
			$registrantIds[] = $row->id ;					
			JPluginHelper::importPlugin( 'eventbooking' );
			$dispatcher =& JDispatcher::getInstance();
			$dispatcher->trigger( 'onAfterStoreRegistrant', array($row));
		}																	
		$sql = 'SELECT title FROM #__eb_events WHERE id IN ('.implode(',', $items).') ORDER BY FIND_IN_SET(id, "'.implode(',', $items).'")';		
		$this->_db->setQuery($sql) ;		
		$eventTitltes = $this->_db->loadResultArray();
		$data['event_title'] = implode(', ', $eventTitltes) ;					
		//Now, we will need to creat registrants for each events										
		//Clear the coupon session
		if (isset($_SESSION['coupon_id'])) {
			$sql = 'UPDATE #__eb_coupons SET used = used + 1 WHERE id='.(int)$_SESSION['coupon_id'] ;
			$this->_db->setQuery($sql) ;
			$this->_db->query();
			unset($_SESSION['coupon_id']) ;
		}		
		$cart->reset();		
		$feeAmount = JCFields::calculateCartFee($items) ;
		$totalAmount += $feeAmount ;		
		$amount = $totalAmount - $totalDiscount ;
		if ($config->enable_tax && $config->tax_rate > 0) {
		    $taxAmount = round($amount*$config->tax_rate/100, 2);
		} else {
		    $taxAmount = 0 ;
		}
		if ($amount > 0) {
			$data['amount'] = $amount + $taxAmount ;	
			$row->load($registrantIds[0]);
			$paymentMethod = $data['payment_method'];
			require_once JPATH_COMPONENT.'/payments/'.$paymentMethod.'.php';
			$sql = 'SELECT params FROM #__eb_payment_plugins WHERE name="'.$paymentMethod.'"';
			$this->_db->setQuery($sql) ;
			$params = $this->_db->loadResult();
			$params = new JParameter($params) ;
			$paymentClass = new $paymentMethod($params) ;
			$paymentClass->processPayment($row, $data);						
		} else {
			$row->load($registrantIds[0]);
			$row->payment_date =  date('Y-m-d H:i:s');
   			$row->published = 1;
   			$row->store();
   			//Update status of all registrants
   			$sql = 'UPDATE #__eb_registrants SET published=1, payment_date=NOW() WHERE cart_id='.$row->id;
			$db->setQuery($sql) ;
			$db->query();
			EventBookingHelper::sendEmails($row, $config);	
			JPluginHelper::importPlugin( 'eventbooking' );
			$dispatcher =& JDispatcher::getInstance();
			$dispatcher->trigger( 'onAfterPaymentSuccess', array($row));	
			$url = JRoute::_('index.php?option=com_eventbooking&view=complete&registration_code='.$row->registration_code.'&Itemid='.$Itemid, false);											
			$mainframe->redirect($url);		
		}
	}	
	/**
	 * 
	 * Enter description here ...
	 */
	function getData() {				
		require_once JPATH_COMPONENT.DS.'helper'.DS.'os_cart.php';
		$db = & JFactory::getDBO() ;
		$cart = new EBCart();	
		return $cart->getEvents();									
	}	
} 