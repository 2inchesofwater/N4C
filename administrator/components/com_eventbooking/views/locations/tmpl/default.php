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
JToolBarHelper::title(   JText::_( 'Locations management' ), 'generic.png' );	
JToolBarHelper::deleteList('Do you want to remove selected locations ?', 'remove_locations');
JToolBarHelper::editListX('edit_location');	
JToolBarHelper::addNewX('add_location');
JToolBarHelper::publishList('locations_publish');
JToolBarHelper::unpublishList('locations_unpublish');	
?>
<form action="index.php?option=com_eventbooking&view=locations" method="post" name="adminForm" id="adminForm">
<table>
<tr>
	<td align="left" width="100%">
		<?php echo JText::_( 'Filter' ); ?>:
		<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />		
		<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
		<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>		
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
			<th style="text-align: left;">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_NAME'), 'a.name', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<th style="text-align: left;">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_ADDRESS'), 'a.address', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<th style="text-align: left;">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_CITY'), 'a.city', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th style="text-align: left;">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_STATE'), 'a.state', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_ZIP'), 'a.zip', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_COUNTRY'), 'a.country', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_LATITUDE'), 'a.lat', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_LONGITUDE'), 'a.long', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_PUBLISHED'), 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>								
			<th width="1%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_ID'), 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="12">
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
		$link 	= JRoute::_( 'index.php?option=com_eventbooking&task=edit_location&cid[]='. $row->id );
		$checked 	= JHTML::_('grid.id',   $i, $row->id );		
		$published = JHTML::_('grid.published', $row, $i, 'tick.png', 'publish_x.png', 'locations_' );									
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
					<?php echo $row->name; ?>
				</a>
			</td>				
			<td>
				<?php echo $row->address ; ?>
			</td>						
			<td>
				<?php echo $row->city ; ?>
			</td>
			<td>
				<?php echo $row->state ; ?>
			</td>
			<td>
				<?php echo $row->zip ; ?>
			</td>
			<td>
				<?php echo $row->country ; ?>
			</td>
			<td>
				<?php echo $row->lat ; ?>
			</td>
			<td>
				<?php echo $row->long ; ?>
			</td>
			<td align="center">
				<?php echo $published ; ?>
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
	<input type="hidden" name="task" value="show_locations" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>