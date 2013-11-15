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

jimport('joomla.application.component.model');
/**
 * Event Booking Component Language Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelLanguage extends JModel
{		
	/**
	 * Constructor function
	 *
	 */
	function __construct()
	{		
		parent::__construct();		
	}	
	/**
	 * Get language items and store them in an array
	 *
	 */	
	function getTrans($lang , $item) {
		jimport('joomla.filesystem.file');		
		$registry	= new JRegistry();
		$languages = array() ;
		$path = JPATH_ROOT.DS.'language'.DS.'en-GB'.DS.'en-GB.'.$item.'.ini' ;
		$content =  JFile::read($path);					
		$registry->loadINI($content);			
		$languages['en-GB'][$item] = $registry->toArray() ; 
		$path = JPATH_ROOT.DS.'language'.DS.$lang.DS.$lang.'.'.$item.'.ini' ;
		if (JFile::exists($path)) {
			$content =  JFile::read($path);					
			$registry->loadINI($content);			
			$languages[$lang][$item] = $registry->toArray() ;
		} else {
			$languages[$lang][$item] = array();
		}				
		return $languages ;									
	}
	/**
	 *  Get site languages
	 *
	 */	
	function getSiteLanguages() {
		jimport('joomla.filesystem.folder') ;
		$path = JPATH_ROOT.DS.'language' ;
		$folders = JFolder::folders($path) ;
		$rets = array() ;
		foreach ($folders as $folder)
			if ($folder != 'pdf_fonts')
				$rets[] = $folder ;
		return $rets ;		
	}
	/**
	 * Save translation data
	 *
	 * @param array $data
	 */
	function save($data) {
		jimport('joomla.filesystem.file') ;
		$lang = $data['lang'] ;
		$item = $data['item'] ;
		$filePath = JPATH_ROOT.DS.'language'.DS.$lang.DS.$lang.'.'.$item.'.ini' ;
		$keys = $data['keys'] ;
		$content = "";
		foreach ($keys as $key) {
		    $key = trim($key);
		    $value = trim($value);
			$value = $data[$key] ;
			$key = trim($key);
			$value = trim($value);
			$content.="$key=\"$value\"\n" ;
		}
		if (isset($data['extra_keys'])) {
			$keys = $data['extra_keys'] ;
			$values = $data['extra_values'] ;
			for ($i = 0 , $n = count($keys) ; $i < $n; $i++) {
				$key = $keys[$i] ;				
				$value = $values[$i] ;
				$key = trim($key);
				$value = trim($value) ;
				$content.="$key=\"$value\"\n" ;
			}
		}
		JFile::write($filePath, $content) ;
		return true ;				
	}
}