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

<section class="blockContainer page" id="registration">

<?php if ($this->config->fix_next_button) { ?>
	<form method="post" name="adminForm" id="adminForm" class="horizontal" action="index.php?option=com_eventbooking&Itemid=<?php echo $this->Itemid; ?>" autocomplete="off" onsubmit="return checkData();">	
<?php	 
} else {
?>
	<form method="post" name="adminForm" id="adminForm" class="horizontal" action="index.php" autocomplete="off" onsubmit="return checkData();">
<?php }	?>

<h2 class="eb_title"><?php echo JText::_('EB_GROUP_REGISTRATION'); ?></h2>


<?php $msg = $this->config->number_members_form_message ;			
if (strlen($msg)) { ?>								
	<div class="eb_message"><?php echo $msg ; ?></div>							 															
<?php }	?>		
   <label for="number_registrants"><?php echo  JText::_('EB_NUMBER_REGISTRANTS') ?><span class="required">*</span></label>
   <input type="text" class="inputbox" name="number_registrants" placeholder="<?php echo  JText::_('EB_NUMBER_REGISTRANTS') ?>" value="" />

   <input type="button" class="button secondary right" value="<?php echo JText::_('EB_BACK'); ?>" onclick="window.history.go(-1) ;" />
   <input type="submit" class="button primary left" value="<?php echo JText::_('EB_NEXT'); ?>" />							

    	<?php
    		if ($this->collectMemberInformation) {
    		?>
    			<input type="hidden" name="task" value="group_member" />		
    		<?php	
    		} else {
    		?>
    			<input type="hidden" name="task" value="create_group_registration" />
    		<?php	
    		}
    	?>
    	<input type="hidden" name="option" value="com_eventbooking" />							
    	<input type="hidden" name="event_id" value="<?php echo $this->eventId ?>" />		
    	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ?>" />					

	<script language="javascript">
		function checkData() {
			var form = document.adminForm ;
			var maxRegistrants = <?php echo $this->maxRegistrants ;?> ;
			if (form.number_registrants.value == '') {
				alert("<?php echo JText::_('EB_NUMBER_REGISTRANTS_IN_VALID'); ?>");
				form.number_registrants.focus();
				return false;
			}
			if (!parseInt(form.number_registrants.value)) {
				alert("<?php echo JText::_('EB_NUMBER_REGISTRANTS_IN_VALID'); ?>");
				form.number_registrants.focus();
				return false;
			}
			if (parseInt(form.number_registrants.value)< 2) {
				alert("<?php echo JText::_('EB_NUMBER_REGISTRANTS_IN_VALID'); ?>");
				form.number_registrants.focus();
				return false;
			}
			if (maxRegistrants != -1) {
				if (parseInt(form.number_registrants.value) > maxRegistrants) {
					alert("<?php echo JText::sprintf('EB_MAX_REGISTRANTS_REACH', $this->maxRegistrants) ; ?>") ;
					form.number_registrants.focus();
					return false;
				}
			}

			return true ;
		}	
	</script>
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
</section>