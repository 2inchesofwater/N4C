<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.N4C
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
unset($this->_scripts[JURI::root(true).'/media/system/js/caption.js']);
if (isset($this->_script['text/javascript'])){
    $this->_script['text/javascript'] = preg_replace('%window\.addEvent\(\'load\',\s*function\(\)\s*{\s*new\s*JCaption\(\'img.caption\'\);\s*}\);\s*%', '', $this->_script['text/javascript']);
    if (empty($this->_script['text/javascript']))
        unset($this->_script['text/javascript']);
}

// check modules
JHtml::_('behavior.framework', true);

// get params
$color			= $this->params->get('templatecolor');
$logo			= $this->params->get('logo');
$app			= JFactory::getApplication();
$doc			= JFactory::getDocument();
$templateparams	= $app->getTemplate(true)->params;

/* EDIT BY ALEX */
//$db = JFactory::getDBO();
//require_once "utilities.php";

/*  global variables  */
//global $geoitemtable, $geolayertable, $articletable, $categorytable;
//$geoitemtable = "n4c_geocontent_item";$geolayertable = "n4c_geocontent_layer";
//$articletable = "n4c_content";$categorytable = "n4c_categories";

//global $layerprojectsid, $layereventsid, $layernewsid, $projectsid, $newsid;
//$projectsid = getCategoryId($db, "Projects"); $newsid = getCategoryId($db, "News");
//$layers = getGeoLayers($db);
//$layerprojectsid = $layers['Projects']->id; $layereventsid = $layers['Events']->id; $layernewsid = $layers['News']->id;

/* request variables */
$cur_option = JRequest::getVar('option');
$id = JRequest::getVar('id');
$cat_id = JRequest::getVar('catid');
$view = JRequest::getVar('view');
$event_id = JRequest::getVar('event_id');

/* derived variables */
//$isProjects = $cur_option == "com_content" && (($id == $projectsid && !$cat_id) || $cat_id == $projectsid);
//$isNews = $cur_option == "com_content" && (($id == $newsid&& !$cat_id) || $cat_id == $newsid);
//$isEvents = $cur_option == "com_eventbooking";
//$isHome = !$isNews && !$isProjects && !$isEvents;

/* LOGIC */
/*$multilayer = false;
if($isHome){
	$multilayer = true; //the only one case!!
	$geoitems = getAllGeoItems($db);
}else if($isProjects){
	$selectedlayer = $layerprojectsid;
	if($view=="article")
		$geoitems = getGeoItemsByLayer($db, $layerprojectsid, $id);
	else
		$geoitems = getGeoItemsByLayer($db, $layerprojectsid, null);
}else if($isNews){
	$selectedlayer = $layernewsid;
	if($view=="article")
		$geoitems = getGeoItemsByLayer($db, $layernewsid, $id);
	else
		$geoitems = getGeoItemsByLayer($db, $layernewsid, null);
}else if($isEvents){
	$selectedlayer = $layereventsid;
	if($event_id)
		$geoitems = getGeoItemsByEventId($db, $event_id);
	else
		$geoitems = getGeoItemsByLayer($db, $layereventsid, true); //also filters by date!
} */

//custom javascript inclusions
$doc->addScript( 'https://maps.googleapis.com/maps/api/js?sensor=false' );
$doc->addScript( JURI::root(true).'/media/system/js/init_map.js' );
/* END EDIT BY ALEX (see second part below!) */
?>

<!DOCTYPE html><head>
<?php $this->setTitle( $app->getCfg( 'sitename' ) ); ?>
<jdoc:include type="head" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/theme_<?php echo ($templateparams->get('theme'))?>.css" type="text/css" /> -->
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/n4c.css" type="text/css" />
<?php	
	$app = JFactory::getApplication();
	$menu = $app->getMenu();


	$files = JHtml::_('stylesheet', 'templates/'.$this->template.'/css/general.css', null, false, true);
	if ($files):
		if (!is_array($files)):
			$files = array($files);
		endif;
		foreach($files as $file):
?>
<link rel="stylesheet" href="<?php echo $file;?>" type="text/css" />
<?php
	 	endforeach;
	endif;
?>
<jdoc:include type="modules" name="analytics"   />
<!-- EDIT BY ALEX -->
<style>
	/*#map .custom{display:none;} --- commented out by Dan */
	#map_canvas{width:100%;height:100%;}
	.home #map_canvas{height:90%;}
	.home #map .custom{display:block;height:10%;}
	#mapSelectorsContainer ul{/*overflow:hidden;*/height:30px;list-style:none;}
	#mapSelectorsContainer ul li{float:left;width:120px;text-align:center;position:relative;}
	#mapSelectorsContainer .icon{width:48px;height:48px;position:absolute;left:-15px;z-index:20;top:-10px;}
	#mapSelectorsContainer li.selected .icon{top:3px;}
	#eventsMapSelector .icon{background: url(../images/pins/pin-orange.png);}
	#projectsMapSelector .icon{background: url(../images/pins/pin-crimson.png);}
	#newsMapSelector .icon{background: url(../images/pins/pin-yellow.png);}
	.item_list li{overflow:hidden;}
	.pin img{display:none;}
	.pin img.visible{display:block;};
</style>
<?php //if(count($geoitems)):?>
<script type="text/javascript">
	/* <?if($selectedlayer):?>var selectedLayer = '<?=$selectedlayer?>';<?endif;?>
	var geoitems = <?=json_encode( $geoitems )?>;
	var multilayer = <?=$multilayer?"true":"false"?>;
	var EVENTSLAYER='<?=$layers['Events']->id?>'; var PROJECTSLAYER='<?=$layers['Projects']->id?>'; var NEWSLAYER='<?=$layers['News']->id?>';
	var root = '<?=JURI::root(true)."/"?>';
	var projectsIcon = '<?=json_decode($layers['Projects']->params)->icon?>';
	var eventsIcon = '<?=json_decode($layers['Events']->params)->icon?>';
	var newsIcon = '<?=json_decode($layers['News']->params)->icon?>'; */
</script>
<?php //endif;?>
<!-- END EDIT BY ALEX -->
</head>

<?php $menu = & JSite::getMenu();
if ($menu->getActive() == $menu->getDefault()) {
echo "<body class='home'>";
} else {
echo "<body class='sitewide'>";	
}?> 
<body>
    <ul id="skiplinks">
      <li><a href="#main" class="accessibility"><?php echo JText::_('TPL_N4C_SKIP_TO_CONTENT'); ?></a></li>
      <li><a href="#nav" class="accessibility"><?php echo JText::_('TPL_N4C_JUMP_TO_NAV'); ?></a></li>
    </ul>

    <div id="page-wrapper">
		<div id="container">    
              <nav id="nav">
                <header class="<?php if ($menu->getActive() == $menu->getDefault()) { echo 'home'; } ?>">
                <div id="logo">
                  <h1><a href="<?php echo $this->baseurl ?>" title="<?php echo $app->getCfg( 'sitename' ) ?> home">
                  <?php if ($logo != null ): ?>
                  <img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($logo); ?>" alt="<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>" />
                  <?php else: ?>
                  <?php echo htmlspecialchars($templateparams->get('sitetitle'));?>
                  <?php endif; ?>
                  </a></h1>
                  <p><?php echo htmlspecialchars($templateparams->get('sitedescription'));?></p>
                  <?php if (htmlspecialchars($templateparams->get('logoreadmore')) !=""): ?>
	                  <a href="<?php echo htmlspecialchars($templateparams->get('logoreadmore'));?>" class="readmore">Read more</a>
					<?php endif; ?>
                </div>
                <jdoc:include type="modules" name="nav" />
              </nav>
            </header>
            
            
            <div id="content-main" class="<?php if ($menu->getActive() == $menu->getDefault()) { echo 'home'; } ?>">
                <jdoc:include type="message" />
                <article id="main">
					<?php if ($this->countModules('breadcrumbs')): ?>
                      <section id="breadcrumbs"><jdoc:include type="modules" name="breadcrumbs" /></section>
                    <?php endif; ?>
                    <jdoc:include type="component" />
                </article>
            </div>
        
            <div id="content-aside">
				<?php if ($this->countModules('map')): ?>
                  <section id="map"><jdoc:include type="modules" name="map" /></section>
                <?php endif; ?>
                <?php if ($this->countModules('extra')): ?>
                  <section id="extra"><jdoc:include type="modules" name="extra" /></section>
                <?php endif; ?>
                <?php if ($this->countModules('promo')): ?>
                  <section id="promo"><jdoc:include type="modules" name="promo" /></section>
                <?php endif; ?>
            </div>
            
        	<div id="content-follow">
				<?php if ($this->countModules('related')): ?>    
                  <section id="related"><jdoc:include type="modules" name="related" /></section>
                <?php endif; ?>
                <?php if ($this->countModules('comments')): ?>    
                  <section id="comments"><jdoc:include type="modules" name="comments" /></section>
                <?php endif; ?>
                <?php if ($this->countModules('artwork')): ?>
                  <section id="artwork"><jdoc:include type="modules" name="artwork" /></section>
                <?php endif; ?>
            </div>
            
            <footer>
            <div id="footer-left">
				<?php if ($this->countModules('login')): ?>
                  <section id="login"><jdoc:include type="modules" name="login" /></section>
                <?php endif; ?>
                <?php if ($this->countModules('search')): ?>
                    <div id="search"><jdoc:include type="modules" name="search" /></div>
                    <div id="social"><jdoc:include type="modules" name="social" /></div>
                <?php endif; ?>
            </div>
            <div id="footer-right">    
                <?php if ($this->countModules('contact')): ?>
                    <div id="contact"><jdoc:include type="modules" name="contact" /></div>
                    <div id="message"><jdoc:include type="modules" name="message" /></div>
                <?php endif; ?>
            </div>
            </footer>
            
            <?php if ($this->countModules('sponsors')): ?>
              <section id="sponsors"><jdoc:include type="modules" name="sponsors" /></section>
            <?php endif; ?>
    	</div>
    </div>

<jdoc:include type="modules" name="script"   />
<jdoc:include type="modules" name="debug"   />
<jdoc:include type="modules" name="system"   />

</body>
</html>