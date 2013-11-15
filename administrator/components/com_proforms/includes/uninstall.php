<?php
/**
* @name MOOJ Proforms 
* @version 1.0
* @package proforms
* @copyright Copyright (C) 2008-2010 Mad4Media. All rights reserved.
* @author Dipl. Inf.(FH) Fahrettin Kutyol
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Please note that some Javascript files are not under GNU/GPL License.
* These files are under the mad4media license
* They may edited and used infinitely but may not repuplished or redistributed.  
* For more information read the header notice of the js files.
**/
	
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );    


class MUninstaller extends JObject{
	
	var $error = null;
	var $success = null;
	var $appName = null;
	var $manifest, $manifestPath ,$rootFolder, $uninstallPath;
	function __construct($type = null, $id = null){
		if(!$type || !$id) return null;
		
		switch($type){
			case "app": 
				$this->_app( (int) $id);
			break;
		}
		if(! $this->error) $this->success = 1;
	}//EOF __construct
	 	
		
	function _app($aid = null){
		if(!$aid) return false;
		
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
		
		$db = & JFactory::getDBO();			
		$db->setQuery("SELECT `app` FROM `#__m4j_apps` WHERE `aid` = '$aid' LIMIT 1");
		$delete = $db->loadObject();
		$app = $delete->app;
		
		
		$this->rootFolder = JPATH_ROOT . DS . "components" . DS . "com_proforms" . DS . "apps" . DS . $app;
		$this->_findManifest();
		$root =& $this->manifest->document;
			
		$kids = & $root->children();
		
		foreach ($kids as $kid){
			if($kid->name() == "uninstall"){
				$uninstall = & $kid->children();
				foreach($uninstall as $item){
					$query = null;
					switch($item->name()){
						case "sql":
						$sqlFile = $item->attributes("file");
						$query = trim($item->data());
						if($sqlFile){
							$sqlFile = $this->rootFolder .DS . $sqlFile;
							if(JFile::exists($sqlFile)){
								$query = file_get_contents( $sqlFile );
							}
						}
						
						if($query){
							$db->setQuery($query);
							$db->queryBatch();
						}
									
							
							
						break;
						
						case "file":
							$file = $this->rootFolder . DS . trim($item->data());
							if(JFile::exists($file)){
								include_once ($file);
							}
						break;
					}
				}
				
				break;
			}
		}
		
					
		$db->setQuery("DELETE FROM `#__m4j_apps2jobs` WHERE `app` = '$app'");
		$db->query();
		$db->setQuery("DELETE FROM `#__m4j_apps` WHERE `aid` = '$aid'");
		$db->query();
		
		JFolder::delete($this->rootFolder);

					
		return true;
	}
	
	 	
	 	
	function _findManifest(){
		// Get an array of all the xml files from teh installation directory
		$xmlfiles = JFolder::files($this->rootFolder, '.xml$', 1, true);
		// If at least one xml file exists
		if (!empty($xmlfiles)) {
			foreach ($xmlfiles as $file)
			{
				// Is it a valid joomla installation manifest file?
				$manifest = $this->_isManifest($file);
				if (!is_null($manifest)) {
	
					// If the root method attribute is set to upgrade, allow file overwrite
					$root =& $manifest->document;
					
	
					// Set the manifest object and path
					$this->manifest =& $manifest;
					$this->manifestPath = $file;
	
					// Set the installation source path to that of the manifest file
					$this->uninstallPath = dirname($file);
					return true;
				}
			}
	
			// None of the xml files found were valid install files
			JError::raiseWarning(1, 'JInstaller::install: '.JText::_('ERRORNOTFINDJOOMLAXMLSETUPFILE'));
			return false;
		} else {
			// No xml files were found in the install folder
			JError::raiseWarning(1, 'JInstaller::install: '.JText::_('ERRORXMLSETUP'));
			return false;
		}
	} 	
 	
	 	
	function &_isManifest($file){
		// Initialize variables
		$null	= null;
		$xml	=& JFactory::getXMLParser('Simple');

		// If we cannot load the xml file return null
		if (!$xml->loadFile($file)) {
			// Free up xml parser memory and return null
			unset ($xml);
			return $null;
		}

		/*
		 * Check for a valid XML root tag.
		 * @todo: Remove backwards compatability in a future version
		 * Should be 'install', but for backward compatability we will accept 'mosinstall'.
		 */
		$root =& $xml->document;
		if (!is_object($root) || ($root->name() != 'proforms') ) {
			// Free up xml parser memory and return null
			unset ($xml);
			return $null;
		}

		// Valid manifest file return the object
		return $xml;
	}
	 	
	 	
	 	
	 	
	
}



?>
