<?php
// $HeadURL: https://joomgallery.org/svn/joomgallery/JG-2.0/JG/trunk/components/com_joomgallery/controllers/send2friend.php $
// $Id: send2friend.php 3904 2012-09-27 19:09:29Z erftralle $
/****************************************************************************************\
**   JoomGallery 2                                                                   **
**   By: JoomGallery::ProjectTeam                                                       **
**   Copyright (C) 2008 - 2012  JoomGallery::ProjectTeam                                **
**   Based on: JoomGallery 1.0.0 by JoomGallery::ProjectTeam                            **
**   Released under GNU GPL Public License                                              **
**   License: http://www.gnu.org/copyleft/gpl.html or have a look                       **
**   at administrator/components/com_joomgallery/LICENSE.TXT                            **
\****************************************************************************************/

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * JoomGallery Send2Friend Controller
 *
 * @package JoomGallery
 * @since   2.1
 */
class JoomGalleryControllerSend2Friend extends JController
{
  /**
   * Sends a mail with a link to the current image to a given address
   *
   * @return  void
   * @since   1.5.5
   */
  public function send()
  {
    $model = $this->getModel('send2friend');

    if(!$model->send())
    {
      $this->setRedirect(JRoute::_('index.php?view=detail&id='.JRequest::getInt('id'), false), $model->getError(), 'error');
    }
    else
    {
      $this->setRedirect(JRoute::_('index.php?view=detail&id='.JRequest::getInt('id'), false), JText::_('COM_JOOMGALLERY_DETAIL_SENDTOFRIEND_MSG_MAIL_SENT'));
    }
  }
}