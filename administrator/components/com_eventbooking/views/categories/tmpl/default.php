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
JToolBarHelper::title(JText::_( 'EB_CATEGORY_MANAGEMENT' ), 'generic.png' );
JToolBarHelper::deleteList(JText::_('EB_DELETE_CATEGORY_CONFIRM') , 'remove_categories');
JToolBarHelper::editListX('edit_category');	
JToolBarHelper::addNewX('new_category');
JToolBarHelper::customX( 'copy_category', 'copy.png', 'copy_f2.png', 'Copy', true );
JToolBarHelper::publishList('categories_publish');
JToolBarHelper::unpublishList('categories_unpublish');		
$ordering = ($this->lists['order'] == 'a.ordering');

JHTML::_('behavior.tooltip');
?>
<form action="index.php?option=com_eventbooking&view=categories" method="post" name="adminForm" id="adminForm">
<table width="100%">
<tr>
	<td align="left">
		<?php echo JText::_( 'Filter' ); ?>:
		<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />		
		<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
		<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>		
	</td>
	<td style="text-align: right;">
		<?php echo $this->lists['parent']; ?>
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
				<?php echo JHTML::_('grid.sort',  JText::_('EB_NAME'), 'a.name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>											
			<th class="title" width="10%">
				<?php echo JText::_('EB_NUMBER_EVENTS'); ?>
			</th>			
			<th width="10%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_ORDER'), 'a.ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				<?php echo JHTML::_('grid.order',  $this->items , 'filesave.png', 'save_category_order' ); ?>
			</th>
			<th width="5%">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_PUBLISHED'), 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="2%">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_ID'), 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>													
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="8">
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
		$link 	= JRoute::_( 'index.php?option=com_eventbooking&task=edit_category&cid[]='. $row->id );
		$checked 	= JHTML::_('grid.id',   $i, $row->id );				
		$published 	= JHTML::_('grid.published', $row, $i, 'tick.png', 'publish_x.png', 'categories_' );			
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
					<?php echo $row->treename; ?>
				</a>
			</td>									
			<td style="text-align: center;">
				<?php echo $row->total_events; ?>
			</td>												
			<td class="order">
				<span><?php echo $this->pagination->orderUpIcon( $i, ($row->parent==0 || $row->parent == @$this->items[$i-1]->parent),'orderup_category', 'Move Up', $ordering ); ?></span>
				<span><?php echo $this->pagination->orderDownIcon( $i, $n, ($row->parent ==0 || $row->parent == @$this->items[$i+1]->parent), 'orderdown_category', 'Move Down', $ordering ); ?></span>
				<?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>				
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering;?>" class="text_area" style="text-align: center" <?php echo $disabled; ?> />
			</td>			
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
	<input type="hidden" name="task" value="show_categories" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />	
	<?php echo JHTML::_( 'form.token' ); ?>			
</form>