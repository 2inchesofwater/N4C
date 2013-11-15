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
		
JToolBarHelper::title(   JText::_( 'Translation management'), 'generic.png' );
JToolBarHelper::addNew('new_item', 'New Item');
JToolBarHelper::save('save_translation');	
JToolBarHelper::cancel('cancel_translation');	
?>
<script language="javascript" type="text/javascript">
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton == 'new_item') {			
		newLanguageItem();						
	} else {
		submitform( pressbutton );
	}
}		
function newLanguageItem() {
	table = document.getElementById('lang_table');
	row = table.insertRow(1);		
	cell0  = row.insertCell(0);
	cell0.innerHTML = '<input type="text" name="extra_keys[]" class="inputbox" size="50" />';
	cell1 = row.insertCell(1);		
	cell2 = row.insertCell(2);
	cell2.innerHTML = '<input type="text" name="extra_values[]" class="inputbox" size="100" />';
}
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<table width="100%">
		<tr>			
			<td style="text-align: left;">
				<?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />		
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
			</td>
			<td style="text-align: right;">
				<strong><?php echo JText::_('EB_SELECT_LANGUAGE'); ?></strong><?php echo $this->lists['lang']; ?>							
			</td>			
		</tr>
	</table>			
	<table class="admintable" style="width:100%" id="lang_table">
		<tr>
			<td class="key" style="width:20%; text-align: left;"><?php echo JText::_('EB_KEY'); ?></td>
			<td class="key" style="width:40%; text-align: left;"><?php echo JText::_('EB_ORIGINAL'); ?></td>
			<td class="key" style="width:40%; text-align: left;"><?php echo JText::_('EB_TRANSLATION'); ?></td>
		</tr>		
		<?php
			$original = $this->trans['en-GB'][$this->item] ;
			$trans = $this->trans[$this->lang][$this->item] ;
			$search = $this->lists['search'] ;
			foreach ($original as  $key=>$value) {
				$show = true ;
				if (isset($trans[$key])) {
					$translatedValue = $trans[$key];
					$missing = false ; 	
				} else {
					$translatedValue = $value;
					$missing = true ;
				}		
				if ($search) {					
					if (strpos(JString::strtolower($key), $search) === false && strpos(JString::strtolower($value), $search) === false) {
						$show = false ;
					}									
				}  				
				if ($show) {
				?>
					<tr>
					<td class="key" style="text-align: left;"><?php echo $key; ?></td>
					<td style="text-align: left;"><?php echo $value; ?></td>
					<td>						
						<input type="hidden" name="keys[]" value="<?php echo $key; ?>" />
						<input type="text" name="<?php echo $key; ?>" class="inputbox" size="100" value="<?php echo $translatedValue; ; ?>" />
						<?php
							if ($missing) {
							?>
								<span style="color:red;">*</span>
							<?php	
							}							
						?>
					</td>					
				</tr>	
				<?php	
				}else {
				?>
					<input type="hidden" name="keys[]" value="<?php echo $key; ?>" />
					<input type="hidden" name="<?php echo $key; ?>"  value="<?php echo $translatedValue; ; ?>" />
				<?php	
				}			
			}
		?>
	</table>
	<input type="hidden" name="option" value="com_eventbooking" />	
	<input type="hidden" name="task" value="show_translation" />		
	<input type="hidden" name="item" value="com_eventbooking" />	
	<?php echo JHTML::_( 'form.token' ); ?>
</form>