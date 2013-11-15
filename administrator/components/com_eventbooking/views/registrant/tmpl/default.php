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

$text = JText::_('New');	
JToolBarHelper::title(   JText::_( 'EB_REGISTRANT' ).': <small><small>[ ' . $text.' ]</small></small>' );
JToolBarHelper::save('save_registrant');	
JToolBarHelper::apply('apply_registrant');
JToolBarHelper::cancel('cancel_registrant');
if (version_compare(JVERSION, '1.6.0', 'ge')) {	    
    $param  = null ;
} else {	    
    $param  = 0 ;
}	
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel_registrant') {
			submitform( pressbutton );
			return;				
		} else {
			submitform( pressbutton );
		}
	}
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div style="float:left">			
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
			<td class="key">
				<?php echo  JText::_('EB_NB_REGISTRANTS'); ?>
			</td>
			<td>
				<?php
					if ($this->item->number_registrants > 0) {
						echo $this->item->number_registrants ;	
					} else {
					?>
						<input class="text_area" type="text" name="number_registrants" id="number_registrants" size="40" maxlength="250" value="" />						
						<small><?php echo JText::_('EB_NUMBER_REGISTRANTS_EXPLAIN'); ?></small>							
					<?php	
					}
				?>				
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
			if ($this->config->s_lastname) {
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
			if ($this->config->s_organization) {
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
			if ($this->config->s_address) {
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
			if ($this->config->s_address2) {
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
			if ($this->config->s_city) {
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
			if ($this->config->s_state) {
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
			if ($this->config->s_zip) {
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
			if ($this->config->s_country) {
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
			if ($this->config->s_phone) {
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
			if ($this->config->s_fax) {
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
		<?php
			if (isset($this->jcFields)) {
				if ($this->jcFields->getTotal()) {
					echo $this->jcFields->renderCustomFieldsEdit($this->item->id);
				}	
			}			
			if ($this->config->s_comment) {
			?>
				<tr>
					<td width="100" class="key">
						<?php echo  JText::_('EB_COMMENT'); ?>
					</td>
					<td>
						<textarea rows="7" cols="40" name="comment"><?php echo $this->item->comment;?></textarea>
					</td>
				</tr>	
			<?php	
			}
		?>
		<tr>
			<td width="100" class="key">
				<?php echo  JText::_('EB_REGISTRATION_DATE'); ?>
			</td>
			<td>
				<?php echo  JHTML::_('date', $this->item->payment_date, $this->config->date_format, $param);?>
			</td>
		</tr>		
		<tr>
			<td width="100" class="key">
				<?php echo  JText::_('EB_TOTAL_AMOUNT'); ?>
			</td>
			<td>
				<?php echo $this->config->currency_symbol.number_format($this->item->total_amount, 2);  ?>
			</td>
		</tr>	
		<?php
			if ($this->item->discount_amount > 0 || $this->item->tax_amount > 0) {
			    if ($this->item->discount_amount > 0) {
			    ?>
			  	<tr>
    				<td width="100" class="key">
    					<?php echo  JText::_('EB_DISCOUNT_AMOUNT'); ?>
    				</td>
    				<td>
    					<?php echo $this->config->currency_symbol.number_format($this->item->discount_amount, 2);  ?>
    				</td>
    			</tr>  	
			    <?php    
			    }			    
			?>			
			<tr>
				<td width="100" class="key">
					<?php echo  JText::_('EB_NET_AMOUNT'); ?>
				</td>
				<td>
					<?php echo $this->config->currency_symbol.number_format($this->item->amount, 2);  ?>
				</td>
			</tr>					
			<?php
			    if ($this->item->tax_amount > 0) {
			    ?>
			    <tr>
    				<td width="100" class="key">
    					<?php echo  JText::_('EB_TAX'); ?>
    				</td>
    				<td>
    					<?php echo $this->config->currency_symbol.number_format($this->item->tax_amount, 2);  ?>
    				</td>
    			</tr> 
			    <?php    
			    }    	
			}					
			if ($this->item->deposit_amount > 0) {
			?>
				<tr>
					<td class="key">
						<?php echo JText::_('EB_DEPOSIT_AMOUNT'); ?>
					</td>
					<td>
						<?php echo $this->config->currency_symbol.number_format($this->item->deposit_amount, 2);  ?>
					</td>
				</tr>
			<?php			   
    			if($this->item->payment_status == 0) {
    			?>
    				<tr>
    					<td class="key">
    						<?php echo JText::_('EB_DUE_AMOUNT'); ?>
    					</td>
    					<td>
    						<?php echo $this->config->currency_symbol.number_format($this->item->amount - $this->item->deposit_amount, 2);  ?>
    					</td>
    				</tr>
    			<?php    			    			       
    			}
    			?>
    				<tr>
    					<td class="key">
    						<?php echo JText::_('EB_PAYMENT_STATUS'); ?>
    					</td>
    					<td>
    						<?php echo $this->lists['payment_status'];?>
    					</td>
    				</tr>
    			<?php			            
			}			
		?>
		<tr>
			<td width="100" class="key">
				<?php echo  JText::_('EB_REGISTRATION_STATUS'); ?>
			</td>
			<td>
				<?php echo $this->lists['published'] ; ?>
			</td>
		</tr>
	</table>	
	
	<?php
		if (count($this->rowMembers)) {
		?>
		<!-- Member information -->	
			<table width="100%" cellspacing="5" cellpadding="5">
			<?php
				for ($i = 0 , $n = count($this->rowMembers) ; $i < $n ; $i++) {
					$rowMember = $this->rowMembers[$i] ;			
					$memberId = $rowMember->id ;
					if ($i%2 == 0)
						echo "<tr>\n";
					?>
						<td>
							<table class="admintable">
								<tr>
									<td colspan="2" class="key eb_row_heading"><?php echo JText::sprintf('EB_MEMBER_INFORMATION', $i + 1); ;?></td>
								</tr>		
								<tr>
									<td class="key title_cell">
										<?php echo  JText::_('EB_FIRST_NAME'); ?>
									</td>
									<td>
										<input class="text_area" type="text" name="first_name_<?php echo $memberId; ?>" size="40" maxlength="250" value="<?php echo $rowMember->first_name;?>" />
									</td>
								</tr>
								<?php
									if ($this->config->gs_lastname) {
									?>
										<tr>
											<td width="100" class="key title_cell">
												<?php echo  JText::_('EB_LAST_NAME'); ?><?php if ($this->config->gr_lastname) echo '<span class="required">*</span>'; ?>
											</td>
											<td>
												<input class="text_area" type="text" name="last_name_<?php echo $memberId; ?>"  size="40" maxlength="250" value="<?php echo $rowMember->last_name;?>" />
											</td>
										</tr>	
									<?php	 
									}		
									if ($this->config->gs_organization) {
									?>
										<tr>
											<td width="100" class="key title_cell">
												<?php echo  JText::_('EB_ORGANIZATION'); ?><?php if ($this->config->gr_organization) echo '<span class="required">*</span>'; ?>
											</td>
											<td>
												<input class="text_area" type="text" name="organization_<?php echo $memberId; ?>"  size="40" maxlength="250" value="<?php echo $rowMember->organization;?>" />
											</td>
										</tr>	
									<?php	
									}
									if ($this->config->gs_address) {
									?>
										<tr>
											<td width="100" class="key title_cell">
												<?php echo  JText::_('EB_ADDRESS'); ?><?php if ($this->config->gr_address) echo '<span class="required">*</span>'; ?>
											</td>
											<td>
												<input class="text_area" type="text" name="address_<?php echo $memberId ; ?>"  size="40" maxlength="250" value="<?php echo $rowMember->address;?>" />
											</td>
										</tr>	
									<?php	
									}
									if ($this->config->gs_address2) {
									?>
										<tr>
											<td width="100" class="key title_cell"><?php if ($this->config->gr_address2) echo '<span class="required">*</span>'; ?>
												<?php echo  JText::_('EB_ADDRESS2'); ?>
											</td>
											<td>
												<input class="text_area" type="text" name="address2_<?php echo $memberId; ?>"  size="40" maxlength="250" value="<?php echo $rowMember->address2;?>" />
											</td>
										</tr>	
									<?php	
									}
									if ($this->config->gs_city) {
									?>
										<tr>
											<td width="100" class="key title_cell">
												<?php echo  JText::_('EB_CITY'); ?><?php if ($this->config->gr_city) echo '<span class="required">*</span>'; ?>
											</td>
											<td>
												<input class="text_area" type="text" name="city_<?php echo $memberId; ?>"  size="40" maxlength="250" value="<?php echo $rowMember->city;?>" />
											</td>
										</tr>	
									<?php	
									}
									if ($this->config->gs_state) {
									?>
										<tr>
											<td width="100" class="key title_cell">
												<?php echo  JText::_('EB_STATE'); ?><?php if ($this->config->gr_state) echo '<span class="required">*</span>'; ?>
											</td>
											<td>
												<input class="text_area" type="text" name="state_<?php echo $memberId; ?>" size="40" maxlength="250" value="<?php echo $rowMember->state;?>" />
											</td>
										</tr>	
									<?php	
									}
									if ($this->config->gs_zip) {
									?>
										<tr>
											<td width="100" class="key title_cell">
												<?php echo  JText::_('EB_ZIP'); ?><?php if ($this->config->gr_zip) echo '<span class="required">*</span>'; ?>
											</td>
											<td>
												<input class="text_area" type="text" name="zip_<?php echo $memberId; ?>" size="40" maxlength="250" value="<?php echo $rowMember->zip;?>" />
											</td>
										</tr>	
									<?php	
									}
									if ($this->config->gs_country) {
									?>
										<tr>
											<td width="100" class="key title_cell"><?php if ($this->config->gr_country) echo '<span class="required">*</span>'; ?>
												<?php echo  JText::_('EB_COUNTRY'); ?>
											</td>
											<td>
												<?php echo JHTML::_('select.genericlist', $this->options, 'country_'.$memberId, ' class="inputbox" ', 'value', 'text', $rowMember->country); ?>
											</td>
										</tr>	
									<?php	
									}
									if ($this->config->gs_phone) {
									?>
										<tr>
											<td width="100" class="key title_cell">
												<?php echo  JText::_('EB_PHONE'); ?><?php if ($this->config->gr_phone) echo '<span class="required">*</span>'; ?>
											</td>
											<td>
												<input class="text_area" type="text" name="phone_<?php echo $memberId; ?>" size="40" maxlength="250" value="<?php echo $rowMember->phone;?>" />
											</td>
										</tr>	
									<?php	
									}			
									if ($this->config->gs_fax) {
									?>
										<tr>
											<td width="100" class="key title_cell"><?php if ($this->config->gr_fax) echo '<span class="required">*</span>'; ?>
												<?php echo  JText::_('EB_FAX'); ?>
											</td>
											<td>
												<input class="key text_area" type="text" name="fax_<?php echo $memberId; ?>" size="40" maxlength="250" value="<?php echo $rowMember->fax;?>" />
											</td>
										</tr>	
									<?php	
									}	
									if ($this->config->gs_email) {
									?>
										<tr>
											<td width="100" class="key title_cell">
												<?php echo  JText::_('EB_EMAIL'); ?><?php if ($this->config->gr_email) echo '<span class="required">*</span>'; ?>
											</td>
											<td>
												<input class="text_area" type="text" name="email_<?php echo $memberId; ?>" size="40" maxlength="250" value="<?php echo $rowMember->email;?>" />
											</td>
										</tr>	
									<?php	
									}
									$fields = new JCFields($this->event->id, 0, 2) ;
									echo $fields->renderMemberCustomFieldsEdit($memberId) ;
									if ($this->config->gs_comment) {
									?>
										<tr>
											<td width="100" class="key title_cell">
												<?php echo  JText::_('EB_COMMENT'); ?>
											</td>
											<td>
												<textarea rows="7" cols="40" name="comment_<?php echo $memberId; ?>"><?php echo $rowMember->comment;?></textarea>
											</td>
										</tr>	
									<?php	
									}
								?>											
							</table>
							<input type="hidden" name="ids[]" value="<?php echo $rowMember->id; ?>" />			
						</td>
					<?php	
					if (($i + 1) %2 == 0)
						echo "</tr>" ;	
				}
				if ($i %2 != 0)
					echo "<td>&nbsp;</td></tr>\n" ;
			?>				
			</table>	
		<?php	
		}
	?>	
	
			
</div>		
<div class="clr"></div>
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="task" value="" />		
	<!--<input type="hidden" name="event_id" value="<?php echo $this->item->event_id ; ?>" /> -->
	<?php echo JHTML::_( 'form.token' ); ?>
</form>