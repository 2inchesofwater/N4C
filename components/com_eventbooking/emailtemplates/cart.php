<?php defined('_JEXEC') or die( 'Restricted access' ); ?>
<style type="text/css">
.sectiontableheader {
	background: #333;
	border: 1px solid #d5d5d5;
	color: #fff;
	padding: 5px;
}

.sectiontableheader a,
.sectiontableheader a:hover,
.sectiontableheader a:focus,
.sectiontableheader a:active { color: #fff; }

.sectiontableentry,
.sectiontableentry0,
.sectiontableentry1,
.sectiontableentry2 {
	background: url(../images/dot2.gif) repeat-x bottom;
	padding: 5px 5px 6px;
}

.sectiontableentry:hover,
.sectiontableentry0:hover,
.sectiontableentry1:hover,
.sectiontableentry2:hover { background-color: #fffff0; }

.sectiontableentry2 { background-color: #f6f6f6; }

.info {
	color : #2C79B3 ;
	margin-top: 10px;
}

.price_col {
	width : 10%;
	text-align: right ;
}
.order_col {
	width : 13%;
	text-align: center ;
}
table.item_list {	
	margin-top: 10px;
}
table.doc_list {
	
}
.no_col {
	width: 5%;
}
.date_col {
	width: 20% ;
}
.capacity_col {
	width: 8%;
}
.registered_col {
	width: 8% ;
}
.list_first_name {
	width: 9% ;
}
.list_last_name {
	width: 9% ;
}
.list_event {
	
}
.list_event_date {
	width: 10% ;
}
.list_email {
	width: 10% ;
}
.list_registrant_number {
	width: 8% ;
}
.list_amount {
	text-align: right ;
	width: 6% ;
}
.list_id {
	text-align: center ;
	width: 0% ;
}
/**CSS for cart page**/
.col_no {
	width: 5% ;
}
.col_action {
	width : 10% ;
	text-align: center ;
}
.col_quantity {
	width : 12% ;
	text-align: center ;
}
.col_price {
	text-align: right ;
	width: 10% ;
}
.quantity_box {
	text-align: center ;
}
span.total_amount {
	font-weight: bold ;
}
.col_subtotal {
	text-align: right ;
}
.qty_title, .eb_rate {
	font-weight: bold ;	
} 
span.error {
	color : red ;
	font-size: 150% ;
}
.col_event_date {
	width: 17% ;
	text-align: center ;
}
span.view_list {
	font-weight: bold ;
}
.col_event {
	text-align: left ;
}
</style>

<?php
    if (version_compare(JVERSION, '1.6.0', 'ge'))
        $param = null ;
    else 
        $param = 0 ;    
?>

<table width="100%" class="item_list">
	<tr>		
		<th class="sectiontableheader col_event">
			<?php echo JText::_('EB_EVENT'); ?>
		</th>		
		<?php
			if ($this->config->show_event_date) {
		?>
			<th class="sectiontableheader col_event_date">
				<?php echo JText::_('EB_EVENT_DATE'); ?>
			</th>
		<?php		
			}
		?>
		<th class="sectiontableheader col_price">
			<?php echo JText::_('EB_PRICE'); ?>
		</th>									
		<th class="sectiontableheader col_quantity">
			<?php echo JText::_('EB_QUANTITY'); ?>
		</th>																
		<th class="sectiontableheader col_quantity">
			<?php echo JText::_('EB_SUB_TOTAL'); ?>
		</th>
	</tr>
	<?php
		$tabs = array('sectiontableentry1', 'sectiontableentry2') ;
		$total = 0 ;
		$k = 0 ;					
		for ($i = 0 , $n = count($this->items) ; $i < $n; $i++) {
			$item = $this->items[$i] ;
			$tab = $tabs[$k] ;
			$rate = EventBookingHelper::getRegistrationRate($item->event_id, $item->number_registrants);
			$total += $item->number_registrants*$rate ;						
        	$url =  JURI::base().'index.php?option=com_eventbooking&task=view_event&event_id='.$item->event_id.'&Itemid='.$this->Itemid ;			        	
		?>
			<tr class="<?php echo $tab; ?>">								
				<td class="col_event">
					<a href="<?php echo $url; ?>"><?php echo $item->title; ?></a>								
				</td>				
				<?php
					if ($this->config->show_event_date) {
					?>
						<td class="col_event_date">
							<?php 
							    if ($item->event_date == EB_TBC_DATE) {
							        echo JText::_('EB_TBC');
							    } else {
							        echo JHTML::_('date', $item->event_date,  $this->config->event_date_format, $param); 
							    }    
							?>							
						</td>	
					<?php	
					}
				?>
				<td class="col_price">
					<?php echo number_format($rate, 2); ?>
				</td>
				<td class="col_quantity">
					<?php echo $item->number_registrants ; ?>
				</td>																										
				<td class="col_price">
					<?php echo number_format($rate*$item->number_registrants, 2); ?>
				</td>						
			</tr>
		<?php				
			$k = 1 - $k ;				
		}
	?>								
</table>	
<table width="100%" class="os_table" cellspacing="2" cellpadding="2">					
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
	    if ($this->totalAmount > 0) {
    	    if ($this->discountAmount > 0 || $this->taxAmount > 0 ) {
    		?>
    			<tr>
    				<td class="title_cell">
    					<?php echo  JText::_('EB_SUB_TOTAL'); ?>
    				</td>
    				<td class="field_cell">
    					<?php echo EventBookingHelper::formatCurrency($this->totalAmount, $this->config); ?>    					
    				</td>
    			</tr>
    			<?php
                    if ($this->discountAmount > 0) {
                    ?>
                  		<tr>
            				<td class="title_cell">
            					<?php echo  JText::_('EB_DISCOUNT_AMOUNT'); ?>
            				</td>
            				<td class="field_cell">
            					<?php echo EventBookingHelper::formatCurrency($this->discountAmount, $this->config) ; ?>    					
            				</td>
            			</tr>  	
                    <?php    
                    }
    	            if ($this->taxAmount > 0) {
                    ?>
                  		<tr>
            				<td class="title_cell">
            					<?php echo  JText::_('EB_TAX'); ?>
            				</td>
            				<td class="field_cell">
            					<?php echo EventBookingHelper::formatCurrency($this->taxAmount, $this->config) ; ?>    					
            				</td>
            			</tr>  	
                    <?php    
                    }
    			?>    			    		
    			<tr>
    				<td class="title_cell">
    					<?php echo  JText::_('EB_TOTAL'); ?>
    				</td>
    				<td class="field_cell">
    					<?php echo EventBookingHelper::formatCurrency($this->amount + $this->taxAmount, $this->config) ; ?>    					
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
    					<?php echo EventBookingHelper::formatCurrency($this->amount, $this->config) ; ?>    					
    				</td>
    			</tr>
    		<?php	
    		}   
	    }		
		if ($this->amount > 0) {
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
        		<td>
        			<?php echo $this->row->transaction_id ; ?>
        		</td>
        	</tr>	
		<?php	
		}			
		$this->jcFields->renderGroupMemberConfirmation($this->row->id) ;
	?>						
	<tr>
		<td class="title_cell">
			<?php echo  JText::_('EB_COMMENT'); ?>
		</td>
		<td class="field_cell">
			<?php echo $this->row->comment; ?>
		</td>
	</tr>													
</table>	