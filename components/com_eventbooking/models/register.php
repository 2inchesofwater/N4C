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
 * Event Booking Component Register Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelRegister extends JModel
{					
	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();				
	}	
	/**
	 * Save member data
	 *
	 * @param array $data
	 */
	function save_member($data) {
		$rowGroup = & JTable::getInstance('EventBooking', 'Registrant') ;
		$user = & JFactory::getUser() ;
		if (!isset($data['group_id'])) {
			$rowGroup->user_id = $user->get('id', 0);	
			$rowGroup->event_id = JRequest::getInt('event_id', 0) ;							
			$rowGroup->store() ;			
			JRequest::setVar('group_id', $rowGroup->id) ;		
		} else {
			$rowGroup->bind($data) ;
			$rowGroup->number_registrants = 0 ;
			$rowGroup->register_date = date('Y-m-d H:i:s');
			$rowGroup->store();	
		}
		if ($rowGroup->group_id) {
			$jcFields = new JCFields($data['event_id'], false, 2) ;
			$jcFields->saveFieldValues($rowGroup->id) ;
		}
		return true ;
	}
	/**
	 * Process individual registration
	 *
	 * @param array $data
	 */
	function processIndividualRegistration($data) {
		$mainframe = & JFactory::getApplication() ;
		$Itemid = JRequest::getInt('Itemid');	
		jimport('joomla.user.helper');
		$user = & JFactory::getUser() ;
		$config = EventBookingHelper::getConfig() ;
		$row = & JTable::getInstance('EventBooking', 'Registrant') ;		
		$user = & JFactory::getUser();		
		$data['transaction_id'] = strtoupper(JUserHelper::genRandomPassword());

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
		
		while(true) {
			$registrationCode = JUserHelper::genRandomPassword(10) ;
			$sql = 'SELECT COUNT(*) FROM #__eb_registrants WHERE registration_code="'.$registrationCode.'"';
			$this->_db->setQuery($sql) ;
			$total = $this->_db->loadResult();
			if (!$total)
				break ;
		}
		$row->registration_code = $registrationCode ;
				
		$row->bind($data);
		$row->group_id = 0 ;
		$row->published = 0;
		$row->register_date =  date('Y-m-d H:i:s');
		$row->number_registrants = 1 ;
		if (isset($data['user_id']))
			$row->user_id = $data['user_id'] ;
		else	
			$row->user_id = $user->get('id');	
		if ($row->deposit_amount > 0)
		    $row->payment_status =  0 ;
		else 
		    $row->payment_status = 1 ; 

	    //Clear the coupon session
		if (isset($_SESSION['coupon_id'])) {
		    if (!EB_AFFILIATE) {
		        $sql = 'UPDATE #__eb_coupons SET used = used + 1 WHERE id='.(int)$_SESSION['coupon_id'] ;
    			$this->_db->setQuery($sql) ;
    			$this->_db->query();   
		    }			
			$row->coupon_id = (int)$_SESSION['coupon_id'] ;
			unset($_SESSION['coupon_id']) ;
		}    
		    
		$row->store();
		$jcFields =  new JCFields($row->event_id, false, 0) ;
		$jcFields->saveFieldValues($row->id) ;
		$sql = 'SELECT title FROM #__eb_events WHERE id='.$data['event_id'];
		$this->_db->setQuery($sql) ;
		$eventTitlte = $this->_db->loadResult();
		$data['event_title'] = $eventTitlte ;
		JPluginHelper::importPlugin( 'eventbooking' );
		$dispatcher =& JDispatcher::getInstance();
		$dispatcher->trigger( 'onAfterStoreRegistrant', array($row));
		$data['amount'] = $data['amount'] + $row->tax_amount ;					
		if ($row->deposit_amount > 0) {
		    $data['amount'] = $row->deposit_amount ;
		}
				
		if ($row->amount > 0) {
			$paymentMethod = $data['payment_method'];
			require_once JPATH_COMPONENT.'/payments/'.$paymentMethod.'.php';
			$sql = 'SELECT params FROM #__eb_payment_plugins WHERE name="'.$paymentMethod.'"';
			$this->_db->setQuery($sql) ;
			$params = $this->_db->loadResult();
			$params = new JParameter($params) ;
			$paymentClass = new $paymentMethod($params) ;			
			$paymentClass->processPayment($row, $data);						
		} else {
			$row->payment_date =  date('Y-m-d H:i:s');
   			$row->published = 1;
   			$row->store();
			EventBookingHelper::sendEmails($row, $config);	
			JPluginHelper::importPlugin( 'eventbooking' );
			$dispatcher =& JDispatcher::getInstance();
			$dispatcher->trigger( 'onAfterPaymentSuccess', array($row));	
			$url = JRoute::_('index.php?option=com_eventbooking&view=complete&registration_code='.$row->registration_code.'&Itemid='.$Itemid, false);
			$mainframe->redirect($url);		
		}
	}
	/**
	 * Process Group Registration
	 *
	 * @param array $data
	 */
	function processGroupRegistration($data) {
		$mainframe = & JFactory::getApplication() ;
		$Itemid = JRequest::getInt('Itemid');			
		jimport('joomla.user.helper');
		$user = & JFactory::getUser() ;
		$config = EventBookingHelper::getConfig() ;
		$row = & JTable::getInstance('EventBooking', 'Registrant') ;
		$row->load($data['group_id']) ;
		$sql = 'SELECT COUNT(*) FROM #__eb_registrants WHERE group_id='.$data['group_id'];
		$this->_db->setQuery($sql) ;
		$row->number_registrants = $this->_db->loadResult();			
		$user = & JFactory::getUser();		
		$data['transaction_id'] = strtoupper(JUserHelper::genRandomPassword());
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
		$row->bind($data);		
		$row->group_id = 0 ;
		$row->published = 0;
		$row->register_date =  date('Y-m-d H:i:s');
		$row->is_group_billing = 1 ;
		if (isset($data['user_id']))
			$row->user_id = $data['user_id'] ;
		else	
			$row->user_id = $user->get('id');		
		if ($row->deposit_amount > 0)
		    $row->payment_status =  0 ;
		else 
		    $row->payment_status = 1 ;	

	    if (isset($_SESSION['coupon_id'])) {
	        if (!EB_AFFILIATE) {
	            $sql = 'UPDATE #__eb_coupons SET used = used + 1 WHERE id='.(int)$_SESSION['coupon_id'] ;
    			$this->_db->setQuery($sql) ;
    			$this->_db->query();   
	        }			
			$row->coupon_id = $_SESSION['coupon_id'] ;
			unset($_SESSION['coupon_id']) ;
		}		
		
		while(true) {
			$registrationCode = JUserHelper::genRandomPassword(10) ;
			$sql = 'SELECT COUNT(*) FROM #__eb_registrants WHERE registration_code="'.$registrationCode.'"';
			$this->_db->setQuery($sql) ;
			$total = $this->_db->loadResult();
			if (!$total)
				break ;
		}
		$row->registration_code = $registrationCode ;
		
		//Clear the coupon session    
		$row->store();
		$jcFields =  new JCFields($row->event_id, false, 1) ;
		$jcFields->saveFieldValues($row->id) ;
		$sql = 'SELECT title FROM #__eb_events WHERE id='.$data['event_id'];
		$this->_db->setQuery($sql) ;		
		$eventTitlte = $this->_db->loadResult();
		$data['event_title'] = $eventTitlte ;
		JPluginHelper::importPlugin( 'eventbooking' );
		$dispatcher =& JDispatcher::getInstance();
		$dispatcher->trigger( 'onAfterStoreRegistrant', array($row));
		$data['amount'] = $data['amount'] + $row->tax_amount ;					
		#Support deposit payment		
	    if ($row->deposit_amount > 0) {
		    $data['amount'] = $row->deposit_amount ;
		}
					
		if ($row->amount > 0) {
			$paymentMethod = $data['payment_method'];
			require_once JPATH_COMPONENT.'/payments/'.$paymentMethod.'.php';
			$sql = 'SELECT params FROM #__eb_payment_plugins WHERE name="'.$paymentMethod.'"';
			$this->_db->setQuery($sql) ;
			$params = $this->_db->loadResult();
			$params = new JParameter($params) ;
			$paymentClass = new $paymentMethod($params) ;
			$paymentClass->processPayment($row, $data);																							
		} else {
			$row->payment_date =  date('Y-m-d H:i:s');
   			$row->published = 1;
   			$row->store();
			if ($row->is_group_billing) {
   				EventBookingHelper::updateGroupRegistrationRecord($row->id);
   			}
			EventBookingHelper::sendEmails($row, $config);	
			JPluginHelper::importPlugin( 'eventbooking' );
			$dispatcher =& JDispatcher::getInstance();
			$dispatcher->trigger( 'onAfterPaymentSuccess', array($row));
			$url = JRoute::_('index.php?option=com_eventbooking&view=complete&registration_code='.$row->registration_code.'&Itemid='.$Itemid, false);
			$mainframe->redirect($url);										
		}			
	}
	/**
	 * Process payment confirmation
	 *
	 */
	function paymentConfirm() {					
		$paymentMethod =  JRequest::getVar('payment_method', '');
		$method = os_payments::getPaymentMethod($paymentMethod) ;
		$method->verifyPayment();		 
	}	
	/**
	 * Delete payment record record
	 *
	 * @param array $data
	 */
	function deleteRegistration($data) {
		$db = & JFactory::getDBO() ;
		$id = (int) $data['id'];
		$sql = 'SELECT event_id FROM #__eb_registrants WHERE id='.$id;		
		$db->setQuery($sql) ;
		$eventId = $db->loadResult();
		$sql = 'SELECT published FROM #__eb_registrants WHERE id='.$id;
		$db->setQuery($sql) ;
		$published = $db->loadResult();  		
		if ($eventId && !$published) {
			$sql = 'SELECT id FROM #__eb_registrants WHERE event_id='.$eventId;
			$db->setQuery($sql) ;
			$registrantIds = $db->loadResultArray() ;
			if (count($registrantIds)) {
				$registrantIds = implode(',', $registrantIds) ;
				$sql = 'DELETE FROM #__eb_field_values WHERE registrant_id IN ('.$registrantIds.')';
				$db->setQuery($sql) ;
				$db->query();
				$sql = 'DELETE FROM #__eb_registrants WHERE id IN ('.$registrantIds.')';
				$db->setQuery($sql) ;
				$db->query();	
			}
		}						
	}
	/**
	 * Process registration cancellation
	 * 
	 */
	function cancelRegistration($id) {		
		$db = & JFactory::getDBO() ;
		$config = EventBookingHelper::getConfig();		
		$sql = 'UPDATE #__eb_registrants SET published = 2 WHERE id='.$id;
		$db->setQuery($sql) ;
		$db->query() ;
		$sql = 'SELECT * FROM #__eb_registrants WHERE id='.$id;
		$db->setQuery($sql) ;
		$row = $db->loadObject();
		//Send notification email to administrator		
		$jconfig = new JConfig();				
		$db = & JFactory::getDBO();			
		$fromEmail =  $jconfig->mailfrom ;
		$fromName = $jconfig->fromname ;			
		$sql = "SELECT * FROM #__eb_events WHERE id=".$row->event_id ;
		$db->setQuery($sql) ;
		$event = $db->loadObject();
		$params = new JParameter($event->params) ;
		$keys = array('s_lastname', 's_organization', 's_address', 's_address2', 's_city', 's_state', 's_zip', 's_country', 's_phone', 's_fax', 's_comment');
		foreach ($keys as $key) {
			$config->$key = $params->get($key, 0) ;
		}				
		//Need to over-ridde some config options				
		$emailContent = EventBookingHelper::getEmailContent($config, $row);
		$sql = 'SELECT title FROM #__eb_events WHERE id='.$row->event_id ;
		$db->setQuery($sql) ;
		$eventTitle = $db->loadResult();		
		$replaces = array() ;		
		$replaces['event_title'] = $eventTitle ;				
		$replaces['first_name'] = $row->first_name ;
		$replaces['last_name'] = $row->last_name ;
		$replaces['organization'] = $row->organization ;
		$replaces['address'] = $row->address ;
		$replaces['address2'] = $row->address ;
		$replaces['city'] = $row->city ;
		$replaces['state'] = $row->state ;
		$replaces['zip'] = $row->zip ;
		$replaces['country'] = $row->country ;
		$replaces['phone'] = $row->phone ;
		$replaces['fax'] = $row->phone ;
		$replaces['email'] = $row->email ;
		$replaces['comment'] = $row->comment ;
		$replaces['amount'] = number_format($row->amount, 2) ;			
		//Notification email send to user
		$subject = $config->registration_cancel_email_subject ;		
		$body = $config->registration_cancel_email_body ;				
		$subject = str_replace('[EVENT_TITLE]', $eventTitle, $subject) ;
		$body = str_replace('[REGISTRATION_DETAIL]', $emailContent, $body) ;
		foreach ($replaces as $key=>$value) {
			$key = strtoupper($key) ;
			$body = str_replace("[$key]", $value, $body) ;
		}																									
		//Send emails to notification emails
		if (strlen(trim($event->notification_emails)) > 0)
			$config->notification_emails = $event->notification_emails ;
		if ($config->notification_emails == '')	
			$notificationEmails = $fromEmail;
		else 
			$notificationEmails = $config->notification_emails;
		$notificationEmails = str_replace(' ', '', $notificationEmails);
		$emails = explode(',', $notificationEmails);						
		for ($i = 0, $n  = count($emails); $i < $n ; $i++) {
			$email = $emails[$i];
			JUtility::sendMail($fromEmail, $fromName, $email, $subject, $body, 1);					
		}									
	}	
	/**
	 * Creat both billing record and members record	
	 * @param array $data
	 */
	function createBothGroupAndMembers($data) {
		$rowGroup = & JTable::getInstance('EventBooking', 'Registrant') ;
		$user = & JFactory::getUser() ;		
		$rowGroup->user_id = $user->get('id', 0);	
		$rowGroup->event_id = JRequest::getInt('event_id', 0) ;							
		$rowGroup->store() ;				
		$numberRegistrants = (int)$data['number_registrants'] ;		
		$rowMember = & JTable::getInstance('EventBooking', 'Registrant') ;
		for ($i = 0 ; $i < $numberRegistrants ; $i++) {			
			$rowMember->id = 0 ;
			$rowMember->group_id = $rowGroup->id ;
			$rowMember->number_registrants = 0 ;
			$rowMember->store() ;
		} 		
		JRequest::setVar('group_id', $rowGroup->id) ;									
		return true ;
	}	
} 