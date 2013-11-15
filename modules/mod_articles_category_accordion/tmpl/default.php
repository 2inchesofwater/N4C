<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_category
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$accordionid=rand();
$document=& JFactory::getDocument();

for($i=0;$i<count($list);$i++) {
	$mootools.="new Fx.Accordion($('accordion".$accordionid."_$i'), '#accordion".$accordionid."_$i h3', '#accordion".$accordionid."_$i .content',{onActive: function(toggler) { toggler.addClass('active-accordion'); },
onBackground: function(toggler) { toggler.removeClass('active-accordion'); }});"."\n";
}
$document->addScriptDeclaration("
window.addEvent('domready', function(){
  $mootools
});
");
?>

<?php if ($grouped) : ?>
	<div id="accordion">
	<?php foreach ($list as $group_name => $group) : ?>
	
		<h1><?php echo $group_name; ?></h1>
			<?php foreach ($group as $item) : ?>
			<?php endforeach; ?>
            
	<?php endforeach; ?>
    </div>
<?php else : ?>
	
	<?php 
	$n=0;
	foreach ($list as $row) : 
	
		echo "<div id=\"accordion".$accordionid."_$n\" class=\"accordion ". current($row)->category_alias ."\">" ;
		$n++;
		$i=0;

		foreach($row as $item) {
			if($i==0) {$cat_id=$item->catid;echo "<h2><a href=\"".JRoute::_(ContentHelperRoute::getCategoryRoute($cat_id))."\">$item->category_title</a></h2>";}
				$i++;
				$images = json_decode($item->images);
			?>
				<div class="accordionItemWrapper"><h3 <?php if ($i==1){echo "class=\"first-child\"";}?> ><img src="images/pins/pin-<?php echo $item->category_title; ?>.png" /><?php echo $item->title; ?></h3>
				<div class="content">
					<p>
					<?php echo $item->displayIntrotext; ?>
					</p>
					<a href="<?php echo $item->link;?>" class="readmore">Read more</a>
					<?php if($images->image_intro) : ?>
					<div class="thumbnail">
                    <img class="image_intro" title="<?php echo htmlspecialchars($images->image_intro_caption); ?>" src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>" />
                    </div>
			<?php endif; ?>  
		</div></div>
        
		<?php } ?>
        <a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($cat_id)); ?>" class="seeall">See all <?php echo $item->category_title; ?></a>
        </div>
	<?php endforeach; ?>

<?php endif; ?>

