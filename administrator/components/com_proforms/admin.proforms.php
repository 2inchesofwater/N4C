<?PHP
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

// Joomla 1.6 detection
$jVersion = new JVersion;
$j = $jVersion->getShortVersion();
$jsub = substr($j,0,3);
if($jsub == '1.5' ){
	define("_M4J_IS_J16" ,0);
}else{
	define("_M4J_IS_J16" ,1);
}
    
	//*ABSOLUTE PATH
	define("M4J_ABS", JPATH_ROOT);
	//proforms internal debug
	define("_M4J_DEBUG",0);
	// get evolution functions	
	require_once(M4J_ABS . '/administrator/components/com_proforms/includes/evolution.php');
	// get defines
	require_once(M4J_ABS . '/administrator/components/com_proforms/defines.proforms.php');
	// load view ( Based on  J1.0x ) or something like this :).
	require_once(M4J_ABS . '/administrator/components/com_proforms/admin.proforms.html.php');
	// load the easy form maker class (new to proforms)
	require_once(M4J_INCLUDE_MFORM);
	// load the curl emulation for servers without curl
//	require_once(M4J_INCLUDE_LIBCURL);
	// a helper class for working with templates 
	require_once(M4J_INCLUDE_TEMPLATER);
	// get the sef builder class
	require_once(M4J_INCLUDE_MSEF);
	// get the layout and the layout list class
	require_once(M4J_INCLUDE_LAYOUT);
	// get proforms's db helpers
	require_once(M4J_INCLUDE_MDB);
	// get Javscript language text helper
	require_once (M4J_INCLUDE_JSTEXT);
	// get the toolbar class
 	require_once(M4J_INCLUDE_TOOLBAR);
	
	// get the file class
	jimport('joomla.filesystem.file'); 
	// get the folder class
	jimport('joomla.filesystem.folder'); 
	// get the path class
	jimport('joomla.filesystem.path'); 	
	
	// get the configuration
	if(file_exists(M4J_INCLUDE_CONFIGURATION)) require_once(M4J_INCLUDE_CONFIGURATION);
	else require_once(M4J_INCLUDE_RESET_CONFIGURATION);
	// fix me . this is the old way to remember the category at the forms section.
	require_once(M4J_INCLUDE_REMEMBER);
	// the old way to include languages. if a certain language doesn't exist, the english files will be loaded
	if(M4J_FORCE_ADMIN_LANG) $m4jConfig_lang = M4J_FORCE_ADMIN_LANG;
	if(file_exists(M4J_LANG.$m4jConfig_lang.'.php')) include_once(M4J_LANG.$m4jConfig_lang.'.php');
	else include_once(M4J_LANG.'en.php');
	
	$GLOBALS["m4j_lang_elements"] = $m4j_lang_elements;
	
	// append stlesheets and javascript to the head
	$document=& JFactory::getDocument();
	$document->addStyleSheet(M4J_CSS);	
	$document->addScript(M4J_JS.'proforms.js');	
	$document->addScript(M4J_FRONTEND_JS_DOJO);	
	$document->addScript(M4J_JS_MWINDOW);	
		
	//append main language variables to js
	HTML_m4j::jsText();
	
	// activating the helper class
	$helpers = new HTML_HELPERS_m4j();
	$GLOBALS['helpers'] = $helpers;
	
	// get the variables
	$section = JRequest::getString('section','jobs');
	$task = JRequest::getString('task',null);
	$id = JRequest::getInt('id', -1);
	$GLOBALS['id'] = $id;
	$GLOBALS['task'] = $task;
	$GLOBALS['section'] = $section;
	
	if( JRequest::getInt("nobar", 0) == 1 ) define("M4J_NOBAR",1);
	
	$editFlag = ($task =='edit') ? 1 : 0;
	define("M4J_EDITFLAG",$editFlag);
	
	switch($section){
			
		default:
		case 'jobs':
		require_once(M4J_INCLUDE_JOBS);
		break;
		
		case 'jobs_new':
		require_once(M4J_INCLUDE_JOBS_NEW);
		break;
		
		case 'forms':
		require_once(M4J_INCLUDE_FORMS);
		break;
		
		case 'form_new':
		require_once(M4J_INCLUDE_FORM_NEW);
		break;

		case 'datastorage':
		require_once(M4J_INCLUDE_DATASTORAGE);
		break;		

		case 'apps':
		require_once(M4J_INCLUDE_APPS);
		break;		
		
		case 'storage_view':
		require_once(M4J_INCLUDE_STORAGE_VIEW);
		break;	
		
		case 'storage_config':
		require_once(M4J_INCLUDE_STORAGE_CONFIG);
		break;	
		
		case 'storage_mail':
		require_once(M4J_INCLUDE_STORAGE_MAIL);
		break;
		
		case 'formelements':
		require_once(M4J_INCLUDE_FORM_ELEMENTS);
		break;
		
		case 'element':
		require_once(M4J_INCLUDE_ELEMENT);
		break;

		case 'category':
		require_once(M4J_INCLUDE_CATEGORY);
		break;

		case 'category_new':
		require_once(M4J_INCLUDE_CATEGORY_NEW);
		break;
				
		case 'config':
		require_once(M4J_INCLUDE_CONFIG);
		break;
				
		case 'applist':
		require_once(M4J_INCLUDE_APPLIST);
		break;
				
		case 'adminapps':
		require_once(M4J_INCLUDE_ADMINAPPS);
		break;
		
		case 'backup':
		require_once(M4J_INCLUDE_BACKUP);
		break;
		
		case 'help':
		define('M4J_NOBAR',0);	
		require_once(M4J_INCLUDE_HELP);
		break;
		
		case 'service':
		define('M4J_NOBAR',0);	
		require_once(M4J_INCLUDE_SERVICE);
		break;		
		
		case 'link':
		require_once(M4J_INCLUDE_LINK);
		break;

		case 'preview':
		require_once(M4J_INCLUDE_PREVIEW);
		break;		
		
		case 'xhr':
		require_once(M4J_INCLUDE_XHR);
		exit();
		break;
				
	}
	
	JSText::render();	
	
	if(isset($GLOBALS['editArea'])){
		$GLOBALS['editArea']->append();   
	}
	
	
	
?>