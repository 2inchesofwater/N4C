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
	<h1 class="eb_title"><?php echo JText::_('EB_GROUP_REGISTRATION'); ?></h1>
<?php    
} else {
?>
	<div class="componentheading"><?php echo JText::_('EB_GROUP_REGISTRATION'); ?></div>
<?php    
}
if ($this->config->fix_next_button) {
?>
	<form method="post" name="adminForm" id="adminForm" action="index.php?option=com_eventbooking&Itemid=<?php echo $this->Itemid; ?>" autocomplete="off" onsubmit="return checkData();">	
<?php	 
} else {
?>
	<form method="post" name="adminForm" id="adminForm" action="index.php" autocomplete="off" onsubmit="return checkData();">
<?php	
}	
$msg = $this->config->number_members_form_message ;			
if (strlen($msg)) {					
?>								
	<div class="eb_message"><?php echo $msg ; ?></div>							 															
<?php	
}	
?>		
    <table width="100%" class="os_table" cellspacing="3" cellpadding="3">					
    	<tr>			
    		<td class="title_cell" width="30%">
    			<?php echo  JText::_('EB_NUMBER_REGISTRANTS') ?><span class="required">*</span>
    		</td>
    		<td class="field_cell">
    			<input type="text" class="inputbox" name="number_registrants" value="" size="10" />
    		</td>
    	</tr>		
    	<tr>
    		<td colspan="2">
    			<input type="button" class="button" value="<?php echo JText::_('EB_BACK'); ?>" onclick="window.history.go(-1) ;" />
    			<input type="submit" class="button" value="<?php echo JText::_('EB_NEXT'); ?>" />								
    		</td>
    	</tr>
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
    </table>			
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