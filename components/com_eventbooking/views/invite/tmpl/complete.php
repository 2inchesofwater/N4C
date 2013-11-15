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

if (version_compare(JVERSION, '1.6.0', 'ge')) {
?> 
	<h1 class="eb_title"><?php echo JText::_('EB_INVITATION_COMPLETE'); ?></h1>
<?php   
} else {
?>
	<div class="componentheading"><?php echo JText::_('EB_INVITATION_COMPLETE'); ?></div>
<?php    
}
?>
<p class="info"><?php echo $this->message; ?></p>