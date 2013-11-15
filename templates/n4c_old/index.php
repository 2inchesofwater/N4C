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


//custom javascript inclusions
$doc->addScript( 'https://maps.googleapis.com/maps/api/js?sensor=false' );
$doc->addScript( JURI::root(true).'/media/system/js/init_map.js' );
?>

<!doctype html>
<!--[if lt IE 9]><html class="ie"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->

<!--
	The comment jumble above is handy for targeting old IE with CSS.
	http://paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/
--><head>
<?php $this->setTitle( $app->getCfg( 'sitename' ) ); ?>
<jdoc:include type="head" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/theme_<?php echo ($templateparams->get('theme'))?>.css" type="text/css" /> -->
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/n4c.css" type="text/css" />
<?php
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
</head>

<body class="<?php echo $color; ?> <jdoc:include type="modules" name="modifier" />


">
<ul class="skiplinks">
  <li><a href="#main" class="accessibility"><?php echo JText::_('TPL_N4C_SKIP_TO_CONTENT'); ?></a></li>
  <li><a href="#nav" class="accessibility"><?php echo JText::_('TPL_N4C_JUMP_TO_NAV'); ?></a></li>
</ul>

	<?php if ($this->countModules('menu')): ?>    
		<nav id="nav">
            <jdoc:include type="modules" name="menu"/>
	    </nav>
    <?php endif; ?>

<section id="masthead" class="blockContainer">
	<header>
      <a href="<?php echo $this->baseurl ?>" title="<?php echo $app->getCfg( 'sitename' ) ?> home" class="logo">
      <h1>
	  <?php if ($logo != null ): ?>
      <img id="logo" src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($logo); ?>" alt="<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>" />
      <?php else: ?>
      <?php echo htmlspecialchars($templateparams->get('sitetitle'));?>
      <?php endif; ?>
      </h1></a>
    <p class="siteDescription"> <?php echo htmlspecialchars($templateparams->get('sitedescription'));?> </p>
     <?php if ($this->countModules('masthead')): ?><jdoc:include type="modules" name="masthead"/><?php endif; ?>
    </header>

	<?php if ($this->countModules('login')): ?>    
        <aside id="login">
            <jdoc:include type="modules" name="login"/>
        </aside>
    <?php endif; ?>
</section>

<?php if ($this->countModules('map')): ?>    
<section id="map" class="blockContainer">
 <jdoc:include type="modules" name="map"/>
</section>
<?php endif; ?>

<?php if ($this->countModules('container')): ?>
<jdoc:include type="modules" name="container"/>
<?php endif; ?>

<jdoc:include type="message" />
<jdoc:include type="component" />

<?php if ($this->countModules('related')): ?>
<section id="related" class="blockContainer">
<jdoc:include type="modules" name="related"/>
</section>
<?php endif; ?>

<?php if ($this->countModules('comments')): ?>
<section id="comments">
<jdoc:include type="modules" name="comments"/>
</section>
<?php endif; ?>



<?php if ($this->countModules('artwork')): ?>
<section id="artwork">
<jdoc:include type="modules" name="artwork"/>
</section>
<?php endif; ?>

<?php if ($this->countModules('promo')): ?>
<section id="promo">
<jdoc:include type="modules" name="promo"/>
</section>
<?php endif; ?>

<?php if ($this->countModules('interaction')): ?>
<section id="interaction">
<jdoc:include type="modules" name="interaction"/>
</section>
<?php endif; ?>


<?php if ($this->countModules('footer')): ?>
<footer id="footer" class="blockContainer">
<jdoc:include type="modules" name="footer"/>
</footer>
<?php endif; ?>

<?php if ($this->countModules('sponsors')): ?>
<section id="sponsors">
<jdoc:include type="modules" name="sponsors"/>
</section>
<?php endif; ?>

<jdoc:include type="modules" name="script"   />
<jdoc:include type="modules" name="debug"   />
<jdoc:include type="modules" name="system"   />
</body></html>




