<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_news
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$images = json_decode($item->images);
$item_heading = $params->get('item_heading', 'h4');
?>

<li class="relatedList">
<div class="elementProjects">
	<?php if (htmlspecialchars($images->image_intro)){ ?>
       <?php if ($params->get('link_titles') && $item->link != '') : ?>
            <a href="<?php echo $item->link;?>" class="intro_image"><?php endif; ?> 
                 <img src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo $item->title;?>"/>
       <?php if ($params->get('link_titles') && $item->link != '') : ?>
            </a><?php endif; ?> 
    <?php } ?>
</div>

<div class="toggleProjects">
    <div class="pin">
        <img src="./images/pins/pin-yellow.png"/>
    </div>
    
    <div class="intro">
    <?php if ($params->get('item_title')) : ?>
        <<?php echo $item_heading; ?> class="newsflash-title<?php echo $params->get('moduleclass_sfx'); ?>">
        <?php if ($params->get('link_titles') && $item->link != '') : ?>
            <a href="<?php echo $item->link;?>">
                <?php echo $item->title;?></a>
        <?php else : ?>
            <?php echo $item->title; ?>
        <?php endif; ?>
        </<?php echo $item_heading; ?>>
    <?php endif; ?>
    </div>
    
    <div class="expand">
        <p class="icon">»</p>
    </div>
</div>

<div class="elementProjects">
	<?php echo $item->beforeDisplayContent; ?>
    
    <div class="details">
    <?php echo $item->introtext; ?>
    </div>
    
    <?php if (!$params->get('intro_only')) : echo $item->afterDisplayTitle; endif; ?>
    
    <?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) :
        echo "<div class='readmore'>";
        echo '<a class="button" href="'.$item->link.'">'.$item->linkText.'</a>';
        echo "</div>";
    endif; ?>
</div>
</li>