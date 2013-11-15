<?php defined('_JEXEC') or die( 'Restricted access' ); ?>
<?php
    if (version_compare(JVERSION, '1.6.0', 'ge'))
        $param = null ;
    else 
        $param = 0 ;    
?>
<table width="100%" class="os_table" cellspacing="2" cellpadding="2">				
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
                                echo JText::_('EB_TOTAL_AMOUNT');  
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
            					<?php echo EventBookingHelper::formatCurrency($this->row->discount_amount, $this->config); ?>    					
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
            					<?php echo EventBookingHelper::formatCurrency($this->row->tax_amount, $this->config); ?>    					
            				</td>
            			</tr>
                    <?php    
                    }
    			?>    			
    			<tr>
    				<td class="title_cell">
    					<?php echo  JText::_('EB_GRAND_TOTAL'); ?>
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
    					<?php echo EventBookingHelper::formatCurrency($this->row->amount, $this->config); ?>    					
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
					<?php echo EventBookingHelper::formatCurrency($this->row->amount + $this->row->tax_amount - $this->row->deposit_amount, $this->config); ?>					
				</td>
			</tr>
		<?php										          
		}	    
		if ($this->row->amount > 0) {
		?>
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
			<tr>
        		<td class="title_cell">
        			<?php echo JText::_('EB_TRANSACTION_ID'); ?>
        		</td>
        		<td class="field_cell">
        			<?php echo $this->row->transaction_id ; ?>
        		</td>
        	</tr>		
		<?php	
		}			
		$this->jcFields->renderGroupMemberConfirmation($this->row->id) ;
		if ($this->config->s_comment) {
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
		}
	?>										
</table>	