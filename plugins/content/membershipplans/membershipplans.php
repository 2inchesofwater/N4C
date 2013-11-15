<?php
/**
 * @version		1.1.1
 * @package		Joomla
 * @subpackage	Helpdesk Pro
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2012 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die ;
/**
 * Heldesk Pro content Plugin
 *
 * @package		Joomla
 * @subpackage	Content
 * @since 		2.5
 */
class plgContentMembershipPlans extends JPlugin {
	function onContentPrepare($context, &$article, &$params, $limitstart) {	
		if (file_exists(JPATH_ROOT.'/components/com_osmembership/osmembership.php')) {			
			$app = & JFactory::getApplication() ;
			if ($app->getName() != 'site') {
				return ;
			}
			if ( strpos( $article->text, 'membershipplans' ) === false ) {
				return true;								
			}
			$regex = '#{membershipplans ids="(.*?)"}#s';				
			$article->text = preg_replace_callback( $regex, array(&$this, 'displayPlans'), $article->text );
		}
								
		return true;
	}
	/**
	 * Replace callback function
	 * 
	 * @param array $matches
	 */
	function displayPlans($matches) {	
		error_reporting(0);	
		require_once JPATH_ROOT.'/components/com_osmembership/helper/helper.php';
		$document = JFactory::getDocument() ;
		$user = JFactory::getUser() ;
		$db = & JFactory::getDBO();				
		OSMembershipHelper::loadLanguage() ;
		$styleUrl = JURI::base(true).'/components/com_osmembership/assets/css/style.css';
		$document->addStylesheet( $styleUrl, 'text/css', null, null );
		$config = OSMembershipHelper::getConfig() ;
		$Itemid = JRequest::getInt('Itemid') ;
		$planIds = $matches[1] ;
		//Initialize the view object
		$viewConfig = array() ;
		$viewConfig['name'] = 'form' ;
		$viewConfig['base_path'] = JPATH_ROOT.'/plugins/content/membershipplans' ;
		$viewConfig['template_path'] = JPATH_ROOT.'/plugins/content/membershipplans/tmpl' ;
		$viewConfig['layout'] = $this->params->get('layout_type', 'default') ;
		require_once JPATH_ROOT.'/administrator/components/com_osmembership/legacy/view.php';
		$jView =  new LegacyView($viewConfig) ;
		
		if ($planIds == '*') {
			$sql = 'SELECT * FROM #__osmembership_plans WHERE published=1 ORDER BY ordering ';
		} elseif (strpos($planIds, 'cat-') !== false){
			$catId = (int) substr($planIds, 4) ;
			$sql = 'SELECT * FROM #__osmembership_plans WHERE category_id='.$catId.' AND published=1 ORDER BY ordering ';
		} else {
			$sql = 'SELECT * FROM #__osmembership_plans WHERE id IN ('.$planIds.') AND published=1 ORDER BY ordering';
		}
		$db->setQuery($sql);
		$rows = $db->loadObjectList() ;		
		if ($user->id) {
			for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
				$row = $rows[$i] ;
				if (!$row->enable_renewal) {
					$sql = 'SELECT COUNT(*) FROM #__osmembership_subscribers WHERE (email="'.$user->email.'" OR user_id='.$user->id.') AND plan_id='.$row->id.' AND published != 0 ' ;
					$db->setQuery($sql);
					$total = (int)$db->loadResult();
					if ($total) {
						$row->disable_subscribe = 1 ;
					}
				}
			}	
		}					
		$jView->items = $rows ;
		$jView->config = $config ;
		$jView->Itemid = $Itemid ;
																	
		ob_start();		
		$jView->display() ;	
		$text = ob_get_contents() ;
		ob_end_clean();
		return $text ;				
	}	
}