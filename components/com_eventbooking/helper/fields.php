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

define('NUMBER_OPTION_PER_LINE', 3) ;
define('FIELD_TYPE_TEXTBOX', 1);
define('FIELD_TYPE_TEXTAREA', 2);
define('FIELD_TYPE_DROPDOWN', 3) ;
define('FIELD_TYPE_MULTISELECT', 4) ;
define('FIELD_TYPE_CHECKBOXLIST', 5) ;
define('FIELD_TYPE_RADIOLIST', 6) ;
define('FIELD_TYPE_DATETIME', 7) ;
define('FIELD_TYPE_HEADING', 8) ;
define('FIELD_TYPE_MESSAGE', 9) ;
class JCFields {
	/**
	 * List of custom fields used in the system
	 *
	 * @var array
	 */
	var $_fields = null ;
	
	var $_loadIn = null ;
	/**
	 * Constructor function
	 *
	 * @param int $eventId  ID of the event
	 * @param boolean $loadFromProfile : Load the default value from use profile or not
	 * @param int $loadIn 0 : Individual billing form, 1 : Group Billing Form, 2 : Group Member Form, 4 : Multiple Booking
	 * @return JCFields
	 */
	function JCFields($eventId, $loadFromProfile = false, $loadIn) {
		$this->_loadIn = $loadIn ;
		$db = & JFactory::getDBO() ;
		$user = & JFactory::getUser() ;
		$userId = $user->get('id');
		$integration = EventBookingHelper::getConfigValue('cb_integration') ;		
		if ($integration && $userId && $loadFromProfile) {
			if ($integration == 1) {
				$sql = 'SELECT * FROM #__comprofiler WHERE user_id='.$userId;
				$db->setQuery($sql) ;
				$rowProfile = $db->loadObject();			
			} elseif ($integration == 2) {
				$sql = 'SELECT cf.fieldcode , fv.value FROM #__community_fields AS cf '
					. ' INNER JOIN #__community_fields_values AS fv '
					. ' ON cf.id = fv.field_id '
					. ' WHERE fv.user_id = '.$userId 
				;				
				$db->setQuery($sql);			
				$rows = $db->loadObjectList();
				$rowProfile = new stdClass() ;
				for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
					$row = $rows[$i] ;
					$fieldName = $row->fieldcode ;
					$fieldValue = $row->value ;
					$rowProfile->$fieldName = $fieldValue ;			
				}
			}				
		}		
		$where = array() ;
		$where[] = ' published = 1 ' ;
		if ($loadIn == 4) {
			//Get all events from front-end
			require_once JPATH_COMPONENT.DS.'helper'.DS.'os_cart.php';
			$cart = new EBCart() ;
			$items = $cart->getItems();
			if (!count($items)) {
				//Get list of events
				$sql = 'SELECT DISTINCT event_id FROM #__eb_registrants WHERE id='.$eventId.' OR group_id='.$eventId;
				$db->setQuery($sql) ;
				$items = $db->loadResultArray();
			}
			$where[] = ' (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id IN ('.implode(',', $items).')))' ;
		} else {
			$where[] = ' (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id='.$eventId.'))' ;	
		}		
		switch ($loadIn) {
			case 0 :
				$where[] = '(display_in IN (0, 1, 3, 5))';
				break ;
			case 1 :
				$where[] = '(display_in IN (0, 2, 3))' ;
				break ;
			case 2 :			
				$where[] = '(display_in IN (0, 4, 5))' ;
				break ;
		}		
		$sql = 'SELECT * FROM #__eb_fields WHERE '.implode(' AND ', $where).' ORDER BY ordering';		
		$db->setQuery($sql);													
		if ($userId && $integration && $loadFromProfile) {
			$rows = $db->loadObjectList();			
			for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
				$row = & $rows[$i] ;
				$row->title = JText::_($row->title);
				if ($row->field_mapping) {
					$fieldName = $row->field_mapping ;				
					if ($fieldName) {
						if (isset($rowProfile->$fieldName)) {
							$defaultValues = $rowProfile->$fieldName ;
							$defaultValues = str_replace('|*|', "\r\n", $defaultValues) ;
							$row->default_values = $defaultValues ;
						}
					}															
				}
			}	
			$this->_fields = $rows ;
		} else {
			$rows = $db->loadObjectList();
			for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
				$row = $rows[$i] ;
				$row->title = JText::_($row->title);
			}
			
			$this->_fields = $rows ;			
		}			
	}	
	/**
	 * Get total custom fields
	 *
	 * @return int
	 */	
	function getTotal() {
		return count($this->_fields);		
	}
	/**
	 * Render a textbox
	 *
	 * @param object $row
	 */
	function _renderTextBox($row) {
		if ($this->_loadIn ==  2)
			$postedValue = $row->default_values ;
		else 			
			$postedValue = JRequest::getVar($row->name,  $row->default_values) ;
	?>	
		<tr>
			<td class="title_cell">
				<?php 
					echo JText::_($row->title);
					if ($row->required)
						echo '<span class="required">*</span>'; 
				?>
			</td>
			<td>
				<input type="text" name="<?php echo $row->name ; ?>" class="<?php echo $row->css_class; ?>" size="<?php echo $row->size ; ?>" value="<?php echo $postedValue ; ?>" />
			</td>
		</tr>		
	<?php
	}
	/**
	 * Textbox output
	 *
	 * @param object $row
	 */
	function _renderTextBoxOutput($row) {
		if ($this->_loadIn == 2)
			$postedValue = $row->default_values ;
		else				
			$postedValue = JRequest::getVar($row->name,  $row->default_values) ;			
	?>			
		<input type="text" name="<?php echo $row->name ; ?>" class="<?php echo $row->css_class; ?>" size="<?php echo $row->size ; ?>" value="<?php echo $postedValue ; ?>" />					
	<?php
	}	
	/**
	 * Render textbox when edit a donor
	 *
	 * @param object $row
	 * @param string $value
	 */
	function _renderTextBoxEdit($row, $value) {
	?>
		<tr>
			<td class="key title_cell">
				<?php echo JText::_($row->title); ?>
			</td>
			<td>
				<input type="text" name="<?php echo $row->name ; ?>" class="<?php echo $row->css_class; ?>" size="<?php echo $row->size ; ?>" value="<?php echo $value ; ?>" />	
			</td>
		</tr>
	<?php	
	}	
	/**
	 * Gender validation for textbox 
	 *
	 * @param object $row
	 */
	function _renderTextBoxValidation($row) {
	?>
		if (form.<?php echo $row->name; ?>.value == "") {
			alert("<?php echo JText::_($row->title);?> <?php echo JText::_('PF_IS_REQUIRED') ; ?>");
			form.<?php echo $row->name; ?>.focus();
			return ;
		}										
	<?php		
	}
	
	/**
	 * Render textbox when edit a member in group registration
	 *
	 * @param object $row
	 * @param string $value
	 */
	function _renderMemberTextBoxEdit($row, $value, $memberId) {
	?>
		<tr>
			<td class="key title_cell">
				<?php echo JText::_($row->title); ?><?php  if ($row->required) echo '<span class="required">*</span>'; ?>
			</td>
			<td>
				<input type="text" name="<?php echo $row->name.'_'.$memberId ; ?>" class="<?php echo $row->css_class; ?>" size="<?php echo $row->size ; ?>" value="<?php echo $value ; ?>" />	
			</td>
		</tr>
	<?php	
	}	
	/**
	 * Gender validation for textbox 
	 *
	 * @param object $row
	 */
	function _renderMemberTextBoxValidation($row, $memberId) {
	?>
		if (form.<?php echo $row->name.'_'.$memberId; ?>.value == "") {
			alert("<?php echo JText::_($row->title); ?> <?php echo JText::_('PF_IS_REQUIRED') ; ?>");
			form.<?php echo $row->name.'_'.$memberId; ?>.focus();
			return ;
		}										
	<?php		
	}		
	/**
	 * Output values which users entered in the textbox field
	 *
	 * @param object $row
	 */
	function _renderTextboxConfirmation($row) {
	?>
		<tr>
			<td class="title_cell">
				<?php echo JText::_($row->title); ?>
			</td>
			<td>
				<?php
					$name = $row->name ;
					$postedValue = JRequest::getVar($name, '', 'post') ;
					echo $postedValue ;
				?>	
			</td>				
		</tr>
	<?php				
	}
	/**
	 * Render hidden field for textbox 
	 *
	 * @param object $row
	 */
	function _renderTextboxHidden($row) {
		$name = $row->name ;		
		$postedValue = JRequest::getVar($name, '', 'post') ;
	?>
		<input type="hidden" name="<?php echo $name ; ?>" value="<?php echo $postedValue; ?>" />
	<?php			
	}
	/**
	 * Render textarea object
	 *
	 * @param object $row
	 */
	function _renderTextarea($row) {
		if ($this->_loadIn == 2)
			$postedValue = $row->default_values ;
		else 	
			$postedValue = JRequest::getVar($row->name,  $row->default_values) ;
	?>
		<tr>
			<td class="title_cell">
				<?php 
					echo JText::_($row->title);
					if ($row->required)
						echo '<span class="required">*</span>'; 
				?>
			</td>
			<td>
				<textarea name="<?php echo $row->name ; ?>" rows="<?php echo $row->rows; ?>" cols="<?php echo $row->cols ; ?>" class="<?php echo $row->css_class; ?>"><?php echo $postedValue; ?></textarea>	
			</td>
		</tr>		
	<?php	
	}
	/**
	 * Render the output of text area
	 *
	 * @param object $row
	 */
	function _renderTextareaOutput($row) {
		if ($this->_loadIn == 2)
			$postedValue = $row->default_values ;
		else	
			$postedValue = JRequest::getVar($row->name,  $row->default_values) ;
	?>		
		<textarea name="<?php echo $row->name ; ?>" rows="<?php echo $row->rows; ?>" cols="<?php echo $row->cols ; ?>" class="<?php echo $row->css_class; ?>"><?php echo $postedValue; ?></textarea>					
	<?php	
	}
	/**
	 * Render textarea in edit mode
	 *
	 * @param object $row
	 * @param string $value
	 */
	function _renderTextareaEdit($row, $value) {		
	?>
		<tr>
			<td class="key title_cell">
				<?php echo JText::_($row->title); ?>
			</td>
			<td>
				<textarea name="<?php echo $row->name ; ?>" rows="<?php echo $row->rows; ?>" cols="<?php echo $row->cols ; ?>" class="<?php echo $row->css_class; ?>"><?php echo $value; ?></textarea>	
			</td>
		</tr>		
	<?php	
	}
	/**
	 * Gender validation for textarea 
	 *
	 * @param object $row
	 */
	function _renderTextAreaValidation($row) {
	?>				
		if (form.<?php echo $row->name; ?>.value == "") {
			alert("<?php echo JText::_($row->title); ?> <?php echo JText::_('JD_IS_REQUIRED') ; ?>");
			form.<?php echo $row->name; ?>.focus();
			return ;
		}	
	<?php		
	}		
	/**
	 * Render member textarea in edit mode
	 *
	 * @param object $row
	 * @param string $value
	 */
	function _renderMemberTextareaEdit($row, $value, $memberId) {		
	?>
		<tr>
			<td class="key title_cell">
				<?php echo JText::_($row->title); ?><?php  if ($row->required) echo '<span class="required">*</span>'; ?>
			</td>
			<td>
				<textarea name="<?php echo $row->name.'_'.$memberId ; ?>" rows="<?php echo $row->rows; ?>" cols="<?php echo $row->cols ; ?>" class="<?php echo $row->css_class; ?>"><?php echo $value; ?></textarea>	
			</td>
		</tr>		
	<?php	
	}
	/**
	 * Gender validation for textarea 
	 *
	 * @param object $row
	 */
	function _renderMemberTextAreaValidation($row, $memberId) {
	?>				
		if (form.<?php echo $row->name.'_'.$memberId; ?>.value == "") {
			alert("<?php echo JText::_($row->title);?> <?php echo JText::_('JD_IS_REQUIRED') ; ?>");
			form.<?php echo $row->name.'_'.$memberId; ?>.focus();
			return ;
		}	
	<?php		
	}		
	/**
	 * Output values which users entered in the textarea field
	 *
	 * @param object $row
	 */
	function _renderTextAreaConfirmation($row) {	
		$name = $row->name ;
		$postedValue = JRequest::getVar($name, '', 'post') ;
	?>
		<tr>
			<td class="title_cell">
				<?php echo $row->title ; ?>
			</td>
			<td>
				<?php echo $postedValue ; ?>
			</td>
		</tr>
	<?php			
	}
	/**
	 * Render hidden field for textarea
	 *
	 * @param object $row
	 */
	function _renderTextAreaHidden($row) {
		$name = $row->name ;		
		$postedValue = JRequest::getVar($name, '', 'post') ;
	?>
		<input type="hidden" name="<?php echo $name ; ?>" value="<?php echo $postedValue; ?>" />
	<?php			
	}		
	/**
	 * Render dropdown field type
	 *
	 * @param object $row
	 */
	function _renderDropdown($row) {		
		if ($this->_loadIn == 2)
			$postedValue = $row->default_values ;
		else 	
			$postedValue = JRequest::getVar($row->name, $row->default_values, 'post') ;			
		$options = array() ;
		$options[] = JHTML::_('select.option', '', JText::_('PF_SELECT'));		
		$values = explode("\r\n", $row->values) ;
		for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
			$options[] = JHTML::_('select.option', $values[$i], $values[$i]) ;
		}
	?>
		<tr>
			<td class="title_cell">
				<?php 
					echo JText::_($row->title);
					if ($row->required)
						echo '<span class="required">*</span>'; 
				?>
			</td>
			<td>
				<?php
					echo JHTML::_('select.genericlist', $options, $row->name, '', 'value', 'text', $postedValue);
				?>
			</td>
		</tr>
	<?php									
	}
	/**
	 * Render output of the dropdown
	 */
	function _renderDropdownOutput($row) {
		if ($this->_loadIn == 2)
			$postedValue = $row->default_values ;
		else 	
			$postedValue = JRequest::getVar($row->name, $row->default_values, 'post') ;			
		$options = array() ;
		$options[] = JHTML::_('select.option', '', JText::_('PF_SELECT'));		
		$values = explode("\r\n", $row->values) ;
		for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
			$options[] = JHTML::_('select.option', $values[$i], $values[$i]) ;
		}
	?>		
		<td>
			<?php
				echo JHTML::_('select.genericlist', $options, $row->name, '', 'value', 'text', $postedValue);
			?>
		</td>		
	<?php									
	}
	/**
	 * Render the dropdown in edit mode
	 *
	 * @param object $row
	 * @param string $value 
	 */
	function _renderDropdownEdit($row, $value) {					
		$options = array() ;
		$options[] = JHTML::_('select.option', '', JText::_('PF_SELECT'));		
		$values = explode("\r\n", $row->values) ;
		for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
			$options[] = JHTML::_('select.option', $values[$i], $values[$i]) ;
		}
		?>
			<tr>
				<td class="key title_cell">
					<?php echo JText::_($row->title); ?>
				</td>
				<td>
					<?php
						echo JHTML::_('select.genericlist', $options, $row->name, '', 'value', 'text', $value);			
					?>
				</td>
			</tr>
		<?php								
	}
	/**
	 * Gender validation for dropdown 
	 *
	 * @param object $row
	 */
	function _renderDropdownValidation($row) {
	?>		
		if (form.<?php echo $row->name; ?>.selectedIndex == 0) {
			alert("<?php echo JText::_($row->title);?> <?php echo JText::_('PF_IS_REQUIRED') ; ?>");
			form.<?php echo $row->name; ?>.focus();
			return ;
		}	
	<?php		
	}	
	/**
	 * Render the dropdown in edit mode
	 *
	 * @param object $row
	 * @param string $value 
	 */
	function _renderMemberDropdownEdit($row, $value, $memberId) {					
		$options = array() ;
		$options[] = JHTML::_('select.option', '', JText::_('PF_SELECT'));		
		$values = explode("\r\n", $row->values) ;
		for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
			$options[] = JHTML::_('select.option', $values[$i], $values[$i]) ;
		}
		?>
			<tr>
				<td class="key title_cell">
					<?php echo JText::_($row->title); ?><?php  if ($row->required) echo '<span class="required">*</span>'; ?>
				</td>
				<td>
					<?php
						echo JHTML::_('select.genericlist', $options, $row->name.'_'.$memberId, '', 'value', 'text', $value);			
					?>
				</td>
			</tr>
		<?php								
	}
	/**
	 * Gender validation for dropdown 
	 *
	 * @param object $row
	 */
	function _renderMemberDropdownValidation($row, $memberId) {
	?>		
		if (form.<?php echo $row->name.'_'.$memberId; ?>.selectedIndex == 0) {
			alert("<?php echo JText::_($row->title);?> <?php echo JText::_('PF_IS_REQUIRED') ; ?>");
			form.<?php echo $row->name.'_'.$memberId; ?>.focus();
			return ;
		}	
	<?php		
	}	
	/**
	 * Output values which users choosed in the dropdown
	 *
	 * @param object $row
	 */
	function _renderDropDownConfirmation($row) {
		$name = $row->name ;
		$postedValue = JRequest::getVar($name, '', 'post') ;
	?>
		<tr>
			<td class="title_cell">
				<?php echo $row->title ; ?>
			</td>
			<td class="field_cell">
				<?php echo $postedValue ; ?>
			</td>
		</tr>
	<?php				
	}
	/**
	 * Render hidden field for textbox 
	 *
	 * @param object $row
	 */
	function _renderDropdownHidden($row) {
		$name = $row->name ;		
		$postedValue = JRequest::getVar($name, '', 'post') ;
	?>
		<input type="hidden" name="<?php echo $name ; ?>" value="<?php echo $postedValue; ?>" />
	<?php			
	}			
	/**
	 * Render dropdown field type
	 *
	 * @param object $row
	 */
	function _renderMultiSelect($row) {
		if ($this->_loadIn == 2) {
			$selectedValues = explode("\r\n", $row->default_values) ;
		} else {
			if (isset($_POST[$row->name])) {
				$selectedValues = $_POST[$row->name] ;	
			} else {
				$selectedValues = explode("\r\n", $row->default_values) ;
			}	
		}						
		$options = array() ;
		//$options[] = JHTML::_('select.option', '', JText::_('PF_SELECT'));		
		$values = explode("\r\n", $row->values) ;
		for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
			$options[] = JHTML::_('select.option', $values[$i], $values[$i]) ;
		}		
		$selectedOptions = array() ;
		for ($i = 0 , $n = count($selectedValues); $i < $n; $i++) {
			$selectedOptions[] = JHTML::_('select.option', $selectedValues[$i], $selectedValues[$i]) ;
		}	 
	?>
		<tr>
			<td class="title_cell">
				<?php 
					echo JText::_($row->title);
					if ($row->required)
						echo '<span class="required">*</span>'; 
				?>
			</td>
			<td>
				<?php
					echo JHTML::_('select.genericlist', $options, $row->name.'[]', ' multiple="multiple" size="4" ', 'value', 'text', $selectedValues);
				?>
			</td>
		</tr>
	<?php					
	}	
	/**
	 * Render multi-select output
	 *
	 * @param object $row
	 */
	function _renderMultiSelectOutput($row) {		
		if ($this->_loadIn == 2) {
			$selectedValues = explode("\r\n", $row->default_values) ;
		} else {
			if (isset($_POST[$row->name])) {
				$selectedValues = $_POST[$row->name] ;	
			} else {
				$selectedValues = explode("\r\n", $row->default_values) ;
			}	
		}			
		$options = array() ;
		//$options[] = JHTML::_('select.option', '', JText::_('PF_SELECT'));		
		$values = explode("\r\n", $row->values) ;
		for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
			$options[] = JHTML::_('select.option', $values[$i], $values[$i]) ;
		}		
		$selectedOptions = array() ;
		for ($i = 0 , $n = count($selectedValues); $i < $n; $i++) {
			$selectedOptions[] = JHTML::_('select.option', $selectedValues[$i], $selectedValues[$i]) ;
		}	 	
		echo JHTML::_('select.genericlist', $options, $row->name.'[]', ' multiple="multiple" size="4" ', 'value', 'text', $selectedValues);							
	}			
	/**
	 * Render the dropdown in edit mode
	 *
	 * @param object $row
	 * @param string $value 
	 */
	function _renderMultiSelectEdit($row, $value) {					
		$options = array() ;
		//$options[] = JHTML::_('select.option', '', JText::_('PF_SELECT'));		
		$values = explode("\r\n", $row->values) ;
		for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
			$options[] = JHTML::_('select.option', $values[$i], $values[$i]) ;
		}
		$selectedValues = explode(',', $value) ;
		$selectedOptions = array() ;
		for ($i = 0 , $n = count($selectedValues); $i < $n; $i++) {
			$selectedOptions[] = JHTML::_('select.option', $selectedValues[$i], $selectedValues[$i]) ;
		}
		?>
			<tr>
				<td class="key title_cell">
					<?php echo JText::_($row->title); ?>
				</td>
				<td>
					<?php
						echo JHTML::_('select.genericlist', $options, $row->name.'[]', ' multiple="multiple" size="4" ', 'value', 'text', $selectedOptions);			
					?>
				</td>
			</tr>
		<?php								
	}
	/**
	 * Gender validation for dropdown 
	 *
	 * @param object $row
	 */
	function _renderMultiSelectValidation($row) {
	?>
		var selectTag =  document.getElementById('<?php echo $row->name; ?>');
		if (selectTag.selectedIndex == -1) {
			alert("<?php echo $row->title ;?> <?php echo JText::_('PF_IS_REQUIRED') ; ?>");
			form.<?php echo $row->name; ?>.focus();
			return ;
		}			
	<?php		
	}		
	/**
	 * Render the dropdown in edit mode
	 *
	 * @param object $row
	 * @param string $value 
	 */
	function _renderMemberMultiSelectEdit($row, $value, $memberId) {					
		$options = array() ;			
		$values = explode("\r\n", $row->values) ;
		for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
			$options[] = JHTML::_('select.option', $values[$i], $values[$i]) ;
		}
		$selectedValues = explode(',', $value) ;
		$selectedOptions = array() ;
		for ($i = 0 , $n = count($selectedValues); $i < $n; $i++) {
			$selectedOptions[] = JHTML::_('select.option', $selectedValues[$i], $selectedValues[$i]) ;
		}
		?>
			<tr>
				<td class="key title_cell">
					<?php echo JText::_($row->title); ?><?php  if ($row->required) echo '<span class="required">*</span>'; ?>
				</td>
				<td>
					<?php
						echo JHTML::_('select.genericlist', $options, $row->name.'_'.$memberId.'[]', ' multiple="multiple" size="4" ', 'value', 'text', $selectedOptions);			
					?>
				</td>
			</tr>
		<?php								
	}
	/**
	 * Gender validation for dropdown 
	 *
	 * @param object $row
	 */
	function _renderMemberMultiSelectValidation($row, $memberId) {
	?>
		var selectTag =  document.getElementById('<?php echo $row->name.'_'.$memberId; ?>');
		if (selectTag.selectedIndex == -1) {
			alert("<?php echo JText::_($row->title);?> <?php echo JText::_('PF_IS_REQUIRED') ; ?>");
			form.<?php echo $row->name.'_'.$memberId; ?>.focus();
			return ;
		}			
	<?php		
	}
	
	
	/**
	 * Output values which users choosed in the dropdown
	 *
	 * @param object $row
	 */
	function _renderMultiSelectConfirmation($row) {
		$name = $row->name ;
		$postedValue = JRequest::getVar($name, array(), 'post') ;
		$postedValue = implode(',', $postedValue);
	?>
		<tr>
			<td class="title_cell">
				<?php echo JText::_($row->title); ?>
			</td>
			<td class="field_cell">
				<?php echo $postedValue ; ?>
			</td>
		</tr>
	<?php				
	}
	/**
	 * Render hidden field for textbox 
	 *
	 * @param object $row
	 */
	function _renderMultiSelectHidden($row) {
		$name = $row->name ;		
		$postedValue = JRequest::getVar($name, array(), 'post') ;
		for ($i = 0 , $n = count($postedValue) ; $i < $n ; $i++) {
			?>
				<input type="hidden" name="<?php echo $name ; ?>[]" value="<?php echo $postedValue[$i]; ?>" />
			<?php	
		}			
	}			
	/**
	 * Render checkbox list
	 *
	 * @param object $row
	 */
	function _renderCheckboxList($row) {
		$values = explode("\r\n", $row->values);
		$optionsPerLine = $row->size ? $row->size : NUMBER_OPTION_PER_LINE ; 
		if ($this->_loadIn == 2) {
			$defaultValues = explode("\r\n", $row->default_values) ;
		} else {
			if (isset($_POST[$row->name])) {
				$defaultValues = $_POST[$row->name] ;	
			} else {
				$defaultValues = explode("\r\n", $row->default_values) ;
			}	
		}		
		?>
			<tr>
				<td class="title_cell">
					<?php 
						echo JText::_($row->title);
						if ($row->required)
							echo '<span class="required">*</span>'; 
					?>
				</td>
				<td>					
					<table cellspacing="3" cellpadding="3" width="100%">
					<?php
						for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
							$value = $values[$i] ;
							if ($i % $optionsPerLine == 0) {
							?>
								<tr>
							<?php	
							}					
							?>
								<td>
									<input class="inputbox" value="<?php echo $value; ?>" type="checkbox" name="<?php echo $row->name; ?>[]" <?php if (in_array($value, $defaultValues)) echo ' checked="checked" ' ; ?>><?php echo $value;?>
								</td>	
							<?php	
							if (($i+1) % $optionsPerLine == 0) {
							?>
								</tr>
							<?php	
							}					
						}
						if ($i % $optionsPerLine != 0) {
							$colspan = $optionsPerLine - $i % $optionsPerLine ;
						?>
								<td colspan="<?php echo $colspan; ?>">&nbsp;</td>
							</tr>
						<?php	
						}				
					?>
					</table>											
				</td>
			</tr>		
	<?php			
	}	
	/**
	 * Render checkbox list output
	 *
	 * @param object $row
	 */
	function _renderCheckboxListOutput($row) {
		$values = explode("\r\n", $row->values);
		$optionsPerLine = $row->size ? $row->size : NUMBER_OPTION_PER_LINE ;
		if ($this->_loadIn == 2) {
			$defaultValues = explode("\r\n", $row->default_values) ;
		} else {
			if (isset($_POST[$row->name])) {
				$defaultValues = $_POST[$row->name] ;	
			} else {
				$defaultValues = explode("\r\n", $row->default_values) ;
			}	
		}
		?>				
		<table cellspacing="3" cellpadding="3" width="100%">
			<?php
				for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
					$value = $values[$i] ;
					if ($i % $optionsPerLine == 0) {
					?>
						<tr>
					<?php	
					}					
					?>
						<td>
							<input class="inputbox" value="<?php echo $value; ?>" type="checkbox" name="<?php echo $row->name; ?>[]" <?php if (in_array($value, $defaultValues)) echo ' checked="checked" ' ; ?>><?php echo $value;?>
						</td>	
					<?php	
					if (($i+1) % $optionsPerLine == 0) {
					?>
						</tr>
					<?php	
					}					
				}
				if ($i % $optionsPerLine != 0) {
					$colspan = $optionsPerLine - $i % $optionsPerLine ;
				?>
						<td colspan="<?php echo $colspan; ?>">&nbsp;</td>
					</tr>
				<?php	
				}				
			?>
		</table>																
	<?php			
	}	
	/**
	 * Render checkboxlist in edit mode
	 *
	 * @param object $row
	 */
	function _renderCheckboxListEdit($row, $savedValues) {
		$values = explode("\r\n", $row->values);
		$defaultValues = explode(',', $savedValues) ;
		$optionsPerLine = $row->size ? $row->size : NUMBER_OPTION_PER_LINE ;
	?>
		<tr>
			<td class="key title_cell">
				<?php echo JText::_($row->title); ?>
			</td>
			<td>
				<table cellspacing="3" cellpadding="3" width="100%">
					<?php
						for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
							$value = $values[$i] ;
							if ($i % $optionsPerLine == 0) {
							?>
								<tr>
							<?php	
							}					
							?>
								<td>
									<input class="inputbox" value="<?php echo $value; ?>" type="checkbox" name="<?php echo $row->name; ?>[]" <?php if (in_array($value, $defaultValues)) echo ' checked="checked" ' ; ?>><?php echo $value;?>
								</td>	
							<?php	
							if (($i+1) % $optionsPerLine == 0) {
							?>
								</tr>
							<?php	
							}					
						}
						if ($i % $optionsPerLine != 0) {
							$colspan = $optionsPerLine - $i % $optionsPerLine ;
						?>
								<td colspan="<?php echo $colspan; ?>">&nbsp;</td>
							</tr>
						<?php	
						}				
					?>
				</table>					
			</td>
		</tr>
	<?php			
	}
	/**
	 * Gender validation for textbox 
	 *
	 * @param object $row
	 */
	function _renderCheckBoxListValidation($row) {				
	?>
		var checked = false ;		
		if (form["<?php echo $row->name; ?>[]"].length) {
			for (var i=0; i < form["<?php echo $row->name; ?>[]"].length; i++) {
				if (form["<?php echo $row->name; ?>[]"][i].checked == true) {
					checked = true ;
					break ;
				}
			}
		} else {
			if (form["<?php echo $row->name; ?>[]"].checked) {
				checked = true ;
			}
		}
		if (!checked) {
			alert("<?php echo JText::_($row->title);?> <?php echo JText::_('PF_IS_REQUIRED') ; ?>");
			form.<?php echo $row->name; ?>.focus();
			return ;
		}		
	<?php		
	}	
	/**
	 * Render checkboxlist in edit mode
	 *
	 * @param object $row
	 */
	function _renderMemberCheckboxListEdit($row, $savedValues, $memberId) {
		$values = explode("\r\n", $row->values);
		$defaultValues = explode(',', $savedValues) ;
		$optionsPerLine = $row->size ? $row->size : NUMBER_OPTION_PER_LINE ;
	?>
		<tr>
			<td class="key title_cell">
				<?php echo JText::_($row->title); ?><?php  if ($row->required) echo '<span class="required">*</span>'; ?>
			</td>
			<td>
				<table cellspacing="3" cellpadding="3" width="100%">
					<?php
						for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
							$value = $values[$i] ;
							if ($i % $optionsPerLine == 0) {
							?>
								<tr>
							<?php	
							}					
							?>
								<td>
									<input class="inputbox" value="<?php echo $value; ?>" type="checkbox" name="<?php echo $row->name.'_'.$memberId; ?>[]" <?php if (in_array($value, $defaultValues)) echo ' checked="checked" ' ; ?>><?php echo $value;?>
								</td>	
							<?php	
							if (($i+1) % $optionsPerLine == 0) {
							?>
								</tr>
							<?php	
							}					
						}
						if ($i % $optionsPerLine != 0) {
							$colspan = $optionsPerLine - $i % $optionsPerLine ;
						?>
								<td colspan="<?php echo $colspan; ?>">&nbsp;</td>
							</tr>
						<?php	
						}				
					?>
				</table>					
			</td>
		</tr>
	<?php			
	}
	/**
	 * Gender validation for textbox 
	 *
	 * @param object $row
	 */
	function _renderMemberCheckBoxListValidation($row, $memberId) {				
	?>
		var checked = false ;		
		if (form["<?php echo $row->name.'_'.$memberId; ?>[]"].length) {
			for (var i=0; i < form["<?php echo $row->name.'_'.$memberId; ?>[]"].length; i++) {
				if (form["<?php echo $row->name.'_'.$memberId; ?>[]"][i].checked == true) {
					checked = true ;
					break ;
				}
			}
		} else {
			if (form["<?php echo $row->name.'_'.$memberId; ?>[]"].checked) {
				checked = true ;
			}
		}
		if (!checked) {
			alert("<?php echo JText::_($row->title); ?> <?php echo JText::_('PF_IS_REQUIRED') ; ?>");
			form.<?php echo $row->name.'_'.$memberId; ?>.focus();
			return ;
		}		
	<?php		
	}		
	/**
	 * Output values which users selectd in the checkboxlist
	 *
	 * @param object $row
	 */
	function _renderCheckBoxListConfirmation($row) {
	?>
		<tr>
			<td class="title_cell">
				<?php echo JText::_($row->title); ?>
			</td>
			<td>
				<?php
					$name = $row->name ;
					$postedValue = JRequest::getVar($name, array(), 'post') ;
					echo implode(',',  $postedValue) ;			
				?>
			</td>
		</tr>
	<?php			
	}
	/**
	 * Render hidden field for textbox 
	 *
	 * @param object $row
	 */
	function _renderCheckBoxListHidden($row) {
		$name = $row->name ;		
		$postedValue = JRequest::getVar($name, array(), 'post') ;
		for ($i = 0 , $n = count($postedValue) ; $i < $n ; $i++) {
			$value = $postedValue[$i];
		?>
			<input type="hidden" name="<?php echo $name ; ?>[]" value="<?php echo $value; ?>" />
		<?php			
		}				
	}
	/**
	 * Reder radio list
	 *
	 * @param object $row
	 */
	function _renderRadioList(&$row) {
	    $optionsPerLine = $row->size ? $row->size : NUMBER_OPTION_PER_LINE ;
		if ($this->_loadIn == 2)
			$postedValue = $row->default_values ;
		else	
			$postedValue = JRequest::getVar($row->name, $row->default_values, 'post') ;
		$values = explode("\r\n",  $row->values);		
		?>
			<tr>
				<td class="title_cell">
					<?php 
						echo JText::_($row->title);
						if ($row->required)
							echo '<span class="required">*</span>'; 
					?>
				</td>
				<td>
					<table cellspacing="3" cellpadding="3" width="100%">
    					<?php
    						for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
    							$value = $values[$i] ;
    							if ($i % $optionsPerLine == 0) {
    							?>
    								<tr>
    							<?php	
    							}					
    							?>
    								<td>
    									<input class="inputbox" value="<?php echo $value; ?>" type="radio" name="<?php echo $row->name; ?>" <?php if ($value == $postedValue) echo ' checked="checked" ' ; ?>><?php echo $value;?>
    								</td>	
    							<?php	
    							if (($i+1) % $optionsPerLine == 0) {
    							?>
    								</tr>
    							<?php	
    							}					
    						}
    						if ($i % $optionsPerLine != 0) {
    							$colspan = $optionsPerLine - $i % $optionsPerLine ;
    						?>
    								<td colspan="<?php echo $colspan; ?>">&nbsp;</td>
    							</tr>
    						<?php	
    						}				
    					?>
					</table>							
				</td>
			</tr>
		<?php
	}	
	/**
	 * Render output of radiolist
	 *
	 * @param object $row
	 */
	function _renderRadioListOutput(&$row) {
	    $optionsPerLine = $row->size ? $row->size : NUMBER_OPTION_PER_LINE ;
		if ($this->_loadIn == 2)
			$postedValue = $row->default_values ;
		else	
			$postedValue = JRequest::getVar($row->name, $row->default_values, 'post') ;
		$values = explode("\r\n",  $row->values);		
		?>
			<table cellspacing="3" cellpadding="3" width="100%">
				<?php
					for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
						$value = $values[$i] ;
						if ($i % $optionsPerLine == 0) {
						?>
							<tr>
						<?php	
						}					
						?>
							<td>
								<input class="inputbox" value="<?php echo $value; ?>" type="radio" name="<?php echo $row->name; ?>" <?php if ($value == $postedValue) echo ' checked="checked" ' ; ?>><?php echo $value;?>
							</td>	
						<?php	
						if (($i+1) % $optionsPerLine == 0) {
						?>
							</tr>
						<?php	
						}					
					}
					if ($i % $optionsPerLine != 0) {
						$colspan = $optionsPerLine - $i % $optionsPerLine ;
					?>
							<td colspan="<?php echo $colspan; ?>">&nbsp;</td>
						</tr>
					<?php	
					}				
				?>
			</table>		
		<?php							
	}	
	/**
	 * Reder radio list in edit mode
	 *
	 * @param object $row
	 * @param string $value
	 */
	function _renderRadioListEdit(&$row, $value) {	
	    $optionsPerLine = $row->size ? $row->size : NUMBER_OPTION_PER_LINE ; 
	    $postedValue = $value ;
	    $values = explode("\r\n",  $row->values);
	?>
		<tr>
			<td class="key title_cell"><?php echo JText::_($row->title); ?></td>
			<td>				
				<table cellspacing="3" cellpadding="3" width="100%">
					<?php
						for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
							$value = $values[$i] ;
							if ($i % $optionsPerLine == 0) {
							?>
								<tr>
							<?php	
							}					
							?>
								<td>
									<input class="inputbox" value="<?php echo $value; ?>" type="radio" name="<?php echo $row->name; ?>" <?php if ($value == $postedValue) echo ' checked="checked" ' ; ?>><?php echo $value;?>
								</td>	
							<?php	
							if (($i+1) % $optionsPerLine == 0) {
							?>
								</tr>
							<?php	
							}					
						}
						if ($i % $optionsPerLine != 0) {
							$colspan = $optionsPerLine - $i % $optionsPerLine ;
						?>
								<td colspan="<?php echo $colspan; ?>">&nbsp;</td>
							</tr>
						<?php	
						}				
					?>
				</table>		
			</td>
		</tr>
	<?php		
	}
	/**
	 * Gender validation for RadioList 
	 *
	 * @param object $row
	 */
	function _renderRadioListValidation($row) {
	?>
		var checked = false ;
		if (form.<?php echo $row->name; ?>.length) {
			for (var i=0 ; i < form.<?php echo $row->name; ?>.length ; i++) {
				if (form.<?php echo $row->name; ?>[i].checked == true) {
					checked = true ;
					break ;
				}
			}
		} else {
			if (form.<?php echo $row->name; ?>.checked == true)
				checked = true ;
		}
		if (!checked) {
			alert("<?php echo JText::_($row->title) . ' '.JText::_('PF_IS_REQUIRED');?>");
			return ;
		}
	<?php		
	}
	
	
	/**	 * Reder radio list in edit mode
	 *
	 * @param object $row
	 * @param string $value
	 */
	function _renderMemberRadioListEdit(&$row, $value, $memberId) {
	    $optionsPerLine = $row->size ? $row->size : NUMBER_OPTION_PER_LINE ;	
	    $postedValue = $value ;
	    $values = explode("\r\n",  $row->values);
	?>
		<tr>
			<td class="key title_cell"><?php echo $row->title; ?></td><?php  if ($row->required) echo '<span class="required">*</span>'; ?>
			<td>			
				<table cellspacing="3" cellpadding="3" width="100%">
					<?php
						for ($i = 0 , $n = count($values) ; $i < $n ; $i++) {
							$value = $values[$i] ;
							if ($i % $optionsPerLine == 0) {
							?>
								<tr>
							<?php	
							}					
							?>
								<td>
									<input class="inputbox" value="<?php echo $value; ?>" type="radio" name="<?php echo $row->name.'_'.$memberId; ?>" <?php if ($value == $postedValue) echo ' checked="checked" ' ; ?>><?php echo $value;?>
								</td>	
							<?php	
							if (($i+1) % $optionsPerLine == 0) {
							?>
								</tr>
							<?php	
							}					
						}
						if ($i % $optionsPerLine != 0) {
							$colspan = $optionsPerLine - $i % $optionsPerLine ;
						?>
								<td colspan="<?php echo $colspan; ?>">&nbsp;</td>
							</tr>
						<?php	
						}				
					?>
				</table>	
			</td>
		</tr>
	<?php		
	}
	/**
	 * Gender validation for RadioList 
	 *
	 * @param object $row
	 */
	function _renderMemberRadioListValidation($row, $memberId) {
	?>
		var checked = false ;
		if (form.<?php echo $row->name.'_'.$memberId; ?>.length) {
			for (var i=0 ; i < form.<?php echo $row->name.'_'.$memberId; ?>.length ; i++) {
				if (form.<?php echo $row->name.'_'.$memberId; ?>[i].checked == true) {
					checked = true ;
					break ;
				}
			}
		} else {
			if (form.<?php echo $row->name.'_'.$memberId; ?>.checked == true)
				checked = true ;
		}
		if (!checked) {
			alert("<?php echo JText::_($row->title) . ' '.JText::_('PF_IS_REQUIRED');?>");
			return ;
		}
	<?php		
	}		
	/**
	 * Output values which users entered in the textarea field
	 *
	 * @param object $row
	 */
	function _renderRadioListConfirmation($row) {
		$name = $row->name ;
		$postedValue = JRequest::getVar($name, '', 'post') ;
		?>
			<tr>
				<td class="title_cell">
					<?php echo $row->title ; ?>
				</td>
				<td class="field_cell">
					<?php echo $postedValue; ?>
				</td>
			</tr>
		<?php
	}
	/**
	 * Render hidden tag for radio list
	 *
	 * @param object $row
	 */		
	function _renderRadioListHidden($row) {
		$name = $row->name ;		
		$postedValue = JRequest::getVar($name, '', 'post') ;		
		?>
			<input type="hidden" name="<?php echo $name ; ?>" value="<?php echo $postedValue; ?>" />
		<?php									
	}				
	/**
	 * 
	 *
	 * @param string $row
	 */
	function _renderDateTime(&$row) {
		$db = & JFactory::getDBO();		
		$dateFormat = '%Y-%m-%d';
		?>
			<tr>
				<td class="title_cell">
					<?php 
						echo JText::_($row->title);
						if ($row->required)
							echo '<span class="required">*</span>'; 
					?>
				</td>
				<td class="field_cell">
					<?php echo JHTML::_('calendar', $row->default_values, $row->name, $row->name, $dateFormat) ; ?>		
				</td>
			</tr>
		<?php
	}
	/**
	 * Render output of datetime field type
	 *
	 * @param object $row
	 */
	function _renderDateTimeOutput(&$row) {
		$dateFormat = '%Y-%m-%d';
		echo JHTML::_('calendar', $row->default_values, $row->name, $row->name, $dateFormat) ;						
	}
	/**
	 * Render datetime inputbox in edit mode
	 *
	 * @param object $row
	 * @param string $value
	 */
	function _renderDateTimeEdit(&$row, $value) {
		$dateFormat = '%Y-%m-%d';
		?>
			<tr>
				<td class="key title_cell">
					<?php echo JText::_($row->title); ?>
				</td>
				<td>
					<?php echo JHTML::_('calendar', $value, $row->name, $row->name, $dateFormat) ; ?>
				</td>
			</tr>
		<?php
	}	
	/**
	 * Gender validation for RadioList 
	 *
	 * @param object $row
	 */
	function _renderDateTimeValidation($row) {
	?>
		if (form.<?php echo $row->name;?>.value == "") {
			alert("<?php echo JText::_($row->title).' '.JText::_('PF_IS_REQUIRED'); ?>");
			form.<?php echo $row->name; ?>.focus();
			return ;	
		}		
	<?php		
	}
	
	/**
	 * Render datetime inputbox in edit mode
	 *
	 * @param object $row
	 * @param string $value
	 */
	function _renderMemberDateTimeEdit(&$row, $value, $memberId) {
		$dateFormat = EventBookingHelper::getConfigValue('date_format');
		?>
			<tr>
				<td class="key title_cell">
					<?php echo JText::_($row->title); ?><?php  if ($row->required) echo '<span class="required">*</span>'; ?>
				</td>
				<td>
					<?php echo JHTML::_('calendar', $value, $row->name, $row->name, $dateFormat) ; ?>
				</td>
			</tr>
		<?php
	}	
	/**
	 * Gender validation for RadioList 
	 *
	 * @param object $row
	 */
	function _renderMemberDateTimeValidation($row, $memberId) {
	?>
		if (form.<?php echo $row->name.'_'.$memberId;?>.value == "") {
			alert("<?php echo JText::_($row->title).' '.JText::_('PF_IS_REQUIRED'); ?>");
			form.<?php echo $row->name.'_'.$memberId; ?>.focus();
			return ;	
		}		
	<?php		
	}		
	/**
	 * Output values which users entered in the textarea field
	 *
	 * @param object $row
	 */
	function _renderDateTimeConfirmation($row) {
		$name = $row->name ;
		$postedValue = JRequest::getVar($name, '', 'post') ;
	?>
		<tr>
			<td class="title_cell">
				<?php echo JText::_($row->title); ?>
			</td>
			<td class="field_cell">	
				<?php echo $postedValue ; ?>
			</td>
		</tr>
	<?php
	}
	/**
	 * Render hidden tag for radio list
	 *
	 * @param object $row
	 */		
	function _renderDateTimeHidden($row) {
		$name = $row->name ;		
		$postedValue = JRequest::getVar($name, '', 'post') ;		
		?>
			<input type="hidden" name="<?php echo $name ; ?>" value="<?php echo $postedValue; ?>" />
		<?php									
	}				
	/**
	 * Render output in the confirmation page
	 *
	 */
	function renderConfirmation() {
		ob_start();			
		for ($i = 0 , $n = count($this->_fields) ; $i < $n ; $i++) {
			$row = $this->_fields[$i];
			switch ($row->field_type) {
				case FIELD_TYPE_HEADING :
				?>
					<tr>
						<td class="heading" colspan="2">
							<?php echo $row->title ; ?>
						</td>
					</tr>
				<?php	
					break ;	
				case FIELD_TYPE_TEXTBOX :							
					$this->_renderTextboxConfirmation($row);
					break ;
				case FIELD_TYPE_TEXTAREA :								
					$this->_renderTextAreaConfirmation($row);
					break ;
				case FIELD_TYPE_DROPDOWN :								
					$this->_renderDropDownConfirmation($row);				
					break ;
				case FIELD_TYPE_CHECKBOXLIST :								
					$this->_renderCheckBoxListConfirmation($row);
					break ;
				case FIELD_TYPE_RADIOLIST :								
					$this->_renderRadioListConfirmation($row);
					break ;
				case FIELD_TYPE_DATETIME :								
					$this->_renderDateTimeConfirmation($row);
					break ;	
				case FIELD_TYPE_MULTISELECT :
					$this->_renderMultiSelectConfirmation($row);
					break ;																
			}																	
		}
		$output = ob_get_contents() ;
		ob_end_clean() ;
		return $output ;
	}		
	/**
	 * Render published custom fields
	 *
	 */
	function renderCustomFields() {
		ob_start();		
		for ($i = 0 , $n = count($this->_fields) ; $i < $n ; $i++) {			
			$row = $this->_fields[$i];
			switch ($row->field_type) {
				case FIELD_TYPE_HEADING :
					?>
						<tr>
							<td colspan="2" class="heading"><?php echo $row->title ; ?></td>
						</tr>
					<?php	
					break ;
				case FIELD_TYPE_MESSAGE :
					?>	
						<tr>
							<td colspan="2" class="message">
								<?php echo $row->description ; ?>
							</td>
						</tr>
					<?php 	
					break ;
				 case FIELD_TYPE_TEXTBOX :							
					$this->_renderTextBox($row);
					break ;
				 case FIELD_TYPE_TEXTAREA :								
					$this->_renderTextarea($row);
					break ;
				 case FIELD_TYPE_DROPDOWN :							
					$this->_renderDropdown($row);				
					break ;
				 case FIELD_TYPE_CHECKBOXLIST :							
					$this->_renderCheckboxList($row);
					break ;
				 case FIELD_TYPE_RADIOLIST :							
					$this->_renderRadioList($row);
					break ;
				 case FIELD_TYPE_DATETIME :							
					$this->_renderDateTime($row);
					break ;	
				 case FIELD_TYPE_MULTISELECT :
				 	$this->_renderMultiSelect($row);
				 	break ;		
			}
			?>				
		<?php														
		}
		$output = ob_get_contents() ;
		ob_end_clean();
		return $output ;
	}			
	/**
	 * Render js validation code
	 *
	 */
	function renderJSValidation() {
		ob_start();		
		for($i=0, $n = count($this->_fields) ; $i < $n ; $i++) {
			$row = $this->_fields[$i] ;
			if ($row->required) {
				switch ($row->field_type) {
					case FIELD_TYPE_TEXTBOX :				
						$this->_renderTextBoxValidation($row);
						break ;
					case FIELD_TYPE_TEXTAREA :						
						$this->_renderTextAreaValidation($row);
						break ;
					case FIELD_TYPE_DROPDOWN :					
						$this->_renderDropdownValidation($row);				
						break ;
					case FIELD_TYPE_CHECKBOXLIST :					
						$this->_renderCheckBoxListValidation($row);
						break ;
					case FIELD_TYPE_RADIOLIST :				
						$this->_renderRadioListValidation($row);
						break ;
					case FIELD_TYPE_DATETIME :					
						$this->_renderDateTimeValidation($row);
						break ;	
					case FIELD_TYPE_MULTISELECT :
						$this->_renderMultiSelectValidation($row);
						break ;			
				}
			}				 	
		}
		$output = ob_get_contents();
		ob_end_clean();
		return $output ;
	}			
	/**
	 * Render js validation code
	 *
	 */
	function renderMemberJSValidation($registrantId) {
		ob_start();								
		for($i=0, $n = count($this->_fields) ; $i < $n ; $i++) {
			$row = $this->_fields[$i] ;
			if ($row->required) {
				switch ($row->field_type) {
					case FIELD_TYPE_TEXTBOX :				
						$this->_renderMemberTextBoxValidation($row, $registrantId);
						break ;
					case FIELD_TYPE_TEXTAREA :						
						$this->_renderMemberTextAreaValidation($row, $registrantId);
						break ;
					case FIELD_TYPE_DROPDOWN :					
						$this->_renderDropdownValidation($row);				
						break ;
					case FIELD_TYPE_CHECKBOXLIST :					
						$this->_renderMemberCheckBoxListValidation($row, $registrantId);
						break ;
					case FIELD_TYPE_RADIOLIST :				
						$this->_renderMemberRadioListValidation($row, $registrantId);
						break ;
					case FIELD_TYPE_DATETIME :					
						$this->_renderMemberDateTimeValidation($row, $registrantId);
						break ;	
					case FIELD_TYPE_MULTISELECT :
						$this->_renderMemberMultiSelectValidation($row, $registrantId);
						break ;			
				}
			}				 	
		}
		$output = ob_get_contents();
		ob_end_clean();
		return $output ;
	}		
	/**
	 * Render hidden fields to pass to the next form
	 *
	 */
	function renderHiddenFields() {
		ob_start();
		for($i=0, $n = count($this->_fields) ; $i < $n ; $i++) {
			$row = $this->_fields[$i] ;
			switch ($row->field_type) {
				case FIELD_TYPE_TEXTBOX :					
					$this->_renderTextboxHidden($row);
					break ;
				case FIELD_TYPE_TEXTAREA :						
					$this->_renderTextAreaHidden($row);
					break ;
				case FIELD_TYPE_DROPDOWN :					
					$this->_renderDropdownHidden($row);				
					break ;
				case FIELD_TYPE_CHECKBOXLIST :					
					$this->_renderCheckBoxListHidden($row);
					break ;
				case FIELD_TYPE_RADIOLIST :					
					$this->_renderRadioListHidden($row);
					break ;
				case FIELD_TYPE_DATETIME :					
					$this->_renderDateTimeHidden($row);
					break ;	
				case FIELD_TYPE_MULTISELECT :
					$this->_renderMultiSelectHidden($row);
					break ;			
			}	 		
		}	
		$output = ob_get_contents();		
		ob_end_clean();
		return $output ;
	}		
	/**
	 * Get output of fields
	 *
	 */		
	function getFieldsOutput() {
		$fields = array() ;
		for ($i = 0 , $n = count($this->_fields) ; $i < $n ; $i++) {
			$row = $this->_fields[$i] ;
			ob_start() ;
			switch ($row->field_type) {
				case FIELD_TYPE_HEADING :
					echo $row->title ;
					break ;
				case FIELD_TYPE_MESSAGE :
					echo $row->description ;
					break ;	
				case FIELD_TYPE_TEXTBOX :					
					$this->_renderTextBoxOutput($row);
					break ;
				case FIELD_TYPE_TEXTAREA :						
					$this->_renderTextareaOutput($row);
					break ;
				case FIELD_TYPE_DROPDOWN :					
					$this->_renderDropdownOutput($row);				
					break ;
				case FIELD_TYPE_CHECKBOXLIST :					
					$this->_renderCheckboxListOutput($row);
					break ;
				case FIELD_TYPE_RADIOLIST :					
					$this->_renderRadioListOutput($row);
					break ;
				case FIELD_TYPE_DATETIME :					
					$this->_renderDateTimeOutput($row);
					break ;	
				case FIELD_TYPE_MULTISELECT :
					$this->_renderMultiSelectOutput($row);
					break ;			
			}
			$fields[$row->name] = ob_get_contents();
			ob_end_clean() ;			
		}
		return $fields ;
	}
	/**
	 * Get list of fields
	 *
	 */	
	function getFields() {
		return $this->_fields ;
	}	
	/**
	 * Save Field Value 
	 *
	 * @param int $id
	 * @return boolean
	 */
	function saveFieldValues($registrantId) {
		$db = & JFactory::getDBO();
		if ($registrantId) {
			$sql = 'DELETE FROM #__eb_field_values WHERE registrant_id='.$registrantId;
			$db->setQuery($sql) ;
			$db->query();
		}				
		for ($i = 0, $n = count($this->_fields) ; $i < $n ; $i++) {
			$row = $this->_fields[$i];
			if ($row->field_type == FIELD_TYPE_HEADING || $row->field_type == FIELD_TYPE_MESSAGE)
				continue ;
			$name = $row->name ;
			$postedValue = JRequest::getVar($name, '', 'post');
			if (is_array($postedValue))
				$postedValue = implode(',', $postedValue);
			$postedValue = $db->Quote($postedValue);
			$sql = 'INSERT INTO #__eb_field_values(registrant_id, field_id, field_value)'
			. " VALUES($registrantId, $row->id, $postedValue) "	
			;
			$db->setQuery($sql);
			$db->query();	
		}
		return true ;
	}	
	/**
	 * Save Field Value For Member in group regisration 
	 *
	 * @param int $id
	 * @return boolean
	 */
	function saveMemberFieldValues($registrantId) {
		$db = & JFactory::getDBO();		
		if ($registrantId) {
			$sql = 'DELETE FROM #__eb_field_values WHERE registrant_id='.$registrantId;
			$db->setQuery($sql) ;
			$db->query();
		}
		for ($i = 0, $n = count($this->_fields) ; $i < $n ; $i++) {
			$row = $this->_fields[$i];
			if ($row->field_type == FIELD_TYPE_HEADING || $row->field_type == FIELD_TYPE_MESSAGE)
				continue ;
			$name = $row->name ;
			$postedValue = JRequest::getVar($name.'_'.$registrantId, '', 'post');
			if (is_array($postedValue))
				$postedValue = implode(',', $postedValue);
			$postedValue = $db->Quote($postedValue);
			$sql = 'INSERT INTO #__eb_field_values(registrant_id, field_id, field_value)'
			. " VALUES($registrantId, $row->id, $postedValue) "	
			;
			$db->setQuery($sql);
			$db->query();	
		}
		return true ;
	}	
	/**
	 * Render custom fields in edit mode
	 *
	 * @param object $donorId
	 */
	function renderCustomFieldsEdit($registrantId) {
		$db = & JFactory::getDBO() ;
		$sql = 'SELECT field_id, field_value FROM #__eb_field_values WHERE registrant_id='.$registrantId;
		$db->setQuery($sql);
		$rowFields = $db->loadObjectList() ;
		$values = array() ;
		for ($i = 0 , $n = count($rowFields) ; $i < $n ; $i++) {
			$rowField = $rowFields[$i] ;
			$values[$rowField->field_id] = $rowField->field_value ;
		}								
		ob_start();		
		for ($i = 0 , $n = count($this->_fields) ; $i < $n ; $i++) {
			$row = $this->_fields[$i];
			if (isset($values[$row->id]))
				$value = $values[$row->id];
			else 
				$value = '' ;	
			switch ($row->field_type) {
				case FIELD_TYPE_HEADING :
					?>
						<tr>
							<td colspan="2" class="key title_cell">
								<?php echo $row->title ; ?>
							</td>
						</tr>
					<?php
					break ;
				case FIELD_TYPE_TEXTBOX :							
					$this->_renderTextBoxEdit($row, $value);
					break ;
				case FIELD_TYPE_TEXTAREA :								
					$this->_renderTextareaEdit($row, $value);
					break ;
				case FIELD_TYPE_DROPDOWN :							
					$this->_renderDropdownEdit($row, $value);				
					break ;
				case FIELD_TYPE_CHECKBOXLIST :							
					$this->_renderCheckboxListEdit($row, $value);
					break ;
				case FIELD_TYPE_RADIOLIST :									
					$this->_renderRadioListEdit($row, $value);
					break ;
				case FIELD_TYPE_DATETIME :							
					$this->_renderDateTimeEdit($row, $value);
					break ;	
				case FIELD_TYPE_MULTISELECT :
					$this->_renderMultiSelectEdit($row, $value);
					break ;						
			}																
		}
		$output = ob_get_contents() ;
		ob_end_clean();
		return $output ;								
	}
			
	/**
	 * Render custom fields in edit mode
	 *
	 * @param object $donorId
	 */
	function renderMemberCustomFieldsEdit($registrantId) {
		$db = & JFactory::getDBO() ;
		$sql = 'SELECT field_id, field_value FROM #__eb_field_values WHERE registrant_id='.$registrantId;
		$db->setQuery($sql);
		$rowFields = $db->loadObjectList() ;
		$values = array() ;
		for ($i = 0 , $n = count($rowFields) ; $i < $n ; $i++) {
			$rowField = $rowFields[$i] ;
			$values[$rowField->field_id] = $rowField->field_value ;
		}								
		ob_start();		
		for ($i = 0 , $n = count($this->_fields) ; $i < $n ; $i++) {
			$row = $this->_fields[$i];
			if (isset($values[$row->id]))
				$value = $values[$row->id];
			else 
				$value = '' ;	
			switch ($row->field_type) {
				case FIELD_TYPE_HEADING :
					?>
						<tr>
							<td colspan="2" class="key title_cell">
								<?php echo $row->title ; ?>
							</td>
						</tr>
					<?php
					break ;
				case FIELD_TYPE_TEXTBOX :							
					$this->_renderMemberTextBoxEdit($row, $value, $registrantId);
					break ;
				case FIELD_TYPE_TEXTAREA :								
					$this->_renderMemberTextareaEdit($row, $value, $registrantId);
					break ;
				case FIELD_TYPE_DROPDOWN :							
					$this->_renderMemberDropdownEdit($row, $value, $registrantId);				
					break ;
				case FIELD_TYPE_CHECKBOXLIST :							
					$this->_renderMemberCheckboxListEdit($row, $value, $registrantId);
					break ;
				case FIELD_TYPE_RADIOLIST :									
					$this->_renderMemberRadioListEdit($row, $value, $registrantId);
					break ;
				case FIELD_TYPE_DATETIME :							
					$this->_renderMemberDateTimeEdit($row, $value, $registrantId);
					break ;	
				case FIELD_TYPE_MULTISELECT :
					$this->_renderMultiSelectEdit($row, $value, $registrantId);
					break ;						
			}																
		}
		$output = ob_get_contents() ;
		ob_end_clean();
		return $output ;								
	}			
	/**
	 * Group Memmber confirmation
	 *
	 * @param int Member Id
	 */		
	function renderGroupMemberConfirmation($memberId) {
		$db = & JFactory::getDBO() ;
		$sql = 'SELECT field_id, field_value FROM #__eb_field_values WHERE registrant_id='.$memberId;
		$db->setQuery($sql) ;		
		$rowFieldValues = $db->loadObjectList();
		$values = array() ;
		for ($i = 0 , $n = count($rowFieldValues) ; $i < $n ; $i++) {
			$row = $rowFieldValues[$i] ;
			$values[$row->field_id] = $row->field_value ;	
		}		
		for ($i = 0 , $n = count($this->_fields) ; $i < $n; $i++) {
			$field = $this->_fields[$i] ;
			switch ($field->field_type) {
				case FIELD_TYPE_HEADING :
					?>
						<tr>
							<td colspan="2" class="os_row_heading"><?php echo $row->title ; ?></td>
						</tr>
					<?php	
					break ;
				case FIELD_TYPE_MESSAGE :
					?>	
						<tr>
							<td colspan="2" class="os_message">
								<?php echo $row->description ; ?>
							</td>
						</tr>
					<?php 	
					break ;
				default:
					?>
						<tr>
							<td class="title_cell key">
								<?php echo $field->title ; ?>
							</td>
							<td class="field_cell">
								<?php
									echo isset($values[$field->id]) ?  $values[$field->id] : '' ; 
								?>
							</td>
						</tr>
					<?php	
			}				
		}					
	}		
	/**
	 * Canculate fee field
	 *
	 */
	function calculateFee($eventId, $registrationType = 0) {
		$db = & JFactory::getDBO();
		if ($registrationType == 0) {
			$sql = 'SELECT * FROM #__eb_fields WHERE fee_field = 1 AND published= 1 AND display_in IN (0, 1, 3, 5) AND (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id='.$eventId.'))';	
		} else {
			$sql = 'SELECT * FROM #__eb_fields WHERE fee_field = 1 AND published= 1 AND display_in IN (0, 2, 3) AND (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id='.$eventId.'))';
		}			
		$db->setQuery($sql) ;		
		$rows = $db->loadObjectList();				
		//Get list of fields which can be used for calculation
		$fieldTypes = array(FIELD_TYPE_TEXTBOX, FIELD_TYPE_RADIOLIST, FIELD_TYPE_DROPDOWN, FIELD_TYPE_CHECKBOXLIST) ;
	    if ($registrationType == 0) {
			$sql = 'SELECT * FROM #__eb_fields WHERE field_type IN ('.implode(',', $fieldTypes).') AND published= 1 AND display_in IN (0, 1, 3, 5) AND (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id='.$eventId.'))';	
		} else {
			$sql = 'SELECT * FROM #__eb_fields WHERE field_type IN ('.implode(',', $fieldTypes).') AND published= 1 AND display_in IN (0, 2, 3) AND (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id='.$eventId.'))';
		}
		$db->setQuery($sql) ;		
		$rowFields = $db->loadObjectList();		
		$fieldFees = JCFields::calculateFieldsPrice($rowFields) ;						
		$fee = 0 ;		
		for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
			$row = $rows[$i] ;
			if ($row->field_type == 1 || $row->fee_formula) {
				//Maybe we need to check fee formula
				if (!$row->fee_formula) {
					continue ;
				} else {
					$postedValue = JRequest::getVar($row->name, '', 'post') ;
					$formula = $row->fee_formula ;					
					$formula = str_replace('[FIELD_VALUE]', $postedValue, $formula ) ;
				    if (count($fieldFees)) {
						foreach ($fieldFees as $fieldName => $fieldFee) {
							$formula = str_replace('['.$fieldName.']', $fieldFee, $formula ) ;
						}
					}
					$feeValue = 0 ;
					eval('$feeValue = '.$formula.';') ;					
					$fee += $feeValue ;	 
				}	
			} else {
				$feeValues = $row->fee_values ;
				$values = $row->values ;
				$feeValues = explode("\r\n", $feeValues) ;
				$values = explode("\r\n", $values) ;
				$postedValue = JRequest::getVar($row->name, '', 'post') ;
				if (is_array($postedValue)) {
					$postedArr = $postedValue ;
				} elseif ($postedValue) {
					$postedArr = array() ;
					$postedArr[] = $postedValue ;
				} else {
					$postedArr = array() ; 
				}				
				for ($j = 0, $m = count($postedArr) ; $j < $m ; $j++) {
					$posted = $postedArr[$j] ;
					$index = JCFields::findIndex($posted, $values) ;
					if ($index != -1 && isset($feeValues[$index]))
						$fee += $feeValues[$index] ; 
				}				
			}								
		}		
		return $fee ;	
	}	
	
	/**
	 * Canculate fee field
	 *
	 */
	function calculateCartFee($eventIds) {
		$db = & JFactory::getDBO();		
		$sql = 'SELECT * FROM #__eb_fields WHERE published=1 AND fee_field = 1 AND (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id IN ('.implode(',', $eventIds).')))';										
		$db->setQuery($sql) ;		
		$rows = $db->loadObjectList();
		
		$fieldTypes = array(FIELD_TYPE_TEXTBOX, FIELD_TYPE_RADIOLIST, FIELD_TYPE_DROPDOWN, FIELD_TYPE_CHECKBOXLIST) ;
	    $sql = 'SELECT * FROM #__eb_fields WHERE published=1 AND field_type IN ('.implode(',', $fieldTypes).') AND (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id IN ('.implode(',', $eventIds).')))';
		$db->setQuery($sql) ;		
		$rowFields = $db->loadObjectList();		
		$fieldFees = JCFields::calculateFieldsPrice($rowFields) ;
		
		$fee = 0 ;		
		for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
			$row = $rows[$i] ;
			if ($row->field_type == 1 || $row->fee_formula) {
				//Maybe we need to check fee formula
				if (!$row->fee_formula) {
					continue ;
				} else {
					$postedValue = JRequest::getVar($row->name, '', 'post') ;
					$formula = $row->fee_formula ;					
					$formula = str_replace('[FIELD_VALUE]', $postedValue, $formula ) ;
					
				    if (count($fieldFees)) {
						foreach ($fieldFees as $fieldName => $fieldFee) {
							$formula = str_replace('['.$fieldName.']', $fieldFee, $formula ) ;
						}
					}															
					$feeValue = 0 ;
					eval('$feeValue = '.$formula.';') ;					
					$fee += $feeValue ;	 
				}	
			} else {
				$feeValues = $row->fee_values ;
				$values = $row->values ;
				$feeValues = explode("\r\n", $feeValues) ;
				$values = explode("\r\n", $values) ;
				$postedValue = JRequest::getVar($row->name, '', 'post') ;
				if (is_array($postedValue)) {
					$postedArr = $postedValue ;
				} elseif ($postedValue) {
					$postedArr = array() ;
					$postedArr[] = $postedValue ;
				} else {
					$postedArr = array() ; 
				}				
				for ($j = 0, $m = count($postedArr) ; $j < $m ; $j++) {
					$posted = $postedArr[$j] ;
					$index = JCFields::findIndex($posted, $values) ;
					if ($index != -1 && isset($feeValues[$index]))
						$fee += $feeValues[$index] ; 
				}				
			}								
		}		
		return $fee ;	
	}	
	
	/**
	 * Calculate fee field for individual member
	 * @param int $memberId
	 * @param int $eventId
	 */
	function getMemberFee($memberId, $eventId) {
		$db = & JFactory::getDbo() ;
		$sql = 'SELECT * FROM #__eb_fields WHERE fee_field = 1 AND published= 1 AND display_in IN (0, 4, 5) AND (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id='.$eventId.'))';
		$db->setQuery($sql) ;
		$rows = $db->loadObjectList();
		
		
		
		$fieldTypes = array(FIELD_TYPE_TEXTBOX, FIELD_TYPE_RADIOLIST, FIELD_TYPE_DROPDOWN, FIELD_TYPE_CHECKBOXLIST) ;	    					
		$sql = 'SELECT * FROM #__eb_fields WHERE field_type IN ('.implode(',', $fieldTypes).') AND published= 1 AND display_in IN (0, 4, 5) AND (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id='.$eventId.'))';		
		$db->setQuery($sql) ;		
		$rowFields = $db->loadObjectList();		
		$fieldFees = JCFields::calculateMemberFieldsPrice($rowFields) ;
		
		
		
		//Get all group members		
		$fee = 0 ;		
		for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
			$row = $rows[$i] ;
			$sql = 'SELECT field_value FROM #__eb_field_values WHERE registrant_id='.$memberId.' AND field_id='.$row->id ;
			$db->setQuery($sql) ;
			$postedValue = $db->loadResult() ;
			if ($postedValue) {
				if ($row->field_type == FIELD_TYPE_CHECKBOXLIST || $row->field_type == FIELD_TYPE_MULTISELECT)
					$postedValue  = explode(',', $postedValue) ;
				if ($row->field_type == 1) {
					if (!$row->fee_formula) {
						continue ;
					} else {
						$feeValue = 0 ;
						$formula = $row->fee_formula ;
						$formula = str_replace('[FIELD_VALUE]', $postedValue, $formula ) ;
						
						if (count($fieldFees)) {
							foreach ($fieldFees as $fieldName => $fieldFee) {
								$formula = str_replace('['.$fieldName.']', $fieldFee, $formula ) ;
							}
						}
																		
						eval('$feeValue = '.$formula.';') ;
						$fee += $feeValue ;
					}
				} else {
					$feeValues = $row->fee_values ;
					$values = $row->values ;
					$feeValues = explode("\r\n", $feeValues) ;
					$values = explode("\r\n", $values) ;
					if (is_array($postedValue)) {
						$postedArr = $postedValue ;
					} elseif ($postedValue) {
						$postedArr = array() ;
						$postedArr[] = $postedValue ;
					} else {
						$postedArr = array() ;
					}
					//Loop over each element in array
					for ($j = 0, $m = count($postedArr) ; $j < $m ; $j++) {
						$posted = $postedArr[$j] ;
						$index = JCFields::findIndex($posted, $values) ;
						if ($index != -1 && isset($feeValues[$index]))
							$fee += $feeValues[$index] ;
					}
				}
			}
		}		
				
		return $fee ;
	}		
	/**
	 * Canculate Fee for total group
	 *
	 * @param int $groupId
	 */
	function canculateGroupFee($groupId) {
		$db = & JFactory::getDBO();
		$sql = 'SELECT event_id FROM #__eb_registrants WHERE id='.$groupId;
		$db->setQuery($sql) ;
		$eventId = $db->loadResult();
		$sql = 'SELECT * FROM #__eb_fields WHERE fee_field = 1 AND published= 1 AND display_in IN (0, 4, 5) AND (event_id = -1 OR id IN (SELECT field_id FROM #__eb_field_events WHERE event_id='.$eventId.'))';
		$db->setQuery($sql) ;
		$rows = $db->loadObjectList();						
		//Get all group members
		$sql = 'SELECT id FROM #__eb_registrants WHERE group_id='.$groupId ;
		$db->setQuery($sql) ;
		$memberIds = $db->loadResultArray();
		$fee = 0 ;		
		foreach ($memberIds as $memberId) {
			for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
				$row = $rows[$i] ;
				$sql = 'SELECT field_value FROM #__eb_field_values WHERE registrant_id='.$memberId.' AND field_id='.$row->id ;
				$db->setQuery($sql) ;
				$postedValue = $db->loadResult() ;
				if ($postedValue) {
					if ($row->field_type == FIELD_TYPE_CHECKBOXLIST || $row->field_type == FIELD_TYPE_MULTISELECT)
						$postedValue  = explode(',', $postedValue) ;
					if ($row->field_type == 1) {				
						if (!$row->fee_formula) {
							continue ;
						} else {														
							$feeValue = 0 ;
							$formula = $row->fee_formula ;					
							$formula = str_replace('[FIELD_VALUE]', $postedValue, $formula ) ;					
							eval('$feeValue = '.$formula.';') ;												
							$fee += $feeValue ;	 
						}	
					} else {
						$feeValues = $row->fee_values ;
						$values = $row->values ;
						$feeValues = explode("\r\n", $feeValues) ;
						$values = explode("\r\n", $values) ;						
						if (is_array($postedValue)) {
							$postedArr = $postedValue ;
						} elseif ($postedValue) {
							$postedArr = array() ;
							$postedArr[] = $postedValue ;
						} else {
							$postedArr = array() ; 
						}
						//Loop over each element in array
						for ($j = 0, $m = count($postedArr) ; $j < $m ; $j++) {
							$posted = $postedArr[$j] ;
							$index = JCFields::findIndex($posted, $values) ;
							if ($index != -1 && isset($feeValues[$index]))
								$fee += $feeValues[$index] ; 
						}				
					}
				}												
			}
		}						
		return $fee ;
	}	
	/**
	 * Find index of an element within array
	 *
	 * @param string $value
	 * @param array $array
	 * @return int
	 */
	function findIndex($value, $array) {
		$index = -1 ;
		for ($i = 0, $n = count($array) ; $i < $n ; $i++) {
			if ($value == $array[$i]) {
				$index = $i ; 
				break ;
			}
		}
		return $index ;		
	}		
	/**
	 * Calculate fields price
	 *
	 * @return array
	 */
	function calculateFieldsPrice($rows) {
		$array = array() ;		
		$fieldTypes = array(FIELD_TYPE_TEXTBOX, FIELD_TYPE_RADIOLIST, FIELD_TYPE_DROPDOWN, FIELD_TYPE_CHECKBOXLIST) ;				 		
		for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
			$row = $rows[$i] ;
			if (!in_array($row->field_type, $fieldTypes))
			    continue ;
			$name = $row->name ;
			$value = JRequest::getVar($name, '', 'post') ;
			if ($row->field_type == FIELD_TYPE_TEXTBOX) {
				$array[strtoupper($name)] = (float)$value ;
			}elseif ($row->field_type == FIELD_TYPE_CHECKBOXLIST) {			    
			    if (strlen(trim($row->fee_values))) {
                    $feeValues = explode("\r\n", $row->fee_values) ;
					$values = explode("\r\n", $row->values) ;
					$fee = 0 ;
					if (is_array($value)) {
					    foreach ($value as $selectedValue) {
					        $index = JCFields::findIndex($selectedValue, $values) ;
					        if ($index != -1) {
					            $fee += (float) $feeValues[$index] ;
					        }
					    }
					}
					$array[strtoupper($name)] = $fee ;
			    }			
			} else {
				if ($value && !is_array($value)) {					
					$feeValues = explode("\r\n", $row->fee_values) ;
					$values = explode("\r\n", $row->values) ;
					$index = JCFields::findIndex($value, $values) ;
					if ($index != -1 && isset($feeValues[$index])) {
						$fee = $feeValues[$index] ;
						$array[strtoupper($name)] = $fee ;
					}						
				}
			}			
		}
		return $array ;
	}				
	/**
	 * Calculate fields price
	 *
	 * @return array
	 */
	function calculateMemberFieldsPrice($rows, $memberId) {
		$db = & JFactory::getDbo() ;
		$sql = 'SELECT field_id, field_value FROM #__eb_field_values WHERE registrant_id='.$memberId ;
		$db->setQuery($sql);
		$rowFields = $db->loadObjectList() ;
		$fieldValues = array();
		if (count($rowFields)) {
			foreach ($rowFields as $rowField) {
				$fieldValues[$rowField->field_id] = $rowField->field_value ;
			}			
		}
		$array = array() ;
		$fieldTypes = array(FIELD_TYPE_TEXTBOX, FIELD_TYPE_RADIOLIST, FIELD_TYPE_DROPDOWN, FIELD_TYPE_CHECKBOXLIST) ;
		for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {			
			$row = $rows[$i] ;
			if (!in_array($row->field_type, $fieldTypes))
				continue ;
			$name = $row->name ;
			$value = isset($fieldValues[$row->id]) ? $fieldValues[$row->id] : '' ;
			if ($row->field_type == FIELD_TYPE_TEXTBOX) {
				$array[strtoupper($name)] = (float)$value ;
			}elseif ($row->field_type == FIELD_TYPE_CHECKBOXLIST) {
				if (strlen(trim($row->fee_values))) {
					$feeValues = explode("\r\n", $row->fee_values) ;
					$values = explode("\r\n", $row->values) ;
					$fee = 0 ;
					$value = explode(',', $value) ;
					if (is_array($value)) {
						foreach ($value as $selectedValue) {
							$index = JCFields::findIndex($selectedValue, $values) ;
							if ($index != -1) {
								$fee += (float) $feeValues[$index] ;
							}
						}
					}
					$array[strtoupper($name)] = $fee ;
				}
			} else {
				if ($value && !is_array($value)) {
					$feeValues = explode("\r\n", $row->fee_values) ;
					$values = explode("\r\n", $row->values) ;
					$index = JCFields::findIndex($value, $values) ;
					if ($index != -1 && isset($feeValues[$index])) {
						$fee = $feeValues[$index] ;
						$array[strtoupper($name)] = $fee ;
					}
				}
			}
		}
		return $array ;
	}	
}
?>