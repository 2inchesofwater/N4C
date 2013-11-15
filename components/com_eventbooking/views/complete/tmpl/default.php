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
?>
<table width="100%">
	<tr>
		<td class="componentheading">
			<?php echo JText::_('EB_REGISTRATION_COMPLETE'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<p class="info"><?php echo $this->message; ?></p>
		</td>
	</tr>
</table>