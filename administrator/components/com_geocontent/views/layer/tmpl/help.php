<?php
/**
*
* @version      $Id: controller.php 66 2008-06-12 06:17:47Z elpaso $
* @package      COM_GEOCONTENT
* @copyright    Copyright (C) 2008 Alessandro Pasotti http://www.itopen.it
* @license      GNU/AGPL

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/


?>


<form action="index.php?option=com_geocontent" method="post" name="adminForm">
<input type="hidden" name="controller" value="layer" />
<input type="hidden" name="option" value="com_geocontent" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>

<h2><?php echo JText::_('COM_GEOCONTENT_GEOCONTENT_MANUAL'); ?></h2>
<p><?php echo Jtext::_('You should have received the PDF manual inside the GeoContent distribution compressed package. On-line manual for the lastest version is always available at the URL below:') ; ?></p>
<p><a target="_new" href="http://www.itopen.it/geocontent_docs"><?php echo JText::_('COM_GEOCONTENT_FULL_ONLINE_DOCUMENTATION'); ?>.</a></p>
