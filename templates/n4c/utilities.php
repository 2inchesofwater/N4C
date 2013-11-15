<?php

function getGeoLayers($db){
	global $geolayertable;
	$query = "SELECT * FROM $geolayertable;";
	$db->setQuery($query);
	return $db->loadObjectList('name'); //it gives me a list of object, indexed by name
}
function getCategoryId($db, $title){
	global $categorytable;
	$query = "SELECT * FROM $categorytable WHERE title='$title';";
	$db->setQuery($query);
	return $db->loadObject()->id;
}
function completeGeoItem($db, $item){
	global $layerprojectsid, $layereventsid, $layernewsid, $projectsid, $newsid, $articletable;
	
	list($item->longitude, $item->latitude) = explode(" ", str_replace(array("POINT(",")"), "",$item->geodata));
		
	if($item->contentid){ //it's binded with an article!
		$query ="SELECT * FROM $articletable WHERE id='{$item->contentid}' LIMIT 1;";
		$db->setQuery($query);
		$article = $db->loadObject();
		
		switch($item->layerid){
			case $layerprojectsid:
				$item->url = JURI::root(true)."/index.php?option=com_content&view=article&id={$item->contentid}:{$article->alias}&catid=$projectsid&Itemid=129";
				break;
			case $layernewsid:
				$item->url = JURI::root(true)."/index.php?option=com_content&view=article&id={$item->contentid}:{$article->alias}&catid=$newsid&Itemid=130";
				break;
			/*case $layereventsid://shouldn't ever get here, anyway!
				$item->url = JURI::root(true)."/index.php?option=com_eventbooking&task=view_event&event_id={$item->contentid}&Itemid=128";
				break;	*/		
		}
		if(!$item->content)
			$item->content = "<h2>{$article->title}</h2>".$article->introtext;
		
	}/*else{
		//it already has url and content
	}*/
	$item->content .= "<a href='{$item->url}'>Read more...</a>"; //by default!!
	foreach(array("id", "created_by", "contentid", "geodata", "minlat", "minlon", "maxlat", "maxlon", "language", "checked_out", "checked_out_time") as $f)
		unset($item->$f);
	return $item;
}
function getGeoItems($db){
	$items = $db->loadObjectList();
	foreach($items as $k=>$item)
		$items[$k] = completeGeoItem($db,$item);
	return $items;
}
function getGeoItemsByEventId($db, $eventid){
	global $layereventsid,$geoitemtable;
	$url = "http://".getenv("HTTP_HOST").JURI::root(true)."/index.php?option=com_eventbooking&task=view_event&event_id=$eventid&Itemid=128";
	$query = "SELECT * FROM $geoitemtable WHERE layerid = $layereventsid AND url = '".addslashes($url)."';";
	$db->setQuery($query);
	return getGeoItems($db);
}
function getGeoItemsByLayer($db, $layerid, $itemid=null, $filterDate=false){
	global $geoitemtable;
	$query = "SELECT * FROM $geoitemtable WHERE layerid = $layerid";
	if($itemid)
		$query.=" AND (contentid is null OR contentid = 0 OR contentid = ".addslashes(reset(explode(":",$itemid))).")";
	if($filterDate)
		$query.=" AND DATE(date) >= NOW() ORDER BY date ASC";
	$query.=" LIMIT 26;";
	$db->setQuery($query);
	return getGeoItems($db);
}
function getAllGeoItems($db){
	global $geoitemtable, $layerprojectsid, $layereventsid, $layernewsid;
	$items = array();
	foreach(array($layerprojectsid, $layereventsid, $layernewsid) as $layer){
		$items[] = getGeoItemsByLayer($db, $layer, null, $layer==$layereventsid);
	}
	//$query = "SELECT * FROM $geoitemtable;";
	//$db->setQuery($query);
	//return getGeoItems($db);
	return $items;
}
?>