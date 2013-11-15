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

jimport( 'joomla.application.component.controller' );
/**
 * Event Booking controller
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingController extends JController
{
	/**
	 * Constructor function
	 *
	 * @param array $config
	 */
	function __construct($config = array())
	{
		parent::__construct($config);	
	}
	/**
	 * Display information
	 *
	 */
	function display( )
	{				
		$task = $this->getTask();
		$document = & JFactory::getDocument();
		$styleUrl = JURI::base(true).'/components/com_eventbooking/assets/css/style.css';		
		$document->addStylesheet( $styleUrl, 'text/css', null, null );	
		switch ($task) {										 																															
			case 'view_categories' :
				JRequest::setVar('view', 'categories') ;
				JRequest::setVar('layout', 'default') ;
				break ;
			case 'view_category' :
				JRequest::setVar('view', 'category') ;
				break ;		
			case 'individual_registration' :
				JRequest::setVar('view', 'register') ;
				JRequest::setVar('layout', 'default') ;
				break ;
			case 'individual_confirmation' :
				JRequest::setVar('view', 'confirmation') ;
				JRequest::setVar('layout', 'default') ;
				break ;	
			case 'group_registration' :
				JRequest::setVar('view', 'register') ;
				JRequest::setVar('layout', 'group') ;
				break ;
			case 'group_member' :
				JRequest::setVar('view', 'register') ;
				JRequest::setVar('layout', 'group_member') ;
				break ;		 			
			case 'group_billing' :				
				$db = & JFactory::getDBO() ;
				$groupId = JRequest::getInt('group_id', 0) ;
				$sql = 'SELECT event_id FROM #__eb_registrants WHERE id='.$groupId ;
				$db->setQuery($sql) ;
				$eventId = (int) $db->loadResult();
				JRequest::setVar('event_id', $eventId) ;				
				JRequest::setVar('view', 'register') ;
				JRequest::setVar('layout', 'group_billing') ;
				break ;			
			case 'group_confirmation' :
				JRequest::setVar('view', 'confirmation') ;
				JRequest::setVar('layout', 'group') ;
				break ;	
			case 'view_event' :
				JRequest::setVar('view', 'event') ;
				JRequest::setVar('layout', 'default') ;				
				break ;
			case 'view_map' :
				JRequest::setVar('view', 'map') ;
				JRequest::setVar('layout', 'default') ;
				break ;	
			case 'registration_complete' :
				JRequest::setVar('view', 'complete') ;
				JRequest::setVar('layout', 'default') ;
				break ;
			case 'registration_failure' :
				JRequest::setVar('view', 'failure') ;
				JRequest::setVar('layout', 'default') ;
				break ;
			case 'view_calendar' :
				JRequest::setVar('view', 'calendar') ;
				JRequest::setVar('layout', 'default') ;
				break ;
			case 'return' :
				JRequest::setVar('view', 'complete') ;
				JRequest::setVar('layout', 'default') ;
				break ;	
			case 'cancel' :
				JRequest::setVar('view', 'cancel') ;
				JRequest::setVar('layout', 'default') ;
				break ;

			#Registrants
			case 'show_history' :
				JRequest::setVar('view', 'history');
				break;
			case 'show_registrants' :
				JRequest::setVar('view', 'registrants');
				break;
			case 'add_registrant':
				JRequest::setVar( 'hidemainmenu', 1 );				
				JRequest::setVar( 'view'  , 'registrant');
				JRequest::setVar( 'edit', false );
				break;	
			case 'edit_registrant':					
				JRequest::setVar( 'view'  , 'registrant');											
				break;			
			case 'email_registrants' :
				JRequest::setVar('view', 'email') ;
				break ;	
			case 'edit_members' :
				JRequest::setVar('view', 'members') ;
				break ;	
			#End registrants	
			
			case 'invite_form' :
				JRequest::setVar('view', 'invite') ;
				JRequest::setVar('layout', 'default');
				break ;		
			case 'invite_complete' :
				JRequest::setVar('view', 'invite') ;
				JRequest::setVar('layout', 'complete'); 
				break ;
			#Cart function					
			case 'view_cart' :
				JRequest::setVar('view', 'cart') ;
				JRequest::setVar('layout', 'default');
				break ;		
			case 'view_checkout' :
				JRequest::setVar('view', 'register') ;
				JRequest::setVar('layout', 'cart');				
				break ;
			case 'checkout' :
				JRequest::setVar('view', 'register') ;
				JRequest::setVar('layout', 'cart');
				break ;	
			case 'checkout_confirmation' :
				JRequest::setVar('view', 'confirmation') ;
				JRequest::setVar('layout', 'cart');
				break ;		
			#Adding, managing events from front-end
			case 'show_events' :
				JRequest::setVar('view', 'events') ;
				JRequest::setVar('layout', 'default');
				break ;	
			case 'edit_event' :
				JRequest::setVar('view', 'event') ;
				JRequest::setVar('layout', 'form');
				break ;	
			#Misc
			case 'show_registrant_list' :
				JRequest::setVar('view', 'registrantlist');
				JRequest::setVar('layout', 'default');
				break ;
			case 'waitinglist_form' ;
				JRequest::setVar('view', 'waitinglist');
				JRequest::setVar('layout', 'default');
				break ;				
			case 'waitinglist_complete' :
			    JRequest::setVar('view', 'waitinglist');
				JRequest::setVar('layout', 'complete');
				break ;									
			default:
				$view = JRequest::getVar('view', '') ;
				if (!$view) {
					JRequest::setVar('view', 'categories') ;
					JRequest::setVar('layout', 'default') ;	
				}					
				break ;		
		}							
		parent::display();
	}		
	/**
	 * Save member information for group registration
	 *
	 */
	function group_member() {
		JRequest::checkToken() or jexit( 'Invalid Token' );
		$db = & JFactory::getDBO() ;
		$Itemid = JRequest::getInt('Itemid') ;				
		$post = JRequest::get('post', JREQUEST_ALLOWHTML);
		$model = & $this->getModel('register') ;
		$model->save_member($post);
		$groupId = JRequest::getInt('group_id', 0) ;
		$numberRegistrants = JRequest::getInt('number_registrants', 0) ;
		$sql = 'SELECT COUNT(*) FROM #__eb_registrants WHERE group_id='.$groupId;
		$db->setQuery($sql) ;
		$totalRegistrants = $db->loadResult();
		if ($totalRegistrants >= $numberRegistrants) {
			$mainframe = & JFactory::getApplication() ;
			$url = JRoute::_('index.php?option=com_eventbooking&task=group_billing&group_id='.$groupId.'&Itemid='.$Itemid, false) ;
			$mainframe->redirect($url);						
		} else {
			$this->display();
		}
	}
	/**
	 * Process individual registration
	 *
	 */	
	function process_individual_registration() {	    
		JRequest::checkToken() or jexit( 'Invalid Token' );		
		//Check captcha
		$eventId = JRequest::getInt('event_id', 0);
		if (!$eventId) 
			return ;
		$db = & JFactory::getDBO();
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId ;
		$db->setQuery($sql) ;
		$event = $db->loadObject();
		if (!$event)
			return ;
		$config = EventBookingHelper::getConfig();
		if (($config->enable_captcha == 3) || (($config->enable_captcha == 2) && ($event->individual_price > 0)) || (($config->enable_captcha == 1) && ($event->individual_price == 0))) {
			$checkCaptcha = 1 ;
		} else {
			$checkCaptcha = 0 ;
		}
		if ($checkCaptcha) {
		    $session = & JFactory::getSession() ;
			$securityCode = JRequest::getVar('security_code', '', 'post');
			if ($securityCode != $session->get('security_code')) {
				JRequest::setVar('view', 'confirmation');
				JRequest::setVar('layout', 'default');
				JRequest::setVar('captcha_invalid', 1);
				$this->display() ;
				return ;
			}
		}		
		$post = JRequest::get('post', JREQUEST_ALLOWHTML) ;
		$model = & $this->getModel('Register') ;
		$model->processIndividualRegistration($post) ;		
	}
	/**
	 * Process group registration
	 *
	 */
	function process_group_registration() {
		JRequest::checkToken() or jexit( 'Invalid Token' );
		//Check captcha
		$eventId = JRequest::getInt('event_id', 0);
		if (!$eventId) 
			return ;
		$db = & JFactory::getDBO();
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId ;
		$db->setQuery($sql) ;
		$event = $db->loadObject();
		if (!$event)
			return ;
		$config = EventBookingHelper::getConfig();
		if (($config->enable_captcha == 3) || (($config->enable_captcha == 2) && ($event->individual_price > 0)) || (($config->enable_captcha == 1) && ($event->individual_price == 0))) {
			$checkCaptcha = 1 ;
		} else {
			$checkCaptcha = 0 ;
		}
		if ($checkCaptcha) {
		    $session = & JFactory::getSession() ;		    
			$securityCode = JRequest::getVar('security_code', '', 'post');
			if ($securityCode != $session->get('security_code')) {
				JRequest::setVar('view', 'confirmation');
				JRequest::setVar('layout', 'group');
				JRequest::setVar('captcha_invalid', 1);
				$this->display() ;
				return ;
			}
		}
		$post = JRequest::get('post', JREQUEST_ALLOWHTML) ;
		$model = & $this->getModel('Register') ;
		$model->processGroupRegistration($post) ;		
	}
	/**
	 * Confirm the payment . Used for Paypal base payment gateway
	 *
	 */
	function payment_confirm() {						
		$model = & $this->getModel('Register');				
		$model->paymentConfirm();			
	}
	/**
	 * Individual Registration Confirmation	 
	 */
	function individual_confirmation() {
		JRequest::checkToken() or jexit( 'Invalid Token' );
		$db = & JFactory::getDBO() ;
		$couponCode = JRequest::getVar('coupon_code');	
		$errorCoupon = false ;
		$errorRegistration = false ;			
		if ($couponCode) {			
			$where = array() ;
			$eventId = JRequest::getInt('event_id', 0);			
			$where[] = 'published = 1' ;
			$where[] = ' code="'.$couponCode.'" ' ;
			$where[] = ' (valid_from="'.$db->getNullDate().'" OR valid_from <= NOW()) ' ;
			$where[] = ' (valid_to="'.$db->getNullDate().'" OR valid_to >= NOW()) ';
			$where[] = ' (times = 0 OR times > used)' ;
			$where[] = ' (event_id=0 OR event_id='.$eventId.')' ;
			$sql = 'SELECT * FROM #__eb_coupons WHERE '.implode(' AND ', $where); 
			$db->setQuery($sql) ;
			$rowCoupon = $db->loadObject();			
			if ($rowCoupon) {
				$_SESSION['coupon_id'] = $rowCoupon->id ;									
			} else {				
				$errorCoupon = true ;							
			}				
		} else {
			unset($_SESSION['coupon_id']) ;
		} 	
		$username =  JRequest::getVar('username', '', 'post', 'string');
		$password = JRequest::getVar('password', '', 'post');
		$email = JRequest::getVar('email', '', 'post');
		$registrationErrorCode = 0 ;
		if (strlen($username) && strlen($password)) {
			//This user want to register for a new account
			$sql = 'SELECT COUNT(id) FROM #__users WHERE username="'.$username.'"';
			$db->setQuery($sql) ;
			$total = $db->loadResult();
			if ($total) {
				$errorRegistration = true ;
				$registrationErrorCode = 1 ;
			} else {
				//Check email
				$sql = 'SELECT COUNT(id) FROM #__users WHERE email="'.$email.'"';
				$db->setQuery($sql) ;
				$total = $db->loadResult();	
				if ($total) {
					$errorRegistration = true ;
					$registrationErrorCode = 2 ;
				}
			}			
		} elseif (strlen($username)) {
			//Just assign the account to user
			$sql = 'SELECT COUNT(id) FROM #__users WHERE username="'.$username.'"';
			$db->setQuery($sql) ;
			$total = $db->loadResult();
			if ($total == 0) {
				$errorRegistration = true ;
				$registrationErrorCode = 3 ;
			}
		}		
		if ($errorCoupon || $errorRegistration) {
			JRequest::setVar('error_coupon', $errorCoupon); 
			JRequest::setVar('error_registration', $errorRegistration);
			JRequest::setVar('registration_error_code', $registrationErrorCode); 
			$this->execute('individual_registration') ;
		} else {
			$this->display() ;
		}
	}
	/**
	 *
	 * Group registration confirmation
	 */
	function group_confirmation() {
		JRequest::checkToken() or jexit( 'Invalid Token' );
		$db = & JFactory::getDBO() ;
		$couponCode = JRequest::getVar('coupon_code');	
		$errorCoupon = false ;
		$errorRegistration = false ;		
		if ($couponCode) {			
			$where = array() ;
			$eventId = JRequest::getInt('event_id', 0);			
			$where[] = 'published = 1' ;
			$where[] = ' code="'.$couponCode.'" ' ;
			$where[] = ' (valid_from="'.$db->getNullDate().'" OR valid_from <= NOW()) ' ;
			$where[] = ' (valid_to="'.$db->getNullDate().'" OR valid_to >= NOW()) ';
			$where[] = ' (times = 0 OR times > used)' ;
			$where[] = ' (event_id=0 OR event_id='.$eventId.')' ;
			$sql = 'SELECT * FROM #__eb_coupons WHERE '.implode(' AND ', $where); 
			$db->setQuery($sql) ;
			$rowCoupon = $db->loadObject();
			if ($rowCoupon) {
				$_SESSION['coupon_id'] = $rowCoupon->id ;								
			} else {				
				$errorCoupon = true ;							
			}				
		} else {
			unset($_SESSION['coupon_id']) ;
		} 	
		$username =  JRequest::getVar('username', '', 'post', 'string');
		$password = JRequest::getVar('password', '', 'post');
		$email = JRequest::getVar('email', '', 'post');
		$registrationErrorCode = 0 ;
		if (strlen($username) && strlen($password)) {
			//This user want to register for a new account
			$sql = 'SELECT COUNT(id) FROM #__users WHERE username="'.$username.'"';
			$db->setQuery($sql) ;
			$total = $db->loadResult();
			if ($total) {
				$errorRegistration = true ;
				$registrationErrorCode = 1 ;
			} else {
				//Check email
				$sql = 'SELECT COUNT(id) FROM #__users WHERE email="'.$email.'"';
				$db->setQuery($sql) ;
				$total = $db->loadResult();	
				if ($total) {
					$errorRegistration = true ;
					$registrationErrorCode = 2 ;
				}
			}			
		} elseif (strlen($username)) {
			//Just assign the account to user
			$sql = 'SELECT COUNT(id) FROM #__users WHERE username="'.$username.'"';
			$db->setQuery($sql) ;
			$total = $db->loadResult();
			if ($total == 0) {
				$errorRegistration = true ;
				$registrationErrorCode = 3 ;
			}
		}		
		if ($errorCoupon || $errorRegistration) {
			JRequest::setVar('error_coupon', $errorCoupon); 
			JRequest::setVar('error_registration', $errorRegistration);
			JRequest::setVar('registration_error_code', $registrationErrorCode); 
			$this->execute('group_billing') ;
		} else {
			$this->display() ;	
		}
	}
	/**
	 * Save the registration record and back to registration record list	 
	 */	
	function save_registrant() {
		$Itemid = JRequest::getInt('Itemid');
		$model = & $this->getModel('registrant');
		$post = JRequest::get('post');
		$model->store($post);
		$from = JRequest::getVar('from', '');
		if ($from == 'history') {
			$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=show_history&Itemid='.$Itemid, false)) ;	
		} else {
			$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=show_registrants&Itemid='.$Itemid, false)) ;
		}					
	}
	/**
	 * Cancel registration for the event
	 * 
	 */
	function cancel_registration() {
		$mainframe = & JFactory::getApplication() ;
		$Itemid = JRequest::getInt('Itemid') ;
		$db = & JFactory::getDBO() ;
		$user = & JFactory::getUser() ;
		$id = JRequest::getInt('id');
		$sql = 'SELECT a.id, a.title, b.user_id FROM #__eb_events AS a INNER JOIN #__eb_registrants AS b ON a.id = b.event_id WHERE b.id='.$id ;
		$db->setQuery($sql) ;
		$rowEvent = $db->loadObject();
		if (!$rowEvent) {
			$mainframe->redirect(JRoute::_('index.php?option=com_eventbooking&Itemid='.$Itemid), JText::_('EB_INVALID_ACTION'));			
		}
		if ($user->get('id') == 0 || ($user->get('id') != $rowEvent->user_id)) {
			$mainframe->redirect(JRoute::_('index.php?option=com_eventbooking&Itemid='.$Itemid), JText::_('EB_INVALID_ACTION'));
		}
		$model = & $this->getModel('register');		
		$model->cancelRegistration($id);		
		$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&view=registrationcancel&id='.$id.'&Itemid='.$Itemid, false)) ;
	}
	/**
	 * Send invitation to friends
	 * 
	 */	
	function send_invite() {
		$model = & $this->getModel('invite');
		$post = JRequest::get('post');
		$model->sendInvite($post);	
		$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=invite_complete&tmpl=component', false)) ;
	}
	/**
	 * Send reminder to registrants about events	 
	 */
	function event_reminder() {
		$model = & $this->getModel('reminder');
		$model->sendReminder() ;
		exit() ;		
	}
	/**
	 * Create group registration record	 
	 */
	function create_group_registration() {
		$Itemid = JRequest::getInt('Itemid');
		$model = & $this->getModel('register');
		$post = JRequest::get('post');		
		$model->createBothGroupAndMembers($post) ;
		$groupId = JRequest::getInt('group_id', 0);				
		$url = JRoute::_('index.php?option=com_eventbooking&task=group_billing&group_id='.$groupId.'&Itemid='.$Itemid, false) ;
		$this->setRedirect($url) ;		
	}	
	############Multiple booking feature###################
	/**
	 * 
	 * Add an events and store it to 
	 */
	function add_to_cart() {
		$Itemid = JRequest::getInt('Itemid');
		$data = JRequest::get();
		$model = & $this->getModel('cart') ;
		$model->processAddToCart($data);
		$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=view_cart&Itemid='.$Itemid, false)) ;
	}
	/**
	 * 
	 * Update cart with new quantities
	 */
	function update_cart() {
		$Itemid = JRequest::getInt('Itemid');
		$eventIds = JRequest::getVar('event_id');
		$quantities = JRequest::getVar('quantity');		
		$model = & $this->getModel('cart') ;
		$model->processUpdateCart($eventIds, $quantities);
		$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=view_cart&Itemid='.$Itemid, false)) ;
	}
	/**
	 * Remove an event from shopping cart
	 *
	 */
	function remove_cart() {
		$Itemid = JRequest::getInt('Itemid');
		$id = JRequest::getInt('id', 0);
		$model = & $this->getModel('cart') ;
		$model->removeEvent($id);
		$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=view_cart&Itemid='.$Itemid, false)) ;
	}
	/*
	 * Checkout
	 */
	function checkout() {			
		$back = JRequest::getInt('is_back', 0);
		$errorCoupon = JRequest::getInt('error_coupon', 0) ;
		$errorRegistration = JRequest::getInt('error_registration', 0) ; ;
		if (!($back || $errorCoupon || $errorRegistration)) {
			$model = & $this->getModel('cart') ;
			$eventIds = JRequest::getVar('event_id');
			$quantities = JRequest::getVar('quantity');		
			$model = & $this->getModel('cart') ;
			$model->processUpdateCart($eventIds, $quantities);
			$this->display() ;	
		} else {
			$this->display() ;
		}		
	}
	/**
	 * Process checkout confirmation
	 *
	 */
	function checkout_confirmation() {
		JRequest::checkToken() or jexit( 'Invalid Token' );
		$db = & JFactory::getDBO() ;
		$couponCode = JRequest::getVar('coupon_code');	
		$errorCoupon = false ;
		$errorRegistration = false ;		
		if ($couponCode) {	
			require_once JPATH_COMPONENT.DS.'helper'.DS.'os_cart.php';		
			$cart = new EBCart() ;		
			$items = $cart->getItems();		
			$where = array() ;
			$eventId = JRequest::getInt('event_id', 0);			
			$where[] = 'published = 1' ;
			$where[] = ' code="'.$couponCode.'" ' ;
			$where[] = ' (valid_from="'.$db->getNullDate().'" OR valid_from <= NOW()) ' ;
			$where[] = ' (valid_to="'.$db->getNullDate().'" OR valid_to >= NOW()) ';
			$where[] = ' (times = 0 OR times > used)' ;
			$where[] = ' (event_id=0 OR event_id IN ('.implode(',', $items).'))' ;
			$sql = 'SELECT * FROM #__eb_coupons WHERE '.implode(' AND ', $where); 
			$db->setQuery($sql) ;
			$rowCoupon = $db->loadObject();
			if ($rowCoupon) {
				$_SESSION['coupon_id'] = $rowCoupon->id ;								
			} else {				
				$errorCoupon = true ;							
			}				
		} else {
			unset($_SESSION['coupon_id']) ;
		} 	
		$username =  JRequest::getVar('username', '', 'post', 'string');
		$password = JRequest::getVar('password', '', 'post');
		$email = JRequest::getVar('email', '', 'post');
		$registrationErrorCode = 0 ;
		if (strlen($username) && strlen($password)) {
			//This user want to register for a new account
			$sql = 'SELECT COUNT(id) FROM #__users WHERE username="'.$username.'"';
			$db->setQuery($sql) ;
			$total = $db->loadResult();
			if ($total) {
				$errorRegistration = true ;
				$registrationErrorCode = 1 ;
			} else {
				//Check email
				$sql = 'SELECT COUNT(id) FROM #__users WHERE email="'.$email.'"';
				$db->setQuery($sql) ;
				$total = $db->loadResult();	
				if ($total) {
					$errorRegistration = true ;
					$registrationErrorCode = 2 ;
				}
			}			
		} elseif (strlen($username)) {
			//Just assign the account to user
			$sql = 'SELECT COUNT(id) FROM #__users WHERE username="'.$username.'"';
			$db->setQuery($sql) ;
			$total = $db->loadResult();
			if ($total == 0) {
				$errorRegistration = true ;
				$registrationErrorCode = 3 ;
			}
		}		
		if ($errorCoupon || $errorRegistration) {
			JRequest::setVar('error_coupon', $errorCoupon); 
			JRequest::setVar('error_registration', $errorRegistration);
			JRequest::setVar('registration_error_code', $registrationErrorCode); 
			$this->execute('checkout') ;
		} else {
			$this->display() ;	
		}
	}		
	/**
	 * Export registrants data into a csv file
	 *
	 */
	function csv_export() {		
		$db = & JFactory::getDBO();
		$config = EventBookingHelper::getConfig();
		if (!EventBookingHelper::canExportRegistrants()) {
			JFactory::getApplication()->redirect('index.php', JText::_('EB_NOT_ALLOWED_TO_EXPORT'));
		}				
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
			$param = null ;
		} else {
			$param = 0 ;
		}
		$taxEnabled = $config->enable_tax && ($config->tax_rate > 0) ;
		$eventId = JRequest::getInt('event_id') ;
		$where = array() ;
		$where[] = '(a.published = 1 OR (a.payment_method LIKE "os_offline%" AND a.published != 2))' ;
		if ($eventId)
			$where[] = ' a.event_id='.$eventId ;
		if (isset($config->include_group_billing_in_csv_export) && !$config->include_group_billing_in_csv_export)
			$where[] = ' a.is_group_billing = 0 ' ;
		if (!$config->include_group_members_in_csv_export)
			$where[] = ' a.group_id = 0 ';
		if ($config->show_coupon_code_in_registrant_list) {
			$sql = 'SELECT a.*, b.event_date, b.title AS event_title, c.code AS coupon_code FROM #__eb_registrants AS a INNER JOIN #__eb_events AS b ON a.event_id = b.id LEFT JOIN #__eb_coupons AS c ON a.coupon_id=c.id WHERE '.implode(' AND ', $where).' ORDER BY a.id ';
		} else {
			$sql = 'SELECT a.*, b.event_date, b.title AS event_title FROM #__eb_registrants AS a INNER JOIN #__eb_events AS b ON a.event_id = b.id WHERE '.implode(' AND ', $where).' ORDER BY a.id ';
		}
		$db->setQuery($sql) ;
		$rows  = $db->loadObjectList();
		if (count($rows) ==  0) {
			JFactory::getApplication()->redirect('index.php', JText::_('EB_NO_REGISTRANTS_TO_EXPORT'));
		}
		if ($eventId)
			$sql = 'SELECT id, title FROM #__eb_fields WHERE published=1 AND (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id='.$eventId.')) ORDER BY ordering';
		else
			$sql = 'SELECT id, title FROM #__eb_fields WHERE published=1  ORDER BY ordering';
		$db->setQuery($sql) ;
		$rowFields = $db->loadObjectList() ;
		//Get the custom fields value and store them into an array
	
		$sql = 'SELECT id FROM #__eb_registrants AS a WHERE '.implode(' AND ', $where) ;
		$db->setQuery($sql) ;
		$registrantIds = array(0) ;
		$registrantIds = array_merge($registrantIds, $db->loadResultArray()) ;
		$sql = 'SELECT registrant_id, field_id, field_value FROM #__eb_field_values WHERE registrant_id IN ('.implode(',', $registrantIds).')';
		$db->setQuery($sql) ;
		$rowFieldValues = $db->loadObjectList();
		$fieldValues = array() ;
		for ($i = 0 , $n = count($rowFieldValues) ; $i < $n ; $i++) {
			$rowFieldValue = $rowFieldValues[$i] ;
			$fieldValues[$rowFieldValue->registrant_id][$rowFieldValue->field_id] = $rowFieldValue->field_value ;
		}
		//Get name of groups
		$groupNames = array() ;
		$sql = 'SELECT id, first_name, last_name FROM #__eb_registrants AS a WHERE is_group_billing = 1'. (COUNT($where) ? ' AND '.implode(' AND ', $where) : '');
		$db->setQuery($sql);
		$rowGroups = $db->loadObjectList() ;
		if (count($rowGroups)) {
			foreach ($rowGroups as $rowGroup) {
				$groupNames[$rowGroup->id] = $rowGroup->first_name . ' '.$rowGroup->last_name ;
			}
		}
		if(count($rows)){
			$results_arr=array();
			$csv_output = JText::_('EB_EVENT');
			if ($config->show_event_date) {
				$csv_output .= ",". JText::_('EB_EVENT_DATE') ;
			}
			$csv_output .= ", ". JText::_('EB_FIRST_NAME') ;
			if ($config->s_lastname)
				$csv_output .= ", ". JText::_('EB_LAST_NAME');
			if ($config->s_organization)
				$csv_output .= ', '. JText::_('EB_ORGANIZATION');
			if ($config->s_address)
				$csv_output .= ', '. JText::_('EB_ADDRESS');
			if ($config->s_address2)
				$csv_output .= ', '. JText::_('EB_ADDRESS2');
			if ($config->s_city)
				$csv_output .= ', '. JText::_('EB_CITY');
			if ($config->s_state)
				$csv_output .= ', '. JText::_('EB_STATE');
			if ($config->s_zip)
				$csv_output .= ', '. JText::_('EB_ZIP');
			if ($config->s_country)
				$csv_output .= ', '. JText::_('EB_COUNTRY');
			if ($config->s_phone)
				$csv_output .= ', '. JText::_('EB_PHONE');
			if ($config->s_fax)
				$csv_output .= ', '. JText::_('EB_FAX');
			$csv_output .= ', '. JText::_('EB_EMAIL');
			$csv_output .= ', '. JText::_('EB_NB_REGISTRANTS');
			$csv_output .= ', '. JText::_('EB_AMOUNT');
			if ($taxEnabled) {
				$csv_output .= ', '. JText::_('EB_TAX');
			}
			if ($config->activate_deposit_feature) {
				$csv_output .= ', '. JText::_('EB_DEPOSIT_AMOUNT');
				$csv_output .= ', '. JText::_('EB_DUE_AMOUNT');
			}
			if ($config->show_coupon_code_in_registrant_list) {
				$csv_output .= ','. JText::_('EB_COUPON');
			}
			$csv_output .= ','. JText::_('EB_REGISTRATION_DATE');
			$csv_output .= ','. JText::_('EB_TRANSACTION_ID');
			$csv_output .= ', '. JText::_('EB_PAYMENT_STATUS');
			if (count($rowFields)) {
				foreach ($rowFields as  $rowField)
					$csv_output .= ', '.$rowField->title ;
			}
			if ($config->s_comment)
				$csv_output .= ', '. JText::_('EB_COMMENT');
			foreach($rows as $r) {
				$results_arr=array();
				$results_arr[]=$r->event_title ;
				if ($config->show_event_date) {
					$results_arr[] = JHTML::_('date', $r->event_date, $config->date_format, $param) ;
				}
				if ($r->is_group_billing)
					$results_arr[]=$r->first_name.' '.JText::_('EB_GROUP_BILLING');
				elseif ($r->group_id > 0)
				$results_arr[]=$r->first_name.' '.JText::_('EB_GROUP').$groupNames[$r->group_id] ;
				else
					$results_arr[]=$r->first_name ;
				if ($config->s_lastname)
					$results_arr[]=$r->last_name ;
				if ($config->s_organization)
					$results_arr[]=$r->organization;
				if ($config->s_address)
					$results_arr[]=$r->address;
				if ($config->s_address2)
					$results_arr[]=$r->address2;
				if ($config->s_city)
					$results_arr[]=$r->city;
				if ($config->s_state)
					$results_arr[]=$r->state;
				if ($config->s_zip)
					$results_arr[]=$r->zip;
				if ($config->s_country)
					$results_arr[]=$r->country;
				if ($config->s_phone)
					$results_arr[]=$r->phone;
				if ($config->s_fax)
					$results_arr[]=$r->fax;
				$results_arr[]=$r->email;
				$results_arr[] = $r->number_registrants ;
				$results_arr[]= number_format($r->amount, 2);
				if ($taxEnabled)
					$results_arr[]= number_format($r->tax_amount, 2);
				if ($config->activate_deposit_feature) {
					if ($r->deposit_amount > 0) {
						$results_arr[]= number_format($r->deposit_amount, 2);
						$results_arr[]= number_format($r->amount - $r->deposit_amount, 2);
					} else {
						$results_arr[]= '';
						$results_arr[]= '';
					}
				}
	
				if ($config->show_coupon_code_in_registrant_list) {
					$results_arr[]= $r->coupon_code ;
				}
	
				$results_arr[]= JHTML::_('date', $r->register_date, $config->date_format, $param);
				$results_arr[]= $r->transaction_id ;
				if ($r->published) {
					$results_arr[]= 'Paid' ;
				} else {
					$results_arr[]= 'Not Paid' ;
				}
				if (count($rowFields))
					foreach ($rowFields as $rowField) {
					$results_arr[] = @$fieldValues[$r->id][$rowField->id] ;
				}
				if ($config->s_comment)
					$results_arr[]= $r->comment;
				$csv_output .= "\n\"".implode ("\",\"", $results_arr)."\"";
			}
			$csv_output .= "\n";
			if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT'])) {
				$UserBrowser = "Opera";
			}
			elseif (ereg('MSIE ([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT'])) {
				$UserBrowser = "IE";
			} else {
				$UserBrowser = '';
			}
			$mime_type = ($UserBrowser == 'IE' || $UserBrowser == 'Opera') ? 'application/octetstream' : 'application/octet-stream';
			$filename = "registrants_list";
			@ob_end_clean();
			ob_start();
			header('Content-Type: ' . $mime_type);
			header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
			if ($UserBrowser == 'IE') {
				header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
			}
			else {
				header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
				header('Pragma: no-cache');
			}
			print $csv_output;
			exit();
		}
	}
	
	/**	 
	 * Process checkout
	 */	
	function process_checkout() {		
		JRequest::checkToken() or jexit( 'Invalid Token' );
		$config = EventBookingHelper::getConfig();
		if ($config->enable_captcha != 0) {
			$checkCaptcha = 1 ;
		} else {
			$checkCaptcha = 0 ;
		}					
		if ($checkCaptcha) {
		    $session = & JFactory::getSession();
			$securityCode = JRequest::getVar('security_code', '', 'post');
			if ($securityCode != $session->get('security_code')) {
				JRequest::setVar('view', 'confirmation');
				JRequest::setVar('layout', 'cart');
				JRequest::setVar('captcha_invalid', 1);
				$this->display() ;
				return ;
			}
		}
		$post = JRequest::get('post');
		$model = & $this->getModel('cart');
		$model->processCheckout($post);				
	}
	/**
	 * Delete the related registration records if customers cancel the payment from Paypal	 
	 */		
	function cancel() {
		$db = & JFactory::getDBO() ;
		$id = JRequest::getInt('id', 0);
		//Check to see whether we can delete this record
		$sql = 'SELECT * FROM #__eb_registrants WHERE id='.$id ;
		$db->setQuery($sql) ;
		$rowRegistrant = $db->loadObject();
		if ($rowRegistrant) {
			if ($rowRegistrant->published == 0  && $rowRegistrant->payment_method == 'os_paypal') {
				$registrantArray = array() ;
				$registrantArray[] = $id ;
				$sql = 'SELECT id FROM #__eb_registrants WHERE group_id='.$id ;
				$db->setQuery($sql) ;
				$registrantArray = array_merge($registrantArray, $db->loadResultArray()) ;
				$sql = 'DELETE FROM #__eb_field_values WHERE registrant_id IN('.implode(',', $registrantArray).')';
				$db->setQuery($sql) ;
				$db->query() ; 
				$sql = 'DELETE FROM #__eb_registrants WHERE in IN ('.implode(',', $registrantArray).')';
				$db->setQuery($sql) ;
				$db->query() ;															
			}
		}
		$this->display() ;
	}
	
	/**
	 * Store users into waitinglist database
	 * 
	 */	
	function save_waitinglist() {
	    $data = JRequest::get('post');
	    $model = $this->getModel('waitinglist');
	    $model->store($data) ;	           
	}			
	/**
	 * Show captcha image, using in the captcha form	 
	 */
	function show_captcha_image() {
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // 		
		require_once JPATH_COMPONENT.DS.'helper'.DS.'captcha.php';
		$captcha = new CaptchaSecurityImages();
		exit();
	}		
	###########################Submitting events from front-end################################
	
	function save_event() {
		JRequest::checkToken() or jexit( 'Invalid Token' );
		$post = JRequest::get('post' , JREQUEST_ALLOWHTML);
		$model =  $this->getModel('event') ;
		$cid = $post['cid'];
		$post['id'] = (int) $cid[0];
		$ret =  $model->store($post);
		if ($ret) {
			$msg = JText::_('Successfully saving event');	
		} else {
			$msg = JText::_('Error while saving event') ;
		}
		$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=show_events&Itemid='.JRequest::getInt('Itemid'), false) , $msg);
	}		
	/**
	 * Publish the selected events
	 *
	 */
	function publish_event() {
		//Check unpublish permission
		$user = & JFactory::getUser() ;		
		$db = & JFactory::getDBO() ;			
		$id = JRequest::getInt('id', 0);				
		if (!$id) {
			$canPublish = false ;
			$msg = JText::_('EB_INVALID_EVENT');
			$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=show_events'), $msg);
			return ;
		}				
		//Get the event object
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$id ;
		$db->setQuery($sql);
		$rowEvent = $db->loadObject() ;
		if (!$rowEvent) {			
			$msg = JText::_('EB_INVALID_EVENT');
			$this->setRedirect(JRouter::_('index.php?option=com_eventbooking&task=show_events'), $msg);
			return ;
		}	
				
		if (($rowEvent->created_by != $user->get('id')) || $user->get('guest')) {
			$msg = JText::_('EB_NO_PUBLISH_PERMISSION');
			$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=show_events'), $msg);
			return ;
		}					
		//OK, enough permission checked. Publish the event		
		$model = $this->getModel('event') ;
		$ret =  $model->publish($id, 1);
		if ($ret) {
			$msg = JText::_('EB_PUBLISH_SUCCESS'); 
		} else {
			$msg = JText::_('EB_PUBLISH_ERROR');
		}
		$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=show_events', false), $msg);
	}
	/**
	 * Unpublish the selected events
	 *
	 */
	function unpublish_event() {		
		$db = & JFactory::getDBO() ;
		$user = & JFactory::getUser() ;
		$id = JRequest::getInt('id', 0);
		if (!$id) {
			$canPublish = false ;
			$msg = JText::_('EB_INVALID_EVENT');
			$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=show_events'), $msg);
			return ;
		}				
		//Get the event object
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$id ;
		$db->setQuery($sql);
		$rowEvent = $db->loadObject() ;
		if (!$rowEvent) {			
			$msg = JText::_('EB_INVALID_EVENT');
			$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=show_events'), $msg);
			return ;
		}	
				
		if (($rowEvent->created_by != $user->get('id')) || $user->get('guest')) {
			$msg = JText::_('EB_NO_UNPUBLISH_PERMISSION');
			$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=show_events'), $msg);
			return ;
		}	
		$model = $this->getModel('event') ;
		$ret =  $model->publish($id, 0);
		if ($ret) {
			$msg = JText::_('EB_UNPUBLISH_SUCCESS'); 
		} else {
			$msg = JText::_('EB_UNPUBLISH_ERROR');
		}
		$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=show_events', false), $msg);
	}
	/**
	 * Redirect user to events mangement page
	 *
	 */
	function cancel_event() {
		$this->setRedirect(JRoute::_('index.php?option=com_eventbooking&task=show_events&Itemid='.JRequest::getInt('Itemid'), false));
	}		
	/***
	 * Change mini calendar
	 */
	function change_minical(){	
		$lang = & JFactory::getLanguage() ;
		$tag = $lang->getTag();
		if (!$tag)
			$tag = 'en-GB' ;			
		$lang->load('mod_eb_minicalendar', JPATH_ROOT, $tag);
		echo "<div id='minical_change'>";
			require_once (JPATH_SITE.DS.'modules'.DS.'mod_eb_minicalendar'.DS.'mod_eb_minicalendar.php');
		echo "</div>";
		?>
		<script language="javascript">
		function doit(){
			var minical_change=document.getElementById('minical_change');
			parent.navminicalLoaded(minical_change);
		}
		window.onload=doit;
		</script>
	<?php 	
	}		
}