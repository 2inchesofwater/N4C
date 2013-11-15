<?php /**  * @package		Joomla.Site  * @subpackage	mod_articles_news  * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.  * @license		GNU General Public License version 2 or later; see LICENSE.txt  */  

// no direct access 

defined('_JEXEC') or die; ?> 

<!-- <div class="newsflash<?php echo $moduleclass_sfx; ?>"> --> 

<section class="blockContainer component_group" id="<?php echo $module->title; ?>"> 	

	<article> 
<a href="#" title="See all <?php echo $module->title; ?>"><h2><?php echo $module->title; ?></h2></a>
	<ul class="">

	<?php foreach ($list as $item) :?> 	

		<?php 	 require JModuleHelper::getLayoutPath('mod_articles_news', '_item');?> 

	<?php endforeach; ?> 

	</ul>

	</article> 
<?php echo '<a class="component_followOn" href="#">See all News</a>'; ?>

</section> <!-- </div> --> 
