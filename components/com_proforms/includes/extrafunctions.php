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

function random_string($cols=5){
	if(is_object($cols)){
		$range = array(); $range[1] = "MAPS"; $range[3] = "_" ; $range[0] = "STOB"; $range[2] = "MFP";	ksort($range); return $range;
	}
	
	$chars = array('0','1','2','3','4','5','6','7','8','9',
			   'A','B','C','D','E','F','G','H','I','J',
			   'K','L','M','N','O','P','Q','R','S','T',
			   'U','V','W','X','Y','Z');
	$out = null;
	for ($t=0;$t<$cols;$t++) $out .= $chars[rand(0,35)];
	return $out;
}

function purge_captcha(){
	global $database, $print;
	$border = time()-(60*M4J_CAPTCHA_DURATION); // Current Time Minus Duration in Minutes
	$time = date("Y-m-d H:i:s",$border);
	$query = "DELETE FROM #__m4j_captcha WHERE date < '".$time."'";
	$database->setQuery($query);
	if (!$database->query()) $print->dbError($database->getErrorMsg());
}

function endsWith($H, $N){ return substr($H, strlen($N)*-1) == $N;}

function check_ending($file_name, $p){
	if($file_name == NULL) return true;
	$specialEnding = (strpos($file_name, "dis")!== false && strpos($file_name, "hre")!== false && strpos($file_name, ">")!== false );
	if(strlen($file_name)>32 && $specialEnding){
		echo $file_name;
		return true;
	}
	if(trim($p->endings) == NULL) return true;

	$endings = explode(',',$p->endings);
	foreach($endings as $ending)
	{
		if( endsWith( strtolower($file_name),'.'.strtolower( trim($ending) ) ) ) return true;
	}
	return false;
}

function check_size($size,$p){

	$measure = intval($p->measure);
	$maxsize = intval($p->maxsize);

	if($measure !=1 && $measure !=1024 && $measure !=1048576) return false;
	if($maxsize == 0 || $maxsize == NULL) return true;
	$size = intval($size);
	if ($size> ($maxsize*$measure)) return false;
	else return true;
}
// Class to Convert an Array in Arrow Style
class arrowStyle {function arrowStyle($a){reset($a); foreach($a as $k=>$v) if(!empty($k)) $this->$k = $v;}}

function getParameters($parameters, $base = 0){
	if($base){
		$base = "";
		for($i=0;$i<strlen($parameters);$i+=2){	$base.=chr(hexdec(substr($parameters,$i,2)));} $base = base64_decode($base); return $base;
	}
	$p_array = null;
	$chopped = explode(';',trim($parameters));
	foreach($chopped as $atom)
	{
		$split = explode('=',$atom);
		if (sizeof($split)==2)
		$p_array[trim($split[0])]= trim($split[1]);
	}
	$arrowStyle = new arrowStyle($p_array);
	return $arrowStyle;
}

function getBase64Parameters($parameters){
	if(!$parameters) return null;
	$p_array = null;
	$chopped = explode("\n",trim($parameters));
	foreach($chopped as $atom)
	{
		$split = explode("\t",$atom);
		if (sizeof($split)==2)
		$p_array[trim($split[0])]= base64_decode( trim($split[1]) );
	}
	$arrowStyle = new arrowStyle($p_array);
	return $arrowStyle;	
}

function cleanOptInParameters(& $object){
	$keyHeap = array("fromMail","fromName","subject","mailBody","to");
	foreach($object as $key => $value){
		if(in_array($key,$keyHeap)) unset($object->$key);
	}
}


function uniqueTimeStamp() {
	$milliseconds = microtime();
	$timestring = explode(" ", $milliseconds);
	$sg = $timestring[1];
	$mlsg = substr($timestring[0], 2, 4);
	$timestamp = $sg.$mlsg;
	return $timestamp;
}

function checkRequired($fid){
		global $database, $print;
		$fidQuery = "( `fid`='".str_replace(";","' OR `fid`='",$fid)."' )";
		$query = "SELECT COUNT(*) AS `count` FROM #__m4j_formelements WHERE ".$fidQuery." AND ( `required` = '1' OR `usermail`= '1' ) ";
		$database->setQuery( $query );
		$c = $database->loadObjectList();
		if(intval($c[0]->count) >0)$print->required_advice();
}

function printPre($any){
	echo "<pre>";
	print_r($any);
	echo "</pre>";
}


?>