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

$edit		= JRequest::getVar('edit',true);
JToolBarHelper::title( JText::_( 'EB_MASS_MAIL' ), 'massemail.png' );
JToolBarHelper::custom('send_massmail','send.png','send_f2.png', JText::_('EB_SEND_MAILS'), false);	
JToolBarHelper::cancel('cancel_massmail');
$editor = & JFactory::getEditor(); 	
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel_massmail') {
			submitform( pressbutton );
			return;				
		} else {
			//Need to check something here
			if (form.event_id.value == 0) {
				alert("<?php echo JText::_("EB_CHOOSE_EVENT"); ?>");
				form.event_id.focus() ;
				return ;				
			}
			submitform( pressbutton );
		}
	}
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div style="float:left; width: 100%;">	
			<table class="admintable" style="width: 100%;">
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_EVENT'); ?>
					</td>
					<td width="60%">
						<?php echo $this->lists['event_id'] ; ?>
					</td>
					<td>
						&nbsp;
					</td>
				</tr>			
				<tr>
					<td class="key">
						<?php echo JText::_('EB_EMAIL_SUBJECT'); ?>
					</td>
					<td>
						<input type="text" name="subject" value="" size="70" class="inputbox" />	
					</td>				
					<td>
						&nbsp;
					</td>
				</tr>													
				<tr>
					<td class="key">
						<?php echo JText::_('EB_EMAIL_MESSAGE'); ?>
					</td>
					<td>
						<?php echo $editor->display( 'description',  $this->item->description , '100%', '250', '75', '10' ) ; ?>
					</td>
					<td valign="top">
						<strong><?php echo JText::_('EB_AVAILABLE_TAGS'); ?> : [FIRST_NAME], [LAST_NAME], [EVENT_TITLE], [EVENT_DATE], [SHORT_DESCRIPTION], [EVENT_LOCATION]</strong>
					</td>
				</tr>								
		</table>										
</div>		
<div class="clr"></div>	
	<?php echo JHTML::_( 'form.token' ); ?>
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="task" value="" />
</form>