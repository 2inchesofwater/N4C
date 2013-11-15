<?php
/**
 * @version		$Id:$
 * @package		GEOCONTENT
 * @copyright	Copyright (C) 2009 ItOpen. All rights reserved.
 * @license		GNU/AGPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU Affero General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

require_once JPATH_BASE . DS . 'components' . DS . 'com_geocontent' . DS . 'helpers' . DS . 'geocontent.php';

define('GEOCONTENT_PARAM_DELIMITER' , '\|');

/**
 * Example Content Plugin
 *
 * @package		Joomla
 * @subpackage	Content
 * @since 		1.5
 */
class plgContentGeoContent extends JPlugin
{

	/**
	* Article has a geocontent tag
	*/
	var $has_geocontent_tag = false;

	/**
	* Map shown
	*/
	var $map_shown = false;

	/**
	 * Constructor
	 *
	 * @param object $subject The object to observe
	 * @param object $params  The object that holds the plugin parameters
	 * @since 1.5
	 */
	function plgContentGeoContent( &$subject, $params )
	{
        parent::__construct( $subject, $params );
        $this->loadLanguage();
    }

	/**
	 * Prepare content method
	 *
	 * Method is called by the view
	 *
	 * @param 	object		The article object.  Note $article->text is also available
	 * @param 	object		The article params
	 * @param 	int			The 'page' number
	 */
    public function onContentPrepare($context, &$article, &$params, $page = 0)
    {

        // simple performance check to determine whether bot should process further
        if (strpos($article->text, 'geocontent') === false && strpos($article->text, 'gcmapeditor') === false) {
            return true;
        }

        $option = JRequest::getVar('option');
        $app = JFactory::getApplication();

	    /*/ Act in front-end and com_content single article view only...
	    if($option != 'com_content'
           || ($context !== 'com_content.article' && $context !== 'text')
           || $app->isAdmin())
        {
            return true;
        }*/

        // No: only check for FE:
        if($app->isAdmin())
        {
            return true;
        }



    	// Allowed parameters for FE tag maps
        $fe_params = GeoContentHelper::$front_end_params;


        // Get the article ID
        if($option == 'com_content' && 'article' == JRequest::getVar('view') && JRequest::getVar('id')) {
            $dynamic_contentid = JRequest::getVar('id');
        } else {
            $dynamic_contentid = '';
        }


        // expression to search for
        $regex = '/{geocontent(.*)}/i';
        $param_list = array();

        // Parse params kvp in the form name="value"
        preg_match_all($regex, $article->text, $matches);
        if (count($matches[1])) {
        	$map_number = 0;
        	foreach($matches[1] as $map_def) {
        		$_params  = $this->params->toArray();
				if(preg_match_all('/([a-z0-9_]+=['.GEOCONTENT_PARAM_DELIMITER.'][^'.GEOCONTENT_PARAM_DELIMITER.']+['.GEOCONTENT_PARAM_DELIMITER.'])/', $map_def, $param_list)) {
					if(count($param_list[1])) {
						foreach($param_list[1] as $p) {
							preg_match('/([a-z0-9_]+)=['.GEOCONTENT_PARAM_DELIMITER.']([^'.GEOCONTENT_PARAM_DELIMITER.']+)['.GEOCONTENT_PARAM_DELIMITER.']/', $p, $m);
							// Check if param is allowed in FE
							if(in_array($m[1], $fe_params)) {
								$_params[$m[1]] = $m[2];
							}
						}
					}
				}
				if(array_key_exists('id', $_params) && $_params['id']){
					$data = GeoContentHelper::getVisibleItemData((int)$_params['id']);
				} else {
					$data = null;
				}
                $this->has_geocontent_tag = true;
                $this->map_shown = true;
                $article->text = str_replace( $matches[0][$map_number], GeoContentHelper::getMapByType($_params['map_type'], $data, $_params), $article->text );
                $map_number++;
        	}
        }

        // Search for button
        // expression to search for
        $regex = '/{gcmapeditor(.*)}/i';

        // Allowed parameters for FE tag maps
        $fe_button_params = GeoContentHelper::$front_end_button_params;


        // Parse params kvp in the form name="value"
        preg_match_all($regex, $article->text, $matches);
        if (count($matches[1])) {
            $button_number = 0;
            foreach($matches[1] as $map_def) {
                $_params  = $this->params->toArray();
                if(preg_match_all('/([a-z0-9_]+='.GEOCONTENT_PARAM_DELIMITER.'[^'.GEOCONTENT_PARAM_DELIMITER.']+'.GEOCONTENT_PARAM_DELIMITER.')/', $map_def, $param_list)) {
                    if(count($param_list[1])) {
                        foreach($param_list[1] as $p) {
                            preg_match('/([a-z0-9_]+)=['.GEOCONTENT_PARAM_DELIMITER.']([^'.GEOCONTENT_PARAM_DELIMITER.']+)['.GEOCONTENT_PARAM_DELIMITER.']/', $p, $m);
                            // Check if param is allowed in FE
                            if(in_array($m[1], $fe_button_params)) {
                                $_params[$m[1]] = $m[2];
                            }
                        }
                    }
                }
                // Override ?
                if(array_key_exists('contentid', $_params) && $_params['contentid'] == 'dynamic_contentid') {
                    if($dynamic_contentid) {
                        $_params['contentid'] = $dynamic_contentid;
                    } else {
                        unset($_params['contentid']);
                    }
                }

                $article->text = str_replace( $matches[0][$button_number], GeoContentHelper::getEditorButton($_params), $article->text );
                $button_number++;
            }
        }



        return true;
	}

    /**
     * Example before save content method
     *
     * Method is called right before content is saved into the database.
     * Article object is passed by reference, so any changes will be saved!
     * NOTE:  Returning false will abort the save with an error.
     *You can set the error by calling $article->setError($message)
     *
     * @param   string      The context of the content passed to the plugin.
     * @param   object      A JTableContent object
     * @param   bool        If the content is just about to be created
     * @return  bool        If false, abort the save
     * @since   1.6
     */
    public function onContentBeforeSave($context, &$article, $isNew)
    {
        return true;
    }


    public function onContentAfterSave($context, &$article, $isNew)
    {
        // Check we are handling the frontend edit form.
        if ($context != 'com_content.form') {
            return true;
        }

        $app = JFactory::getApplication();
        // No: only check for FE:
        if($app->isAdmin() || $this->params->get('redirect_after_save') != 'yes')
        {
            return true;
        }
        //add your plugin codes here
        $itemId = JRequest::getVar('Itemid');
        $route = JURI::root() . 'index.php?option=com_content&view=form&layout=edit&a_id='.$article->id;
        //vardie($route);

        $values = (array) $app->getUserState('com_content.edit.article.id');

        // Add the id to the list if non-zero.
        if (!empty($article->id)) {
            array_push($values, (int) $article->id);
            $values = array_unique($values);
            $app->setUserState('com_content.edit.article.id', $values);

            if (JDEBUG) {
                jimport('joomla.error.log');
                $log = JLog::getInstance('jcontroller.log.php')->addEntry(
                    array('comment' => sprintf('Holding edit ID %s.%s %s', 'com_content.edit.article', $article->id, str_replace("\n", ' ', print_r($values, 1))))
                );
            }
        }

        $msg = JText::_('GEOCONTENT_PLUGIN_ARTICLE_SAVED');
        $app->redirect($route, $msg);
        return true;
    }




	/**
	 * Before display content method
	 *
	 * Method is called by the view and the results are imploded and displayed in a placeholder
	 *
	 * @return	string
	 */
	function onContentBeforeDisplay( $context, &$article, &$params, $page = 0)
	{
        // simple performance check to determine whether bot should process further
        if ( strpos( @$article->text, 'gcmapskip' ) !== false) {
            $article->text = str_replace('{gcmapskip}', '', $article->text );
            return '';
        }

        $app = JFactory::getApplication();
        $option    = JRequest::getVar('option');


        // Act in front-end and com_content only...
        if($option != 'com_content'
           || ($context !== 'com_content.article' && $context !== 'text')
           || $app->isAdmin())
        {
            return '';
        }
        if(!$this->has_geocontent_tag && $this->params->get('automatic_map') == 'yes'){
            if((!$app->getMenu()->getActive() || (!$app->getMenu()->getActive()->home || $this->params->get('frontpage_enabled') == 'yes'))
                && $this->params->get('display_position') == 'before_content'){
                return $this->_showMap($article->id);
            }
        }
		return '';
	}

	/**
	 * After display content method
	 *
	 * Method is called by the view and the results are imploded and displayed in a placeholder
	 *
	 * @return	string
	 */
	function onContentAfterDisplay( $context, &$article, &$params, $page = 0)
	{
        // simple performance check to determine whether bot should process further
        if ( strpos( @$article->text, 'gcmapskip' ) !== false) {
            $article->text = str_replace('{gcmapskip}', '', $article->text );
            return '';
        }

        $app = JFactory::getApplication();
        $option    = JRequest::getVar('option');

        // Act in front-end and com_content only...
        if($option != 'com_content'
           || ($context !== 'com_content.article' && $context !== 'text')
           || $app->isAdmin())
        {
            return '';
        }

        if(!$this->has_geocontent_tag && $this->params->get('automatic_map') == 'yes'){
            if((!$app->getMenu()->getActive() || (!$app->getMenu()->getActive()->home || $this->params->get('frontpage_enabled') == 'yes'))
                && $this->params->get('display_position') == 'after_content'){
                return $this->_showMap($article->id);
            }
        }
		return '';
	}




	/**
	* Show the map
	*
	*/
	function _showMap($contentid){
        $data = GeoContentHelper::getVisibleItemData($contentid);
        if(!$data || $this->map_shown ) {
                return '';
        }
        $this->map_shown = true;
        // Pass through specific plugin parameters
        return GeoContentHelper::getMapByType($this->params->get('map_type'), $data, $this->params->toArray());

	}
}