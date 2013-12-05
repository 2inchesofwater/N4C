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

<h2 class="eb_title"><?php echo JText::_('EB_EDIT_REGISTRANT'); ?></h2>
<form action="index.php" method="post" name="adminForm" id="adminForm">		








<?php
if (version_compare(JVERSION, '1.6.0', 'ge')) {
    $format = 'Y-m-d' ;
    $param = null ;
?>
	<h1 class="TEST eb_title"><?php echo JText::_('EB_EDIT_REGISTRANT'); ?></h1>
<?php        
} else {
    $format = '%Y-%m-%d' ;
    $param = 0 ;
?>
	<div class="componentheading"><?php echo JText::_('EB_EDIT_REGISTRANT'); ?></div>
<?php    
}
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">		
	<table width="100%">
		<tr>
			<td width="100" class="key title_cell">
				<?php echo  JText::_('EB_EVENT'); ?>
			</td>
			<td class="field_cell">
				<?php echo $this->event->title ; ?>
			</td>
		</tr>
		<tr>
			<td class="key title_cell">
				<?php echo  JText::_('EB_NUMBER_REGISTRANTS'); ?>
			</td>
			<td class="field_cell">
				<?php
					if ($this->item->number_registrants > 0) {
						echo $this->item->number_registrants ;	
					} 
				?>				
			</td>
		</tr>
		<tr>
			<td class="key title_cell">
				<?php echo  JText::_('EB_FIRST_NAME'); ?><span class="required">*</span>
			</td>
			<td class="field_cell">
				<input class="text_area" type="text" name="first_name" id="first_name" size="40" maxlength="250" value="<?php echo $this->item->first_name;?>" />
			</td>
		</tr>
		<?php
			if ($this->config->s_lastname) {
			?>
				<tr>
					<td class="title_cell">
						<?php echo  JText::_('EB_LAST_NAME'); ?><?php if ($this->config->r_lastname) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input class="text_area" type="text" name="last_name" id="last_name" size="40" maxlength="250" value="<?php echo $this->item->last_name;?>" />
					</td>
				</tr>	
			<?php	 
			}		
			if ($this->config->s_organization) {
			?>
				<tr>
					<td class="title_cell">
						<?php echo  JText::_('EB_ORGANIZATION'); ?><?php if ($this->config->r_organization) echo '<span class="required">*</span>'; ?>
					</td>
					<td class="field_cell">
						<input class="text_area" type="text" name="organization" id="organization" size="40" maxlength="250" value="<?php echo $this->item->organization;?>" />
					</td>
				</tr>	
			<?php	
			}
			if ($this->config->s_address) {
			?>
				<tr>
					<td class="title_cell">
						<?php echo  JText::_('EB_ADDRESS'); ?><?php if ($this->config->r_address) echo '<span class="required">*</span>'; ?>
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
					<td class="title_cell">
						<?php echo  JText::_('EB_ADDRESS2'); ?><?php if ($this->config->r_address2) echo '<span class="required">*</span>'; ?>
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
					<td class="title_cell">
						<?php echo  JText::_('EB_CITY'); ?><?php if ($this->config->r_city) echo '<span class="required">*</span>'; ?>
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
					<td class="title_cell">
						<?php echo  JText::_('EB_STATE'); ?><?php if ($this->config->r_state) echo '<span class="required">*</span>'; ?>
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
					<td class="title_cell">
						<?php echo  JText::_('EB_ZIP'); ?><?php if ($this->config->r_zip) echo '<span class="required">*</span>'; ?>
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
					<td class="title_cell">
						<?php echo  JText::_('EB_COUNTRY'); ?><?php if ($this->config->r_country) echo '<span class="required">*</span>'; ?>
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
					<td class="title_cell">
						<?php echo  JText::_('EB_PHONE'); ?><?php if ($this->config->r_phone) echo '<span class="required">*</span>'; ?>
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
					<td class="title_cell">
						<?php echo  JText::_('EB_FAX'); ?><?php if ($this->config->r_fax) echo '<span class="required">*</span>'; ?>
					</td>
					<td>
						<input class="text_area" type="text" name="fax" id="fax" size="40" maxlength="250" value="<?php echo $this->item->fax;?>" />
					</td>
				</tr>	
			<?php	
			}	
		?>	
		<tr>
			<td class="title_cell">
				<?php echo  JText::_('EB_EMAIL'); ?><span class="required">*</span>
			</td>
			<td>
				<input class="text_area" type="text" name="email" id="email" size="40" maxlength="250" value="<?php echo $this->item->email;?>" />
			</td>
		</tr>			
		<?php
			if ($this->canChangeStatus) {
			?>
				<tr>
					<td class="title_cell">
						<?php echo  JText::_('Payment Status'); ?>
					</td>
					<td>
						<?php echo $this->lists['published'] ; ?>
					</td>
				</tr>	
			<?php	
			}		
			if (isset($this->jcFields)) {
				if ($this->jcFields->getTotal()) {
					echo $this->jcFields->renderCustomFieldsEdit($this->item->id);
				}	
			}			
			if ($this->config->s_comment) {
			?>
				<tr>
					<td class="title_cell">
						<?php echo  JText::_('EB_COMMENT'); ?><?php if ($this->config->r_comment) echo '<span class="required">*</span>'; ?>
					</td>
					<td>
						<textarea rows="7" cols="40" name="comment"><?php echo $this->item->comment;?></textarea>
					</td>
				</tr>	
			<?php	
			}
		?>
		<tr>
			<td class="title_cell">
				<?php echo  JText::_('EB_REGISTRATION_DATE'); ?>
			</td>
			<td>
				<?php echo  JHTML::_('date', $this->item->payment_date, $format, $param);?>
			</td>
		</tr>		
		<tr>
			<td class="title_cell">
				<?php echo  JText::_('EB_TOTAL_AMOUNT'); ?>
			</td>
			<td>
				<?php echo EventBookingHelper::formatCurrency($this->item->total_amount, $this->config) ; ?>				
			</td>
		</tr>	
		<?php
			if ($this->item->discount_amount > 0 || $this->item->tax_amount > 0) {
			    if ($this->item->discount_amount > 0) {
			    ?>
			  		<tr>
        				<td class="title_cell">
        					<?php echo  JText::_('EB_DISCOUNT_AMOUNT'); ?>
        				</td>
        				<td>
        					<?php echo EventBookingHelper::formatCurrency($this->item->discount_amount, $this->config);?>					
        				</td>
        			</tr>  	
			    <?php    
			    }
			?>			
			<tr>
				<td class="title_cell">
					<?php echo  JText::_('EB_NET_AMOUNT'); ?>
				</td>
				<td>
					<?php echo EventBookingHelper::formatCurrency($this->item->amount, $this->config) ; ?>					
				</td>
			</tr>		
			<?php	
			    if ($this->item->tax_amount > 0) {
			    ?>
			  		<tr>
        				<td class="title_cell">
        					<?php echo  JText::_('EB_TAX'); ?>
        				</td>
        				<td>
        					<?php echo EventBookingHelper::formatCurrency($this->item->tax_amount, $this->config);?>					
        				</td>
        			</tr>  	
			    <?php    
			    }
			}
		?>		
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
									<td colspan="2" class="eb_row_heading"><?php echo JText::sprintf('EB_MEMBER_INFORMATION', $i + 1); ;?></td>
								</tr>		
								<tr>
									<td class="title_cell">
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
											<td width="100" class="title_cell">
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
											<td width="100" class="title_cell">
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
											<td width="100" class="title_cell">
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
											<td width="100" class="title_cell"><?php if ($this->config->gr_address2) echo '<span class="required">*</span>'; ?>
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
											<td width="100" class="title_cell">
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
											<td width="100" class="title_cell">
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
											<td width="100" class="title_cell">
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
											<td width="100" class="title_cell"><?php if ($this->config->gr_country) echo '<span class="required">*</span>'; ?>
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
											<td width="100" class="title_cell">
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
											<td width="100" class="title_cell"><?php if ($this->config->gr_fax) echo '<span class="required">*</span>'; ?>
												<?php echo  JText::_('EB_FAX'); ?>
											</td>
											<td>
												<input class="text_area" type="text" name="fax_<?php echo $memberId; ?>" size="40" maxlength="250" value="<?php echo $rowMember->fax;?>" />
											</td>
										</tr>	
									<?php	
									}	
									if ($this->config->gs_email) {
									?>
										<tr>
											<td width="100" class="title_cell">
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
											<td width="100" class="title_cell">
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
	<table width="100%" cellspacing="5" cellpadding="5">		
		<tr>
			<td colspan="2">
				<input type="button" class="button" name="btnCancel" onclick="registrantList();" value="<?php echo $this->from == 'history' ? JText::_('EB_REGISTRATION_HISTORY') : JText::_('EB_REGISTRANT_LIST'); ?>" />
				<input type="button" class="button" name="btnSave" onclick="saveRegistrant();" value="<?php echo JText::_('EB_SAVE_REGISTRANT'); ?>" />				
				<?php
					if (EventBookingHelper::canCancel($this->item->event_id) && $this->item->published != 2) {
					?>
						<input type="button" class="button" name="btnCancelRegistration" onclick="cancelRegistration();" value="<?php echo JText::_('EB_CANCEL_REGISTRATION'); ?>" />
					<?php	
					}
				?>
			</td>
		</tr>
	</table>
	<!-- End members information -->			
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="task" value="" />		
	<input type="hidden" name="event_id" value="<?php echo $this->item->event_id ; ?>" />
	<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid'); ?>" />
	<input type="hidden" name="from" value="<?php echo $this->from ; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>	
	<script language="javascript">
		function registrantList() {
			var form = document.adminForm ;
			if (form.from.value == 'history') {
				location.href = 'index.php?option=com_eventbooking&task=show_history&Itemid=<?php echo JRequest::getInt('Itemid'); ?>' ;
			} else {
				location.href = 'index.php?option=com_eventbooking&task=show_registrants&Itemid=<?php echo JRequest::getInt('Itemid'); ?>' ;
			}			
		}			
		function saveRegistrant() {
			var form = document.adminForm ;
			if (form.first_name.value == '') {
				alert("<?php echo JText::_('EB_REQUIRE_FIRST_NAME'); ?>");
				form.first_name.focus();
				return ;
			}						
			<?php
				if ($this->config->s_lastname && $this->config->r_lastname) {
				?>
					if (form.last_name.value=="") {
						alert("<?php echo JText::_('EB_REQUIRE_LAST_NAME'); ?>");
						form.last_name.focus();
						return;
					}						
				<?php		
				}
				if ($this->config->s_organization && $this->config->r_organization) {
				?>
					if (form.organization.value=="") {
						alert("<?php echo JText::_('EB_REQUIRE_ORGANIZATION'); ?>");
						form.organization.focus();
						return;
					}						
				<?php		
				}
				if ($this->config->s_address && $this->config->r_address) {
				?>
					if (form.address.value=="") {
						alert("<?php echo JText::_('EB_REQUIRE_ADDRESS'); ?>");
						form.address.focus();
						return;	
					}						
				<?php		
				}
				if ($this->config->s_city && $this->config->r_city) {
				?>
					if (form.city.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_CITY'); ?>");
						form.city.focus();
						return;	
					}						
				<?php		
				}				
				if ($this->config->s_state && $this->config->r_state) {
				?>
					if (form.state.value =="") {
						alert("<?php echo JText::_('EB_REQUIRE_STATE'); ?>");
						form.state.focus();
						return;	
					}						
				<?php		
				}
				if ($this->config->s_zip && $this->config->r_zip) {
				?>
					if (form.zip.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_ZIP'); ?>");
						form.zip.focus();
						return;
					}						
				<?php		
				}
				if ($this->config->s_country && $this->config->r_country) {
				?>
					if (form.country.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_COUNTRY'); ?>");
						form.country.focus();
						return;	
					}				
				<?php		
				}
				if ($this->config->s_phone && $this->config->r_phone) {
				?>
					if (form.phone.value == "") {
						alert("<?php echo JText::_('EB_REQUIRE_PHONE'); ?>");
						form.phone.focus();
						return;
					}						
				<?php		
				}																										
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
				echo $this->jcFields->renderJSValidation() ;				
				//Now, we will need to validate member information
				if (count($this->rowMembers)) {
					$fields =  new JCFields($this->item->event_id, 0, 2) ;
					$rowMembers = $this->rowMembers ;
					foreach ($rowMembers as $rowMember) {
						$memberId = $rowMember->id ;
					?>
					if (form.first_name_<?php echo $memberId ; ?>.value == '') {
						alert("<?php echo JText::_('EB_REQUIRE_FIRST_NAME'); ?>");
						form.first_name_<?php echo $memberId; ?>.focus();
						return ;
					}						
					<?php
						if ($this->config->gs_lastname && $this->config->gr_lastname) {
						?>
							if (form.last_name_<?php echo $memberId;  ?>.value=="") {
								alert("<?php echo JText::_('EB_REQUIRE_LAST_NAME'); ?>");
								form.last_name_<?php echo $memberId; ?>.focus();
								return;
							}						
						<?php		
						}
						if ($this->config->gs_organization && $this->config->gr_organization) {
						?>
							if (form.organization_<?php echo $memberId; ?>.value=="") {
								alert("<?php echo JText::_('EB_REQUIRE_ORGANIZATION'); ?>");
								form.organization_<?php echo $memberId; ?>.focus();
								return;
							}						
						<?php		
						}
						if ($this->config->gs_address && $this->config->gr_address) {
						?>
							if (form.address_<?php echo $memberId; ?>.value=="") {
								alert("<?php echo JText::_('EB_REQUIRE_ADDRESS'); ?>");
								form.address_<?php echo $memberId; ?>.focus();
								return;	
							}						
						<?php		
						}
						if ($this->config->gs_city && $this->config->gr_city) {
						?>
							if (form.city_<?php echo $memberId; ?>.value == "") {
								alert("<?php echo JText::_('EB_REQUIRE_CITY'); ?>");
								form.city_<?php echo $memberId; ?>.focus();
								return;	
							}						
						<?php		
						}				
						if ($this->config->gs_state && $this->config->gr_state) {
						?>
							if (form.state_<?php echo $memberId; ?>.value =="") {
								alert("<?php echo JText::_('EB_REQUIRE_STATE'); ?>");
								form.state_<?php echo $memberId; ?>.focus();
								return;	
							}						
						<?php		
						}
						if ($this->config->gs_zip && $this->config->gr_zip) {
						?>
							if (form.zip_<?php echo $memberId; ?>.value == "") {
								alert("<?php echo JText::_('EB_REQUIRE_ZIP'); ?>");
								form.zip_<?php echo $memberId ; ?>.focus();
								return;
							}						
						<?php		
						}
						if ($this->config->gs_country && $this->config->gr_country) {
						?>
							if (form.country_<?php echo $memberId; ?>.value == "") {
								alert("<?php echo JText::_('EB_REQUIRE_COUNTRY'); ?>");
								form.country_<?php echo $memberId; ?>.focus();
								return;	
							}				
						<?php		
						}
						if ($this->config->gs_phone && $this->config->gr_phone) {
						?>
							if (form.phone_<?php echo $memberId; ?>.value == "") {
								alert("<?php echo JText::_('EB_REQUIRE_PHONE'); ?>");
								form.phone_<?php echo $memberId; ?>.focus();
								return;
							}						
						<?php		
						}			
						if ($this->config->gs_email && $this->config->gr_email) {
						?>
							if (form.email_<?php echo $memberId; ?>.value == '') {
								alert("<?php echo JText::_('EB_REQUIRE_EMAIL'); ?>");
								form.email_<?php echo $memberId; ?>.focus();
								return;
							}							
							var emailFilter = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
							var ret = emailFilter.test(form.email_<?php echo $memberId; ?>.value);
							if (!ret) {
								alert('<?php echo  JText::_('EB_VALID_EMAIL'); ?>');
								form.email_<?php echo $memberId; ?>.focus();
								return;
							}
						<?php	
						}
						echo $fields->renderMemberJSValidation($memberId) ;											
					}	
				}
			?>		
			form.task.value = 'save_registrant' ;
			form.submit() ;	
		}
		function cancelRegistration() {
			var form = document.adminForm ;			
			if (confirm("<?php echo JText::_('EB_CANCEL_REGISTRATION_CONFIRM'); ?>")) {
				form.task.value = 'cancel_registration' ;
				form.submit() ;
			}	
		}
	</script>		
</form>