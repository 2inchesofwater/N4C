<?php
/**
 * @version		$Id: default_form.php 21504 2011-06-10 06:21:35Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	com_search
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();
?>

<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search');?>" method="post">

	<fieldset class="word">
		<div class="word_container">
            <input type="search" name="searchword-results" id="search-searchword" maxlength="<?php echo $upper_limit; ?>" placeholder="<?php echo $this->escape($this->origkeyword); ?>" class="input-search" />
            <button name="Search" onclick="this.form.submit()" class="button"><?php echo JText::_('COM_SEARCH_SEARCH');?></button>
            <input type="hidden" name="task" value="search" />
        </div>
        
        <div class="options_container">
        	<h4><?php echo JText::_('COM_SEARCH_FOR');?></h4>
			<div class="phrases-box">
			<?php echo $this->lists['searchphrase']; ?>
			</div>
			<div class="ordering-box">
			<label for="ordering" class="ordering">
				<?php echo JText::_('COM_SEARCH_ORDERING');?>
			</label>
			<?php echo $this->lists['ordering'];?>
			</div>

			<?php if ($this->params->get('search_areas', 0)) : ?>
                <h4><?php echo JText::_('COM_SEARCH_SEARCH_ONLY');?></h4>
                <div class="areas-box">
                <?php foreach ($this->searchareas['search'] as $val => $txt) :
                    $checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : '';
                ?>
                <input type="checkbox" name="areas[]" value="<?php echo $val;?>" id="area-<?php echo $val;?>" <?php echo $checked;?> />
                    <label for="area-<?php echo $val;?>">
                        <?php echo JText::_($txt); ?>
                    </label>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
			<?php if ($this->total > 0) : ?>
                <div class="form-limit">
                    <label for="limit">
                        <?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
                    </label>
                    <?php echo $this->pagination->getLimitBox(); ?>
                </div>
             <?php if ($this->pagination->getPagesCounter()) : ?>   
            	<p class="counter">
                    <?php echo $this->pagination->getPagesCounter(); ?>
                </p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
	</fieldset>

	<div class="searchintro<?php echo $this->params->get('pageclass_sfx'); ?>">
		<?php if (!empty($this->searchword)):?>
		<p><?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', $this->total);?></p>
		<?php endif;?>
	</div>



</form>