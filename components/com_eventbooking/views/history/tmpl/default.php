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
    $param = null ;
?>
	<h1 class="eb_title"><?php echo JText::_('EB_REGISTRATION_HISTORY'); ?></h1>  
<?php               
} else {
    $param = 0 ;
?>
	<div class="componentheading"><?php echo JText::_('EB_REGISTRATION_HISTORY'); ?></div>
<?php    
}
if ($this->config->fix_next_button) {
    $action = 'index.php?option=com_eventbooking&Itemid='.$this->Itemid ;
} else {
    $action = 'index.php' ;
}
?>
<form action="<?php echo $action ; ?>" method="post" name="adminForm">
<?php
	if (count($this->items)) {
	?>
		<table width="100%">
			<tr>
				<td align="left">
					<?php echo JText::_( 'EB_FILTER' ); ?>:
					<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />		
					<button onclick="this.form.submit();"><?php echo JText::_( 'EB_GO' ); ?></button>
					<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'EB_RESET' ); ?></button>		
				</td >	
				<td style="text-align: right;">
					<?php echo $this->lists['event_id']; ?>
				</td>
			</tr>
		</table>
			
		<table width="100%">
			<thead>
				<tr>
					<td width="5" class="sectiontableheader">
						<?php echo JText::_( 'NUM' ); ?>
					</td>						
					<td class="sectiontableheader list_event">
						<?php echo JHTML::_('grid.sort',  JText::_('EB_EVENT'), 'b.title', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</td>
					<?php
						if ($this->config->show_event_date) {
						?>
							<td class="sectiontableheader list_event_date">
								<?php echo JHTML::_('grid.sort',  JText::_('EB_EVENT_DATE'), 'b.event_date', $this->lists['order_Dir'], $this->lists['order'] ); ?>
							</td>	
						<?php	
						}
					?>	
					<td class="sectiontableheader list_event_date">
						<?php echo JHTML::_('grid.sort',  JText::_('EB_REGISTRATION_DATE'), 'a.register_date', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</td>					
					<td class="sectiontableheader list_registrant_number">
						<?php echo JHTML::_('grid.sort',  JText::_('EB_REGISTRANTS'), 'a.number_registrants', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</td>													
					<td class="sectiontableheader list_amount">
						<?php echo JHTML::_('grid.sort',  JText::_('EB_AMOUNT'), 'a.amount', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</td>																																					
					<td class="sectiontableheader list_id">
						<?php echo JHTML::_('grid.sort',  JText::_('EB_REGISTRATION_STATUS'), 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</td>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<?php
						if ($this->pagination->total > $this->pagination->limit) {
							if ($this->config->show_event_date) {
							?>
								<td colspan="7">
									<?php echo $this->pagination->getListFooter(); ?>
								</td>	
							<?php	
							} else {
							?>
								<td colspan="6">
									<?php echo $this->pagination->getListFooter(); ?>
								</td>
							<?php	
							}	
						}			
					?>			
				</tr>
			</tfoot>
			<tbody>
			<?php
			$k = 0;
			$tabs = array('sectiontableentry1', 'sectiontableentry2') ;
			for ($i=0, $n=count( $this->items ); $i < $n; $i++)
			{
				$row = &$this->items[$i];
				$link 	= JRoute::_( 'index.php?option=com_eventbooking&task=edit_registrant&cid[]='. $row->id.'&from=history');
				$tab = $tabs[$k] ;							
				?>
				<tr class="<?php echo $tab; ?>">
					<td>
						<?php echo $this->pagination->getRowOffset( $i ); ?>
					</td>							
					<td>
						<a href="<?php echo $link; ?>"><?php echo $row->title ; ?></a>
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
					<td align="center">
						<?php echo JHTML::_('date', $row->register_date, $this->config->date_format, $param) ; ?>			
					</td>										
					<td align="center" style="font-weight: bold;">
						<?php echo $row->number_registrants; ?>			
					</td>												
					<td align="right">
						<?php echo number_format($row->amount, 2) ; ?>
					</td>						
					<td align="center">
						<?php
							switch($row->published) {
								case 0 :
									echo JText::_('EB_PENDING');
									break ;
								case 1 :
									echo JText::_('EB_PAID');
									break ;
								case 2 :
									echo JText::_('EB_CANCELLED');
									break ;										 
							}
						?>
					</td>
				</tr>
				<?php
				$k = 1 - $k;
			}
			?>
			</tbody>
		</table>								
	<?php	
	} else {
		echo '<div align="center" class="info">'.JText::_('EB_YOU_HAVENT_REGISTER_FOR_EVENTS').'</div>' ;
	}
?>	
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="task" value="show_history" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />	
	<?php echo JHTML::_( 'form.token' ); ?>		
	<script language="javascript">
		function submitbutton(pressbutton) {			
			if (pressbutton == 'add_registrant') {
				var form = document.adminForm;
				if (form.event_id.value == 0) {
					alert("Please choose an event to add registration record");
					form.event_id.focus();
					return 
				}
			}
			submitform(pressbutton);
		}	
	</script>	
</form>