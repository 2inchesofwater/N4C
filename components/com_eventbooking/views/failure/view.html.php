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
 * @since 1.5
 */
class EventBookingViewFailure extends JView
{
	function display($tpl = null)
	{										
	    $this->setLayout('default') ;	
		$reason =  isset($_SESSION['reason']) ? $_SESSION['reason'] : '';
		if (!$reason) {
			$reason = JRequest::getVar('failReason', '') ;
		}
		$this->assignRef('reason', $reason);												
		parent::display($tpl);				
	}
}