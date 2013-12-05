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
<link rel="stylesheet" href="/n4c/templates/n4c/css/n4c.css" type="text/css">
<section class="events">

<h2 class="eb_title"><?php echo JText::_('EB_REGISTRATION_INVITE'); ?></h2>

<p class="message">
	<?php
        $message = $this->config->invitation_form_message ;
        $message = str_replace('[EVENT_TITLE]', $this->event->title, $message) ;
    ?>
	<?php echo $message ; ?>
</p>

<div class="invite">
<form name="adminForm" method="post" action="index.php?tmpl=component">
			
            <div class="invite-name">
			<label for="name"><?php echo JText::_('EB_NAME'); ?></label>
			<input type="text" name="name" value="<?php echo $this->user->get('name'); ?>" class="inputbox" placeholder="Your name" />
            </div>
            
            <div class="invite-friend_names">
			<label for="friend_names"><?php echo JText::_('EB_FRIEND_NAMES'); ?>
				<br />
				<small><?php echo JText::_('EB_ONE_NAME_ONE_LINE'); ?></small></label>
				<textarea rows="5" cols="50" name="friend_names" class="inputbox"></textarea>
            </div>

            <div class="invite-friend_emails">
			<label for="friend_emails"><?php echo JText::_('EB_FRIEND_EMAILS'); ?>
				<br />
				<small><?php echo JText::_('EB_ONE_EMAIL_ONE_LINE'); ?></small></label>
				<textarea rows="5" cols="50" name="friend_emails" class="inputbox"></textarea>
            </div>

            <div class="invite-message">
            	<label for="message"><?php echo JText::_('EB_MESSAGE'); ?></label>				
				<textarea rows="5" name="message" class="inputbox"></textarea>
            </div>

			<div class="invite-actions">
				<input type="button" onclick="sendInvite()" value="<?php echo JText::_('EB_INVITE'); ?>" class="button" />
            </div>	



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
</section>