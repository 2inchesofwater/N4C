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
JToolBarHelper::title(JText::_( 'EB_COUPON_MANAGEMENT' ), 'generic.png' );
JToolBarHelper::deleteList(JText::_('Do you want to remove the selected coupons?') , 'remove_coupons');
JToolBarHelper::editListX('edit_coupon');	
JToolBarHelper::addNewX('add_coupon');
JToolBarHelper::publishList('coupons_publish');
JToolBarHelper::unpublishList('coupons_unpublish');
JHTML::_('behavior.tooltip'); 							
?>
<form action="index.php?option=com_eventbooking&view=coupons" method="post" name="adminForm" id="adminForm">
<table width="100%">
<tr>
	<td>
		<?php echo JText::_( 'Filter' ); ?>:
		<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />		
		<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
		<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>		
	</td>	
	<td style="float:right;">
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
				<?php echo JHTML::_('grid.sort',  JText::_('EB_CODE'), 'a.code', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>								
			<th width="15%" class="title" nowrap="nowrap">
				<?php echo JText::_('Discount'); ?>
			</th>									
			<th width="10%" class="title" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_TIMES'), 'a.times', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="10%" class="title" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_USED'), 'a.used', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>	
			<th width="10%" class="title" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_VALID_FROM'), 'a.valid_from', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>					
			<th width="10%" class="title" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_VALID_TO'), 'a.valid_to', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="5%" class="title" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_PUBLISHED'), 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>																
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="9">
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
		$link 	= JRoute::_( 'index.php?option=com_eventbooking&task=edit_coupon&cid[]='. $row->id );
		$checked 	= JHTML::_('grid.id',   $i, $row->id );				
		$published 	= JHTML::_('grid.published', $row, $i, 'tick.png', 'publish_x.png', 'coupons_' );			
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
					<?php echo $row->code; ?>
				</a>
			</td>
			<td style="text-align: center;">
				<?php echo number_format($row->discount, 2).$this->discountTypes[$row->coupon_type]  ;?>
			</td>										
			<td style="text-align: center;">
				<?php echo $row->times; ?>
			</td>	
			<td style="text-align: center;">
				<?php echo $row->used; ?>
			</td>
			<td align="center">
				<?php
					if ($row->valid_from != $this->nullDate) {
						echo JHTML::_('date', $row->valid_from, $this->dateFormat, $param);
					}
				?>
			</td>	
			<td align="center">
				<?php
					if ($row->valid_to != $this->nullDate) {
						echo JHTML::_('date', $row->valid_to, $this->dateFormat, $param);
					}
				?>
			</td>										
			<td align="center">
				<?php echo $published; ?>
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
	<input type="hidden" name="task" value="show_coupons" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />	
	<?php echo JHTML::_( 'form.token' ); ?>			
</form>