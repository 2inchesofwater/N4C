<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
	$text = JText::_('New');	
	JToolBarHelper::title(   JText::_( 'EB_WAITING' ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save('save_waiting');	
	JToolBarHelper::cancel('cancel_waiting');	
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel_waiting') {
			submitform( pressbutton );
			return;				
		} else {
			submitform( pressbutton );
		}
	}
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div style="float:left; width: 100%;">			
	<table class="admintable adminform">
		<tr>
			<td width="100" class="key">
				<?php echo  JText::_('EB_EVENT'); ?>
			</td>
			<td>
				<?php echo $this->lists['event_id']; ?>
			</td>
		</tr>
		<tr>
			<td width="100" class="key">
				<?php echo  JText::_('EB_USERNAME'); ?>
			</td>
			<td>
				<?php echo $this->lists['user_id']; ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo  JText::_('EB_NB_REGISTRANTS'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="number_registrants" id="number_registrants" size="20" maxlength="250" value="<?php echo $this->item->number_registrants; ?>" />							
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo  JText::_('EB_FIRST_NAME'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="first_name" id="first_name" size="40" maxlength="250" value="<?php echo $this->item->first_name;?>" />
			</td>
		</tr>
		<?php
			if ($this->config->swt_lastname) {
			?>
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_LAST_NAME'); ?>
					</td>
					<td>
						<input class="text_area" type="text" name="last_name" id="last_name" size="40" maxlength="250" value="<?php echo $this->item->last_name;?>" />
					</td>
				</tr>	
			<?php	 
			}		
			if ($this->config->swt_organization) {
			?>
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_ORGANIZATION'); ?>
					</td>
					<td>
						<input class="text_area" type="text" name="organization" id="organization" size="40" maxlength="250" value="<?php echo $this->item->organization;?>" />
					</td>
				</tr>	
			<?php	
			}
			if ($this->config->swt_address) {
			?>
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_ADDRESS'); ?>
					</td>
					<td>
						<input class="text_area" type="text" name="address" id="address" size="40" maxlength="250" value="<?php echo $this->item->address;?>" />
					</td>
				</tr>	
			<?php	
			}
			if ($this->config->swt_address2) {
			?>
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_ADDRESS2'); ?>
					</td>
					<td>
						<input class="text_area" type="text" name="address2" id="address2" size="40" maxlength="250" value="<?php echo $this->item->address2;?>" />
					</td>
				</tr>	
			<?php	
			}
			if ($this->config->swt_city) {
			?>
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_CITY'); ?>
					</td>
					<td>
						<input class="text_area" type="text" name="city" id="city" size="40" maxlength="250" value="<?php echo $this->item->city;?>" />
					</td>
				</tr>	
			<?php	
			}
			if ($this->config->swt_state) {
			?>
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_STATE'); ?>
					</td>
					<td>
						<input class="text_area" type="text" name="state" id="state" size="40" maxlength="250" value="<?php echo $this->item->state;?>" />
					</td>
				</tr>	
			<?php	
			}
			if ($this->config->swt_zip) {
			?>
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_ZIP'); ?>
					</td>
					<td>
						<input class="text_area" type="text" name="zip" id="zip" size="40" maxlength="250" value="<?php echo $this->item->zip;?>" />
					</td>
				</tr>	
			<?php	
			}
			if ($this->config->swt_country) {
			?>
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_COUNTRY'); ?>
					</td>
					<td>
						<?php echo $this->lists['country_list']; ?>
					</td>
				</tr>	
			<?php	
			}
			if ($this->config->swt_phone) {
			?>
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_PHONE'); ?>
					</td>
					<td>
						<input class="text_area" type="text" name="phone" id="phone" size="40" maxlength="250" value="<?php echo $this->item->phone;?>" />
					</td>
				</tr>	
			<?php	
			}			
			if ($this->config->swt_fax) {
			?>
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_FAX'); ?>
					</td>
					<td>
						<input class="text_area" type="text" name="fax" id="fax" size="40" maxlength="250" value="<?php echo $this->item->fax;?>" />
					</td>
				</tr>	
			<?php	
			}	
		?>	
		<tr>
			<td width="100" class="key">
				<?php echo  JText::_('EB_EMAIL'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="email" id="email" size="40" maxlength="250" value="<?php echo $this->item->email;?>" />
			</td>
		</tr>			
		<tr>
			<td width="100" class="key">
				<?php echo  JText::_('EB_REGISTRATION_DATE'); ?>
			</td>
			<td>
				<?php echo  JHTML::_('date', $this->item->register_date, $this->config->date_format, $this->param);?>
			</td>
		</tr>			
	</table>				
</div>		
<div class="clr"></div>
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="task" value="" />		
	<!--<input type="hidden" name="event_id" value="<?php echo $this->item->event_id ; ?>" /> -->
	<?php echo JHTML::_( 'form.token' ); ?>
</form>