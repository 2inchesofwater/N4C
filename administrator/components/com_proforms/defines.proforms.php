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
	
	//* Apps Folders	
	define("M4J_APPS_BASE", JPATH_ROOT . '/components/com_proforms/apps/');
	define("M4J_APPS_PARAMS", JPATH_ROOT . '/administrator/components/com_proforms/includes/appsparamdisplay.php');
	define("M4J_HTTP_APPS", $m4jConfig_live_site . '/components/com_proforms/apps/');
	
	//*Frontend Folder
	define("M4J_JS_CALNEDAR", JPATH_ROOT . '/components/com_proforms/js/calendar/');
	define("M4J_FRONTEND_STYLESHEET", JPATH_ROOT . '/components/com_proforms/css/stylesheet.css');
	define("M4J_TMP", JPATH_ROOT . '/components/com_proforms/tmp/');
	
	//* Frontend Includes
	define("M4J_INCLUDE_CALENDAR", JPATH_ROOT . '/components/com_proforms/includes/calendar.php');
	define("M4J_INCLUDE_VALIDATE", JPATH_ROOT . '/components/com_proforms/includes/validate.php');
	
	//* Fontend HTTP
	define("M4J_FRONTEND", $m4jConfig_live_site . '/components/com_proforms/');
	define("M4J_FRONTEND_LINK", $m4jConfig_live_site . '/index.php?option=com_proforms');
	define("M4J_FRONTEND_CALENDAR", M4J_FRONTEND . 'js/calendar/');
	define("M4J_FRONTEND_JS_DOJO", M4J_FRONTEND . 'js/dojo.js');

	//* Frontend App MVC
	define("M4J_INCLUDE_CONTROLLER", JPATH_ROOT . '/components/com_proforms/includes/mcontroller.php');
	define("M4J_INCLUDE_VIEW", JPATH_ROOT . '/components/com_proforms/includes/mview.php');
	define("M4J_INCLUDE_MODEL", JPATH_ROOT . '/components/com_proforms/includes/mmodel.php');

	//* Folders
	define("M4J_LANG", JPATH_ROOT . '/administrator/components/com_proforms/language/');
	define("M4J_TEMPLATES", JPATH_ROOT . '/administrator/components/com_proforms/templates/');
	define("M4J_PATH_JS", JPATH_ROOT . '/administrator/components/com_proforms/js/');
	define("M4J_LAYOUT", JPATH_ROOT . '/administrator/components/com_proforms/layout/');
	define("M4J_XHR", JPATH_ROOT . '/administrator/components/com_proforms/xhr/');
	
	//* Include Constants
	define("M4J_INCLUDE_CONFIGURATION", JPATH_ROOT . '/administrator/components/com_proforms/config.proforms.php');
	define("M4J_INCLUDE_RESET_CONFIGURATION", JPATH_ROOT . '/administrator/components/com_proforms/includes/reset_config.php');
	
	define("M4J_INCLUDE_FUNCTIONS", JPATH_ROOT . '/administrator/components/com_proforms/includes/functions.php');	
	define("M4J_INCLUDE_FORMFACTORY", JPATH_ROOT . '/administrator/components/com_proforms/includes/formfactory.php');	
	define("M4J_INCLUDE_REMEMBER", JPATH_ROOT . '/administrator/components/com_proforms/includes/remember_cid.php');

	define("M4J_INCLUDE_XHR", JPATH_ROOT . '/administrator/components/com_proforms/includes/xhr.php');
	define("M4J_INCLUDE_JOBS", JPATH_ROOT . '/administrator/components/com_proforms/includes/jobs.php');
	define("M4J_INCLUDE_JOBS_NEW", JPATH_ROOT . '/administrator/components/com_proforms/includes/jobs_new.php');
	define("M4J_INCLUDE_DATASTORAGE", JPATH_ROOT . '/administrator/components/com_proforms/includes/datastorage.php');
	define("M4J_INCLUDE_APPS", JPATH_ROOT . '/administrator/components/com_proforms/includes/apps.php');
	define("M4J_INCLUDE_APPTEXT", JPATH_ROOT . '/administrator/components/com_proforms/includes/apptext.php');
	define("M4J_INCLUDE_APPHELPER", JPATH_ROOT . '/administrator/components/com_proforms/includes/apphelper.php');
	define("M4J_INCLUDE_APPDB", JPATH_ROOT . '/administrator/components/com_proforms/includes/appdb.php');
	define("M4J_INCLUDE_TOOLBAR", JPATH_ROOT . '/administrator/components/com_proforms/includes/toolbar.php');
	define("M4J_INCLUDE_FORMS", JPATH_ROOT . '/administrator/components/com_proforms/includes/forms.php');
	define("M4J_INCLUDE_FORM_NEW", JPATH_ROOT . '/administrator/components/com_proforms/includes/form_new.php');
	define("M4J_INCLUDE_FORM_ELEMENTS", JPATH_ROOT . '/administrator/components/com_proforms/includes/form_elements.php');	
	define("M4J_INCLUDE_ELEMENT", JPATH_ROOT . '/administrator/components/com_proforms/includes/element.php');	
	define("M4J_INCLUDE_CATEGORY", JPATH_ROOT . '/administrator/components/com_proforms/includes/category.php');	
	define("M4J_INCLUDE_CATEGORY_NEW", JPATH_ROOT . '/administrator/components/com_proforms/includes/category_new.php');	
	define("M4J_INCLUDE_CONFIG", JPATH_ROOT . '/administrator/components/com_proforms/includes/config.php');	
	define("M4J_INCLUDE_APPLIST", JPATH_ROOT . '/administrator/components/com_proforms/includes/applist.php');	
	define("M4J_INCLUDE_ADMINAPPS", JPATH_ROOT . '/administrator/components/com_proforms/includes/admin.apps.php');
	define("M4J_INCLUDE_BACKUP", JPATH_ROOT . '/administrator/components/com_proforms/includes/backup.php');	
	define("M4J_INCLUDE_HELP", JPATH_ROOT . '/administrator/components/com_proforms/includes/help.php');
	define("M4J_INCLUDE_SERVICE", JPATH_ROOT . '/administrator/components/com_proforms/includes/service.php');
	define("M4J_INCLUDE_LINK", JPATH_ROOT . '/administrator/components/com_proforms/includes/link.php');
	define("M4J_INCLUDE_EDIT_AREA", JPATH_ROOT . '/administrator/components/com_proforms/includes/editarea.php');
	define("M4J_INCLUDE_MFORM", JPATH_ROOT . '/administrator/components/com_proforms/includes/mform.php');
	define("M4J_INCLUDE_LIBCURL", JPATH_ROOT . '/administrator/components/com_proforms/libcurl/libcurlemu.inc.php');
	define("M4J_INCLUDE_TEMPLATER", JPATH_ROOT . '/administrator/components/com_proforms/includes/templater.php');
	define("M4J_INCLUDE_PREVIEW", JPATH_ROOT . '/administrator/components/com_proforms/includes/preview.php');
	define("M4J_INCLUDE_MSEF", JPATH_ROOT . '/administrator/components/com_proforms/includes/sef.php');
	define("M4J_INCLUDE_LAYOUT", JPATH_ROOT . '/administrator/components/com_proforms/includes/layout.php');
	define("M4J_INCLUDE_MDB", JPATH_ROOT . '/administrator/components/com_proforms/includes/mdb.php');
	define("M4J_INCLUDE_DOWNLOAD", JPATH_ROOT . '/administrator/components/com_proforms/includes/get.php');
	define("M4J_INCLUDE_JSTEXT", JPATH_ROOT . '/administrator/components/com_proforms/includes/jstext.php');
	define("M4J_INCLUDE_STORAGE_CONFIG", JPATH_ROOT . '/administrator/components/com_proforms/includes/storage_config.php');
	define("M4J_INCLUDE_STORAGE_VIEW", JPATH_ROOT . '/administrator/components/com_proforms/includes/storage_view.php');
	define("M4J_INCLUDE_STORAGE_MAIL", JPATH_ROOT . '/administrator/components/com_proforms/includes/storage_mail.php');
	define("M4J_INCLUDE_DB_CONFIG", JPATH_ROOT . '/administrator/components/com_proforms/includes/db_config.php');
	define("M4J_INCLUDE_ELEMENT_HELPER", JPATH_ROOT . '/administrator/components/com_proforms/includes/element_helper.php');
	define("M4J_INCLUDE_INSTALL", JPATH_ROOT . '/administrator/components/com_proforms/includes/install.php');
	define("M4J_INCLUDE_UNINSTALL", JPATH_ROOT . '/administrator/components/com_proforms/includes/uninstall.php');
	define("M4J_INCLUDE_COUNTRIES", JPATH_ROOT . '/administrator/components/com_proforms/includes/countries.php');
	
	$tmpl = (JRequest::getString("tmpl")=="component")? "&tmpl=component" : "";
	//* HTTP Contstants
	define("M4J_HOME",$m4jConfig_live_site .'/administrator/index.php?option=com_proforms'.$tmpl);
	define("M4J_JOBS", M4J_HOME.'&section=jobs');	
	define("M4J_JOBS_NEW", M4J_HOME.'&section=jobs_new');	
	define("M4J_DATASTORAGE", M4J_HOME.'&section=datastorage');	
	define("M4J_APPS", M4J_HOME.'&section=apps');	
	define("M4J_FORMS", M4J_HOME.'&section=forms');
	define("M4J_FORM_NEW", M4J_HOME.'&section=form_new');
	define("M4J_FORM_ELEMENTS", M4J_HOME.'&section=formelements');
	define("M4J_ELEMENT", M4J_HOME.'&section=element');
	define("M4J_CATEGORY", M4J_HOME.'&section=category');
	define("M4J_CATEGORY_NEW", M4J_HOME.'&section=category_new');
 	define("M4J_CONFIG", M4J_HOME.'&section=config'); 
 	define("M4J_APPLIST", M4J_HOME.'&section=applist'); 
 	define("M4J_ADMINAPPS", M4J_HOME.'&section=adminapps');
 	define("M4J_BACKUP", M4J_HOME.'&section=backup'); 
	define("M4J_HELP",  M4J_HOME.'&section=help');
	define("M4J_SERVICE",  M4J_HOME.'&section=service'); 
	define("M4J_LINK",  M4J_HOME.'&section=link');
	define("M4J_PREVIEW",  M4J_HOME.'&section=preview&format=raw&fid=');
	define("M4J_LOAD_XHR",  M4J_HOME.'&section=xhr&xhr=');
	define("M4J_DOWNLOAD",  M4J_HOME.'&section=download&format=raw&stiid=');
	define("M4J_STORAGE_CONFIG",  M4J_HOME.'&section=storage_config&id=');
	define("M4J_STORAGE_MAIL",  M4J_HOME.'&section=storage_mail&id=');
	
	define("M4J_HTTP_LAYOUT", $m4jConfig_live_site . '/administrator/components/com_proforms/layout/');
	define("M4J_IMAGES", $m4jConfig_live_site . '/administrator/components/com_proforms/images/');
	define("M4J_CSS", $m4jConfig_live_site . '/administrator/components/com_proforms/admin.stylesheet.css'); 
	define("M4J_JS", $m4jConfig_live_site . '/administrator/components/com_proforms/js/');
	define("M4J_THICKBOX", M4J_JS. 'thickbox/');
	define("M4J_EDIT_AREA", M4J_JS. 'editarea/');
	define("M4J_JS_INFO", M4J_JS. 'info.js');
	define("M4J_JS_PREVIEW", M4J_JS. 'preview.js');
	define("M4J_JS_LAYOUT_SLOT", M4J_JS. 'layoutslot.js');
	define("M4J_JS_NEW_FORM", M4J_JS. 'newform.js');
	define("M4J_JS_NEW_JOB", M4J_JS. 'newjob.js');
	define("M4J_JS_SERVICE", M4J_JS. 'service.js');
	define("M4J_JS_MWINDOW", M4J_JS. 'mwindow.js');
	define("M4J_JS_APPS", M4J_JS. 'apps.js');
	
	//* ACTIONS
	define("M4J_HIDE_BAR",'&nobar=1');
	define("M4J_NEW",'&task=new');	
	define("M4J_EDIT",'&task=edit');
   	define("M4J_DELETE",'&task=delete');	
	define("M4J_UPDATE",'&task=update');
	define("M4J_SAVE",'&task=save');
	define("M4J_UP",'&task=up');	
	define("M4J_DOWN",'&task=down');	
	define("M4J_PUBLISH",'&task=publish');		
	define("M4J_UNPUBLISH",'&task=unpublish');
	define("M4J_REQUIRED",'&task=required');		
	define("M4J_NOT_REQUIRED",'&task=not_required');
	define("M4J_COPY",'&task=copy');	
	define("M4J_RESET",'&task=reset');	
	define("M4J_MENUTYPE",'&menutype=');
	
	
	
	// Service Connect
	define('M4J_SERVICE_CONNECT','http://www.mad4software.com/packages/proforms.html');
	
	// Ident
	define("M4J_IDENTIFIER","");
?>