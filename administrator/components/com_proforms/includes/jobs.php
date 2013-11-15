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
  include(M4J_INCLUDE_FUNCTIONS);
  include_once(M4J_INCLUDE_FORMFACTORY);
  include_once(M4J_INCLUDE_CALENDAR);


  $sort_order = m4jGetParam($_REQUEST, 'sort_order');

  // Check cid if is legal
  $legal = null;
  $cid = JRequest::getInt("cid" , null);
  if($cid) $legal = $cid;
  else $legal =  JRequest::getInt("remember_cid" , null); 
 
  if($legal!=null && $legal !=-1)
  	{
	  $query = "SELECT name FROM #__m4j_category WHERE cid=".$legal." AND active = 1";
	  $database->setQuery( $query );
	  $is_active = $database->loadObjectList();
	  if(!$is_active) $cid =-2;  
  	}
  
  $cid= remember_cid($cid);
  
  $caption = M4J_LANG_FORMS.' ';
  if($cid==-2) $caption = M4J_LANG_ALL_FORMS;
  if($cid==-1) $caption .= M4J_LANG_NO_CATEGORYS;
  if($cid>-1)
  	{
		$query = "SELECT `name` FROM `#__m4j_category` WHERE `cid`= '".$cid . "'";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();
		$caption = M4J_LANG_FORMS_OF_CATEGORY . $helpers->span(MReady::_($rows[0]->name),'m4j_green');	
	}
	
  define('M4J_NEW_JOB_CID_QUERY','&cid='.$cid);
  	 
	switch($task)
		{
		
		case 'delete':
			if($id){
				// Delete Jobs
				$query = "DELETE FROM `#__m4j_jobs` WHERE `jid` = '".$id . "'";
				$database->setQuery($query);
				if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
				//Delete Apps2Jobs
				$query = "DELETE FROM `#__m4j_apps2jobs` WHERE `jid` = '". $id . "'" ;
				$database->setQuery($query);
				if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
				//Delete SEF entries
				MSEF::delete($id,MSEF_FORM);					
			}
		 break;
		 
		case 'up':
			if($sort_order && $cid !=-2 )
			{
				$query = "SELECT * FROM `#__m4j_jobs` WHERE `cid` = '".$cid."' AND `sort_order` < ". (int) $sort_order ." ORDER BY `sort_order` DESC LIMIT 1 ";
				$database->setQuery( $query );
				$rows = $database->loadObjectList();	
				if($rows)
					{
					$prev_id = $rows[0]->jid;
					$prev_sort_order = $rows[0]->sort_order;
					if($id)
						{
							$query = "UPDATE #__m4j_jobs"
							. "\n SET"
							. "\n sort_order = ".$prev_sort_order." "
							. "\n WHERE jid = ".$id;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
							
							$query = "UPDATE #__m4j_jobs"
							. "\n SET"
							. "\n sort_order = ".$sort_order." "
							. "\n WHERE jid = ".$prev_id;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
						}//EOF $id exist
					 }//EOF $rows exist	
			}//EOF $sort_order exist
			
			m4jRedirect(M4J_JOBS.M4J_REMEMBER_CID_QUERY);
		break; 
	
	
		case 'down':
			if($sort_order && $cid !=-2 )
			{
				$query = "SELECT * FROM #__m4j_jobs WHERE cid = ".$cid." AND sort_order > ". $sort_order ." ORDER BY sort_order ASC LIMIT 1 ";
				$database->setQuery( $query );
				$rows = $database->loadObjectList();	
				if($rows)
						{
						$next_id = $rows[0]->jid;
						$next_sort_order = $rows[0]->sort_order;
						if($id)
							{
								$query = "UPDATE #__m4j_jobs"
								. "\n SET"
								. "\n sort_order = ".$next_sort_order." "
								. "\n WHERE jid = ".$id;
								$database->setQuery($query);
								if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
								
								$query = "UPDATE #__m4j_jobs"
								. "\n SET"
								. "\n sort_order = ".$sort_order." "
								. "\n WHERE jid = ".$next_id;
								$database->setQuery($query);
								if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
							}//EOF $id exist
						 }//EOF $rows exist	
			}//EOF $sort_order exist
			m4jRedirect(M4J_JOBS.M4J_REMEMBER_CID_QUERY);
		break; 
		
		case'publish':
		if($id)
						{
							$query = "UPDATE #__m4j_jobs"
							. "\n SET"
							. "\n active = 1 "
							. "\n WHERE jid = ".$id;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
						}
		break;
		
		case'unpublish':
		if($id)
						{
							$query = "UPDATE #__m4j_jobs"
							. "\n SET"
							. "\n active = 0 "
							. "\n WHERE jid = ".$id;
							$database->setQuery($query);
							if (!$database->query()) $helpers->dbError($database->getErrorMsg()); 
						}
		break;	
		
		case'copy':
		  if($id)
			{
					$max_sort = null;
					$query = "SELECT MAX(sort_order) AS max_sort ".
						  "\n FROM #__m4j_jobs WHERE cid=".
						  "\n ( SELECT cid FROM #__m4j_jobs WHERE jid=".$id.")";

					$database->setQuery( $query );
					$rows = $database->loadObjectList();
					$max_sort = $rows[0]->max_sort;
			
					
					$insertId = MDB::copy("#__m4j_jobs",MDB::_("jid",$id));
					MDB::setSortOrder("#__m4j_jobs", ($max_sort+1) , MDB::_("jid",$insertId) );
					
					MDB::copyApp($id, $insertId);
					
					$sefInfo = MDB::get("#__m4j_jobs",array("title","alias","cid"),MDB::_("jid",$insertId));
					
					$sef = new MSEF($sefInfo[0]->title,$sefInfo[0]->alias,$insertId,$sefInfo[0]->cid);
					$sef->insert();	
			}
		  break;
		}//EOF SWITCH TASK



  HTML_m4j::head(M4J_JOBS);
  
  $query = "SELECT cid,name FROM #__m4j_category ORDER BY sort_order ASC";
				$database->setQuery( $query );
				$rows = $database->loadObjectList();
				
  $helpers->caption($caption,$helpers->category_menu($rows,$cid,M4J_JOBS,null,true)); 

	
 if($cid!=-2) 
 	$head = array( M4J_LANG_ACTIVE , M4J_LANG_TITLE , M4J_LANG_EMAIL ,M4J_LANG_CATEGORY, M4J_LANG_TEMPLATES , 'jid' ,M4J_LANG_POSITION,'','' , '', '' , '', '' );
 else
 	$head = array( M4J_LANG_ACTIVE , M4J_LANG_TITLE , M4J_LANG_EMAIL ,M4J_LANG_CATEGORY, M4J_LANG_TEMPLATES, 'jid' ,'','' ,'', '', '' , '', '' ); 

	  $helpers->init_table($head);
	  
	  	// DB Query
//		if($cid==-2)
//		$query = "SELECT a.active as active, a.title as title, a.email as email, b.name as category, a.jid as jid, c.name as template , a.sort_order as sort_order  ".
//			  "\n FROM #__m4j_jobs AS a LEFT JOIN #__m4j_category AS b ON (a.cid=b.cid) LEFT JOIN #__m4j_forms AS c ON (a.fid=c.fid) ".
//			  "\n WHERE  (a.cid = b.cid OR a.cid = -1) AND a.fid = c.fid AND a.public = 1 ORDER BY a.cid ASC, a.sort_order ASC";
//		else
//		$query = "SELECT a.active as active, a.title as title, a.email as email, b.name as category, a.jid as jid, c.name as template ,  a.sort_order as sort_order  ".
//			  "\n FROM #__m4j_jobs AS a LEFT JOIN #__m4j_category AS b ON (a.cid=b.cid) LEFT JOIN #__m4j_forms AS c ON (a.fid=c.fid) ".
//			  "\n WHERE ( (a.cid = b.cid OR a.cid = -1) AND a.cid = ".$cid.") AND a.fid = c.fid AND a.public = 1 ORDER BY a.sort_order ASC";
		
		// DB Query
		if($cid==-2){
		$query = "SELECT a.active as active, a.title as title, a.email as email, a.fid as fid, a.cid as linkcid, ".
				 "b.name as category, a.jid as jid, a.sort_order as sort_order".
			     "\n FROM #__m4j_jobs AS a LEFT JOIN #__m4j_category AS b ON (a.cid=b.cid)".
			     "\n WHERE  (a.cid = b.cid OR a.cid = -1) AND a.public = 1 ORDER BY a.cid ASC, a.sort_order ASC";
		}else{
		$query = "SELECT a.active as active, a.title as title, a.email as email, a.fid as fid, a.cid as linkcid, ".
				 "b.name as category, a.jid as jid, a.sort_order as sort_order  ".
			     "\n FROM #__m4j_jobs AS a LEFT JOIN #__m4j_category AS b ON (a.cid=b.cid)".
			     "\n WHERE ( (a.cid = b.cid OR a.cid = -1) AND a.cid = ".$cid.") AND a.public = 1 ORDER BY a.sort_order ASC";
		}
		
		$database->setQuery( $query );
		$rows = $database->loadObjectList();
		
		
		$even=true;
		
		$templateRows = MDB::get("#__m4j_forms",array("fid","name"));
		$fid = array();
		foreach($templateRows as $row){
			$fid[$row->fid] = $row->name;
		}
		
		foreach($rows as $row){
			
			if($row->fid != ""){
				$fids = explode(";",$row->fid);
				$fidCount = sizeof($fids);
				$template = ($fidCount == 1) ? "1 ".M4J_LANG_TEMPLATE : $fidCount." ". M4J_LANG_TEMPLATES ;
				$templateInfo ="<ul>";
				foreach($fids as $item){
					$templateInfo .= "<li>".htmlspecialchars(MReady::_($fid[$item]))."</li>";
				}
				$templateInfo .="</ul>";
			}else{
				$template = "0 ".M4J_LANG_TEMPLATE;
				$templateInfo = M4J_LANG_ADD_TEMPLATE;
			}
			
			
			$template .= $helpers->info_button($templateInfo);
			
			
			($row->category)?$cat = MReady::_($row->category):$cat=M4J_LANG_NO_CATEGORYS;
			$widthArray = array('16px','','100px','120px', '130px','24px', '45px','44px','16px','16px','16px','16px','16px');
			
			$position = "";
			if($cid!=-2) $position = $helpers->up_down_button(M4J_JOBS.M4J_NEW_JOB_CID_QUERY,$row->jid,$row->sort_order);
			
					$rowArray = array (
										$helpers->active_button(M4J_JOBS.M4J_NEW_JOB_CID_QUERY,$row->jid,$row->active),
										$helpers->edit_by_name(MReady::_($row->title),M4J_JOBS_NEW.M4J_NEW_JOB_CID_QUERY,$row->jid,M4J_LANG_EDIT),
										$row->email ,
										_chopString($cat,20),
										$template,
										$row->jid,
										$position,
										'<a href="'.M4J_APPS.M4J_HIDE_BAR.M4J_REMEMBER_CID_QUERY.'&amp;id='.$row->jid.'" class="m4jApps"></a>',
										$helpers->storage_button(M4J_DATASTORAGE,$row->jid,M4J_LANG_READ_STORAGES),
										$helpers->copy_button(M4J_JOBS.M4J_NEW_JOB_CID_QUERY,$row->jid),
										$helpers->delete_button(M4J_JOBS.M4J_NEW_JOB_CID_QUERY,$row->jid),
										$helpers->edit_button(M4J_JOBS_NEW.M4J_NEW_JOB_CID_QUERY,$row->jid,M4J_LANG_EDIT),
										(_M4J_IS_J16) ? "" : $helpers->link_button(M4J_LINK,$row->jid,$row->title,$row->linkcid)
									  );			 
			
				$helpers->table_row($rowArray,$even,$widthArray);
				$even = !$even; 
		} //EOF foreach
		//EOF DB Query	
		

	  $helpers->close_table();	
	  if($cid==-2) $helpers->advice(M4J_LANG_ASSIGN_ORDER_HINT);
	  if(M4J_SHOW_LEGEND) HTML_m4j::legend('jobs');	
	 
 
  HTML_m4j::footer();
   

?>
