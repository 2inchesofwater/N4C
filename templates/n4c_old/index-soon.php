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
?>

<!DOCTYPE html><head>
<title><?php echo $app->getCfg( 'sitename' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/n4c.css" type="text/css" />
<jdoc:include type="modules" name="analytics"   />
</head>

<body class="<?php echo $color; ?> <jdoc:include type="modules" name="modifier" />

">
<section id="wrapper">
    <header>
    <a id="badge" href="<?php echo $this->baseurl ?>" title="<?php echo $app->getCfg( 'sitename' ) ?> home"><h1>
      <?php if ($logo != null ): ?>
      <img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($logo); ?>" alt="<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>" />
      <?php else: ?>
      <?php echo htmlspecialchars($templateparams->get('sitetitle'));?>
      <?php endif; ?>
      </h1></a>
    
    </header>

	<article>
    	<p>A new website for the Norman Creek Catchment Coordinating Committee (N4C) is almost ready. </p>
        <p class="siteDescription"> <?php echo htmlspecialchars($templateparams->get('sitedescription'));?> </p>
    </article>

</section>
</body></html>