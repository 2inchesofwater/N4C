<?php
	/**
	* @version $Id: proforms 10041 2008-03-18 21:48:13Z fahrettinkutyol $
	* @package joomla
	* @copyright Copyright (C) 2008 Mad4Media. All rights reserved.
	* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
	* Joomla! is free software. This version may have been modified pursuant
	* to the GNU General Public License, and as distributed it includes or
	* is derivative of works licensed under the GNU General Public License or
	* other free or open source software licenses.
	* See COPYRIGHT.php for copyright notices and details.
	* @copyright (C) mad4media , www.mad4media.de
	*/
	
    defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
    $xhr = JRequest::getString('xhr','default');
    $xhr = preg_replace("/[^a-zA-Z0-9_\s]/", "", $xhr);
    if(! file_exists(M4J_XHR.$xhr.".php")) die("No such XHR peer!");
    include_once (M4J_XHR.$xhr.".php");
?>