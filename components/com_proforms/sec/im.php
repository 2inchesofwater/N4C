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

header("Content-type: image/png");
include_once('../../../configuration.php');

$user =null;
$dead = null;
if (isset($HTTP_GET_VARS['id'])) $user = addslashes(strip_tags($HTTP_GET_VARS['id']));

	$config= new JConfig();
	$dbname=$config->db;
	$dbhost=$config->host;
	$dbuser=$config->user;
	$dbpass=$config->password;
	$m4jConfig_dbprefix = $config->dbprefix;

mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);


$query = "SELECT captcha, dead FROM ".$m4jConfig_dbprefix."m4j_captcha WHERE user = '".$user."'";
$result = mysql_query($query);

$captcha = null;
while ($line = mysql_fetch_array($result))
	{
	$captcha = $line['captcha']."<br/>";
	if($line['dead'] >1) die();
	}

if($captcha==null) die();

$im = imagecreate(160,32);
$abc    = imagecreatefrompng("abc.png");

for($t=0; $t<5;$t++)
	{
	$ascii = ord(substr($captcha,$t,1));
	if(!(($ascii>=48 && $ascii<58) || ($ascii>65 && $ascii<91))) die();
	if($ascii>=48 && $ascii<58) $ascii = $ascii+7;
	$ascii = $ascii-55;
	$slide = rand(-2,2);
	imagecopy($im,$abc,($t*32),0,($ascii*32)+$slide,0,32,32);
	}

 imagepng($im);
 imagedestroy($im);

 $query = "SELECT dead  FROM ".$m4jConfig_dbprefix."m4j_captcha WHERE user = '".$user."'";
 $result = mysql_query($query);
 $line = mysql_fetch_array($result);
 $dead = $line['dead']+1;

 $query = "UPDATE ".$m4jConfig_dbprefix."m4j_captcha SET dead = '".$dead."' WHERE user = '".$user."'";
 $result = mysql_query($query);
 exit();
?>