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


// no direct access
defined('_JEXEC') or die('Restricted access');

/*
 * Function to convert a system URL to a SEF URL
 */
function proformsBuildRoute(&$query) {

	
	$segments = array();

	if(isset($query["view"])){
		unset($query["view"]);
	}
	
	if(isset($query['app'])){	
		foreach ($query as $key =>$value){
			if($key != "option" && $key != "Itemid"){
				$segments[] = $key . "-". $value;
				unset($query[$key]);
			}
		}
		return $segments;
	}
	
    $db =& JFactory::getDBO();
    
	$cid = null;
	$jid = null;
    
	
    if(isset($query['cid']) ) {
    	$cid = (int) $query['cid'];
    	unset($query['cid']);
    }
 	if(isset($query['jid']) ) {
    	$jid = (int) $query['jid'];
    	unset($query['jid']);
    }else $jid = 0;
    
    if($jid && !$cid){
    	$sql = "SELECT `cid` FROM #__m4j_jobs WHERE `jid`='".$jid."' LIMIT 1";
		$db->setQuery($sql);	
	    $job = $db->loadObject();
	    if($job){
	    	$cid = (int) $job->cid;
	    }
    }
    
    if($cid==-1 && $jid ==0){
    	$segments[]= "proforms";
    }else {
    	$sql = "SELECT `url` FROM #__m4j_sef WHERE `cid`='".$cid."' AND `jid` = '".$jid."'";
		$db->setQuery($sql);	
	    $sef = $db->loadObject();
	    if($sef){
		    $split = explode("/",$sef->url);
	    	foreach($split as $seg){
	    		$segments[] = $seg;
	    	}	
	    }
	    
    }
    
    
    return $segments;
    
//	return $segments;
}
/*
 * Function to convert a SEF URL back to a system URL
 */
function proformsParseRoute($segments) {
	$vars = array();
	
	$as = implode("", $segments);
	if(strpos($as,"app:") !== false && strpos($as,"jid:") !== false){
		foreach($segments as $segment){
			$split = explode(":", $segment);
			$vars[strtolower(trim($split[0]))] = $split[1];
		}
		return $vars;
	}
	
	
 	$db =& JFactory::getDBO();

	$newSegments = array();
 	foreach($segments as $segment){
 		$newSegments[] = str_replace(":","-",$segment);
 	}
 	$count = count($newSegments);
 	if($count==1 && $newSegments[0]== "proforms"){
 		$vars['cid'] = -1;
 	}else{
 		$url ="";
 		if($count>1) $url = implode("/",$newSegments);
 		else if ($count==1) $url = $newSegments[0];
 		
 		
	 	$sql = "SELECT * FROM #__m4j_sef WHERE `url`='".$db->getEscaped($url)."'";
		$db->setQuery($sql);	
	    $sef = $db->loadObject();
	 	
	    if($sef){
	    	if($sef->jid == 0){
	    		
	    	}else {
	    		$vars['jid'] = (int)$sef->jid;
	    	}
	    	
	    	if($sef->cid) $vars['cid'] = (int) $sef->cid;
	    }	
 	}
	return $vars;
}
?>