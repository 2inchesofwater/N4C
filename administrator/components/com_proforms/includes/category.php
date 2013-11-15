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
	define('M4J_NOBAR',0);	
	remember_cid();
	
	$error = null;
	$sort_order = m4jGetParam($_REQUEST, 'sort_order');
	 
	switch($task)
	{
		case 'delete':
			if($id){
					$query = "DELETE FROM #__m4j_category WHERE cid = ".$id;
					$database->setQuery($query);
					if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
					
					// Refactor all Forms with the deleted cid
					$max_sort = null;
					$query = "SELECT MAX(sort_order) AS max_sort FROM #__m4j_jobs WHERE cid = -1";
					$database->setQuery( $query );
					$rows = $database->loadObjectList();
					$max_sort = $rows[0]->max_sort + 1;
					
					$query = "SELECT jid FROM #__m4j_jobs WHERE cid = ". $id ." ORDER BY sort_order ASC" ;
					$database->setQuery( $query );
					$rows = $database->loadObjectList();	
					foreach($rows as $row)
						{
						$query = "UPDATE #__m4j_jobs"
						. "\n SET" 
						. "\n sort_order = ".$max_sort++." , "
						. "\n cid = -1 "
						. "\n WHERE jid = ".$row->jid;
						$database->setQuery($query);
						if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
						}
					// EOF Refactor
					MSEF::delete($id,MSEF_CAT);
					
					// Refactor Menu Links
					$component = MDB::get("#__components","id",MDB::_("link","option=com_proforms"),"LIMIT 1");
					$component_id = $component[0]->id;
					
					$query = "SELECT `id`,`link` FROM #__menu WHERE `componentid` = '".(int) $component_id."' AND `link` LIKE '%cid=". $id ."%' ";
					$database->setQuery( $query );
					$links = $database->loadObjectList();
					
					foreach($links as $link){
						$oldCID = "cid=".$id;
						$newLink = str_replace($oldCID,"cid=-1",$link->link);
						MDB::update("#__menu",array("link"=>$newLink),MDB::_("id",$link->id));
					}
					
					
					
			 }//EOF if($id)
		 break;
		 
		case 'up':
			if($sort_order)
			{
				$query = "SELECT * FROM #__m4j_category WHERE sort_order < ". $sort_order ." ORDER BY sort_order DESC LIMIT 1 ";
				$database->setQuery( $query );
				$rows = $database->loadObjectList();	
				if($rows)
					{
					$prev_id = $rows[0]->cid;
					$prev_sort_order = $rows[0]->sort_order;
					if($id)
						{
							$query = "UPDATE #__m4j_category"
							. "\n SET"
							. "\n sort_order = ".$prev_sort_order." "
							. "\n WHERE cid = ".$id;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
							
							$query = "UPDATE #__m4j_category"
							. "\n SET"
							. "\n sort_order = ".$sort_order." "
							. "\n WHERE cid = ".$prev_id;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
						}//EOF $id exist
					 }//EOF $rows exist	
			}//EOF $sort_order exist
			m4jRedirect(M4J_CATEGORY.M4J_REMEMBER_CID_QUERY);
		break; 
	
	
		case 'down':
			if($sort_order)
			{
				$query = "SELECT * FROM #__m4j_category WHERE sort_order > ". $sort_order ." ORDER BY sort_order ASC LIMIT 1 ";
				$database->setQuery( $query );
				$rows = $database->loadObjectList();	
				if($rows)
						{
						$next_id = $rows[0]->cid;
						$next_sort_order = $rows[0]->sort_order;
						if($id)
							{
								$query = "UPDATE #__m4j_category"
								. "\n SET"
								. "\n sort_order = ".$next_sort_order." "
								. "\n WHERE cid = ".$id;
								$database->setQuery($query);
								if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
								
								$query = "UPDATE #__m4j_category"
								. "\n SET"
								. "\n sort_order = ".$sort_order." "
								. "\n WHERE cid = ".$next_id;
								$database->setQuery($query);
								if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
							}//EOF $id exist
						 }//EOF $rows exist	
			}//EOF $sort_order exist
			m4jRedirect(M4J_CATEGORY.M4J_REMEMBER_CID_QUERY);
		break; 
	
	    case'publish':
			if($id)
							{
								$query = "UPDATE #__m4j_category"
								. "\n SET"
								. "\n active = 1 "
								. "\n WHERE cid = ".$id;
								$database->setQuery($query);
								if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
							}
		break;
			
		case'unpublish':
			if($id)
							{
								$query = "UPDATE #__m4j_category"
								. "\n SET"
								. "\n active = 0 "
								. "\n WHERE cid = ".$id;
								$database->setQuery($query);
								if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
							}
		break;		 
		}	

	 
	 
	 
	 
	 
	  
  	HTML_m4j::head(M4J_CATEGORY,$error);
  
 	$helpers->caption(M4J_LANG_CATEGORY);
  
  	  $head = array( M4J_LANG_ACTIVE , M4J_LANG_NAME , M4J_LANG_EMAIL , 'cid' ,M4J_LANG_POSITION , '' , '','' );
	  $helpers->init_table($head);
	  
	  	// DB Query
		$query = "SELECT * FROM #__m4j_category ORDER BY sort_order ASC";

		$database->setQuery( $query );
		$rows = $database->loadObjectList();
	
		$even=true;
		foreach($rows as $row)
		{
		$name = "<span style='color:green;font-weight: bold;'>".MReady::_($row->name)."</span>";
		$info = ' info="'.sprintf(M4J_LANG_LINK_THIS_CAT,$name).'" ';	
			
	    $widthArray = array('45px','','150px','24px','45px','16px','16px','16px');
		$rowArray = array (
							$helpers->active_button(M4J_CATEGORY,$row->cid,$row->active),
							$helpers->edit_by_name(MReady::_($row->name) ,M4J_CATEGORY_NEW,$row->cid,M4J_LANG_EDIT),							
							$row->email ,
							$row->cid,
							$helpers->up_down_button(M4J_CATEGORY,$row->cid,$row->sort_order),
							$helpers->delete_button(M4J_CATEGORY,$row->cid),
							$helpers->edit_button(M4J_CATEGORY_NEW,$row->cid,M4J_LANG_EDIT),
							(_M4J_IS_J16) ? "" : $helpers->image("link2cat.png",M4J_LINK. "&id=-999&cid=".(int) $row->cid.M4J_HIDE_BAR."&name=".urlencode($row->name), null,null,null,0,null,$info)	
							
							);
		
			$helpers->table_row($rowArray,$even,$widthArray);
			$even = !$even; 
		} //EOF foreach
		//EOF DB Query	
		
	  $helpers->close_table();
  
    if(M4J_SHOW_LEGEND) HTML_m4j::legend('cat');	
  
   
  HTML_m4j::footer();
	
?>
