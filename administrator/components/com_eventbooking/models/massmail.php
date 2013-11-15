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
 * Event Booking Component Field Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelMassmail extends JModel
{	
    /**
     * Send email to all registrants of event
     * 
     * @param array $data
     */
	function send($data) {	    
	    if ($data['event_id'] >= 1) {
	        $config = EventBookingHelper::getConfig() ;	        
	        $jconfig = new JConfig();				
    		$db = & JFactory::getDBO();			
    		if ($config->from_name)
    			$fromName = $config->from_name ;
    		else 
    			$fromName = $jconfig->fromname ;
    		if ($config->from_email)
    			$fromEmail = $config->from_email ;
    		else			
    			$fromEmail =  $jconfig->mailfrom ;
    		if (version_compare(JVERSION, '1.6.0', 'ge')) {
    		    $param = null ;
    		} else {
    		    $param = 0 ;
    		}	    			    			    				       
	        $db = & JFactory::getDBO() ;
	        $sql = 'SELECT * FROM #__eb_events AS a LEFT JOIN #__eb_locations AS b ON a.location_id = b.id WHERE a.id='.(int)$data['event_id'] ;
	        $db->setQuery($sql) ;
	        $event = $db->loadObject() ;
	        
	        $replaces = array() ;
	        $replaces['event_title'] = $event->title ;
	        $replaces['event_date'] = JHTML::_('date', $event->event_date, $config->event_date_format, $param);
	        $replaces['short_description'] = $event->short_description;
	        $replaces['description'] = $event->description ;
	        $replaces['event_location'] = $event->name.' ('.$event->address.', '.$event->city.', '.$event->zip.', '.$event->country.')' ;

	        //Get list of registrants
	        $sql = 'SELECT first_name, last_name, email FROM #__eb_registrants WHERE event_id='.$data['event_id'].' AND (published=1 OR (payment_method LIKE "os_offline%" AND published != 2)) ' ;
	        $db->setQuery($sql) ;
	        $rows = $db->loadObjectList() ;
	        $emails = array() ;	        
	        $subject = $data['subject'] ;
	        $body = $data['description'] ;
    	    foreach ($replaces as $key=>$value) {
    			$key = strtoupper($key) ;
    			$body = str_replace("[$key]", $value, $body) ;
    		}	        	      
    		if (count($rows)) {
    		    foreach ($rows as $row) {
    		        $message = $body ;
    		        $email = $row->email ;
    		        if (!in_array($email, $emails)) {
    		            $message = str_replace("[FIRST_NAME]", $row->first_name, $message) ;
    		            $message = str_replace("[LAST_NAME]", $row->last_name, $message) ;
    		            $emails[] = $email ;    		                		                		           
    		            JUtility::sendMail($fromEmail, $fromName, $email, $subject, $message, 1);    		                		              
    		        }    		           
    		    }
    		}
	    }	    	    	   	    
	    return true ;
	}
}