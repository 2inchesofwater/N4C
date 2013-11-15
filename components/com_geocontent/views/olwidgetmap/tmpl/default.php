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

JHTML::_('behavior.mootools');

//vardie($this->params);

if(@$this->warning): ?>
<div class="message ">
<?php  echo $this->warning ?>
</div>
<?php endif; ?>
<?php
if($this->params->get('show_page_title', 1) && $this->params->get('page_title')): ?>
<div class="contentheading">
    <h1>
        <?php echo $this->escape($this->params->get('page_title')); ?>
    </h1>
</div>
<?php endif; ?>
<?php echo $this->map_html; ?>
