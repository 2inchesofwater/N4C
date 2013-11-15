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
<div style="width: 100%; margin: 15px;">
<?php
    if (version_compare(JVERSION, '1.6.0', 'ge')) {
    ?>
    	<h1 class="eb_title"><?php echo JText::_('EB_REGISTRATION_INVITE'); ?></h1>
    <?php    
    } else {
    ?>
    	<div class="componentheading"><?php echo JText::_('EB_REGISTRATION_INVITE'); ?></div>
    <?php    
    }
	$message = $this->config->invitation_form_message ;
	$message = str_replace('[EVENT_TITLE]', $this->event->title, $message) ;
?>
<p class="message">
	<?php echo $message ; ?>
</p>
<form name="adminForm" method="post" action="index.php?tmpl=component">
	<table class="os_table" width="100%">
		<tr>
			<td>
				<?php echo JText::_('EB_NAME'); ?>
			</td>
			<td>
				<input type="text" name="name" value="<?php echo $this->user->get('name'); ?>" class="inputbox" size="50" />
			</td>
		</tr> 
		<tr>
			<td>
				<?php echo JText::_('EB_FRIEND_NAMES'); ?>
				<br />
				<small><?php echo JText::_('EB_ONE_NAME_ONE_LINE'); ?></small>
			</td>
			<td>
				<textarea rows="5" cols="50" name="friend_names" class="inputbox"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo JText::_('EB_FRIEND_EMAILS'); ?>
				<br />
				<small><?php echo JText::_('EB_ONE_NAME_ONE_LINE'); ?></small>
			</td>
			<td>
				<textarea rows="5" cols="50" name="friend_emails" class="inputbox"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo JText::_('EB_MESSAGE'); ?>				
			</td>
			<td>
				<textarea rows="10" cols="80" name="message" class="inputbox"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="button" onclick="sendInvite()" value="<?php echo JText::_('EB_INVITE'); ?>" class="button" />	
			</td>				
		</tr>
	</table>
	<script language="javascript">
		function sendInvite(){
			var form = document.adminForm ;
			if (form.name.value == '') {
				alert("<?php echo JText::_("EB_ENTER_YOUR_NAME"); ?>");
				form.name.focus();
				return ;
			}
			if (form.friend_names.value == '') {
				alert("<?php echo JText::_("EB_ENTER_YOUR_FRIEND_NAMES"); ?>");
				form.friend_names.focus();
				return ;
			}
			if (form.friend_emails.value == '') {
				alert("<?php echo JText::_("EB_ENTER_YOUR_FRIEND_EMAILS"); ?>");
				form.friend_emails.focus();
				return ;
			}
			form.submit();					
		}
	</script>
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="task" value="send_invite" />
	<input type="hidden" name="event_id" value="<?php echo $this->event->id; ?>" />
	<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid'); ?>" />
</form>
</div>	