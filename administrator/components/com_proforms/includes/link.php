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
	remember_cid();
	

	$error = null;
	$menutype =  JRequest::getString('menutype',null);
	$remember_cid =  JRequest::getInt('remember_cid',null);
	$name =  JRequest::getString('name',null);
	$title =  JRequest::getString('title',null);
	$link_name =  JRequest::getString('link_name',null);
	$alias = JRequest::getString("alias",null);
	$cid = JRequest::getInt('cid',null);
	

		JLoader::register('JTableMenu', JPATH_LIBRARIES.DS.'joomla'.DS.'database'.DS.'table'.DS.'menu.php');
		include_once(M4J_ABS.'/administrator/components/com_menus/helpers/helper.php');
		$comp = "component";
		$alias = $alias ? MSEF::replace($alias): MSEF::replace($link_name);
		$alias .=  "', '";	

	include_once(M4J_INCLUDE_FUNCTIONS);
	
	$link_to_cat = true;
	$link = 'index.php?option=com_proforms';
	if($id==-999){
			if($cid){
				$link .= "&cid=".(int) $cid;
			}else if($remember_cid !=-2){
				$link .= "&cid=".$remember_cid;
			}
	}else{
		$link .= "&jid=".$id."&cid=".$cid;
		$link_to_cat = false;
	}
	
	if($menutype) define('M4J_LINK_FORM_READY',1);
	
	
   switch($task){
   	
	case 'new':
	if($link_name){
		$query = "SELECT `id` FROM #__components WHERE link ='option=com_proforms' AND `parent` = '0' LIMIT 1";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();	
		$compID = $rows[0]->id;
		$parent = intval( m4jGetParam( $_REQUEST, 'parent', 0 ) );
		//Getting the sublevel
		$sublevel = 0;
		if($parent != 0){
			$query = "SELECT (`sublevel` +1 ) AS pfm_sublevel FROM #__menu WHERE `id` ='".intval($parent)."' LIMIT 1";
			$database->setQuery( $query );
			$rows = $database->loadObjectList();
			$sublevel = $rows[0]->pfm_sublevel;	
		}
		
		$query = "SELECT MAX(ordering) AS MAX FROM #__menu WHERE parent ='".$parent."' AND menutype = '".$menutype."' ";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();	
		$maxpos = intval($rows[0]->MAX) +1 ;
				
		$query = "INSERT INTO #__menu"
						. "\n ( menutype, name, alias,  link, type, published, parent, componentid, sublevel, access, ordering, params )"
						. "\n VALUES"
						. "\n ( '".$menutype."', '".
						$database->getEscaped($link_name)."', '".
						$alias.
						$link."','".$comp."' ,'".
						intval( m4jGetParam( $_REQUEST, 'published', 1 ) )."', '".
						$parent."', '".$compID."', '".$sublevel."', '".
						intval( m4jGetParam( $_REQUEST, 'access', 0 ) )."', '".$maxpos."' ,'')";
		$database->setQuery($query);
		if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 

		m4jRedirect(M4J_JOBS.M4J_REMEMBER_CID_QUERY);
	}else{
		$error .= M4J_LANG_NO_LINK_NAME;
	}
	
	
	
	break;
	}	
		
		
		
		

  HTML_m4j::head(M4J_LINK,$error);
   
   if($link_to_cat){
   		
		$fork = ($cid) ? $cid : $remember_cid;
   	
		switch($fork)
			{
			case -2:
			$helpers->caption(M4J_LANG_LINK_TO_ALL_CAT,null,M4J_LANG_FORMS.' > '.M4J_LANG_LINK);
			break;
			
			case -1:
			$helpers->caption(M4J_LANG_LINK_TO_NO_CAT,null,M4J_LANG_FORMS.' > '.M4J_LANG_LINK);
			break;
			
			default:
			$helpers->caption(M4J_LANG_LINK_TO_CAT.$helpers->span(MReady::_($name),'m4j_green'),null,M4J_LANG_FORMS.' > '.M4J_LANG_LINK);
			break;
			}
	}else {
		$helpers->caption(M4J_LANG_LINK_TO_FORM.$helpers->span(MReady::_($name),'m4j_green'),null,M4J_LANG_FORMS.' > '.M4J_LANG_LINK);
	}
   
   
   
   	if(!$menutype) //* SHOW MENUS
   		{
		$helpers->advice(M4J_LANG_CHOOSE_MENU,3);		
		$query = "SELECT * FROM #__menu_types ORDER BY `id`";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();	
		HTML_m4j::link_menu($rows,$id,$name,$cid);	
		}//* EOF SHOW MENUS
	else //* SHOW MASK
		{
		$helpers->advice(M4J_LANG_MENU.$title,2);
		

			$menu = new JTableMenu($db);
			$menu->type='components';
			$menu->menutype = $menutype;
			$menu->browserNav = 0;
			$menu->ordering = 9999;
			$menu->parent =  intval( m4jGetParam( $_REQUEST, 'parent', 0 ) );
			$menu->published = intval( m4jGetParam( $_REQUEST, 'published', 1 ) );
			$menu->access =  intval( m4jGetParam( $_REQUEST, 'access', 0 ) ) ;
			
			$parent = MenusHelper::Parent($menu);
			$access =  JHTML::_('list.accesslevel',  $menu);
			$published = MenusHelper::Published($menu);

		
		
		
		HTML_m4j::link_form($id,$parent,$access,$published,$menutype,$name,$title,$cid);	
		}//* EOF SHOW MASK
	
	
	
					
   
  HTML_m4j::footer();
?>
