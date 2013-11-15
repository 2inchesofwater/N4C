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
	<h1 class="eb_title"><?php echo JText::_('EB_REGISTRATION_FAILURE'); ?></h1>
<?php    
} else {
?>
	<div class="componentheading"><?php echo JText::_('EB_REGISTRATION_FAILURE'); ?></div>
<?php    
}
?>
<table width="100%">		<tr>		<td colspan="2" align="left">			<?php echo  JText::_('EB_FAILURE_MESSAGE'); ?>		</td>	</tr>		<tr>		<td valign="top">			<?php echo JText::_('EB_REASON'); ?>		</td>		<td>			<p class="info"><?php echo $this->reason; ?></p>		</td>	</tr>
	<tr>
		<td colspan="2">
			<input type="button" class="button" value="<?php echo JText::_('EB_BACK'); ?>" onclick="window.history.go(-1);" />
		</td>
	</tr>	</table>