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

$headerText = JText::_('EB_MEMBER_REGISTRATION') ;
$headerText = str_replace('[EVENT_TITLE]', $this->eventTitle, $headerText) ;
$headerText = str_replace('[ATTENDER_NUMBER]', $this->currentMember, $headerText) ;
if (version_compare(JVERSION, '1.6.0', 'ge')) {
?>
	<h1 class="eb_title"><?php echo $headerText; ?></h1>
<?php    
} else {
?>
	<div class="componentheading"><?php echo $headerText; ?></div>
<?php    
}
if ($this->config->fix_next_button) {
?>
	<form method="post" name="adminForm" id="adminForm" action="index.php?option=com_eventbooking&Itemid=<?php echo $this->Itemid; ?>" autocomplete="off">	
<?php	 
} else {
?>
	<form method="post" name="adminForm" id="adminForm" action="index.php" autocomplete="off">
<?php			
}		
$msg = $this->config->member_information_form_message ;			
if (strlen($msg)) {					
?>								
	<div class="eb_message"><?php echo $msg ; ?></div>							 															
<?php	
}
?>		
	<table width="100%" class="os_table" cellspacing="3" cellpadding="3">					
		<tr>			
			<td class="title_cell" width="30%">
				<?php echo  JText::_('EB_FIRST_NAME') ?><span class="required">*</span>
			</td>
			<td class="field_cell">
				<input type="text" class="inputbox" name="first_name" value="" size="25" />
			</td>
		</tr>
		<?php
			if ($this->config->gs_lastname) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_LAST_NAME') ?><?php if ($this->config->gr_lastname) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="last_name" value="" size="25" />
					</td>
				</tr>
			<?php	
			}		
			if ($this->config->gs_organization) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ORGANIZATION'); ?><?php if ($this->config->gr_organization) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="organization" value="" size="30" />
					</td>
				</tr>
			<?php	
			}
			if ($this->config->gs_address) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ADDRESS'); ?><?php if ($this->config->gr_address) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="address" value="" size="50" />
					</td>
				</tr>	
			<?php	
			}
			
			if ($this->config->gs_address2) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ADDRESS2'); ?><?php if ($this->config->gr_address2) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="address2" value="" size="50" />
					</td>
				</tr>	
			<?php	
			}			
			if ($this->config->gs_city) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_CITY'); ?><?php if ($this->config->gr_city) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="city" value="" size="15" />
					</td>
				</tr>		
			<?php	
			}			
			if ($this->config->gs_state) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_STATE'); ?><?php if ($this->config->gr_state) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="state" value="" size="15" />
					</td>
				</tr>
			<?php	
			}
			if ($this->config->gs_zip) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ZIP'); ?><?php if ($this->config->gr_zip) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="zip" value="" size="15" />
					</td>
				</tr>
			<?php	
			}
			
			if ($this->config->gs_country) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_COUNTRY'); ?><?php if ($this->config->gr_country) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<?php echo $this->lists['country_list']; ?>
					</td>
				</tr>	
			<?php	
			}			
			if ($this->config->gs_phone) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_PHONE'); ?><?php if ($this->config->gr_phone) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="phone" value="" size="15" />
					</td>
				</tr>
			<?php
			}
			if ($this->config->gs_fax) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_FAX'); ?><?php if ($this->config->gr_fax) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="fax" value="" size="15" />
					</td>
				</tr>
			<?php
			}	
			if ($this->config->gs_email) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_EMAIL'); ?><span class="required">*</span>
					</td>
					<td class="field_cell">
						<input type="text" class="inputbox" name="email" value="" size="40" />
					</td>
				</tr>	
			<?php				
			}	

			if ($this->customField) {
				echo $this->fields ;
			}
			
			if ($this->config->gs_comment) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_COMMENT'); ?><?php if ($this->config->gr_comment) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<textarea rows="7" cols="50" name="comment" class="inputbox"></textarea>
					</td>
				</tr>	
			<?php	
			}						
			?>									
		<tr>
			<td colspan="2" align="left">										
				<?php
					if ($this->currentMember > 2) {
					?>
						<input type="button" class="button" name="btnSubmit" value="<?php echo  JText::_('EB_SKIP_THIS_MEMBER') ;?>" onclick="billingPage();">
					<?php	
					}
				?>											
				<input type="button" class="button" name="btnSubmit" value="<?php echo  JText::_('EB_NEXT') ;?>" onclick="checkData();">								
			</td>
		</tr>										
	</table>						
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
	<input type="hidden" name="event_id" value="<?php echo $this->eventId ; ?>" />
	<input type="hidden" name="option" value="com_eventbooking" />	
	<input type="hidden" name="number_registrants" value="<?php echo $this->numberRegistrants; ?>" />
	<input type="hidden" name="task" value="group_member" />					
	<input type="hidden" name="group_id" value="<?php echo $this->groupId; ?>" />
	<script language="javascript">
		function cancel() {
			location.href = 'index.php?option=com_eventbooking&Itemid=' + <?php echo $this->Itemid; ?> ;	
		}		
		function billingPage() {
			var form = document.adminForm ;
			form.task.value = 'group_billing';
			form.submit();
		}
		function checkData() {
			var form = document.adminForm ;
			if (form.first_name.value == '') {
				alert("<?php echo JText::_('EB_REQUIRE_FIRST_NAME'); ?>");
				form.first_name.focus();
				return ;
			}						
			<?php
				if ($this->config->gs_lastname && $this->config->gr_lastname) {
				?>
					if (form.last_name.value=="") {
						alert("<?php echo JText::_('EB_REQUIRE_LAST_NAME'); ?>");
						form.last_name.focus();
						return;
					}						
				<?php		
				}
				if ($this->config->gs_organization && $this->config->gr_organization) {
				?>
					if (form.organization.value=="") {
						alert("<?php echo JText::_('EB_REQUIRE_ORGANIZATION'); ?>");
						form.organization.focus();
						return;
					}						
				<?php		
				}
				if ($this->config->gs_address && $this->config->gr_address) {
				?>
					if (form.address.value=="") {
						alert("<?php echo JText::_('EB_REQUIRE_ADDRESS'); ?>");
						form.address.focus();
						return;	
					}						
				<?php		
				}
				if ($this->config->gs_city && $this->config->gr_city) {
				?>
					if (form.city.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_CITY'); ?>");
						form.city.focus();
						return;	
					}						
				<?php		
				}				
				if ($this->config->gs_state && $this->config->gr_state) {
				?>
					if (form.state.value =="") {
						alert("<?php echo JText::_('EB_REQUIRE_STATE'); ?>");
						form.state.focus();
						return;	
					}						
				<?php		
				}
				if ($this->config->gs_zip && $this->config->gr_zip) {
				?>
					if (form.zip.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_ZIP'); ?>");
						form.zip.focus();
						return;
					}						
				<?php		
				}
				if ($this->config->gs_country && $this->config->gr_country) {
				?>
					if (form.country.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_COUNTRY'); ?>");
						form.country.focus();
						return;	
					}				
				<?php		
				}
				if ($this->config->gs_phone && $this->config->gr_phone) {
				?>
					if (form.phone.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_PHONE'); ?>");
						form.phone.focus();
						return;
					}						
				<?php		
				}			
				if ($this->config->gs_email && $this->config->gr_email) {
				?>
					if (form.email.value == '') {
						alert("<?php echo JText::_('EB_REQUIRE_EMAIL'); ?>");
						form.email.focus();
						return;
					}							
					var emailFilter = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
					var ret = emailFilter.test(form.email.value);
					if (!ret) {
						alert('<?php echo  JText::_('EB_VALID_EMAIL'); ?>');
						form.email.focus();
						return;
					}
				<?php	
				}	
				if ($this->customField) {
					echo $this->customFieldValidation ;
				}
			?>																						
			form.submit();
		}		
		function checkNumber(txtName)
		{			
			var num = txtName.value			
			if(isNaN(num))			
			{			
				alert("<?php echo JText::_('EB_ONLY_NUMBER'); ?>");			
				txtName.value = "";			
				txtName.focus();			
			}			
		}								
	</script>	
	<?php echo JHTML::_( 'form.token' ); ?>
</form>