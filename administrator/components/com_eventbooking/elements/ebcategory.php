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
    jimport('joomla.form.formfield');
    class JFormFieldEBCategory extends JFormField
    {
    	/**
    	 * Element name
    	 *
    	 * @access	protected
    	 * @var		string
    	 */
    	var	$_name = 'ebcategory';
    	
    	function getInput()
    	{    		
    		$db =& JFactory::getDBO();
    		$sql = "SELECT id, parent, parent AS parent_id, name, name AS title FROM #__eb_categories WHERE published = 1";			
    		$db->setQuery($sql);
    		$rows = $db->loadObjectList();		
    		$children = array();
    		if ($rows)
    		{
    			// first pass - collect children
    			foreach ( $rows as $v )
    			{
    				$pt 	= $v->parent;
    				$list 	= @$children[$pt] ? $children[$pt] : array();
    				array_push( $list, $v );
    				$children[$pt] = $list;
    			}
    		}			
    		$list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );				
    		$options 	= array();
    		$options[] 	= JHTML::_('select.option',  '0', JText::_( 'Top' ) );
    		foreach ( $list as $item ) {
    			$options[] = JHTML::_('select.option',  $item->id, '&nbsp;&nbsp;&nbsp;'. $item->treename );
    		}							
    		return JHtml::_('select.genericlist', $options, $this->name, array(
    		    'option.text.toHtml' => false ,
    		    'option.value' => 'value', 
    		    'option.text' => 'text', 
    		    'list.attr' => ' class="inputbox" ',
    		    'list.select' => $this->value    		        		
    		));					    		
    	}
    }
} else {
    class JElementEBCategory extends JElement
    {
    	/**
    	 * Element name
    	 *
    	 * @access	protected
    	 * @var		string
    	 */
    	var	$_name = 'ebcategory';
    	
    	function fetchElement($name, $value, &$node, $control_name)
    	{
    		$db =& JFactory::getDBO();
    		$sql = "SELECT id, parent, name FROM #__eb_categories WHERE published = 1";			
    		$db->setQuery($sql);
    		$rows = $db->loadObjectList();		
    		$children = array();
    		if ($rows)
    		{
    			// first pass - collect children
    			foreach ( $rows as $v )
    			{
    				$pt 	= $v->parent;
    				$list 	= @$children[$pt] ? $children[$pt] : array();
    				array_push( $list, $v );
    				$children[$pt] = $list;
    			}
    		}			
    		$list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );				
    		$options 	= array();
    		$options[] 	= JHTML::_('select.option',  '0', JText::_( 'Top' ) );
    		foreach ( $list as $item ) {
    			$options[] = JHTML::_('select.option',  $item->id, '&nbsp;&nbsp;&nbsp;'. $item->treename );
    		}												
    		return JHTML::_('select.genericlist', $options, $control_name.'['.$name.']', ' class="inputbox" ', 'value', 'text', $value) ;
    	}
    }   
}
