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

class JElementEBCurrency extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'ebcurrency';
	
	function fetchElement($name, $value, &$node, $control_name)
	{
		$db =& JFactory::getDBO();
		$sql = "SELECT currency_code, currency_name  FROM #__eb_currencies ORDER BY currency_name ";			
		$db->setQuery($sql);								
		$options 	= array();
		$options[] 	= JHTML::_('select.option',  '', JText::_( 'Select Currency' ), 'currency_code', 'currency_name');
		$options = array_merge($options, $db->loadObjectList()) ;												
		return JHTML::_('select.genericlist', $options, $control_name.'['.$name.']', ' class="inputbox" ', 'currency_code', 'currency_name', $value) ;
	}
}   
