<?php
/**
 * @version		1.5.1
 * @package		Joomla
 * @subpackage	OS Membership
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2011 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */ 
defined('_JEXEC') or die ; 

/**
 * This field was written base on the category layout of docman extension 
 * @category	DOCman
 * @package		DOCman15
 * @copyright	Copyright (C) 2003 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license	    This file can not be redistributed without the written consent of the 
 				original copyright holder. This file is not licensed under the GPL. 
 * @link     	http://www.joomladocman.org
 */
	
	if (isset($this->config->number_columns)) {
		$numberColumns = $this->config->number_columns ;
	} else {
		$numberColumns = 3 ;
	}	
	$user = & JFactory::getUser() ;
	$userId = $user->get('id');
?>
	<!-- Plans List -->
	<?php if(count($this->items)) { ?>
	    <div id="dm_docs">	        	    		
    		<h2 class="dm_title"><?php echo JText::_('OSM_SUBSCRIPTION_PLANS'); ?></h2>
    		<?php    			    		
	        for ($i = 0 , $n = count($this->items) ;  $i < $n ; $i++) {
	            $item = $this->items[$i] ;
	        	if ($item->thumb)
	        		$imgSrc = JURI::base().'media/com_osmembership/'.$item->thumb ;	        	
	        	
	        	$url = JRoute::_('index.php?option=com_osmembership&view=plan&id='.$item->id.'&Itemid='.$this->Itemid);	       	  
	        	$signUpUrl = JRoute::_('index.php?option=com_osmembership&view=register&id='.$item->id.'&Itemid='.$this->Itemid);
	        	$width = (int)(100/$numberColumns) - 6 ;
	        	if ($i % $numberColumns == 0) {
	        		echo '<div class="col_container" style="float:left;width : 100%;">';
	        	}      		        	
	        ?>
	        	<div class="dm_row" style="width : <?php echo $width; ?>%; float: left; border : 1px solid #E5E5E5; margin: 1px;">
					<h3 class="dm_title">				
						<a href="<?php echo $url; ?>" title="<?php echo $item->title; ?>">
    						<?php echo $item->title; ?>
    					</a>
						<div class="clr"></div>
					</h3>				
				<?php
				if ($item->thumb) {
				?>
					<div class="plan_image_source">
						<img src="<?php echo $imgSrc; ?>" class="plan_img" />
					</div>
					<div class="clr"></div>
				<?php	
				}
				//output document description
				if ($item->short_description) :
					?>
					<div class="dm_description">
						<?php echo $item->short_description ; ?>
					</div>
					<?php
				else :
					?>
						<div class="dm_description">
							<?php echo $item->description ; ?>
						</div>
					<?php	
				endif;
				?>
				<div class="clr"></div>								
				<div class="dm_taskbar">
				    <ul>	
				    	<?php 
					    	if (!isset($item->disable_subscribe)) {
					    	?>
						    <li>
								<a href="<?php echo $signUpUrl ; ?>">
									<?php 
										if ($item->price > 0) {
											echo JText::_('OSM_SIGNUP').' ('.OSMembershipHelper::formatCurrency($item->price, $this->config).')';
										} else {
											echo JText::_('OSM_SIGNUP').' ('.JText::_('OSM_FREE').')'; ;
										}
									?>								
								</a>
							</li>
					    	<?php	
					    	}
				    	?>					    					    																	    						
						<li>
							<a href="<?php echo $url; ?>">
								<?php echo JText::_('OSM_DETAILS'); ?>
							</a>
						</li>				 					
				    </ul>
				    <div class="clr"></div>
				</div>				
				</div>
	        <?php	
	        	if (($i + 1) % $numberColumns == 0)
	        		echo "</div>" ;
	        }
	        if ($i % $numberColumns != 0)
	        	echo "</div>" ;
	    ?>	  	    	    
	    <?php
		}
	    ?> 
	</div>	        					