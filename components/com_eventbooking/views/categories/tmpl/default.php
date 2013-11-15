<?php
/**
 * @version		1.4.4
 * @package		Joomla
 * @subpackage	Event Booking
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2010 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */
// no direct access
defined( '_JEXEC' ) or die ;

/** This field was written base on the categories layout of docman extension 
 * @copyright	Copyright (C) 2003 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license	    This file can not be redistributed without the written consent of the 
 				original copyright holder. This file is not licensed under the GPL. 
 * @link     	http://www.joomladocman.org
 */
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">	
	<?php
		if ($this->categoryId) {
		?>
			<div class="eb_cat">								
				<?php					       		    		      
					if($this->category->name != '') :
				        ?><h1 class="eb_title"><?php echo $this->category->name;?></h1><?php
				    endif;		
					if($this->category->description != '') :
						?><div class="eb_description"><?php echo $this->category->description;?></div><?php
					endif;
				?>
				<div class="clr"></div>
			</div>
		<?php	
		}
		if (count($this->items)) {
			if ($this->categoryId)
				$text = JText::_('EB_SUB_CATEGORIES');
			else
				$text = JText::_('EB_CATEGORIES') ;				
		?>
			<div id="eb_cats">
			    <h2 class="eb_title"><?php echo $text ;?></h2>
			    <div>
			    <?php			     	
			    	for ($i = 0 , $n = count($this->items) ; $i < $n ; $i++) {
			    		$item = $this->items[$i] ;			    		
			    		if (!$this->config->show_empty_cat && !$item->total_events)
			    			continue ;
			    		if ($item->total_categories) {
			    			$link = JRoute::_('index.php?option=com_eventbooking&task=view_categories&category_id='.$item->id.'&Itemid='.$this->Itemid);
			    		} else {
			    			$link = JRoute::_('index.php?option=com_eventbooking&task=view_category&category_id='.$item->id.'&Itemid='.$this->Itemid);
			    		}			    					    		
			    	?>
			    		<div class="eb_row">																											
							<h3 class="eb_title">
								<a href="<?php echo $link; ?>">									 
										<?php 
											echo $item->name; 																					
											if ($this->config->show_number_events) {
											?>
												<small>( <?php echo $item->total_events ;?> <?php echo $item->total_events > 1 ? JText::_('EB_EVENTS') :  JText::_('EB_EVENT') ; ?> )</small>
											<?php	
											}
										?>																																										
								</a>
							</h3>
						    <?php
						    if($item->description) :
						        ?><div class="eb_description"><?php echo $item->description;?></div><?php
						    endif;
						    ?>
						    <div class="clr"></div>
						</div>
			    	<?php		
			    	}
			    ?>
			    </div>
		    </div>
		    
		    <?php
		    	 if ($this->pagination->total > $this->pagination->limit) {
		    	 ?>
		    	 	<div align="center" class="eb_pagination">
		    	 		<?php echo $this->pagination->getListFooter(); ?>
		    	 	</div>
		    	 <?php	
		    	 }
		    ?>
		    
		<?php	
		}
	?>
	<input type="hidden" name="category_id" value="<?php echo $this->category_id; ?>" />
	<input type="hidden" name="view" value="categories" />	
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ; ?>" />
	<input type="hidden" name="option" value="com_eventbooking" />
</form>