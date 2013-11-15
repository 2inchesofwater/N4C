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
?>
	<div class="componentheading"><?php echo JText::_('EB_REGISTRANT_LIST'); ?></div>  	
<?php    
    $param = 0 ;
}
if (count($this->items)) {
?>		
	<table width="100%">
	<thead>
		<tr>
			<td width="5" class="sectiontableheader">
				<?php echo JText::_( 'NUM' ); ?>
			</td>				
			<td class="sectiontableheader">
				<?php echo JText::_('EB_FIRST_NAME'); ?>
			</td>
			<td class="sectiontableheader">						
				<?php echo JText::_('EB_LAST_NAME'); ?>
			</td>								
			<td class="sectiontableheader">
				<?php echo JText::_('EB_REGISTRANTS'); ?>
			</td>																
			<td class="sectiontableheader">
				<?php echo JText::_('EB_REGISTRATION_DATE'); ?>
			</td>
			<?php
				if ($this->displayCustomField) {
					foreach($this->fields as $fieldId) {
					?>
						<td class="sectiontableheader">
							<?php echo $this->fieldTitles[$fieldId] ; ?>
						</td>
					<?php	
					}	
				}
			?>
		</tr>
	</thead>		
	<tbody>
	<?php
	$k = 0;
	$tabs = array('sectiontableentry1', 'sectiontableentry2') ;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];			
		$tab = $tabs[$k] ;							
		?>
		<tr class="<?php echo $tab; ?>">
			<td>
				<?php echo $i+1 ; ?>
			</td>					
			<td>					
					<?php echo $row->first_name ?>					
			</td>			
			<td>
				<?php echo $row->last_name ; ?>
			</td>
			<td>
				<?php echo $row->number_registrants ; ?>
			</td>				
			<td>
				<?php echo JHTML::_('date', $row->register_date, $this->config->date_format, $param) ; ?>
			</td>	
			<?php
				if ($this->displayCustomField) {
					foreach($this->fields as $fieldId) {
					?>
						<td class="sectiontableheader">
							<?php echo $this->fieldValues[$row->id][$fieldId] ; ?>
						</td>
					<?php	
					}	
				}
			?>							
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