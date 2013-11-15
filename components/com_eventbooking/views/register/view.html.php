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
 * HTML View class for Event Booking component
 *
 * @static
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.0
 */
class EventBookingViewRegister extends JView
{
	/**
	 * Display interface to user
	 *
	 * @param string $tpl
	 */
	function display($tpl = null)
	{	
		$layout = $this->getLayout() ;
		if ($layout == 'cart') {
			$this->_displayCart($tpl);
			return ;
		} 	
		$db = & JFactory::getDBO() ;		
		$document = & JFactory::getDocument() ;		
		$eventId = JRequest::getInt('event_id', 0) ;
		if (!$eventId) {
			$menus = & JSite::getMenu();
			$menu = $menus->getActive();
			if (is_object($menu)) {
			    if (version_compare(JVERSION, '1.6.0', 'ge')) {
			        $params = new JRegistry() ;
			        $params->loadString($menu->params) ;			        
			    } else {
			        $params = new JParameter($menu->params) ;    
			    }				
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
		switch ($layout) {
			case 'group' :
				$this->_displayGroupForm($tpl);
				break ;
			case 'group_member':
				$this->_displayMemberForm($tpl);
				break ;
			case 'group_billing' :
				$this->_displayGroupBillingForm($tpl);
				break ;
			default:
				$this->_displayIndividualRegistrationForm($tpl);
				break ;					
		}		  					
	}
	/**
	 * Display individual registration Form
	 *
	 * @param string $tpl
	 */
	function _displayIndividualRegistrationForm($tpl) {		
		$Itemid = JRequest::getInt('Itemid');				
		$document = & JFactory::getDocument() ;
		$document->addScript(JURI::base(true).'/components/com_eventbooking/assets/js/paymentmethods.js');
		$db = & JFactory::getDBO();
		$user = & JFactory::getUser();		
		$userId = $user->get('id');
		$config = EventBookingHelper::getConfig() ;	
		$eventId = JRequest::getInt('event_id', 0) ;							
		if (($userId > 0) && ($config->cb_integration == 1)) {
			$sql = 'SELECT * FROM #__comprofiler WHERE user_id='.$userId;
			$db->setQuery($sql);
			$rowProfile = $db->loadObject();
			$mFirstname = $config->m_firstname ? $config->m_firstname : 'firstname' ;			
			$mLastname = $config->m_lastname ? $config->m_lastname : 'lastname';
			$mOrganization = $config->m_organization ? $config->m_organization : 'organization' ;
			$mAddress = $config->m_address ? $config->m_address : 'address';			
			$mAddress2 = $config->m_address2 ? $config->m_address2 : 'address2';
			$mCity = $config->m_city  ? $config->m_city : 'city';
			$mState = $config->m_state ? $config->m_state : 'state' ;
			$mZip = $config->m_zip ? $config->m_zip : 'zip';
			$mCountry = $config->m_country ? $config->m_country : 'country';
			$mPhone = $config->m_phone ? $config->m_phone : 'phone' ;
			$mFax = $config->m_fax ? $config->m_fax : 'fax' ;																
			$firstName = JRequest::getVar('first_name', @$rowProfile->$mFirstname, 'post');
			$lastName = JRequest::getVar('last_name', @$rowProfile->$mLastname, 'post');
			$organization = JRequest::getVar('organization', @$rowProfile->$mOrganization, '');
			$address = JRequest::getVar('address', @$rowProfile->$mAddress, 'post');
			$address2 = JRequest::getVar('address2', @$rowProfile->$mAddress2, 'post');
			$city = JRequest::getVar('city', @$rowProfile->$mCity, 'post');
			$state = JRequest::getVar('state', @$rowProfile->$mState, 'post');
			$zip = JRequest::getVar('zip', @$rowProfile->$mZip, 'post');
			$country = JRequest::getVar('country', @$rowProfile->$mCountry, 'post');
			$phone = JRequest::getVar('phone', @$rowProfile->$mPhone, 'post');					
			$fax = JRequest::getVar('fax', @$rowProfile->$mFax, 'post');					
		} elseif (($userId > 0) && ($config->cb_integration == 2)) {
			//Read information from database
			$sql = 'SELECT cf.fieldcode , fv.value FROM #__community_fields AS cf '
				. ' INNER JOIN #__community_fields_values AS fv '
				. ' ON cf.id = fv.field_id '
				. ' WHERE fv.user_id = '.$userId 
			;				
			$db->setQuery($sql);			
			$rows = $db->loadObjectList();
			$fieldData = array() ;
			for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
				$row = $rows[$i] ;
				$fieldData["$row->fieldcode"] = $row->value ;
			}						
			$mFirstname = $config->m_firstname ?  $config->m_firstname : 'firstname';
			$mLastname = $config->m_lastname ? $config->m_lastname : 'lastname';
			$mOrganization = $config->m_organization ? $config->m_organization : 'organization' ;			
			$mAddress = $config->m_address ? $config->m_address : 'address';
			$mAddress2 = $config->m_address2 ? $config->m_address2 : 'address2' ;
			$mCity = $config->m_city ? $config->m_city : 'city' ;
			$mState = $config->m_state ? $config->m_state : 'state' ;
			$mZip = $config->m_zip ? $config->m_zip : 'zip' ;
			$mCountry = $config->m_country ? $config->m_country : 'country';
			$mPhone = $config->m_phone ? $config->m_phone : 'phone';
			$mFax = $config->m_fax ? $config->m_fax : 'fax' ;																				
			$firstName = JRequest::getVar('first_name', @$fieldData["$mFirstname"], 'post');
			$lastName = JRequest::getVar('last_name', @$fieldData["$mLastname"], 'post');
			$organization = JRequest::getVar('organization', @$fieldData["$mOrganization"], '');
			$address = JRequest::getVar('address', @$fieldData["$mAddress"], 'post');
			$address2 = JRequest::getVar('address2', @$fieldData["$mAddress2"], 'post');
			$city = JRequest::getVar('city', @$fieldData["$mCity"], 'post');
			$state = JRequest::getVar('state', @$fieldData["$mState"], 'post');
			$zip = JRequest::getVar('zip', @$fieldData["$mZip"], 'post');
			$country = JRequest::getVar('country', @$fieldData["$mCountry"], 'post');
			$phone = JRequest::getVar('phone', @$fieldData["$mPhone"], 'post');			
			$fax = JRequest::getVar('fax', @$fieldData["$mFax"], 'post');			
		} else {			
			$row = null ;
			if ($userId) {
				$sql = 'SELECT * FROM #__eb_registrants WHERE user_id = '.$userId .' AND first_name != "" ORDER BY id LIMIT 1';
				$db->setQuery($sql) ;
				$row = $db->loadObject();
				if (!$row) {
					$row = new stdClass ;
					$name = $user->name ;
					$pos = strpos($name, ' ') ;
					if ($pos !== false) {
						$row->first_name = substr($name, 0, $pos) ;
						$row->last_name = substr($name, $pos + 1) ;
					} else {
						$row->first_name = $name ;
					}
				}				
			}
			if (!$row) {
				$row = new stdClass() ;
			}
			$firstName = JRequest::getVar('first_name', @$row->first_name, 'post');
			$lastName = JRequest::getVar('last_name', @$row->last_name, 'post');
			$organization = JRequest::getVar('organization', @$row->organization, '');
			$address = JRequest::getVar('address', @$row->address, 'post');
			$address2 = JRequest::getVar('address2', @$row->address2, 'post');
			$city = JRequest::getVar('city', @$row->city, 'post');
			$state = JRequest::getVar('state', @$row->state, 'post');
			$zip = JRequest::getVar('zip', @$row->zip, 'post');
			$country = JRequest::getVar('country', @$row->country ? @$row->country : $config->default_country, 'post');
			$phone = JRequest::getVar('phone', @$row->phone, 'post');
			$fax = JRequest::getVar('fax', @$row->fax, 'post');
		}				
		$email = JRequest::getVar('email', $user->get('email'), 'post');
		$comment = JRequest::getVar('comment', '' ,'post');		
		$paymentMethod = JRequest::getVar('payment_method', os_payments::getDefautPaymentMethod(), 'post');				
		$x_card_num = JRequest::getVar('x_card_num', '', 'post');
		$expMonth =  JRequest::getVar('exp_month', date('m'), 'post') ;				
		$expYear = JRequest::getVar('exp_year', date('Y'), 'post') ;		
		$x_card_code = JRequest::getVar('x_card_code', '', 'post');
		$cardHolderName = JRequest::getVar('card_holder_name', '', 'post') ;
		$lists['exp_month'] = JHTML::_('select.integerlist', 1, 12, 1, 'exp_month', '', $expMonth, '%02d') ;
		$curentYear = date('Y') ;
		$lists['exp_year'] = JHTML::_('select.integerlist', $curentYear, $curentYear + 10 , 1, 'exp_year', '', $expYear) ;																							
		//Get list of country		
		$sql  = 'SELECT name AS value, name AS text FROM #__eb_countries WHERE published = 1 ORDER BY name';
		$db->setQuery($sql);
		$rowCountries = $db->loadObjectList();
		$options = array();
		$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_COUNTRY'));
		$options = array_merge($options, $rowCountries);	
		if ($config->display_state_dropdown) {
			$onChange = ' onchange="updateStateList();" ' ;
		} else {
			$onChange = '' ;
		}	
		$lists['country_list'] =  JHTML::_('select.genericlist', $options, 'country' , $onChange, 'value', 'text', $country);								
		//Custom fields feature		
		if (JRequest::getVar('first_name', '', 'post')) {
			//Back button pressed, don't load information from profile
			$loadFromProfile = false ;						
		} else {
			$loadFromProfile = true ;
		}		
		$jcFields = new JCFields($eventId, $loadFromProfile, 0);		
		if ($jcFields->getTotal()) {
			$customField = true ;
			$fields = $jcFields->renderCustomFields();
			$validations = $jcFields->renderJSValidation();
			$fieldsList = $jcFields->getFields();
			$fieldsOutput = $jcFields->getFieldsOutput();
			$this->assignRef('fieldsList', $fieldsList) ;
			$this->assignRef('fieldsOutput', $fieldsOutput) ;
			$this->assignRef('fields', $fields);
			$this->assignRef('validations', $validations) ;			
		} else {
			$customField = false ;
		}							
		$url = EventBookingHelper::getURL();		
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId ;
		$db->setQuery($sql) ;		
		$event = $db->loadObject();
		$params = new JParameter($event->params) ;
		$keys = array('s_lastname', 'r_lastname', 's_organization', 'r_organization', 's_address', 'r_address', 's_address2', 'r_address2', 's_city', 'r_city', 's_state', 'r_state', 's_zip', 'r_zip', 's_country', 'r_country', 's_phone', 'r_phone', 's_fax', 'r_fax', 's_comment', 'r_comment');
		foreach ($keys as $key) {
			$config->$key = $params->get($key, 0) ;
		}															
		$rate = $event->individual_price ;				
		$customFields =  new JCFields($eventId, false, false) ;
		$extraFee = $customFields->calculateFee($eventId) ;
		$totalAmount = $rate + $extraFee ;			
		$methods = os_payments::getPaymentMethods();
		//TODO: Get enabled card type from configuration function
		$options =  array() ;
		$options[] = JHTML::_('select.option', 'Visa', 'Visa') ;		 
		$options[] = JHTML::_('select.option', 'MasterCard', 'MasterCard') ;		 
		$options[] = JHTML::_('select.option', 'Discover', 'Discover') ;		 
		$options[] = JHTML::_('select.option', 'Amex', 'American Express') ;
		$lists['card_type'] = JHTML::_('select.genericlist', $options, 'card_type', ' class="inputbox" ', 'value', 'text') ;
		$couponCode = JRequest::getVar('coupon_code', '', 'post');		
		//$enableCoupon = !isset($_SESSION['coupon_id']) && $config->enable_coupon ;
		
		$enableCoupon = $config->enable_coupon ;
		
		$username = JRequest::getVar('username', '');
		$password = JRequest::getVar('password', '');
		$errorCoupon = JRequest::getVar('error_coupon', 0);
		$registrationErrorCode = JRequest::getVar('registration_error_code', 0);	

		$idealEnabled = EventBookingHelper::idealEnabled();
		if ($idealEnabled) {			
			$bankLists = EventBookingHelper::getBankLists() ;			
			$options = array() ;
			foreach ($bankLists as $bankId => $bankName) {
				$options[] = JHTML::_('select.option', $bankId, $bankName) ; 
			}	
			$lists['bank_id'] = JHTML::_('select.genericlist', $options, 'bank_id', ' class="inputbox" ', 'value', 'text', JRequest::getInt('bank_id'));				
		}
		//Displaying state dropdown
		if ($config->display_state_dropdown) {			
			//Get list of country and corresponding states
			$sql = 'SELECT country_id, CONCAT(state_2_code, ":", state_name) AS state_name FROM #__eb_states';
			$db->setQuery($sql) ;
			$rowStates = $db->loadObjectList();
			$states = array() ;
			for ($i = 0 , $n = count($rowStates) ; $i < $n ; $i++) {
				$rowState = $rowStates[$i] ;
				$states[$rowState->country_id][] = $rowState->state_name ;					
			}	
			$stateString = " var stateList = new Array();\n" ;					
			foreach ($states as $countryId => $stateArray) {
					$stateString .= " stateList[$countryId] = \"".implode(',', $stateArray)."\";\n" ;  
			}
			$this->assignRef('stateString', $stateString) ;
			$options = array() ;
			$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_STATE'), 'state_2_code', 'state_name') ;
			if ($country) {
				$sql = 'SELECT country_id FROM #__eb_countries WHERE LOWER(name)="'.JString::strtolower($country).'"';
				$db->setQuery($sql) ;
				$countryId = $db->loadResult();
				if ($countryId) {
					$sql = 'SELECT state_2_code, state_name FROM #__eb_states WHERE country_id='.$countryId;
					$db->setQuery($sql) ;
					$options = array_merge($options, $db->loadObjectList()) ;		
				}										
			}
			$lists['state'] = JHTML::_('select.genericlist', $options, 'state', ' class="inputbox" ', 'state_2_code', 'state_name', $state) ;
			$sql = 'SELECT country_id, name FROM #__eb_countries'; 
			$db->setQuery($sql) ;
			$rowCountries = $db->loadObjectList();
			$countryIdsString = " var countryIds = new Array(); \n" ;
			$countryNamesString = " var countryNames = new Array(); \n" ;
			$i = 0;
			foreach ($rowCountries as $rowCountry) {							
				$countryIdsString .= " countryIds[".$i."] = $rowCountry->country_id;\n" ;
				$countryNamesString .= " countryNames[".$i."]= \"$rowCountry->name\"\n" ;
				$i++ ;  	
			}
			$this->assignRef('countryIdsString', $countryIdsString) ;
			$this->assignRef('countryNamesString', $countryNamesString) ;			
		}		
		//Check to see whether we should show payment method
		$sql = 'SELECT COUNT(*) FROM #__eb_fields WHERE published=1 AND fee_field = 1 AND (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id='.$eventId.')) AND (display_in IN (0, 1, 3, 5))';
		$db->setQuery($sql) ;
		$numberFeeFields = (int)$db->loadResult();		
		##Add support for deposit payment
		if ($config->activate_deposit_feature && $event->deposit_amount > 0) {
		    $options = array() ;
    		$options[] = JHTML::_('select.option', 0, JText::_('EB_FULL_PAYMENT')) ;
    		$options[] = JHTML::_('select.option', 1, JText::_('EB_DEPOSIT_PAYMENT')) ;
    		$lists['payment_type'] = JHTML::_('select.genericlist', $options, 'payment_type', ' class="inputbox" ', 'value', 'text', JRequest::getInt('payment_type'), 0) ;
    		$depositPayment = 1 ;    		
		} else {
		    $depositPayment = 0 ;
		}											
		//Assign these parameters							
		$this->assignRef('userId', $userId) ;		
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
		$this->assignRef('email', $email);
		$this->assignRef('comment', $comment);
		$this->assignRef('paymentMethod', $paymentMethod);		
		$this->assignRef('lists', $lists);		
		$this->assignRef('Itemid', $Itemid);
		$this->assignRef('config', $config);								
		$this->assignRef('x_card_num', $x_card_num);
		$this->assignRef('x_card_code', $x_card_code);
		$this->assignRef('cardHolderName', $cardHolderName) ;						
		$this->assignRef('customField', $customField) ;		
		$this->assignRef('url', $url) ;			
		$this->assignRef('event', $event) ;			
		$this->assignRef('amount', $totalAmount) ;	
		$this->assignRef('methods', $methods) ;
		$this->assignRef('enableCoupon', $enableCoupon) ;
		$this->assignRef('couponCode', $couponCode) ;
		$this->assignRef('username', $username) ;
		$this->assignRef('password', $password) ;		
		$this->assignRef('errorCoupon', $errorCoupon) ;
		$this->assignRef('registrationErrorCode', $registrationErrorCode) ;
		$this->assignRef('userId', $userId) ;
		$this->assignRef('lists', $lists) ;
		$this->assignRef('idealEnabled', $idealEnabled) ;	
		$this->assignRef('numberFeeFields', $numberFeeFields) ;	
		$this->assignRef('depositPayment', $depositPayment) ;							
		parent::display($tpl); 
	}
	/**
	 * Display member forms so that users 
	 *
	 * @param string $tpl
	 */	
	function _displayMemberForm($tpl) {
		$Itemid = JRequest::getInt('Itemid') ;
		$db = & JFactory::getDBO() ;		
		$config = EventBookingHelper::getConfig() ;				
		$eventId = JRequest::getInt('event_id') ;
		$groupId = JRequest::getInt('group_id', 0) ;
		$numberRegistrants = JRequest::getInt('number_registrants', 0) ;
		$sql = 'SELECT title FROM #__eb_events WHERE id='.$eventId ;								
		$db->setQuery($sql) ;
		$eventTitle = $db->loadResult();		
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId;
		$db->setQuery($sql) ;
		$event = $db->loadObject();
		$country = JRequest::getVar('country', $config->default_country) ;
		$sql = 'SELECT name AS `value`, name AS `text` FROM #__eb_countries ORDER BY name';
		$db->setQuery($sql) ;
		$options = array() ;
		$options[] = JHTML::_('select.option', '', '') ;
		$options = array_merge($options, $db->loadObjectList()) ;	
		$lists['country_list'] = JHTML::_('select.genericlist', $options, 'country', ' class="inputbox" ', 'value', 'text', $country) ;
		$sql = 'SELECT COUNT(*) FROM #__eb_registrants WHERE group_id='.$groupId ;
		$db->setQuery($sql) ;
		$totalRegistrants = $db->loadResult();
		$currentMember = $totalRegistrants + 1 ;		
		$params = new JParameter($event->params) ;		
		$keys = array('gr_lastname', 'gr_lastname', 'gs_organization', 'gr_organization', 'gs_address', 'gr_address', 'gs_address2', 'gr_address2', 'gs_city', 'gr_city', 'gs_state', 'gr_state', 'gs_zip', 'gr_zip', 'gs_country', 'gr_country', 'gs_phone', 'gr_phone', 'gs_fax', 'gr_fax', 'gs_email', 'gr_email', 'gs_comment', 'gr_comment');
		foreach ($keys as $key) {
			$config->$key = $params->get($key, 0) ;
		}	
		//Finally, we need custom fields
		$jcFields = new JCFields($eventId, false, 2) ; 
		if ($jcFields->getTotal()) {
			$customField = true ;
			$fields = $jcFields->renderCustomFields() ;
			$customFieldValidation = $jcFields->renderJSValidation() ;									
			$this->assignRef('fields', $fields) ;
			$this->assignRef('customFieldValidation', $customFieldValidation) ;				
		} else {
			$customField = false ;
		}		
		$this->assignRef('config', $config) ;		
		$this->assignRef('eventId', $eventId) ;
		$this->assignRef('eventTitle', $eventTitle) ;
		$this->assignRef('groupId', $groupId) ;								
		$this->assignRef('Itemid', $Itemid) ;		
		$this->assignRef('lists', $lists) ;
		$this->assignRef('customField', $customField) ;
		$this->assignRef('currentMember', $currentMember) ;
		$this->assignRef('numberRegistrants', $numberRegistrants) ;
		parent::display($tpl);				
	}
	/**
	 * Display Group Form
	 *
	 * @param string $tpl
	 */
	function _displayGroupForm($tpl) {		
		$db = & JFactory::getDBO() ;
		$Itemid = JRequest::getInt('Itemid', 0) ;
		$config = EventBookingHelper::getConfig() ;		
		$eventId = JRequest::getInt('event_id', 0) ;				
		$totalRegistrants = EventBookingHelper::getTotalRegistrants($eventId) ;
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId ;
		$db->setQuery($sql) ;
		$rowEvent = $db->loadObject();
		$eventCapacity = (int) $rowEvent->event_capacity ;
		$maxGroupNumber = (int) $rowEvent->max_group_number ;
		if ($eventCapacity) 
			$maxRegistrants = $eventCapacity - $totalRegistrants ;
		else
			$maxRegistrants = -1 ;	
		if ($maxGroupNumber) {
			if ($maxRegistrants == -1) {
				$maxRegistrants = $maxGroupNumber ;		
			} else {
				$maxRegistrants = $maxRegistrants > $maxGroupNumber ? $maxGroupNumber : $maxRegistrants ;
			}
		}
		$collectMemberInformation = EventBookingHelper::getConfigValue('collect_member_information');		
		$this->assignRef('eventId', $eventId) ;
		$this->assignRef('config', $config) ;
		$this->assignRef('maxRegistrants', $maxRegistrants) ;
		$this->assignRef('Itemid', $Itemid) ;		
		$this->assignRef('collectMemberInformation', $collectMemberInformation) ;
		parent::display($tpl) ;	
	}	
	/**
	 * Display billing page for group member
	 *
	 * @params string $tpl
	 */	
	function _displayGroupBillingForm($tpl) {
		$Itemid = JRequest::getInt('Itemid');
		$db = & JFactory::getDBO();
		$document = & JFactory::getDocument() ;
		$document->addScript(JURI::base(true).'/components/com_eventbooking/assets/js/paymentmethods.js');
		$user = & JFactory::getUser();		
		$userId = $user->get('id');
		$config = EventBookingHelper::getConfig() ;	
		$eventId = JRequest::getInt('event_id', 0) ;		
		$groupId = JRequest::getInt('group_id', 0) ;
		//Init data on the form			
		if (($userId > 0) && ($config->cb_integration == 1)) {
			$sql = 'SELECT * FROM #__comprofiler WHERE user_id='.$userId;
			$db->setQuery($sql);
			$rowProfile = $db->loadObject();
			$mFirstname = $config->m_firstname ? $config->m_firstname : 'cb_firstname' ;			
			$mLastname = $config->m_lastname ? $config->m_lastname : 'cb_lastname';
			$mOrganization = $config->m_organization ? $config->m_organization : 'cb_organization' ;
			$mAddress = $config->m_address ? $config->m_address : 'cb_address';			
			$mAddress2 = $config->m_address2 ? $config->m_address2 : 'cb_address2';
			$mCity = $config->m_city  ? $config->m_city : 'cb_city';
			$mState = $config->m_state ? $config->m_state : 'cb_state' ;
			$mZip = $config->m_zip ? $config->m_zip : 'cb_zip';
			$mCountry = $config->m_country ? $config->m_country : 'cb_country';
			$mPhone = $config->m_phone ? $config->m_phone : 'cb_phone' ;
			$mFax = $config->m_fax ? $config->m_fax : 'cb_fax' ;																
			$firstName = JRequest::getVar('first_name', @$rowProfile->$mFirstname, 'post');
			$lastName = JRequest::getVar('last_name', @$rowProfile->$mLastname, 'post');
			$organization = JRequest::getVar('organization', @$rowProfile->$mOrganization, '');
			$address = JRequest::getVar('address', @$rowProfile->$mAddress, 'post');
			$address2 = JRequest::getVar('address2', @$rowProfile->$mAddress2, 'post');
			$city = JRequest::getVar('city', @$rowProfile->$mCity, 'post');
			$state = JRequest::getVar('state', @$rowProfile->$mState, 'post');
			$zip = JRequest::getVar('zip', @$rowProfile->$mZip, 'post');
			$country = JRequest::getVar('country', @$rowProfile->$mCountry, 'post');
			$phone = JRequest::getVar('phone', @$rowProfile->$mPhone, 'post');					
			$fax = JRequest::getVar('fax', @$rowProfile->$mFax, 'post');					
		} elseif (($userId > 0) && ($config->cb_integration == 2)) {
			//Read information from database
			$sql = 'SELECT cf.fieldcode , fv.value FROM #__community_fields AS cf '
				. ' INNER JOIN #__community_fields_values AS fv '
				. ' ON cf.id = fv.field_id '
				. ' WHERE fv.user_id = '.$userId 
			;				
			$db->setQuery($sql);			
			$rows = $db->loadObjectList();
			$fieldData = array() ;
			for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
				$row = $rows[$i] ;
				$fieldData["$row->fieldcode"] = $row->value ;
			}						
			$mFirstname = $config->m_firstname ?  $config->m_firstname : 'firstname';
			$mLastname = $config->m_lastname ? $config->m_lastname : 'lastname';
			$mOrganization = $config->m_organization ? $config->m_organization : 'organization' ;			
			$mAddress = $config->m_address ? $config->m_address : 'address';
			$mAddress2 = $config->m_address2 ? $config->m_address2 : 'address2' ;
			$mCity = $config->m_city ? $config->m_city : 'city' ;
			$mState = $config->m_state ? $config->m_state : 'state' ;
			$mZip = $config->m_zip ? $config->m_zip : 'zip' ;
			$mCountry = $config->m_country ? $config->m_country : 'country';
			$mPhone = $config->m_phone ? $config->m_phone : 'phone';
			$mFax = $config->m_fax ? $config->m_fax : 'fax' ;																				
			$firstName = JRequest::getVar('first_name', @$fieldData["$mFirstname"], 'post');
			$lastName = JRequest::getVar('last_name', @$fieldData["$mLastname"], 'post');
			$organization = JRequest::getVar('organization', @$fieldData["$mOrganization"], '');
			$address = JRequest::getVar('address', @$fieldData["$mAddress"], 'post');
			$address2 = JRequest::getVar('address2', @$fieldData["$mAddress2"], 'post');
			$city = JRequest::getVar('city', @$fieldData["$mCity"], 'post');
			$state = JRequest::getVar('state', @$fieldData["$mState"], 'post');
			$zip = JRequest::getVar('zip', @$fieldData["$mZip"], 'post');
			$country = JRequest::getVar('country', @$fieldData["$mCountry"], 'post');
			$phone = JRequest::getVar('phone', @$fieldData["$mPhone"], 'post');			
			$fax = JRequest::getVar('fax', @$fieldData["$mFax"], 'post');			
		} else {			
			$row = null ;
			if ($userId) {
				$sql = 'SELECT * FROM #__eb_registrants WHERE user_id = '.$userId .' AND first_name != "" ORDER BY id LIMIT 1';
				$db->setQuery($sql) ;
				$row = $db->loadObject();
				if (!$row) {
					$row = new stdClass ;
					$name = $user->name ;
					$pos = strpos($name, ' ') ;
					if ($pos !== false) {
						$row->first_name = substr($name, 0, $pos) ;
						$row->last_name = substr($name, $pos + 1) ;
					} else {
						$row->first_name = $name ;
					}
				}				
			}
			if (!$row) {
				$row = new stdClass() ;
			}
			$firstName = JRequest::getVar('first_name', @$row->first_name, 'post');
			$lastName = JRequest::getVar('last_name', @$row->last_name, 'post');
			$organization = JRequest::getVar('organization', @$row->organization, '');
			$address = JRequest::getVar('address', @$row->address, 'post');
			$address2 = JRequest::getVar('address2', @$row->address2, 'post');
			$city = JRequest::getVar('city', @$row->city, 'post');
			$state = JRequest::getVar('state', @$row->state, 'post');
			$zip = JRequest::getVar('zip', @$row->zip, 'post');
			$country = JRequest::getVar('country', @$row->country ? @$row->country : $config->default_country, 'post');
			$phone = JRequest::getVar('phone', @$row->phone, 'post');
			$fax = JRequest::getVar('fax', @$row->fax, 'post');
		}				
		$email = JRequest::getVar('email', $user->get('email'), 'post');
		$comment = JRequest::getVar('comment', '' ,'post');		
		$paymentMethod = JRequest::getVar('payment_method', os_payments::getDefautPaymentMethod() , 'post');				
		$x_card_num = JRequest::getVar('x_card_num', '', 'post');
		$expMonth =  JRequest::getVar('exp_month', date('m'), 'post') ;				
		$expYear = JRequest::getVar('exp_year', date('Y'), 'post') ;		
		$x_card_code = JRequest::getVar('x_card_code', '', 'post');
		$cardHolderName = JRequest::getVar('card_holder_name', '', 'post') ;
		$lists['exp_month'] = JHTML::_('select.integerlist', 1, 12, 1, 'exp_month', '', $expMonth, '%02d') ;
		$curentYear = date('Y') ;
		$lists['exp_year'] = JHTML::_('select.integerlist', $curentYear, $curentYear + 10 , 1, 'exp_year', '', $expYear) ;																							
		//Get list of country		
		$sql  = 'SELECT name AS value, name AS text FROM #__eb_countries WHERE published = 1 ORDER BY name';
		$db->setQuery($sql);
		$rowCountries = $db->loadObjectList();
		$options = array();
		$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_COUNTRY'));
		$options = array_merge($options, $rowCountries);	
		if ($config->display_state_dropdown) {
			$onChange = ' onchange="updateStateList();" ' ;
		} else {
			$onChange = '' ;
		}	
		$lists['country_list'] =  JHTML::_('select.genericlist', $options, 'country' , $onChange, 'value', 'text', $country);								
		//Custom fields feature		
		if (JRequest::getVar('first_name', '', 'post')) {
			//Back button pressed, don't load information from profile
			$loadFromProfile = false ;						
		} else {
			$loadFromProfile = true ;
		}		
		$jcFields = new JCFields($eventId, $loadFromProfile, 1);		
		if ($jcFields->getTotal()) {
			$customField = true ;
			$fields = $jcFields->renderCustomFields();
			$validations = $jcFields->renderJSValidation();
			$fieldsList = $jcFields->getFields();
			$fieldsOutput = $jcFields->getFieldsOutput();
			$this->assignRef('fieldsList', $fieldsList) ;
			$this->assignRef('fieldsOutput', $fieldsOutput) ;
			$this->assignRef('fields', $fields);
			$this->assignRef('validations', $validations) ;			
		} else {
			$customField = false ;
		}								
		$url = EventBookingHelper::getURL() ;		
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId ;
		$db->setQuery($sql) ;		
		$event = $db->loadObject();
		$params = new JParameter($event->params) ;
		$keys = array('s_lastname', 'r_lastname', 's_organization', 'r_organization', 's_address', 'r_address', 's_address2', 'r_address2', 's_city', 'r_city', 's_state', 'r_state', 's_zip', 'r_zip', 's_country', 'r_country', 's_phone', 'r_phone', 's_fax', 'r_fax', 's_comment', 'r_comment');
		foreach ($keys as $key) {
			$config->$key = $params->get($key, 0) ;
		}														
		//Get total registrants
		$sql = 'SELECT COUNT(*) FROM #__eb_registrants WHERE group_id='.$groupId ;
		$db->setQuery($sql) ;
		$numberRegistrants = $db->loadResult();
		$rate = EventBookingHelper::getRegistrationRate($eventId, $numberRegistrants) ;				
		$customFields =  new JCFields($eventId, false, true) ;
		$extraFee = $customFields->canculateGroupFee($groupId) ;
		$totalAmount = $rate*$numberRegistrants + $extraFee ;
		
		$methods = os_payments::getPaymentMethods();				
				
		//TODO: Get enabled card type from configuration function
		$options =  array() ;
		$options[] = JHTML::_('select.option', 'Visa', 'Visa') ;		 
		$options[] = JHTML::_('select.option', 'MasterCard', 'MasterCard') ;		 
		$options[] = JHTML::_('select.option', 'Discover', 'Discover') ;		 
		$options[] = JHTML::_('select.option', 'Amex', 'American Express') ;
		$lists['card_type'] = JHTML::_('select.genericlist', $options, 'card_type', ' class="inputbox" ', 'value', 'text') ;
		$couponCode = JRequest::getVar('coupon_code', '', 'post');
		//$enableCoupon = !isset($_SESSION['coupon_id']) && $config->enable_coupon ;
		
		$enableCoupon = $config->enable_coupon ;
		
		$username = JRequest::getVar('username', '');
		$password = JRequest::getVar('password', '');
		$errorCoupon = JRequest::getVar('error_coupon', 0);
		$registrationErrorCode = JRequest::getVar('registration_error_code', 0);
		
		$idealEnabled = EventBookingHelper::idealEnabled();
		if ($idealEnabled) {			
			$bankLists = EventBookingHelper::getBankLists() ;			
			$options = array() ;
			foreach ($bankLists as $bankId => $bankName) {
				$options[] = JHTML::_('select.option', $bankId, $bankName) ; 
			}	
			$lists['bank_id'] = JHTML::_('select.genericlist', $options, 'bank_id', ' class="inputbox" ', 'value', 'text', JRequest::getInt('bank_id'));				
		}
		
		
		if ($config->display_state_dropdown) {			
			//Get list of country and corresponding states
			$sql = 'SELECT country_id, CONCAT(state_2_code, ":", state_name) AS state_name FROM #__eb_states';
			$db->setQuery($sql) ;
			$rowStates = $db->loadObjectList();
			$states = array() ;
			for ($i = 0 , $n = count($rowStates) ; $i < $n ; $i++) {
				$rowState = $rowStates[$i] ;
				$states[$rowState->country_id][] = $rowState->state_name ;					
			}	
			$stateString = " var stateList = new Array();\n" ;					
			foreach ($states as $countryId => $stateArray) {
					$stateString .= " stateList[$countryId] = \"".implode(',', $stateArray)."\";\n" ;  
			}
			$this->assignRef('stateString', $stateString) ;
			$options = array() ;
			$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_STATE'), 'state_2_code', 'state_name') ;
			if ($country) {
				$sql = 'SELECT country_id FROM #__eb_countries WHERE LOWER(name)="'.JString::strtolower($country).'"';
				$db->setQuery($sql) ;
				$countryId = $db->loadResult();
				if ($countryId) {
					$sql = 'SELECT state_2_code, state_name FROM #__eb_states WHERE country_id='.$countryId;
					$db->setQuery($sql) ;
					$options = array_merge($options, $db->loadObjectList()) ;		
				}										
			}
			$lists['state'] = JHTML::_('select.genericlist', $options, 'state', ' class="inputbox" ', 'state_2_code', 'state_name', $state) ;
			$sql = 'SELECT country_id, name FROM #__eb_countries'; 
			$db->setQuery($sql) ;
			$rowCountries = $db->loadObjectList();
			$countryIdsString = " var countryIds = new Array(); \n" ;
			$countryNamesString = " var countryNames = new Array(); \n" ;
			$i = 0;
			foreach ($rowCountries as $rowCountry) {							
				$countryIdsString .= " countryIds[".$i."] = $rowCountry->country_id;\n" ;
				$countryNamesString .= " countryNames[".$i."]= \"$rowCountry->name\"\n" ;
				$i++ ;  	
			}
			$this->assignRef('countryIdsString', $countryIdsString) ;
			$this->assignRef('countryNamesString', $countryNamesString) ;			
		}					

		//Check to see whether we should show payment method
		$sql = 'SELECT COUNT(*) FROM #__eb_fields WHERE published=1 AND fee_field = 1 AND (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id='.$eventId.')) AND (display_in IN (0, 2, 3))';
		$db->setQuery($sql) ;
		$numberFeeFields = (int)$db->loadResult();		

		
		##Add support for deposit payment
		if ($config->activate_deposit_feature && $event->deposit_amount > 0) {
		    $options = array() ;
    		$options[] = JHTML::_('select.option', 0, JText::_('EB_FULL_PAYMENT')) ;
    		$options[] = JHTML::_('select.option', 1, JText::_('EB_DEPOSIT_PAYMENT')) ;
    		$lists['payment_type'] = JHTML::_('select.genericlist', $options, 'payment_type', ' class="inputbox" ', 'value', 'text', JRequest::getInt('payment_type'), 0) ;
    		$depositPayment = 1 ;    		
		} else {
		    $depositPayment = 0 ;
		}	
		
		//Assign these parameters								
		$this->assignRef('userId', $userId) ;		
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
		$this->assignRef('email', $email);
		$this->assignRef('comment', $comment);
		$this->assignRef('paymentMethod', $paymentMethod);
		$this->assignRef('amount', $totalAmount);		
		$this->assignRef('lists', $lists);		
		$this->assignRef('Itemid', $Itemid);
		$this->assignRef('config', $config);								
		$this->assignRef('x_card_num', $x_card_num);
		$this->assignRef('x_card_code', $x_card_code);
		$this->assignRef('cardHolderName', $cardHolderName) ;						
		$this->assignRef('customField', $customField) ;			
		$this->assignRef('url', $url) ;			
		$this->assignRef('event', $event) ;		
		$this->assignRef('groupId', $groupId) ;	
		$this->assignRef('methods', $methods) ;		
		$this->assignRef('couponCode', $couponCode) ;								
		$this->assignRef('enableCoupon', $enableCoupon) ;
		$this->assignRef('username', $username) ;
		$this->assignRef('password', $password) ;	
		$this->assignRef('userId', $userId) ;
		$this->assignRef('errorCoupon', $errorCoupon) ;
		$this->assignRef('registrationErrorCode', $registrationErrorCode) ;
		$this->assignRef('idealEnabled', $idealEnabled) ;
		$this->assignRef('lists', $lists) ;
		$this->assignRef('numberFeeFields', $numberFeeFields) ;
		$this->assignRef('depositPayment', $depositPayment) ;					
		parent::display($tpl);					
	}
	/**
	 * 
	 * Display registration page for cart
	 * @param string $tpl
	 */
	function _displayCart($tpl) {
		$mainframe = & JFactory::getApplication() ;
		$Itemid = JRequest::getInt('Itemid');
		$db = & JFactory::getDBO();
		$document = & JFactory::getDocument() ;
		$document->addScript(JURI::base(true).'/components/com_eventbooking/assets/js/paymentmethods.js');
		$user = & JFactory::getUser();		
		$userId = $user->get('id');
		$config = EventBookingHelper::getConfig() ;		
		require_once JPATH_COMPONENT.DS.'helper'.DS.'os_cart.php';
		$cart = new EBCart() ;
		$items = $cart->getItems();			
		if (!count($items)) {
			$url = JRoute::_('index.php?option=com_eventbooking&Itemid='.$Itemid);
			$mainframe->redirect($url, JText::_('EB_NO_EVENTS_FOR_CHECKOUT'));				
		}			
		//Init data on the form			
		if (($userId > 0) && ($config->cb_integration == 1)) {
			$sql = 'SELECT * FROM #__comprofiler WHERE user_id='.$userId;
			$db->setQuery($sql);
			$rowProfile = $db->loadObject();
			$mFirstname = $config->m_firstname ? $config->m_firstname : 'cb_firstname' ;			
			$mLastname = $config->m_lastname ? $config->m_lastname : 'cb_lastname';
			$mOrganization = $config->m_organization ? $config->m_organization : 'cb_organization' ;
			$mAddress = $config->m_address ? $config->m_address : 'cb_address';			
			$mAddress2 = $config->m_address2 ? $config->m_address2 : 'cb_address2';
			$mCity = $config->m_city  ? $config->m_city : 'cb_city';
			$mState = $config->m_state ? $config->m_state : 'cb_state' ;
			$mZip = $config->m_zip ? $config->m_zip : 'cb_zip';
			$mCountry = $config->m_country ? $config->m_country : 'cb_country';
			$mPhone = $config->m_phone ? $config->m_phone : 'cb_phone' ;
			$mFax = $config->m_fax ? $config->m_fax : 'cb_fax' ;																
			$firstName = JRequest::getVar('first_name', @$rowProfile->$mFirstname, 'post');
			$lastName = JRequest::getVar('last_name', @$rowProfile->$mLastname, 'post');
			$organization = JRequest::getVar('organization', @$rowProfile->$mOrganization, '');
			$address = JRequest::getVar('address', @$rowProfile->$mAddress, 'post');
			$address2 = JRequest::getVar('address2', @$rowProfile->$mAddress2, 'post');
			$city = JRequest::getVar('city', @$rowProfile->$mCity, 'post');
			$state = JRequest::getVar('state', @$rowProfile->$mState, 'post');
			$zip = JRequest::getVar('zip', @$rowProfile->$mZip, 'post');
			$country = JRequest::getVar('country', @$rowProfile->$mCountry, 'post');
			$phone = JRequest::getVar('phone', @$rowProfile->$mPhone, 'post');					
			$fax = JRequest::getVar('fax', @$rowProfile->$mFax, 'post');					
		} elseif (($userId > 0) && ($config->cb_integration == 2)) {
			//Read information from database
			$sql = 'SELECT cf.fieldcode , fv.value FROM #__community_fields AS cf '
				. ' INNER JOIN #__community_fields_values AS fv '
				. ' ON cf.id = fv.field_id '
				. ' WHERE fv.user_id = '.$userId 
			;				
			$db->setQuery($sql);			
			$rows = $db->loadObjectList();
			$fieldData = array() ;
			for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
				$row = $rows[$i] ;
				$fieldData["$row->fieldcode"] = $row->value ;
			}						
			$mFirstname = $config->m_firstname ?  $config->m_firstname : 'firstname';
			$mLastname = $config->m_lastname ? $config->m_lastname : 'lastname';
			$mOrganization = $config->m_organization ? $config->m_organization : 'organization' ;			
			$mAddress = $config->m_address ? $config->m_address : 'address';
			$mAddress2 = $config->m_address2 ? $config->m_address2 : 'address2' ;
			$mCity = $config->m_city ? $config->m_city : 'city' ;
			$mState = $config->m_state ? $config->m_state : 'state' ;
			$mZip = $config->m_zip ? $config->m_zip : 'zip' ;
			$mCountry = $config->m_country ? $config->m_country : 'country';
			$mPhone = $config->m_phone ? $config->m_phone : 'phone';
			$mFax = $config->m_fax ? $config->m_fax : 'fax' ;																				
			$firstName = JRequest::getVar('first_name', @$fieldData["$mFirstname"], 'post');
			$lastName = JRequest::getVar('last_name', @$fieldData["$mLastname"], 'post');
			$organization = JRequest::getVar('organization', @$fieldData["$mOrganization"], '');
			$address = JRequest::getVar('address', @$fieldData["$mAddress"], 'post');
			$address2 = JRequest::getVar('address2', @$fieldData["$mAddress2"], 'post');
			$city = JRequest::getVar('city', @$fieldData["$mCity"], 'post');
			$state = JRequest::getVar('state', @$fieldData["$mState"], 'post');
			$zip = JRequest::getVar('zip', @$fieldData["$mZip"], 'post');
			$country = JRequest::getVar('country', @$fieldData["$mCountry"], 'post');
			$phone = JRequest::getVar('phone', @$fieldData["$mPhone"], 'post');			
			$fax = JRequest::getVar('fax', @$fieldData["$mFax"], 'post');			
		} else {			
			$row = null ;
			if ($userId) {
				$sql = 'SELECT * FROM #__eb_registrants WHERE user_id = '.$userId .' AND first_name != "" ORDER BY id LIMIT 1';
				$db->setQuery($sql) ;
				$row = $db->loadObject();	
				if (!$row) {
					$row = new stdClass ;
					$name = $user->name ;
					$pos = strpos($name, ' ') ;
					if ($pos !== false) {
						$row->first_name = substr($name, 0, $pos) ;
						$row->last_name = substr($name, $pos + 1) ;
					} else {
						$row->first_name = $name ;
					}
				}			
			}
			if (!$row) {
				$row = new stdClass() ;
			}
			$firstName = JRequest::getVar('first_name', @$row->first_name, 'post');
			$lastName = JRequest::getVar('last_name', @$row->last_name, 'post');
			$organization = JRequest::getVar('organization', @$row->organization, '');
			$address = JRequest::getVar('address', @$row->address, 'post');
			$address2 = JRequest::getVar('address2', @$row->address2, 'post');
			$city = JRequest::getVar('city', @$row->city, 'post');
			$state = JRequest::getVar('state', @$row->state, 'post');
			$zip = JRequest::getVar('zip', @$row->zip, 'post');
			$country = JRequest::getVar('country', @$row->country ? @$row->country : $config->default_country, 'post');
			$phone = JRequest::getVar('phone', @$row->phone, 'post');
			$fax = JRequest::getVar('fax', @$row->fax, 'post');
		}				
		$email = JRequest::getVar('email', $user->get('email'), 'post');
		$comment = JRequest::getVar('comment', '' ,'post');		
		$paymentMethod = JRequest::getVar('payment_method', os_payments::getDefautPaymentMethod() , 'post');				
		$x_card_num = JRequest::getVar('x_card_num', '', 'post');
		$expMonth =  JRequest::getVar('exp_month', date('m'), 'post') ;				
		$expYear = JRequest::getVar('exp_year', date('Y'), 'post') ;		
		$x_card_code = JRequest::getVar('x_card_code', '', 'post');
		$cardHolderName = JRequest::getVar('card_holder_name', '', 'post') ;
		$lists['exp_month'] = JHTML::_('select.integerlist', 1, 12, 1, 'exp_month', '', $expMonth, '%02d') ;
		$curentYear = date('Y') ;
		$lists['exp_year'] = JHTML::_('select.integerlist', $curentYear, $curentYear + 10 , 1, 'exp_year', '', $expYear) ;																							
		//Get list of country		
		$sql  = 'SELECT name AS value, name AS text FROM #__eb_countries WHERE published = 1 ORDER BY name';
		$db->setQuery($sql);
		$rowCountries = $db->loadObjectList();
		$options = array();
		$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_COUNTRY'));
		$options = array_merge($options, $rowCountries);		
		if ($config->display_state_dropdown) {
			$onChange = ' onchange="updateStateList();" ' ;
		} else {
			$onChange = '' ;
		}	
		$lists['country_list'] =  JHTML::_('select.genericlist', $options, 'country' , $onChange, 'value', 'text', $country);									
		//Custom fields feature

		$url = EventBookingHelper::getURL() ;
																									
		$methods = os_payments::getPaymentMethods();							
		//TODO: Get enabled card type from configuration function
		$options =  array() ;
		$options[] = JHTML::_('select.option', 'Visa', 'Visa') ;		 
		$options[] = JHTML::_('select.option', 'MasterCard', 'MasterCard') ;		 
		$options[] = JHTML::_('select.option', 'Discover', 'Discover') ;		 
		$options[] = JHTML::_('select.option', 'Amex', 'American Express') ;
		$lists['card_type'] = JHTML::_('select.genericlist', $options, 'card_type', ' class="inputbox" ', 'value', 'text') ;
		$couponCode = JRequest::getVar('coupon_code', '', 'post');				
		$enableCoupon = $config->enable_coupon ;		
		$username = JRequest::getVar('username', '');
		$password = JRequest::getVar('password', '');
		$errorCoupon = JRequest::getVar('error_coupon', 0);
		$registrationErrorCode = JRequest::getVar('registration_error_code', 0);		
		$idealEnabled = EventBookingHelper::idealEnabled();
		if ($idealEnabled) {			
			$bankLists = EventBookingHelper::getBankLists() ;			
			$options = array() ;
			foreach ($bankLists as $bankId => $bankName) {
				$options[] = JHTML::_('select.option', $bankId, $bankName) ; 
			}	
			$lists['bank_id'] = JHTML::_('select.genericlist', $options, 'bank_id', ' class="inputbox" ', 'value', 'text', JRequest::getInt('bank_id'));				
		}																
		$events = $cart->getEvents();
		$totalAmount = $cart->calculateTotal();			
		$discount = $cart->calculateTotalDiscount() ;		
		$amount = $totalAmount - $discount ;	

		if ($config->enable_tax && $config->tax_rate > 0) {
		    $taxAmount =  round($amount*$config->tax_rate/100, 2) ;
		} else {
		    $taxAmount = 0 ;
		}

		$sql = 'SELECT title FROM #__eb_events WHERE id IN ('.implode(',', $items).') ORDER BY FIND_IN_SET(id, "'.implode(',', $items).'")';
		$db->setQuery($sql) ;
		$eventTitles = $db->loadResultArray();		
		$eventTitle = implode(', ', $eventTitles);					

		
		if ($config->display_state_dropdown) {			
			//Get list of country and corresponding states
			$sql = 'SELECT country_id, CONCAT(state_2_code, ":", state_name) AS state_name FROM #__eb_states';
			$db->setQuery($sql) ;
			$rowStates = $db->loadObjectList();
			$states = array() ;
			for ($i = 0 , $n = count($rowStates) ; $i < $n ; $i++) {
				$rowState = $rowStates[$i] ;
				$states[$rowState->country_id][] = $rowState->state_name ;					
			}	
			$stateString = " var stateList = new Array();\n" ;					
			foreach ($states as $countryId => $stateArray) {
					$stateString .= " stateList[$countryId] = \"".implode(',', $stateArray)."\";\n" ;  
			}
			$this->assignRef('stateString', $stateString) ;
			$options = array() ;
			$options[] = JHTML::_('select.option', '', JText::_('EB_SELECT_STATE'), 'state_2_code', 'state_name') ;
			if ($country) {
				$sql = 'SELECT country_id FROM #__eb_countries WHERE LOWER(name)="'.JString::strtolower($country).'"';
				$db->setQuery($sql) ;
				$countryId = $db->loadResult();
				if ($countryId) {
					$sql = 'SELECT state_2_code, state_name FROM #__eb_states WHERE country_id='.$countryId;
					$db->setQuery($sql) ;
					$options = array_merge($options, $db->loadObjectList()) ;		
				}										
			}
			$lists['state'] = JHTML::_('select.genericlist', $options, 'state', ' class="inputbox" ', 'state_2_code', 'state_name', $state) ;
			$sql = 'SELECT country_id, name FROM #__eb_countries' ; 
			$db->setQuery($sql) ;
			$rowCountries = $db->loadObjectList();
			$countryIdsString = " var countryIds = new Array(); \n" ;
			$countryNamesString = " var countryNames = new Array(); \n" ;
			$i = 0;
			foreach ($rowCountries as $rowCountry) {							
				$countryIdsString .= " countryIds[".$i."] = $rowCountry->country_id;\n" ;
				$countryNamesString .= " countryNames[".$i."]= \"$rowCountry->name\"\n" ;
				$i++ ;  	
			}
			$this->assignRef('countryIdsString', $countryIdsString) ;
			$this->assignRef('countryNamesString', $countryNamesString) ;			
		}			

		#Add suppport for custom fields for multiple booking
		if (JRequest::getVar('first_name', '', 'post')) {
			//Back button pressed, don't load information from profile
			$loadFromProfile = false ;						
		} else {
			$loadFromProfile = true ;
		}		
		$jcFields = new JCFields(0, $loadFromProfile, 4);		
		if ($jcFields->getTotal()) {			
			$customField = true ;
			$fields = $jcFields->renderCustomFields();
			$validations = $jcFields->renderJSValidation();
			$fieldsList = $jcFields->getFields();
			$fieldsOutput = $jcFields->getFieldsOutput();
			$this->assignRef('fieldsList', $fieldsList) ;
			$this->assignRef('fieldsOutput', $fieldsOutput) ;
			$this->assignRef('fields', $fields);
			$this->assignRef('validations', $validations) ;			
		} else {
			$customField = false ;
		}		

		$sql = 'SELECT COUNT(*) FROM #__eb_fields WHERE published=1 AND fee_field = 1 AND (event_id = -1 OR id IN ('.implode(',', $items).'))';										
		$db->setQuery($sql) ;		
		$numberFeeFields = $db->loadResult() ;					
		//Assign these parameters								
		$this->assignRef('userId', $userId) ;		
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
		$this->assignRef('email', $email);
		$this->assignRef('comment', $comment);
		$this->assignRef('paymentMethod', $paymentMethod);
		$this->assignRef('amount', $amount);		
		$this->assignRef('lists', $lists);		
		$this->assignRef('Itemid', $Itemid);
		$this->assignRef('config', $config);								
		$this->assignRef('x_card_num', $x_card_num);
		$this->assignRef('x_card_code', $x_card_code);
		$this->assignRef('cardHolderName', $cardHolderName) ;										
		$this->assignRef('url', $url) ;					
		$this->assignRef('methods', $methods) ;		
		$this->assignRef('couponCode', $couponCode) ;								
		$this->assignRef('enableCoupon', $enableCoupon) ;
		$this->assignRef('username', $username) ;
		$this->assignRef('password', $password) ;	
		$this->assignRef('userId', $userId) ;
		$this->assignRef('errorCoupon', $errorCoupon) ;
		$this->assignRef('registrationErrorCode', $registrationErrorCode) ;
		$this->assignRef('idealEnabled', $idealEnabled) ;
		$this->assignRef('lists', $lists) ;
		$this->assignRef('items', $events) ;		
		$this->assignRef('discount', $discount) ;
		$this->assignRef('eventTitle', $eventTitle) ;
		$this->assignRef('customField', $customField) ;
		$this->assignRef('numberFeeFields', $numberFeeFields) ;	
		$this->assignRef('taxAmount', $taxAmount) ;			
		parent::display($tpl) ;
	}
}