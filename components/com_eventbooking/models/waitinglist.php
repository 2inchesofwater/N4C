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
 * Event Booking Component Waiting List Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelWaitingList extends JModel
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
	 * Process individual registration
	 *
	 * @param array $data
	 */
	function store($data) {
		$mainframe = & JFactory::getApplication() ;
		$Itemid    = JRequest::getInt('Itemid');	
		jimport('joomla.user.helper');
		$user = & JFactory::getUser() ;
		$config = EventBookingHelper::getConfig() ;
		$row = & JTable::getInstance('EventBooking', 'WaitingList') ;		
				
		$user = & JFactory::getUser();							
		$row->bind($data);		
		$row->notified = 0;
		$row->register_date =  date('Y-m-d H:i:s');				
		$row->user_id = $user->get('id');			    		     	
		$row->store();
		#Send notificaiton email here
		EventBookingHelper::sendWaitinglistEmail($row, $config) ;		
		#Rediect to complete page
		$app = JFactory::getApplication('site');
		$app->redirect(JRoute::_('index.php?option=com_eventbooking&task=waitinglist_complete&id='.$row->id.'&Itemid='.$Itemid));				
	}	
} 