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
class EventBookingViewWaitinglist extends JView
{
	/**
	 * Display interface to user
	 *
	 * @param string $tpl
	 */
	function display($tpl = null)
	{			 
	    $Itemid = JRequest::getInt('Itemid');
	    $config = EventBookingHelper::getConfig() ;
        $layout = $this->getLayout() ;
        if ($layout == 'complete') {
            $this->_displayComplete($tpl) ;
            return ;
        }    	    
		$db = & JFactory::getDBO() ;		
		$eventId = JRequest::getInt('event_id', 0);								
		$sql = 'SELECT * FROM #__eb_events WHERE id='.$eventId ;
		$db->setQuery($sql) ;
		$event = $db->loadObject() ;
						
		$user = & JFactory::getUser();		
		$userId = $user->get('id');
		
						
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
				$sql = 'SELECT * FROM #__eb_registrants WHERE user_id = '.$userId .' ORDER BY id LIMIT 1';
				$db->setQuery($sql) ;
				$row = $db->loadObject();				
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
		$this->assignRef('lists', $lists);		
		$this->assignRef('Itemid', $Itemid);
		$this->assignRef('config', $config);												
		$this->assignRef('event', $event) ;							
		$this->assignRef('lists', $lists) ;								
		parent::display($tpl); 							
	}	
	/**
	 * Display payment complete page
	 * 
	 * @param string $tpl
	 */
	function _displayComplete($tpl) {
	    $db = & JFactory::getDBO() ;
	    $id = JRequest::getInt('id', 0);
	    $sql = 'SELECT a.* , b.title FROM #__eb_waiting_lists AS a LEFT JOIN #__eb_events AS b ON a.event_id = b.id WHERE a.id='.$id;
	    $db->setQuery($sql) ;
	    $row = $db->loadObject() ;	    
	    $config = EventBookingHelper::getConfig() ;
	    $message = $config->waitinglist_complete_message ;
	    	    	    	   
	    $replaces = array() ;		
		$replaces['event_title'] = $row->title ;				
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
	    foreach ($replaces as $key=>$value) {
			$key = strtoupper($key) ;
			$message = str_replace("[$key]", $value, $message) ;
		}	    
		$this->assignRef('message', $message) ;
			    
	    parent::display($tpl) ;
	}
}