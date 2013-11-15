<?php
/**
* Flexi Custom Code - Joomla Module
* Version			: 1.1
* Created by		: RBO Team > Project::: RumahBelanja.com, Demo::: MedicRoom.com
* Created on		: v1.0 - December 16th, 2010
* Updated			: v1.1 - February 26th, 2011
* Package			: Joomla 1.6.x
* License			: http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

require JModuleHelper::getLayoutPath('mod_flexi_customcode', $params->get('layout', 'default'));
?>