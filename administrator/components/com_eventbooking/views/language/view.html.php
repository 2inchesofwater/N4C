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

jimport( 'joomla.application.component.view');
/**
 * HTML View class for Event Booking Extension
 *
 * @static
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingViewLanguage extends JView
{
	function display($tpl = null)
	{	
		$mainframe = & JFactory::getApplication() ;
		$option    = 'com_eventbooking' ;    
		jimport('joomla.filesystem.file') ;
		$search				= $mainframe->getUserStateFromRequest( $option.'language_search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );				
		$lists['search'] = $search;			
		$lang = JRequest::getVar('lang', '') ;
		if (!$lang)
			$lang = 'en-GB' ;		
		$item = JRequest::getVar('item', '') ;
		if (!$item)
			$item = 'com_eventbooking' ;
		$model = & $this->getModel('language') ;	
		$trans = $model->getTrans($lang, $item);
		$languages = $model->getSiteLanguages();		
		$options = array() ;
		$options[] = JHTML::_('select.option', '', JText::_('Select Language'))	;
		foreach ($languages as $language) {
			$options[] = JHTML::_('select.option', $language, $language) ;		
		}
		$lists['lang'] = JHTML::_('select.genericlist', $options, 'lang', ' class="inputbox"  onchange="submit();" ', 'value', 'text', $lang) ;		
				
		$this->assignRef('trans', $trans) ;	
		$this->assignRef('lists', $lists) ;	
		$this->assignRef('lang', $lang) ;
		$this->assignRef('item', $item) ;				
		parent::display($tpl);				
	}
}