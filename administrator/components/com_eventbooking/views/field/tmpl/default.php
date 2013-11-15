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
	
$edit = JRequest::getVar('edit', false);	
$text = $edit ? JText::_('EB_EDIT') : JText::_('EB_NEW');	
JToolBarHelper::title(   JText::_( 'Field' ).': <small><small>[ ' . $text.' ]</small></small>' );
JToolBarHelper::save('save_field');	
JToolBarHelper::cancel('cancel_field');	
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel_field') {
			submitform( pressbutton );
			return;				
		} else {
			//Should validate the information here
			if (form.name.value == "") {
				alert("<?php echo JText::_('EB_ENTER_FIELD_NAME'); ?>");
			}
			if (form.title.value == "") {
				alert("<?php echo JText::_("EB_ENTER_FIELD_TITLE"); ?>");
				form.title.focus();
				return ; 
			}
			if (form.field_type.value == -1) {
				alert("<?php echo JText::_("EB_CHOOSE_FIELD_TYPE") ; ?>");
				return ; 
			}			
			submitform( pressbutton );
		}
	}
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col width-95" style="float:left">			
	<table class="admintable" width="100%">		
		<tr>
			<td class="key" valign="top"> 
				<?php echo JText::_('EB_EVENT'); ?>
			</td>
			<td>
				<?php echo $this->lists['event_id'] ; ?>
			</td>
			<td>
				&nbsp;
			</td>
		</tr>			
		<tr>
			<td class="key" width="30%">
				<?php echo  JText::_('EB_NAME'); ?>				
			</td>
			<td>
				<input class="text_area" type="text" name="name" id="name" size="50" maxlength="250" value="<?php echo $this->item->name;?>" onchange="checkFieldName();" />
			</td>
			<td>
				<?php echo JText::_('EB_FIELD_NAME_REQUIREMENT'); ?>
			</td>
		</tr>
		<tr>
			<td class="key" width="30%">
				<?php echo  JText::_('EB_TITLE'); ?>				
			</td>
			<td>
				<input class="text_area" type="text" name="title" id="title" size="50" maxlength="250" value="<?php echo $this->item->title;?>" />
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_('EB_FIELD_TYPE'); ?>
			</td>
			<td>
				<?php echo $this->lists['field_type']; ?>
			</td>
			<td>
				&nbsp;
			</td>
		</tr>		
		<tr>
			<td class="key">
				<?php echo JText::_('EB_DISPLAY_IN'); ?>
			</td>
			<td>
				<?php echo $this->lists['display_in']; ?>
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo  JText::_('EB_DESCRIPTION'); ?>
			</td>
			<td>
				<textarea rows="5" cols="50" name="description"><?php echo $this->item->description;?></textarea>
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_('EB_REQUIRED'); ?>
			</td>
			<td>
				<?php echo $this->lists['required']; ?>
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_('EB_VALUES'); ?>
			</td>
			<td>
				<textarea rows="5" cols="50" name="values"><?php echo $this->item->values; ?></textarea>
			</td>
			<td>
				<?php echo JText::_('EB_EACH_ITEM_LINE'); ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_('EB_DEFAULT_VALUES'); ?>
			</td>
			<td>
				<textarea rows="5" cols="50" name="default_values"><?php echo $this->item->default_values; ?></textarea>
			</td>
			<td>
				<?php echo JText::_('EB_EACH_ITEM_LINE'); ?>
			</td>
		</tr>	
		<tr>
			<td class="key"><?php echo JText::_('EB_FEE_FIELD') ; ?></td>
			<td>
				<?php echo $this->lists['fee_field']; ?>
			</td>
			<td>
				&nbsp;
			</td>			
		</tr>	
		<tr>
			<td class="key">
				<?php echo JText::_('EB_FEE_VALUES'); ?>
			</td>
			<td>
				<textarea rows="5" cols="50" name="fee_values"><?php echo $this->item->fee_values; ?></textarea>
			</td>
			<td>
				 <?php echo JText::_('EB_EACH_ITEM_LINE'); ?>
			</td>
		</tr>			
		<tr>
			<td class="key">
				<?php echo JText::_('EB_FEE_FORMULA') ; ?>
			</td>
			<td>
				<input type="text" class="inputbox" size="50" name="fee_formula" value="<?php echo $this->item->fee_formula ; ?>" />
			</td>
			<td>
				<?php echo JText::_('EB_FEE_FORMULA_EXPLAIN'); ?>
			</td>
		</tr>
		<?php	
			if ($this->integration) {
			?>
				<tr>
					<td class="key">
						<?php echo JText::_('EB_FIELD_MAPPING') ; ?>
					</td>
					<td>
						<?php echo $this->lists['field_mapping'] ; ?>						
					</td>
					<td>
						<?php echo JText::_('EB_FIELD_MAPPING_EXPLAIN'); ?> 
					</td>
				</tr>
			<?php	
			}
		?>		
		<tr>
			<td class="key" width="30%">
				<?php echo  JText::_('EB_ROWS'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="rows" id="rows" size="10" maxlength="250" value="<?php echo $this->item->rows;?>" />
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class="key" width="30%">
				<?php echo  JText::_('EB_COLS'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="cols" id="cols" size="10" maxlength="250" value="<?php echo $this->item->cols;?>" />
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class="key" width="30%">
				<?php echo  JText::_('EB_SIZE'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="size" id="size" size="10" maxlength="250" value="<?php echo $this->item->size;?>" />
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class="key" width="30%">
				<?php echo  JText::_('EB_CSS_CLASS'); ?>
			</td>
			<td>
				<input class="text_area" type="text" name="css_class" id="css_class" size="10" maxlength="250" value="<?php echo $this->item->css_class;?>" />
			</td>
			<td>
				&nbsp;
			</td>
		</tr>		
		<tr>
			<td class="key">
				<?php echo JText::_('EB_PUBLISHED'); ?>
			</td>
			<td>
				<?php echo $this->lists['published']; ?>
			</td>
			<td>
				&nbsp;
			</td>
		</tr>		
	</table>			
</div>		
<div class="clr"></div>
	<input type="hidden" name="option" value="com_eventbooking" />
	<input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="task" value="" />	
	<?php echo JHTML::_( 'form.token' ); ?>	
	<script type="text/javascript" language="javascript">
		function checkFieldName() {
			var form = document.adminForm ;
			var name = form.name.value ;
			var oldValue = name ;			
			name = name.replace('eb_','');			
			name = name.replace(/[^a-zA-Z0-9_]*/ig, '');
			form.name.value='eb_' + name;						
		}
	</script>	
</form>