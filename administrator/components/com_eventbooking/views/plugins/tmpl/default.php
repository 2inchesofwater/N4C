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
	
JToolBarHelper::title(   JText::_( 'EB_PAYMENT_PLUGIN_MANAGEMENT' ), 'generic.png' );			
JToolBarHelper::publishList('plugins_publish');
JToolBarHelper::unpublishList('plugins_unpublish');	
JToolBarHelper::deleteList(JText::_('EB_PAYMENT_PLUGIN_MANAGEMENT'), 'uninstall_plugin', 'Uninstall');				
?>
<form action="index.php?option=com_eventbooking&view=plugins" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
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
			<th class="title" style="text-align: left;">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_NAME'), 'a.name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title" width="20%" style="text-align: left;">
				<?php echo JHTML::_('grid.sort', JText::_('EB_TITLE'), 'a.title', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>			
			<th class="title" style="text-align: left;">
				<?php echo JHTML::_('grid.sort', JText::_('EB_AUTHOR') , 'a.author', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>			
			<th class="title">
				<?php echo JHTML::_('grid.sort', JText::_('EB_AUTHOR_EMAIL'), 'a.email', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>			
			<th>
				<?php echo JHTML::_('grid.sort', JText::_('EB_PUBLISHED') , 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="8%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  JText::_('EB_ORDER'), 'a.ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				<?php echo JHTML::_('grid.order',  $this->items , 'filesave.png', 'save_plugin_order' ); ?>
			</th>												
			<th>
				<?php echo JHTML::_('grid.sort', JText::_('EB_ID') , 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
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
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		$link 	= JRoute::_( 'index.php?option=com_eventbooking&task=edit_plugin&cid[]='. $row->id );
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$ordering = ($this->lists['order'] == 'a.ordering');
		$ordering = true ;
		$published 	= JHTML::_('grid.published', $row, $i, 'tick.png', 'publish_x.png', 'plugins_' );			
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
				<?php echo $row->title; ?>
			</td>												
			<td>
				<?php echo $row->author; ?>
			</td>
			<td align="center">
				<?php echo $row->author_email;?>
			</td>
			<td align="center">
				<?php echo $published ; ?>
			</td>			
			<td class="order">
				<span><?php echo $this->pagination->orderUpIcon( $i, true,'orderup_plugin', 'Move Up', $ordering ); ?></span>
				<span><?php echo $this->pagination->orderDownIcon( $i, $n, true, 'orderdown_plugin', 'Move Down', $ordering ); ?></span>
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
	<table class="adminform" style="margin-top: 50px;">
		<tr>
			<td>
				<fieldset class="adminform">
					<legend><?php echo JText::_('EB_INSTALL_PLUGIN'); ?></legend>
					<table>
						<tr>
							<td>
								<input type="file" name="plugin_package" id="plugin_package" size="50" class="inputbox" /> <input type="button" class="button" value="<?php echo JText::_('EB_INSTALL'); ?>" onclick="installPlugin();" />
							</td>
						</tr>
					</table>					
				</fieldset>
			</td>
		</tr>		
	</table>
	</div>
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="task" value="show_plugins" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />	
	<?php echo JHTML::_( 'form.token' ); ?>				 
	<script type="text/javascript">
		function installPlugin() {
			var form = document.adminForm ;
			if (form.plugin_package.value =="") {
				alert("<?php echo JText::_('EB_CHOOSE_PLUGIN'); ?>");
				return ;	
			}
			form.task.value = 'install_plugin' ;
			form.submit();
		}
	</script>
</form>