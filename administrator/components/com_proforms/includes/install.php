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


class MInstaller extends JObject{
	
	var $error = null;
	var $success = null;
	var $uploadVar = "install_file";
	var $appName = null;
	var $manifest, $manifestPath ,$tempFolder, $installPath;
	function __construct($uploadVar = "install_file"){
		if($uploadVar) $this->uploadVar = $uploadVar;
		
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.path');
		jimport('joomla.filesystem.archive');
		
		$file = JRequest::getVar($this->uploadVar, null, 'files', 'array');
	 	if($file){
			$filename = JFile::makeSafe($file['name']);
			$hash = "proforms_install_" . md5($filename);
			$src = $file['tmp_name'];
			$dest = JPATH_ROOT . DS . "tmp" . DS . $hash . ".zip";
		 
			//First check if the file has the right extension, we need sql only
			if ( strtolower(JFile::getExt($filename) ) == 'zip') {
				if ( JFile::upload($src, $dest) ) {
					$this->tempFolder = JPATH_ROOT . DS . "tmp" . DS . $hash ;
					if( true === JArchive::extract($dest, $this->tempFolder) ){
						$isManifest = $this->_findManifest();
						if($isManifest) {
							$root =& $this->manifest->document;
							$type = $root->attributes('type');
							switch ($type){
								case "app": 
									$this->_app();
								break;
								
								case "patch": 
									$for = $root->attributes('for');
									if($for && ($for != M4J_BUILD) ){
										$this->error = 1;
										JError::raiseWarning(1, 'Proforms Patch Installer: ' . 'This Patch is for Build: '.$for.'. Your current Proforms is Build: '.M4J_BUILD);
										break;
									}
									$this->_patch();
								break;
							}
						}
					}
					JFolder::delete($this->tempFolder);
					JFile::delete($dest);
				}else{
					$this->error = 1;
					JError::raiseWarning(1, 'Proforms Installer: ' . 'Could not upload file to Joomla\'s tmp folder. Please check if you have writing permissions on /tmp ');
				}
			}else{
				$this->error = 1;
	 			JError::raiseWarning(1, 'Proforms Installer: ' . 'Uploaded file is not a ZIP file');
			}
	 	}else{
			$this->error = 1;
	 		JError::raiseWarning(1, 'Proforms Installer: ' . 'No file has been uploaded');
	 	}    
	 	
		if(!$this->error) $this->success= 1;
	}//EOF __construct
	 	
		
		function _app(){
			jimport('joomla.filesystem.file');
			jimport('joomla.filesystem.folder');
			$db = & JFactory::getDBO();
			
			$root =& $this->manifest->document;
			$version = strtolower(trim($root->attributes('version')) );
			$onlypro = strtolower(trim($root->attributes('onlypro')) );
			$admin = (int) $root->attributes('admin');
			$plugin = (int) $root->attributes('plugin');
			$view = (int) $root->attributes('view');
			$infoINI = null;
			$app = null;
			
			$kids = & $root->children();
			
			$format = JRegistryFormat::getInstance("ini");
			
		
			if($onlypro){
				$this->error = 1;
				JError::raiseWarning(1, 'Proforms App Installer: This App is not for the BASIC version. It works only with the PRO version!');
				return false;
			}
			
			foreach ($kids as $kid){
				
				if($kid->name() == "info"){
					$infos = & $kid->children();
					$infoObject = new stdClass();
					foreach($infos as $info){
						if($info->name() == "name"){
							$app = strtolower(trim($info->data()));
						}else{
							$name = strtolower(trim($info->name()));
							$data = trim($info->data());
							$infoObject->$name = $data;
						}
					}
					$infoINI = $format->objectToString($infoObject, null);
				}//EOF is info
				
				if($kid->name() == "install"){
					$items = & $kid->children();
					foreach($items as $item){
						$query = null;
						switch($item->name()){
							case "sql": 
								$sqlFile = $item->attributes("file");
								$query = trim($item->data());
								if($sqlFile){
									$sqlFile = $this->installPath .DS . $sqlFile;
									if(JFile::exists($sqlFile)){
										$query = file_get_contents( $sqlFile );
									}else{
										$this->error = 1;
										JError::raiseWarning(1, 'Proforms App Installer: ' . 'SQL file not found at: '.$sqlFile );
									}
								}
								
								if($query){
									$db->setQuery($query);
									$db->queryBatch();
								}
								
							break;
							
							case "file":
								$file = $this->installPath .DS . trim($item->data());
								if(JFile::exists($file)){
									include_once ($file);
								}else{
									$this->error = 1;
									JError::raiseWarning(1, 'Proforms App Installer: '.JText::_('Install file not found at:'. $file));
								}
							break;
						}
					}
				}//EOF is install
				
			}//EOF foreach root kids
			
			if(! $app){				
				$this->error = 1;
				JError::raiseWarning(1, 'Proforms App Installer: App mismatch. No app folder found.');
				return false;
			}
					
			$destination = JPATH_ROOT . DS . "components" . DS . "com_proforms" . DS . "apps" . DS . $app;
			if (!(JFolder::copy($this->installPath, $destination, null, true))) {
				$this->error = 1;
				JError::raiseWarning(1, 'Proforms Installer: '.'Failed to copy folder to: '.$destination);
				return false;
			}
			
			$db->setQuery("SELECT `aid`, `sort_order`, `active` FROM `#__m4j_apps` WHERE `app` = '$app' LIMIT 1 ");
			$data = $db->loadObject();
			
			$app = $db->getEscaped($app);
			$infoINI = $db->getEscaped($infoINI);
			
			if(!$data){				
				$sort_order = MDB::getMax("#__m4j_apps",null,1);
				$query = "INSERT INTO `#__m4j_apps` 
					(`app`, `has_admin_view`, `has_view`, `has_plugin`, `active`, `sort_order`, `created`, `info`, `admin_params`) 
					VALUES ('$app', '$admin', '$view', '$plugin', '1', '$sort_order' , NOW(), '$infoINI', NULL)";
			}else{
				$query = "UPDATE `#__m4j_apps` SET 
						`has_admin_view` = '$admin',
						`has_view` = '$view',
						`has_plugin` = '$plugin',
						`active` = '$data->active',
						`sort_order` = '$data->sort_order',
						`created` = NOW(),
						`info` = '$infoINI' 
						WHERE `aid` = $data->aid;
						";
			}
			$db->setQuery($query);
			$db->query();	
						
			return true;
		}
	
	 	
		function _patch(){
			jimport('joomla.filesystem.file');
			jimport('joomla.filesystem.folder');
			$db = & JFactory::getDBO();
			
			$root =& $this->manifest->document;
			
			if($root->attributes("version") != "pro"){
				$this->error = 1;
				JError::raiseWarning(1, 'Proforms Patch Installer:  This is not a patch file for the PRO version!' );
				return false;
			}
		
			
			
			$version = null;
			$build = null;
			$admin = 'admin';
			$site = 'site';
			$patchScript = null;
			$kids = & $root->children();
			
//			$format = JRegistryFormat::getInstance("ini");
			
			foreach ($kids as & $kid){
				switch($kid->name()){
					
					case "info":
					$infos = & $kid->children();
					MDebug::pre($infos);
					foreach($infos as & $info){
						switch($info->name()){
							case "version":
								$version = trim($info->data());
								break;
								
							case "build":
								$build = trim($info->data());
								break;
						}
					}	
					break;
					
					case "sql":
						$sqlFile = $kid->attributes("file");
						$query = trim($kid->data());
						if($sqlFile){
							$sqlFile = $this->installPath .DS . $sqlFile;
							if(JFile::exists($sqlFile)){
								$query = file_get_contents( $sqlFile );
							}else{
								$this->error = 1;
								JError::raiseWarning(1, 'Proforms Patch Installer: ' . 'SQL file not found at: '.$sqlFile );
								return false;
							}
						}
						
						if($query){
							$db->setQuery($query);
							$db->queryBatch();
						}	
						
					break;
					
					case "admin":
						$admin = trim($kid->data());
					break;
					
					case "site":
						$site = trim($kid->data());
					break;
					
					case "patchscript":
						$patchScript = $this->installPath .DS . trim($kid->data());
						if(!JFile::exists($patchScript)){
							$this->error = 1;
							JError::raiseWarning(1, 'Proforms Patch Installer: '.JText::_('Patch script not found at:'. $file));
							return false;
						}
					break;
				
				}//EOF switch kid->name()
			}//EOF foreach kids	
				
			$adminDestination = JPATH_ROOT . DS . "administrator" . DS."components" . DS . "com_proforms" ;	
			$admin = $this->installPath .DS . $admin;
			if(JFolder::exists($admin) ){
				if (!(JFolder::copy($admin, $adminDestination, null, true))) {
					$this->error = 1;
					JError::raiseWarning(1, 'Proforms Installer: '.'Failed to copy folder to: '.$adminDestination);
					return false;
				}
			}		
				
			$siteDestination = JPATH_ROOT . DS . "components" . DS . "com_proforms" ;
			$site = $this->installPath .DS . $site;
			if(JFolder::exists($site) ){
				if (!(JFolder::copy($site, $siteDestination, null, true))) {
					$this->error = 1;
					JError::raiseWarning(1, 'Proforms Installer: '.'Failed to copy folder to: '.$siteDestination);
					return false;
				}
			}	
				
			
			if($version){
				$db->setQuery("UPDATE #__m4j_config SET ".
					  "`value` = '".$db->getEscaped($version)."' ".
					  "WHERE `key` = 'M4J_VERSION_NO'");	
				$db->query();
			}
			
			
			if($build){
				$db->setQuery("UPDATE #__m4j_config SET ".
					  "`value` = '".$db->getEscaped($build)."' ".
					  "WHERE `key` = 'M4J_BUILD'");	
				$db->query();
			}

			if($patchScript){
				include_once ($patchScript);
			}
			return true;
		}
		
		
	 	
		function _findManifest(){
		// Get an array of all the xml files from teh installation directory
		$xmlfiles = JFolder::files($this->tempFolder, '.xml$', 1, true);
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
					$this->installPath = dirname($file);
					return true;
				}
			}

			// None of the xml files found were valid install files
			$this->error = 1;
			JError::raiseWarning(1, 'Proforms Installer: '.JText::_('Found manifest XML file wasn not a valid Proforms manifest '));
			return false;
		} else {
			// No xml files were found in the install folder
			$this->error = 1;
			JError::raiseWarning(1, 'Proforms Installer: '.JText::_('No manifest XML file found.'));
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
