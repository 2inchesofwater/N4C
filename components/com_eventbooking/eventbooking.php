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
error_reporting(0) ;
define('EB_AFFILIATE', 0) ;
define('EB_TBC_DATE', '2099-12-31 00:00:00');
//For the current version, we need to import JParameter class
jimport('joomla.html.parameter') ;
//Constans for width and height 

define('VIEW_LIST_WIDTH', 800);
define('VIEW_LIST_HEIGHT', 600);
define('TC_POPUP_WIDTH', 800);
define('TC_POPUP_HEIGHT', 600);

require_once JPATH_COMPONENT.'/controller.php';
require_once JPATH_COMPONENT.'/helper/helper.php';
require_once JPATH_COMPONENT.'/helper/fields.php';
require_once JPATH_COMPONENT.'/payments/os_payment.php';
require_once JPATH_COMPONENT.'/payments/os_payments.php';
//Init the controller
$controller	= new EventBookingController() ;


// Perform the Request task
$controller->execute( JRequest::getCmd('task'));
$controller->redirect();
?>