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

//Require the controller
error_reporting(0);
define('EB_AFFILIATE', 0) ;
global $eb_version ;
$eb_version = '1.4.4';
require_once (JPATH_COMPONENT.DS.'controller.php');
require_once JPATH_ROOT.DS.'components'.DS.'com_eventbooking'.DS.'helper'.DS.'helper.php';
require_once JPATH_ROOT.DS.'components'.DS.'com_eventbooking'.DS.'helper'.DS.'fields.php';
//Init the controller
$controller	= new EventBookingController();
// Perform the Request task
$controller->execute( JRequest::getCmd('task'));
$controller->redirect();
?>