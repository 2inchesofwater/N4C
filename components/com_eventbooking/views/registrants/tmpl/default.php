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
	<h1 class="eb_title"><?php echo JText::_('EB_REGISTRANT_LIST'); ?></h1>
<?php    
} else {
    $param = 0 ;
?>
	<div class="componentheading"><?php echo JText::_('EB_REGISTRANT_LIST'); ?></div>
<?php    
}
if ($this->config->fix_next_button) {
    $action = 'index.php?option=com_eventbooking&view=registrants&Itemid='.$this->Itemid ;
} else {
    $action = 'index.php?option=com_eventbooking&view=registrants' ;
}
?>
<form action="<?php echo $action ; ?>" method="post" name="adminForm">
	<table width="100%">
		<tr>
			<td align="left">
				<?php echo JText::_( 'EB_FILTER' ); ?>:
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />		
				<button onclick="this.form.submit();"><?php echo JText::_( 'EB_GO' ); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'EB_RESET' ); ?></button>		
			</td >	
			<td style="text-align: right;">
				<?php echo $this->lists['event_id'] ; ?>
				<?php echo $this->lists['published'] ; ?>
			</td>
		</tr>
	</table>
<?php
	if (count($this->items)) {
	?>		
		<table width="100%">
		<thead>
			<tr>
				<td width="5" class="sectiontableheader">
					<?php echo JText::_( 'NUM' ); ?>
				</td>				
				<td class="sectiontableheader list_first_name">
					<?php echo JHTML::_('grid.sort',  JText::_('EB_FIRST_NAME'), 'a.first_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</td>						
				<td class="sectiontableheader list_last_name">
					<?php echo JHTML::_('grid.sort',  JText::_('EB_LAST_NAME'), 'a.last_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
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
				<td class="sectiontableheader list_email">
					<?php echo JHTML::_('grid.sort',  JText::_('EB_EMAIL'), 'a.email', $this->lists['order_Dir'], $this->lists['order'] ); ?>
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
							<td colspan="9">
								<?php echo $this->pagination->getListFooter(); ?>
							</td>	
						<?php	
						} else {
						?>
							<td colspan="8">
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
			$link 	= JRoute::_( 'index.php?option=com_eventbooking&task=edit_registrant&cid[]='. $row->id );
			$tab = $tabs[$k] ;			
			$isMember = $row->group_id > 0 ? true : false ;
			if ($isMember) {
				$groupLink = JRoute::_( 'index.php?option=com_eventbooking&task=edit_registrant&cid[]='. $row->group_id );
			}				
			?>
			<tr class="<?php echo $tab; ?>">
				<td>
					<?php echo $this->pagination->getRowOffset( $i ); ?>
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
					<?php echo $row->title ; ?>
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
				<td style="text-align: center;">
					<?php echo $row->email; ?>
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
	?>
		<div align="center" class="info"><?php echo JText::_('EB_NO_REGISTRATION_RECORDS');?></div>
	<?php	
	}
?>
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
					alert("Please choose an event to add registration record");
					form.event_id.focus();
					return 
				}
			}
			submitform(pressbutton);
		}	
	</script>	
</form>