<?php defined('_JEXEC') or die( 'Restricted access' ); ?>
<?php
	$rowMember = $this->rowMembers[0] ;	
	if ($rowMember->first_name) {
		$showMember = true ;
	} else {
		$showMember = false ;
	}
	if (version_compare(JVERSION, '1.6.0', 'ge'))
	    $param = null ;
	else 
	    $param = 0 ;    
?>
<table width="100%" class="os_table" cellspacing="2" cellpadding="2">		
		<tr>
			<td class="heading" colspan="2">
				<?php echo JText::_('EB_GENERAL_INFORMATION') ; ?>
			</td>
		</tr>
		<tr>			
			<td class="title_cell">
				<?php echo  JText::_('EB_EVENT_TITLE') ?>
			</td>
			<td class="field_cell">
				<?php echo $this->rowEvent->title ; ?>
			</td>
		</tr>
		<?php
			if ($this->config->show_event_date) {
			?>
			<tr>			
				<td class="title_cell">
					<?php echo  JText::_('EB_EVENT_DATE') ?>
				</td>
				<td class="field_cell">
					<?php
                        if ($this->rowEvent->event_date == EB_TBC_DATE) {
                            echo JText::_('EB_TBC');
                        } else {
                            echo JHTML::_('date', $this->rowEvent->event_date, $this->config->event_date_format, $param) ;  
                        }
					?>					
				</td>
			</tr>	
			<?php	
			}
			if ($this->config->show_event_location_in_email && $this->rowLocation) {
				$location = $this->rowLocation ;
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_LOCATION') ?>
					</td>
					<td class="field_cell">				
						<?php echo $location->name.' ('.$location->address.', '.$location->city.','. $location->state.', '.$location->zip.', '.$location->country.')' ; ?>
					</td>
				</tr>
			<?php	
			}
		?>		
		<tr>
			<td class="title_cell">
				<?php echo  JText::_('EB_NUMBER_REGISTRANTS') ?>
			</td>
			<td class="field_cell">
				<?php echo $this->row->number_registrants ; ?>
			</td>
		</tr>							
		<tr>
			<td colspan="2" class="os_row_heading">
				<?php echo JText::_('EB_BILLING_INFORMATION') ; ?>
			</td>
		</tr>		
		<tr>			
			<td class="title_cell">
				<?php echo  JText::_('EB_FIRST_NAME') ?>
			</td>
			<td class="field_cell">
				<?php echo $this->row->first_name; ?>
			</td>
		</tr>	
		<?php
			if ($this->config->s_lastname) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_LAST_NAME') ?>
					</td>
					<td class="field_cell">
						<?php echo $this->row->last_name ; ?>
					</td>
				</tr>	
			<?php	
			}																		
			if ($this->config->s_organization) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ORGANIZATION'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->row->organization; ?>
					</td>
				</tr>	
			<?php	
			}
			if ($this->config->s_address) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ADDRESS'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->row->address; ?>
					</td>
				</tr>
			<?php	
			}
			
			if ($this->config->s_address2) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ADDRESS2'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->row->address2; ?>
					</td>
				</tr>
			<?php	
			}			
			if ($this->config->s_city) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_CITY'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->row->city; ?>
					</td>
				</tr>
			<?php	
			}
			if ($this->config->s_state) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_STATE'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->row->state; ?>
					</td>
				</tr>
			<?php	
			}
			if ($this->config->s_zip) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_ZIP'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->row->zip; ?>
					</td>
				</tr>
			<?php	
			}
			if ($this->config->s_country) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_COUNTRY'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->row->country; ?>
					</td>
				</tr>
			<?php	
			}
			if ($this->config->s_phone) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_PHONE'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->row->phone; ?>
					</td>
				</tr>
			<?php	
			}						
			if ($this->config->s_fax) {
			?>
				<tr>			
					<td class="title_cell">
						<?php echo  JText::_('EB_FAX'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->row->fax; ?>
					</td>
				</tr>
			<?php	
			}						
		?>																						
		<tr>			
			<td class="title_cell">
				<?php echo  JText::_('EB_EMAIL'); ?>
			</td>
			<td class="field_cell">
				<?php echo $this->row->email; ?>
			</td>
		</tr>						
		<?php
		    if ($this->row->total_amount > 0) {
        	    if ($this->row->discount_amount > 0 || $this->row->tax_amount > 0) {
        		?>
        			<tr>
        				<td class="title_cell">
        					<?php
                                if ($this->row->tax_amount > 0) {
                                    echo JText::_('EB_BASE_PRICE');
                                } else {
                                    echo  JText::_('EB_TOTAL_AMOUNT');    
                                }
        					?>        					
        				</td>
        				<td class="field_cell">
        					<?php echo EventBookingHelper::formatCurrency($this->row->total_amount, $this->config); ?>        					
        				</td>
        			</tr>
        			<?php
                        if ($this->row->discount_amount > 0) {
                        ?>
                      		<tr>
                				<td class="title_cell">
                					<?php echo  JText::_('EB_DISCOUNT_AMOUNT'); ?>
                				</td>
                				<td class="field_cell">
                					<?php echo EventBookingHelper::formatCurrency($this->row->discount_amount, $this->config) ; ?>        					
                				</td>
                			</tr>  
                        <?php    
                        }
                        if ($this->row->tax_amount > 0) {
                        ?>
                        	<tr>
                				<td class="title_cell">
                					<?php echo  JText::_('EB_TAX'); ?>
                				</td>
                				<td class="field_cell">
                					<?php echo EventBookingHelper::formatCurrency($this->row->tax_amount, $this->config) ; ?>        					
                				</td>
                			</tr>
                        <?php    
                        }
        			?>        			
        			<tr>
        				<td class="title_cell">
        					<?php echo  JText::_('EB_GRAND_AMOUNT'); ?>
        				</td>
        				<td class="field_cell">
        					<?php echo EventBookingHelper::formatCurrency($this->row->amount + $this->row->tax_amount, $this->config) ; ?>        					
        				</td>
        			</tr>				
        		<?php	
        		} else {
        		?>
        			<tr>
        				<td class="title_cell">
        					<?php echo  JText::_('EB_TOTAL_AMOUNT'); ?>
        				</td>
        				<td class="field_cell">
        					<?php echo EventBookingHelper::formatCurrency($this->row->amount, $this->config) ?>        					
        				</td>
        			</tr>
        		<?php	
        		}   
    	    }    	 
    	    if ($this->row->deposit_amount > 0) {
    		?>
    			<tr>
    				<td class="title_cell">
    					<?php echo JText::_('EB_DEPOSIT_AMOUNT'); ?>
    				</td>
    				<td class="field_cell">
    					<?php echo EventBookingHelper::formatCurrency($this->row->deposit_amount, $this->config); ?>    					
    				</td>
    			</tr>		
    			<tr>
    				<td class="title_cell">
    					<?php echo JText::_('EB_DUE_AMOUNT'); ?>
    				</td>
    				<td class="field_cell">
    					<?php echo EventBookingHelper::formatCurrency($this->row->amount - $this->row->deposit_amount, $this->config); ?>    					
    				</td>
    			</tr>
    		<?php										          
    		}	    		    	    											
			if ($this->row->amount > 0) {
			?>
				<tr>
					<td class="title_cell">
						<?php echo JText::_('EB_TRANSACTION_ID'); ?>
					</td>
					<td class="field_cell">
						<?php echo $this->row->transaction_id ; ?>
					</td>
				</tr>
				<tr>
        			<td class="title_cell">
        				<?php echo  JText::_('EB_PAYMEMNT_METHOD'); ?>
        			</td>
        			<td class="field_cell">
        				<?php
							$method = os_payments::loadPaymentMethod($this->row->payment_method);
							if ($method)
								echo JText::_($method->title) ;	
						?>
        			</td>
        		</tr>
			<?php	
			}			
			$jcFields = new JCFields($this->row->event_id, false, 1) ;
			$jcFields->renderGroupMemberConfirmation($this->row->id);
		?>													
		<tr>
			<td class="title_cell">
				<?php echo  JText::_('EB_COMMENT'); ?>
			</td>
			<td class="field_cell">
				<?php echo $this->row->comment; ?>
			</td>
		</tr>	
		<?php
			if ($showMember) {
			?>
				<tr>
					<td class="heading" colspan="2">
						<?php echo JText::_('EB_MEMBERS_INFORMATION') ; ?>
					</td>
				</tr>	
				<tr>
					<td colspan="2">										
						<table width="100%" class="os_member_list">																		
								<?php			
									$jcField = new JCFields($this->row->event_id, false, 2) ;				
									for ($i = 0 , $n  = count($this->rowMembers); $i < $n; $i++) {								
										if ($i %2 == 0)
											echo "<tr>\n" ;
										$rowMember = $this->rowMembers[$i] ;
									?>
										<td>
											<table class="os_table" width="100%" cellspacing="3" cellpadding="3">
												<tr>
													<td colspan="2" class="os_row_heading"><?php echo JText::sprintf('EB_MEMBER_INFORMATION', $i + 1) ; ?></td>
												</tr>
												<tr>
													<td class="title_cell">
														<?php echo JText::_('EB_FIRST_NAME'); ?>
													</td>
													<td>
														<?php echo $rowMember->first_name ; ?>
													</td>
												</tr>		
												<?php			
													if ($this->config->gs_lastname) {
													?>
														<tr>			
															<td class="title_cell">
																<?php echo  JText::_('EB_LAST_NAME') ?>
															</td>
															<td class="field_cell">
																<?php echo $rowMember->last_name ; ?>
															</td>
														</tr>
													<?php	
													}		
													if ($this->config->gs_organization) {
													?>
														<tr>			
															<td class="title_cell">
																<?php echo  JText::_('EB_ORGANIZATION'); ?>
															</td>
															<td class="field_cell">
																<?php echo $rowMember->organization ; ?>
															</td>
														</tr>
													<?php	
													}
													if ($this->config->gs_address) {
													?>
														<tr>			
															<td class="title_cell">
																<?php echo  JText::_('EB_ADDRESS'); ?>
															</td>
															<td class="field_cell">
																<?php echo $rowMember->address ; ?>
															</td>
														</tr>	
													<?php	
													}											
													if ($this->config->gs_address2) {
													?>
														<tr>			
															<td class="title_cell">
																<?php echo  JText::_('EB_ADDRESS2'); ?>
															</td>
															<td class="field_cell">
																<?php echo $rowMember->address2 ; ?>
															</td>
														</tr>	
													<?php	
													}			
													if ($this->config->gs_city) {
													?>
														<tr>			
															<td class="title_cell">
																<?php echo  JText::_('EB_CITY'); ?>
															</td>
															<td class="field_cell">
																<?php echo $rowMember->city ; ?>
															</td>
														</tr>		
													<?php	
													}			
													if ($this->config->gs_state) {
													?>
														<tr>			
															<td class="title_cell">
																<?php echo  JText::_('EB_STATE'); ?>
															</td>
															<td class="field_cell">
																<?php echo $rowMember->state ; ?>
															</td>
														</tr>
													<?php	
													}
													if ($this->config->gs_zip) {
													?>
														<tr>			
															<td class="title_cell">
																<?php echo  JText::_('EB_ZIP'); ?>
															</td>
															<td class="field_cell">
																<?php echo $rowMember->zip ; ?>
															</td>
														</tr>
													<?php	
													}
													
													if ($this->config->gs_country) {
													?>
														<tr>			
															<td class="title_cell">
																<?php echo  JText::_('EB_COUNTRY'); ?>
															</td>
															<td class="field_cell">
																<?php echo $rowMember->country ; ?>
															</td>
														</tr>	
													<?php	
													}			
													if ($this->config->gs_phone) {
													?>
														<tr>			
															<td class="title_cell">
																<?php echo  JText::_('EB_PHONE'); ?>
															</td>
															<td class="field_cell">
																<?php echo $rowMember->phone ; ?>
															</td>
														</tr>
													<?php
													}
													if ($this->config->gs_fax) {
													?>
														<tr>			
															<td class="title_cell">
																<?php echo  JText::_('EB_FAX'); ?>
															</td>
															<td class="field_cell">
																<?php echo $rowMember->fax ; ?>
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
																<?php echo $rowMember->email ; ?>
															</td>
														</tr>	
													<?php				
													}
													$jcField->renderGroupMemberConfirmation($rowMember->id);
													if ($this->config->gs_comment) {
													?>
														<tr>
															<td class="title_cell">
																<?php echo JText::_('EB_COMMENT') ; ?> 
															</td>
															<td>
																<?php echo $rowMember->comment ; ?>
															</td>
														</tr>
													<?php	
													}											
												?>																																					
											</table>
										</td>
									<?php	
										if (($i + 1) %2 == 0)
											echo "</tr>\n" ;	
									}				
		
									if ($i %2 != 0) {
										echo "<td>&nbsp;</td></tr>" ;
									}
								?>																					
						</table>
					</td>
				</tr>	
			<?php	
			}
		?>																														
	</table>	