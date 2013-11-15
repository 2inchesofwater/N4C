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
JToolBarHelper::title(   JText::_( 'Field management' ), 'generic.png' );	
JToolBarHelper::deleteList('Do you want to remove selected fields ?', 'remove_fields');
JToolBarHelper::editListX('edit_field');	
JToolBarHelper::addNewX('add_field');
JToolBarHelper::customX( 'copy_field', 'copy.png', 'copy_f2.png', 'Copy' );
JToolBarHelper::publishList('fields_publish');
JToolBarHelper::unpublishList('fields_unpublish');	
?>
<form action="index.php?option=com_eventbooking&view=fields" method="post" name="adminForm" id="adminForm">
<table width="100%">
<tr>
	<td align="left">
		<?php echo JText::_( 'Filter' ); ?>:
		<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />		
		<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
		<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>		
	</td>	
	<td style="float: right;">		
		<?php echo $this->lists['event_id']; ?>
		<?php echo $this->lists['filter_state']; ?>
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
				<?php echo JHTML::_('grid.sort', JText::_('EB_NAME'), 'a.name', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<th style="text-align: left;">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_TITLE'), 'a.title', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<th style="text-align: left;">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_FIELD_TYPE'), 'a.field_type', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_REQUIRE'), 'a.required', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_PUBLISHED'), 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="8%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_ORDER'), 'a.ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				<?php echo JHTML::_('grid.order',  $this->items , 'filesave.png', 'save_field_order' ); ?>
			</th>						
			<th width="1%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_ID'), 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
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
	$j15 = version_compare(JVERSION, '1.6.0', 'ge') ? false : true ;
	$ordering = ($this->lists['order'] == 'a.ordering');
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		$link 	= JRoute::_( 'index.php?option=com_eventbooking&task=edit_field&cid[]='. $row->id );
		$checked 	= JHTML::_('grid.id',   $i, $row->id );		
		$published = JHTML::_('grid.published', $row, $i, 'tick.png', 'publish_x.png', 'fields_' );					
		$img 	= $row->required ? 'tick.png' : 'publish_x.png';
		$task 	= $row->required ? 'un_required' : 'required';
		$alt 	= $row->required ? JText::_( 'EB_REQUIRED' ) : JText::_( 'EB_NOT_REQUIRED' );
		$action = $row->required ? JText::_( 'EB_NOT_REQUIRE' ) : JText::_( 'EB_REQUIRE' );
		if ($j15) {
		    $href = '
    		<a href="javascript:void(0);" onclick="return listItemTask(\'cb'. $i .'\',\''. $task .'\')" title="'. $action .'">
    		<img src="images/'. $img .'" border="0" alt="'. $alt .'" /></a>'
    		;    
		} else {
		    $img = JHTML::_('image','admin/'.$img, $alt, array('border' => 0), true) ;
    		$href = '
    		<a href="javascript:void(0);" onclick="return listItemTask(\'cb'. $i .'\',\''. $task .'\')" title="'. $action .'">'.
    		$img .'</a>'
    		;
		}						
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
				<a href="<?php echo $link; ?>">
					<?php echo $row->title; ?>
				</a>
			</td>
			<td>
				<?php
					$fieldTypes = array(
					1 => 'Textbox' ,
					2 => 'Textarea' ,
					3 => 'Dropdown' ,
					4 => 'MultiSelect',
					5 => 'Checkbox List' ,
					6 => 'Radio List' ,
					7 => 'Date Time',
					8 => 'Heading',		
					9 => 'Message'								
					);
					echo $fieldTypes[$row->field_type] ;								
			 	?>
			</td>						
			<td align="center">
				<?php echo $href; ?>
			</td>
			<td align="center">
				<?php echo $published ; ?>
			</td>
			<td class="order">
				<span><?php echo $this->pagination->orderUpIcon( $i, true,'orderup_field', 'Move Up', $ordering ); ?></span>
				<span><?php echo $this->pagination->orderDownIcon( $i, $n, true, 'orderdown_field', 'Move Down', $ordering ); ?></span>
				<?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering;?>" <?php echo $disabled ?> class="text_area" style="text-align: center" />
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
	<input type="hidden" name="task" value="show_fields" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>