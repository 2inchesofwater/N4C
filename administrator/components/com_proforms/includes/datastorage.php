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
if($id==-1) m4jRedirect(M4J_FORMS);

require_once(M4J_INCLUDE_VALIDATE);
require_once(M4J_INCLUDE_FUNCTIONS);

define('M4J_IS_SEARCH', "");
define('M4J_SHOW_ALIAS', 1);

HTML_m4j::head(M4J_DATASTORAGE,"");
$helpers->caption(M4J_LANG_ONLYPRO_DESC,null,M4J_LANG_FORMS.' > '.M4J_LANG_STORAGES);

HTML_m4j::dataStorageSearch($id,array(),0,0,0);

echo '<center><span style="font-size: 48px; color:red;">'.M4J_LANG_ONLYPRO.'</span></center>';


HTML_m4j::footer();


?>