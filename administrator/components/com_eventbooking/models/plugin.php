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
 * Event Booking Component Plugin Model
 *
 * @package		Joomla
 * @subpackage	Event Booking
 * @since 1.5
 */
class EventBookingModelPlugin extends JModel {
	/**
	 * Plugin ID
	 *
	 * @var int
	 */
	var $_id = null;
	/**
	 * Plugin data
	 *
	 * @var array
	 */
	var $_data = null;
	/**
	 * Constructor function, init some data
	 *
	 */
	function  __construct() {		
		parent::__construct();
		$array = JRequest::getVar('cid', array(0), '', 'array');
		$edit	= JRequest::getVar('edit',true);
		if($edit)
			$this->setId((int)$array[0]);
	}	
	
	/**
	 * Method to set the plugin identifier
	 *
	 * @access	public
	 * @param	int plugin identifier
	 */
	function setId($id)
	{
		// Set plugin id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}
	/**
	 * Method to get a plugin data
	 *
	 * @since 1.5
	 */
	function &getData()
	{
		if (empty($this->_data)) {
			if ($this->_id)
				$this->_loadData();						
		}
		return $this->_data;
	}	
	/**
	 * Load plugin data
	 *
	 */
	function _loadData() {
		$sql = 'SELECT * FROM #__eb_payment_plugins WHERE id='.$this->_id;
		$this->_db->setQuery($sql) ;
		$this->_data = $this->_db->loadObject();		
	}	
	/**
	 * Method to store a plugin
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store(&$data)
	{				
		$row = & $this->getTable('EventBooking', 'Plugin');
		$row->load($this->_id);						
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}				
		//Save parameters
		$params		= JRequest::getVar( 'params', null, 'post', 'array' );		
		if (is_array($params))
		{
			$txt = array ();
			foreach ($params as $k => $v) {
				if (is_array($v)) {
					$v = implode(',', $v);	
				}
				$v =  str_replace("\r\n", '@@', $v) ;				
				$txt[] = "$k=\"$v\"";
			}
			$row->params = implode("\n", $txt);
		}
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}		
		return true;
	}
	
	/**
	 * Publish/unpublish plugins
	 *
	 * @param array $cid
	 * @param int $state 
	 */
	function publish($cid, $state = 1) {
		$db = & JFactory::getDBO() ;
		$sql = 'UPDATE #__eb_payment_plugins SET published='.$state.' WHERE id IN('.implode(',', $cid).')' ;
		$db->setQuery($sql);
		if ($db->query())
			return true ;
		else
			return false ;			
	}		
	/**
	 * Install the plugin
	 *
	 */
	function install() {
		$db = & JFactory::getDBO();		
		jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.archive');
		$plugin = JRequest::getVar('plugin_package', null, 'files');
		if ( $plugin['error'] || $plugin['size'] < 1 )
		{
			JRequest::setVar('msg', JText::_('Upload plugin package error')) ;
			return false;
		}				
		$config =& JFactory::getConfig();
		$dest 	= $config->getValue('config.tmp_path').DS.$plugin['name'];							
		$uploaded = JFile::upload($plugin['tmp_name'], $dest);
		if (!$uploaded) {
			JRequest::setVar('msg', JText::_('Upload plugin package')) ;
			return false;
		} 			
		// Temporary folder to extract the archive into
		$tmpdir = uniqid('install_');		
		$extractdir = JPath::clean(dirname($dest).DS.$tmpdir);			
		$result = JArchive::extract($dest , $extractdir);
		if (!$result) {
			JRequest::setVar('msg', JText::_('Upload plugin package')) ;
			return false;
		}		
		$dirList = array_merge(JFolder::files($extractdir, ''), JFolder::folders($extractdir, ''));
		if (count($dirList) == 1)
		{
			if (JFolder::exists($extractdir.DS.$dirList[0]))
			{
				$extractdir = JPath::clean($extractdir.DS.$dirList[0]);
			}
		}		
		//Now, search for xml file
		$xmlfiles = JFolder::files($extractdir, '.xml$', 1, true);
		if (empty($xmlfiles)) {
			JRequest::setVar('msg', JText::_('Could not find xml file in the package')) ;
			return false;
		}				
		$file = $xmlfiles[0] ;
		$xml	=& JFactory::getXMLParser('Simple');				
		if (!$xml->loadFile($file)) {			
			unset ($xml);
			JRequest::setVar('msg', JText::_('Could not load xml file')) ;
			return false;
		}			
		$root =& $xml->document;
		if ($root->name() !=='install') {
			JRequest::setVar('msg', JText::_('Invalid xml file for payment plugin installation function')) ;
			return false;	
		}				
		$element = $root->name ;		
		$name = $element ? $element[0]->data() : '';		
		$sql = 'SELECT COUNT(*) FROM #__eb_payment_plugins WHERE name="'.$name.'"';
		$db->setQuery($sql);
		$total = $db->loadResult();
		if ($total) {
			JRequest::setVar('msg', JText::_('A plugin with the name: '.$name.' existed already')) ;
			return false;
		}				
		$pluginFile = JPATH_ROOT.DS.'components'.DS.'com_eventbooking'.DS.'payments'.DS.$name.'.php';
		if (JFile::exists($pluginFile)) {
			JRequest::setVar('msg', JText::_('Plugin '.$name.' existed . Could not install the plugin')) ;
			return false;
		} 														
		$element = $root->title ;
		$title = $element ? $element[0]->data() : '';		
		$element = $root->author ;
		$author = $element ? $element[0]->data() : '';		
		$element = $root->creationDate ;
		$creationDate = $element ? $element[0]->data() : '';		
		$element = $root->copyright ;
		$copyright = $element ? $element[0]->data() : '';		
		$element = $root->license ;
		$license = $element ? $element[0]->data() : '';		
		$element = $root->authorEmail ;
		$authorEmail = $element ? $element[0]->data() : '';		
		$element = $root->authorUrl ;
		$authorUrl = $element ? $element[0]->data() : '';		
		$element = $root->version ;
		$version = $element ? $element[0]->data() : '';													
		$element = $root->description ;
		$description = $element ? $element[0]->data() : '';											
		$row = & JTable::getInstance('EventBooking', 'Plugin') ;
		$row->name  = $name ;		
		$row->title = $title ;
		$row->author = $author ;
		$row->creation_date = $creationDate ;
		$row->copyright = $copyright ;
		$row->license = $license ;
		$row->author_email = $authorEmail ; 
		$row->author_url = $authorUrl ;
		$row->version = $version ;
		$row->description = $description ;		
		$row->published = 0 ;		
		$row->ordering = $row->getNextOrder('published=1');				
		$row->store() ;				
		$pluginDir = JPATH_ROOT.DS.'components'.DS.'com_eventbooking'.DS.'payments' ;			
		JFile::move($file, $pluginDir.DS.basename($file)) ;			
		$files = $root->files[0]->children() ;						
		for ($i = 0 , $n = count($files) ; $i < $n; $i++) {
			$file = $files[$i] ;
			if ($file->name() == 'filename') {
				$fileName = $file->data();
				if (!JFile::exists($pluginDir.DS.$fileName)) {
					JFile::copy($extractdir.DS.$fileName, $pluginDir.DS.$fileName);					
				}	
			}elseif ($file->name() == 'folder') {
				$folderName = $file->data();
				if (JFolder::exists($extractdir.DS.$folderName)) {
					JFolder::move($extractdir.DS.$folderName, $pluginDir.DS.$folderName) ;
				}							
			}
		}							
		$languages =  $root->languages ;
		if ($languages) {
			$languageFolder = JPATH_ROOT.DS.'language' ;
			$files = $languages[0]->filename ;
			for ($i = 0 , $n = count($files) ; $i < $n; $i++) {
				$file = $files[$i] ;
				$fileName = $file->data();
				$pos = strpos($fileName, '.') ;
				$languageSubFolder = substr($fileName, 0, $pos) ;
				if (!JFile::exists($languageFolder.DS.$languageSubFolder.DS.$fileName)) {
					JFile::copy($extractdir.DS.$fileName, $languageFolder.DS.$languageSubFolder.DS.$fileName);					
				}
			}				
		}
		$installSql = $root->installsql ;
		if ($installSql) {
			$installSql = $installSql[0] ;			
			if ($installSql->children()) {
				$file = $installSql[0]->filename[0] ;
				$fileName = $file->data() ;
				if (JFile::exists($extractdir.DS.$fileName)) {
					$sqlFile = $extractdir.DS.$fileName ;
					$sql = JFile::read($sqlFile) ;
					$queries = $db->splitSql($sql);
					if (count($queries)) {
						foreach ($queries as $query) {
							$query = trim($query) ;
							if ($query != '' && $query{0} != '#') {
									$db->setQuery($query);
									$db->query();						
							}	
						}
					}	
				}				
			}			
		}		
		$installFile = $root->installfile ;
		if ($installFile) {
			$installFile = $installFile[0] ;
			if ($installFile->children()) {
				$file = $installFile[0]->filename[0] ;
				$fileName = $file->data() ;
				if (JFile::exists($extractdir.DS.$fileName)) {
					$installFile = $extractdir.DS.$fileName ;
					if (JFile::exists($installFile)) {
						require_once $installFile ;
						if (function_exists('payment_plugin_install')) {
							payment_plugin_install() ;			
						}
					}						
				}	
			}			
		}
		JFolder::delete($extractdir) ;
		return true ;				
	}		
	/**
	 * Uninstall a payment plugin
	 *
	 * @param int $id
	 * @return boolean
	 */
	function uninstall($id) {
		jimport('joomla.filesystem.folder') ;
		jimport('joomla.filesystem.file') ;
		$row = & JTable::getInstance('EventBooking', 'Plugin');
		$row->load($id);
		$name = $row->name ;		
		$pluginFolder = JPATH_ROOT.DS.'components'.DS.'com_eventbooking'.DS.'payments' ;				
		$file = $pluginFolder.DS.$name.'.xml' ;
		$xml	=& JFactory::getXMLParser('Simple') ;					
		if (!$xml->loadFile($file)) {			
			unset ($xml) ;
			JRequest::setVar('msg', JText::_('Could not load xml file')) ;
			return false ;
		}			
		$root = & $xml->document ;		
		$files = $root->files[0]->children() ;
		$pluginDir = JPATH_ROOT.DS.'components'.DS.'com_eventbooking'.DS.'payments' ;				
		for ($i = 0 , $n = count($files) ; $i < $n; $i++) {
			$file = $files[$i] ;
			if ($file->name() == 'filename') {
				$fileName = $file->data();
				if (JFile::exists($pluginDir.DS.$fileName)) {
					JFile::delete($pluginDir.DS.$fileName) ;					
				}	
			}elseif ($file->name() == 'folder') {
				$folderName = $file->data();
				if ($folderName) {
					if (JFolder::exists($pluginDir.DS.$folderName)) {
						JFolder::delete($pluginDir.DS.$folderName) ;
					}	
				}										
			}
		}							
		$languages =  $root->languages ;
		if ($languages) {
			$languageFolder = JPATH_ROOT.DS.'language' ;
			$files = $languages[0]->filename ;
			for ($i = 0 , $n = count($files) ; $i < $n; $i++) {
				$file = $files[$i] ;
				$fileName = $file->data();
				$pos = strpos($fileName, '.') ;
				$languageSubFolder = substr($fileName, 0, $pos) ;
				if (JFile::exists($languageFolder.DS.$languageSubFolder.DS.$fileName)) {
					JFile::delete($languageFolder.DS.$languageSubFolder.DS.$fileName) ;					
				}
			}				
		}							
		JFile::delete($pluginFolder.DS.$name.'.xml') ;	
		$row->delete();
		return true ;					
	}
	/**
	 * Save the order of plugins
	 *
	 * @param array $cid
	 * @param array $order
	 */
	function saveOrder($cid, $order) {
		$row =& JTable::getInstance('EventBooking', 'Plugin');		
		// update ordering values
		for( $i=0; $i < count($cid); $i++ )
		{
			$row->load( (int) $cid[$i] );
			// track parents			
			if ($row->ordering != $order[$i])
			{
				$row->ordering = $order[$i];
				if (!$row->store()) {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
			}
		}				
		return true;	
	}	
	/**
	 * Change ordering of a category
	 *
	 */
	function move($direction) {
		$row =& JTable::getInstance('EventBooking', 'Plugin');
		$row->load($this->_id);		
		if (!$row->move( $direction, ' published = 1 ' )) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return true;
	}
}
?> 