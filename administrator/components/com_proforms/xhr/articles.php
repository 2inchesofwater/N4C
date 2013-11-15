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

    $field = JRequest::getString("field");
 	$rootURL = (JRequest::getInt("is_root")) ? JURI::root() : "";
    
    
	$db = & JFactory::getDBO();
	$query = $db->setQuery(
		"SELECT `c`.`id` AS `aid`, `c`.`title` AS `articlename`, `cat`.`title` AS `catname` ".
		"FROM `#__content` AS `c` LEFT JOIN `#__categories` AS `cat` ON `c`.`catid` = `cat`.`id`".
		"ORDER BY `c`.`id` "
	);
	$articles = $db->loadObjectList();
?>
<html>
<head>
 <link rel="stylesheet" href="components/com_proforms/admin.stylesheet.css" type="text/css" />

</head>
<body>
<div class="articlesWrap">
<h2><?php echo M4J_LANG_ARTICLES; ?></h2>


<?php 
	foreach( $articles as $article){
?>
<a class="article" onclick="javascript: return parent.setArticle('<?php echo $field; ?>', '<?php echo $rootURL; ?>index.php?option=com_content&view=article&id=<?php echo $article->aid ;?>');">
<?php echo $article->articlename;?> <span><?php if($article->catname) echo "[ ". $article->catname . " ]"; ?></span>
</a>

<?php }?>

</div>
</body>
</html>