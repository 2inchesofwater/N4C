<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-2.0/JG/trunk/components/com_joomgallery/model.php $
// $Id: model.php 3651 2012-02-19 14:36:46Z mab $
/****************************************************************************************\
**   JoomGallery 2                                                                      **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2012  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

jimport('joomla.application.component.model');

/**
 * JoomGallery Parent Model
 *
 * @package JoomGallery
 * @since   1.5.5
 */
class JoomGalleryModel extends JModel
{
  /**
   * JApplication object
   *
   * @var   object
   */
  protected $_mainframe;

  /**
   * JoomConfig object
   *
   * @var   object
   */
  protected $_config;

  /**
   * JoomAmbit object
   *
   * @var   object
   */
  protected $_ambit;

  /**
   * JUser object, holds the current user data
   *
   * @var   object
   */
  protected $_user;

  /**
   * Constructor
   *
   * @return  void
   * @since   1.5.5
   */
  public function __construct($config = array())
  {
    parent::__construct($config);

    $this->_ambit     = JoomAmbit::getInstance();
    $this->_config    = JoomConfig::getInstance();

    $this->_mainframe = JFactory::getApplication('site');
    $this->_user      = JFactory::getUser();
  }
}