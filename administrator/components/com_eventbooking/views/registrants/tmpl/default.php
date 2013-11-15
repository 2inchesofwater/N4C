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

// Set toolbar items for the page
JToolBarHelper::title(JText::_( 'EB_REGISTRANT_MANAGEMENT' ), 'generic.png' );
JToolBarHelper::deleteList(JText::_('EB_DELETE_REGISTRANT_CONFIRM') , 'remove_registrants');
JToolBarHelper::editListX('edit_registrant');	
JToolBarHelper::addNewX('add_registrant');
JToolBarHelper::publishList('registrants_publish');
JToolBarHelper::unpublishList('registrants_unpublish');		
JToolBarHelper::custom('csv_export', 'export', 'export', 'Export Registration', false);
$colspan = 13 ;
if ($this->config->show_event_date)
    $colspan++ ;
if ($this->config->activate_deposit_feature)
    $colspan++ ;

if (version_compare(JVERSION, '1.6.0', 'ge'))
    $param = null ;
else 
    $param = 0 ;	        
?>
<style>
	.icon-32-export {
		background-image:url("components/com_eventbooking/assets/icons/export.png");
	}
</style>
<form action="index.php?option=com_eventbooking&view=registrants" method="post" name="adminForm" id="adminForm">
<table width="100%">
<tr>
	<td align="left">
		<?php echo JText::_( 'Filter' ); ?>:
		<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />		
		<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
		<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>		
	</td >	
	<td style="text-align: right;">
		<?php echo $this->lists['event_id']; ?>
		<?php echo $this->lists['published'] ; ?>
	</td>
</tr>
</table>
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="20" align="center">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>			
			<th class="title" style="text-align: left;" width="12%">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_FIRST_NAME'), 'a.first_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>						
			<th class="title" style="text-align: left;" width="7%">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_LAST_NAME'), 'a.last_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title" style="text-align: left;" width="15%">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_EVENT'), 'b.title', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<?php
				if ($this->config->show_event_date) {
				?>
					<th width="7%" style="text-align: left;" class="title" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',  JText::_('EB_EVENT_DATE'), 'b.event_date', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>	
				<?php	
				}
			?>			
			<th width="10%" class="title" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_PHONE'), 'a.phone', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>			
			<th width="10%" class="title" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_EMAIL'), 'a.email', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="10%" class="title" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_NUMBER_REGISTRANTS'), 'a.number_registrants', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="10%" class="title" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_REGISTRATION_DATE'), 'a.register_date', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>													
			<th width="5%" class="title" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_AMOUNT'), 'a.amount', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>											
				<?php
				    if ($this->config->activate_deposit_feature) {
				    ?>
				    	<th width="5%" class="title" nowrap="nowrap">
            				<?php echo JHTML::_('grid.sort',  JText::_('EB_PAYMENT_STATUS'), 'a.payment_status', $this->lists['order_Dir'], $this->lists['order'] ); ?>
            			</th>	
				    <?php    
				    }
				    if ($this->config->show_coupon_code_in_registrant_list) {
				    ?>
				    	<th width="7%" class="title" nowrap="nowrap">
            				<?php echo JHTML::_('grid.sort',  JText::_('EB_COUPON'), 'c.code', $this->lists['order_Dir'], $this->lists['order'] ); ?>
            			</th>
				    <?php    
				    } 
				?>						
			<th width="5%" class="title" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_REGISTRATION_STATUS'), 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>																								
			<th width="3%" class="title" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_ID'), 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>
	<tfoot>
		<tr>			
			<td colspan="<?php echo $colspan ; ?>">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>							
		</tr>
	</tfoot>
	<tbody>
	<?php
	$k = 0;	
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		$link 	= JRoute::_( 'index.php?option=com_eventbooking&task=edit_registrant&cid[]='. $row->id );
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		if ($row->published == 0 || $row->published == 1) {
			$published 	= JHTML::_('grid.published', $row, $i, 'tick.png', 'publish_x.png', 'registrants_' );	
		} else {
			$imageSrc = 'components/com_eventbooking/assets/icons/cancelled.jpg' ;
			$title = JText::_('EB_CANCELLED') ;
			$published = '<img src="'.$imageSrc.'" title="'.$title.'" />';
		}				
		$isMember = $row->group_id > 0 ? true : false ;	
		if ($isMember) {
			$groupLink = JRoute::_( 'index.php?option=com_eventbooking&task=edit_registrant&cid[]='. $row->group_id );			
		}							
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td align="center">
				<?php echo $checked; ?>
			</td>				
			<td>
				<a href="<?php echo $link; ?>">
					<?php echo $row->first_name ?>
				</a>
				<?php
					if ($row->is_group_billing) {
						echo '<br />' ;
						echo JText::_('EB_GROUP_BILLING');
					}
					if ($isMember) {
					?>
						<br />
						<?php echo JText::_('EB_GROUP'); ?><a href="<?php echo $groupLink; ?>"><?php echo $row->group_name ;  ?></a>
					<?php			
					}
				?>
			</td>			
			<td>
				<?php echo $row->last_name ; ?>
			</td>
			<td>
				<a href="index.php?option=com_eventbooking&task=edit_event&cid[]=<?php echo $row->event_id; ?>"><?php echo $row->title ; ?></a>
			</td>
			<?php
				if ($this->config->show_event_date) {
				?>
					<td>
						<?php echo JHTML::_('date', $row->event_date, $this->config->date_format, $param) ; ?>
					</td>
				<?php	
				}
			?>			
			<td>
				<?php echo $row->phone ; ?>
			</td>					
			<td style="text-align: center;">
				<?php echo $row->email; ?>
			</td>							
			<td align="center" style="font-weight: bold;">
				<?php echo $row->number_registrants; ?>				
			</td>								
			<td style="text-align: center;">
				<?php echo JHTML::_('date', $row->register_date, $this->config->date_format, $param); ?>
			</td>			
			<td>
				<?php echo number_format($row->amount, 2) ; ?>
			</td>
			<?php			    
			    if ($this->config->activate_deposit_feature) {
			    ?>   
			    	<td> 
        			    <?php
        			        if($row->payment_status == 1) {
        			            echo JText::_('EB_FULL_PAYMENT');
        			        } else {
        			            echo JText::_('EB_PARTIAL_PAYMENT');
        			        }
        			    ?>
			        </td>
			    <?php        
			    }
	            if ($this->config->show_coupon_code_in_registrant_list) {
			    ?>
			    	<td>
			    		<?php echo $row->coupon_code ; ?>
			    	</td>
			    <?php    
			    }
			?>
			<td align="center">
				<?php
					echo $published ;
				?>
			</td>						
			<td style="text-align: center;">
				<?php echo $row->id; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</tbody>
	</table>
	</div>
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="task" value="show_registrants" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />	
	<?php echo JHTML::_( 'form.token' ); ?>		
	<script language="javascript">
		function submitbutton(pressbutton) {			
			if (pressbutton == 'add_registrant') {
				var form = document.adminForm;
				if (form.event_id.value == 0) {
					alert("<?php echo JText::_('EB_CHOOSE_EVENT_TO_ADD'); ?>");
					form.event_id.focus();
					return 
				}
			}
			submitform(pressbutton);
		}	
	</script>	
</form>