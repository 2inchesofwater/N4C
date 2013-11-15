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
JToolBarHelper::title( JText::_( 'EB_EVENT_MANAGEMENT' ), 'generic.png' );	
JToolBarHelper::deleteList(JText::_('EB_DELETE_EVENT_CONFIRM'), 'remove_events');
JToolBarHelper::addNewX('add_event');
JToolBarHelper::editListX('edit_event');
JToolBarHelper::customX( 'copy_event', 'copy.png', 'copy_f2.png', 'Copy' );
JToolBarHelper::publishList('events_publish');				
JToolBarHelper::unpublishList('events_unpublish');				
$ordering = ($this->lists['order'] == 'a.ordering');

JHTML::_('behavior.tooltip');
?>
<form action="index.php?option=com_eventbooking&view=events" method="post" name="adminForm" id="adminForm">
<table width="100%">
<tr>
	<td align="left" width="50%" style="text-align: left;">
		<?php echo JText::_( 'Filter' ); ?>:
		<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />		
		<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
		<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>		
	</td>			
	<td style="text-align: right;">
		<strong><?php echo JText::_('EB_PAST_EVENTS'); ?></strong>:&nbsp;&nbsp;&nbsp;<?php echo $this->lists['past_event']; ?>
		<strong><?php echo JText::_('EB_CATEGORY'); ?></strong>:&nbsp;&nbsp;&nbsp;
		<?php echo $this->lists['category_id'] ; ?>
		<?php echo $this->lists['filter_state'] ; ?>
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
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<th class="title" style="text-align: left;">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_TITLE'), 'a.title', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title" width="18%" style="text-align: left;">
				<?php echo JText::_('EB_CATEGORY'); ?>				
			</th>
			<th class="title" width="7%">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_EVENT_DATE'), 'a.event_date', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>			
			<th class="title" width="7%">
				<?php echo JHTML::_('grid.sort', JText::_('EB_CAPACITY'), 'a.event_capacity', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>																							
			<th class="title" width="7%">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_NUMBER_REGISTRANTS'), 'total_registrants', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="10%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_ORDER'), 'a.ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				<?php echo JHTML::_('grid.order',  $this->items , 'filesave.png', 'save_event_order' ); ?>
			</th>	
			<?php
				if ($this->activateRecurringEvent) {
				?>
					<th width="8%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort', JText::_('EB_EVENT_TYPE'), 'a.event_type', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>	
				<?php	
				} 
			?>		
			<th width="5%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort', JText::_('EB_PUBLISHED'), 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="1%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_ID'), 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>			
		</tr>
	</thead>
	<?php
		if ($this->activateRecurringEvent)
			$colspan = 11 ;
		else 
			$colspan = 10 ;	
	?>
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
	if (version_compare(JVERSION, '1.6.0', 'ge'))
	    $param = null ;
	else 
	    $param = 0 ;    
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		$link 	= JRoute::_( 'index.php?option=com_eventbooking&task=edit_event&cid[]='. $row->id );
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$published 	= JHTML::_('grid.published', $row, $i, 'tick.png', 'publish_x.png', 'events_' );		
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>	
			<td>
				<a href="<?php echo $link; ?>">
					<?php echo $row->title ; ?>
				</a>
			</td>
			<td>
				<?php echo $row->category_name ; ?>
			</td>
			<td align="center">
				<?php echo JHTML::_('date', $row->event_date, $this->dateFormat, $param); ?>
			</td>
			<td align="center">				
				<?php echo $row->event_capacity; ?>											
			</td>									
			<td align="center">
				<?php echo (int) $row->total_registrants ; ?>
			</td>
			<td class="order">
				<span><?php echo $this->pagination->orderUpIcon( $i, ($row->category_id == @$this->items[$i-1]->category_id),'orderup_event', 'Move Up', $ordering ); ?></span>
				<span><?php echo $this->pagination->orderDownIcon( $i, $n, ($row->category_id == @$this->items[$i+1]->category_id), 'orderdown_event', 'Move Down', $ordering ); ?></span>
				<?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>				
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering;?>" class="text_area" style="text-align: center" <?php echo $disabled; ?> />
			</td>
			<?php
				if ($this->activateRecurringEvent) {
				?>
					<td align="left">
						<?php
							if ($row->event_type == 0)
								echo JText::_('EB_STANDARD_EVENT');
							elseif($row->event_type == 1) {
								echo JText::_('EB_PARENT_EVENT');
							} else {
								echo JText::_('EB_CHILD_EVENT');
							}								
						?>
					</td>	
				<?php	
				} 
			?>
			<td align="center">
				<?php echo $published; ?>
			</td>								
			<td align="center">
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
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>