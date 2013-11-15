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

class os_offline extends os_payment {	
	/**
	 * Constructor functions, init some parameter
	 *
	 * @param object $params
	 */
	function os_offline($params) {
		parent::setName('os_offline');		
		parent::os_payment();				
		parent::setCreditCard(false);		
    	parent::setCardType(false);
    	parent::setCardCvv(false);
    	parent::setCardHolderName(false);		
	}	
	/**
	 * Process payment 
	 *
	 */
	function processPayment($row, $data) {
		$mainframe = & JFactory::getApplication() ;
		$Itemid = JRequest::getint('Itemid');
		$config = EventBookingHelper::getConfig() ;
		if (EventBookingHelper::isGroupRegistration($row->id)) {
			EventBookingHelper::updateGroupRegistrationRecord($row->id);
		}
		EventBookingHelper::sendEmails($row, $config);				
		$url = JRoute::_('index.php?option=com_eventbooking&view=complete&registration_code='.$row->registration_code.'&Itemid='.$Itemid, false, false);
		$mainframe->redirect($url);				    
	}		
}