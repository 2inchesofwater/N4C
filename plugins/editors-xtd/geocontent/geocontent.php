<?php
/**
 * @version		$Id: image.php 12542 2009-07-22 17:40:48Z ian $
 * @package		Joomla
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );


require_once JPATH_ADMINISTRATOR . DS . 'components'. DS . 'com_geocontent' . DS .'helpers' . DS . 'geocontent.php';


/**
 * Editor Image buton
 *
 * @package Editors-xtd
 * @since 1.5
 */
class plgButtonGeoContent extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param 	object $subject The object to observe
	 * @param 	array  $config  An array that holds the plugin configuration
	 * @since 1.5
	 */
	function plgButtonGeoContent(& $subject, $config)
	{

        $language = JFactory::getLanguage();
        $language->load('com_geocontent', JPATH_SITE . DS . 'components' . DS . 'com_geocontent' );

        parent::__construct($subject, $config);
	}

    /**
     * Display the button
     *
     * @return object
     */
    function onDisplay($name, $asset, $author)
    {

        // Check ACL first
        // * user can add/edit items to at least one of the existing layers

        $application =& JFactory::getApplication();
        $doc         =& JFactory::getDocument();
        if(!$application->isSite()){
            $doc->addStyleDeclaration('.button2-left .geocontent { background: url("../media/com_geocontent/images/j_button2_geocontent.png") no-repeat scroll 100% 0 transparent;}');
        }

		$button_text = $this->params->get('button_text');


		extract(GeoContentHelper::getComponentParamsArray());

		// Check enabled TODO: check front-end only
        $option    = JRequest::getVar('option');
        $view      = JRequest::getVar('view');
        $task      = JRequest::getVar('task');
        $article_id= JRequest::getVar('id');


        if(!$article_id){
            $article_id = JRequest::getVar('cid');
            if(is_array($article_id)){
                $article_id = $article_id[0];
            }
        }

        // Front-end editor
        if(!$article_id){
            $article_id = JRequest::getVar('a_id');
        }

        // Act in front-end and com_content only...
        if( $option !== 'com_content') {
            return;
        }

		//Make sure the user is authorized to view this page
		$doc 		=& JFactory::getDocument();
        $cssurl = JURI::base() . 'templates/' . $application->getTemplate();

        $modal = true;
        // checks if the user can add new geocontent items
        // TODO: check that the user can add/edit at least in one layer
        if(!GeoContentHelper::getActions()->get('core.create') && !(GeoContentHelper::getEditorVisibleLayers($article_id))) { // Error no id
            return false;
            //$link = 'index.php?option=com_geocontent&amp;view=editor&amp;task=err_no_id&amp;tmpl=component';
        } elseif(!$article_id) {
            $link = '';
            $msg = JText::_('COM_GEOCONTENT_EDITORS_XTD_MISSING_ID', true);
            $js =<<<_JS_
            window.addEvent('domready', function(){
                $$('div.geocontent a').addEvent('click', function(){alert('$msg');});
            });
_JS_;
            $doc->addScriptDeclaration($js);
            $modal = false;
        } else {
            $link = 'index.php?option=com_geocontent&amp;task=editor&amp;view=editor&amp;fe=1&amp;tmpl=component&amp;contentid=' . $article_id;
            JHTML::_('behavior.modal');
        }


		$button = new JObject();
		$button->set('modal', $modal);
		$button->set('link', $link);
		$button->set('class', 'geocontent');
		$button->set('text',$button_text ?  $button_text : JText::_('GeoContent'));
		$button->set('name', 'geocontent');
		$button->set('options', "{handler: 'iframe', size: {x: 626, y: 570}}");

		return $button;
	}
}
