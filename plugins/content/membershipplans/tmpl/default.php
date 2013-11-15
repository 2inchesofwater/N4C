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
		
$user = & JFactory::getUser() ;	
$userId = $user->get('id');	
if(count($this->items)) { ?>
	    <div id="dm_docs">    	
    		<h2 class="dm_title"><?php echo JText::_('OSM_SUBSCRIPTION_PLANS'); ?></h2>
    		<?php	    			   
        for ($i = 0 , $n = count($this->items) ;  $i < $n ; $i++) {
        	$item = $this->items[$i] ;
        	if ($item->thumb)
        		$imgSrc = JURI::base().'media/com_osmembership/'.$item->thumb ;	        		        	        	
        		$url = JRoute::_('index.php?option=com_osmembership&view=plan&id='.$item->id.'&Itemid='.$this->Itemid);	        	
        		$signUpUrl = JRoute::_('index.php?option=com_osmembership&view=register&id='.$item->id.'&Itemid='.$this->Itemid);  	  	        		        		        	    		   
        ?>
        	<div class="dm_row">
				<h3 class="dm_title">		
					<?php
						if ($item->thumb) {
						?>
							<img src="<?php echo $imgSrc; ?>" alt="<?php echo $item->title; ?>" />
						<?php	
						}
					?>																								
					<a href="<?php echo $url; ?>" title="<?php echo $item->title; ?>">
					    <?php echo $item->title; ?>											
					</a>																				
				</h3>					
				<dl class="dm_props">
					<div class="dm_prop">
						<dt>
							<?php echo JText::_('OSM_DURATION'); ?>:
						</dt>
						<dd>
							<?php echo $item->subscription_length.' '.JText::_('OSM_DAYS') ; ?>
						</dd>
					</div>
					<div class="dm_prop">
						<dt>
							<?php echo JText::_('OSM_PRICE'); ?>:
						</dt>
						<dd>
							<?php 
								if ($item->price > 0) {
									echo OSMembershipHelper::formatCurrency($item->price, $this->config);
								} else {
									echo JText::_('OSM_FREE');	
								}	
							?>																									
						</dd>
					</div>
				</dl>							
			<?php
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
					    		<a href="<?php echo $signUpUrl; ?>">
									<?php echo JText::_('OSM_SIGNUP'); ?>
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
        }	        	    	  
    ?>	    
    </div>
  <?php
	}
  ?> 	        			
<input type="hidden" name="Itemid" value="<?php echo $this->Itemid ; ?>" />			
<input type="hidden" name="task" value="" />
<input type="hidden" name="option" value="com_osmembership" />		
<?php echo JHtml::_('form.token'); ?>				