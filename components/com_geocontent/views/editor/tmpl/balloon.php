<?php
/**
*
* @version      $Id: controller.php 66 2008-06-12 06:17:47Z elpaso $
* @package      COM_GEOCONTENT
* @copyright    Copyright (C) 2010 Alessandro Pasotti http://www.itopen.it
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

$canDo = GeoContentHelper::getActions($this->layerid);
?>
        <h1><?php echo JText::_('COM_GEOCONTENT_BALLOON_CONTENT');  ?></h1>


        <?php
        JFilterOutput::objectHTMLSafe( $this->item, ENT_QUOTES );
        ?>

        <script language="javascript" type="text/javascript">
            function gc_submitbutton(pressbutton) {
                var form = document.adminForm;
                if (pressbutton == 'cancel') {
                    Joomla.submitform( pressbutton );
                    return;
                }
                // do field validation
                var errors = false;
                $$('input.required').each(function(elm){
                    elm.removeClass('invalid');
                    if(!elm.value){
                        elm.addClass('invalid');
                        errors = true;
                    }
                });
                if (errors) {
                    alert( "<?php echo JText::_( 'COM_GEOCONTENT_FILL_REQUIRED', true ); ?>" );
                } else {
                    Joomla.submitform( pressbutton );
                }
            }
        </script>
        <form  method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" >
        <div class="col width-70">

            <div>
            		<button type="button" onclick="gc_submitbutton()">
                    <?php echo JText::_('COM_GEOCONTENT_NEXT') ?> &gt;&gt;
                	</button>
            </div>

            <fieldset class="adminform">
            <legend><?php echo JText::_( 'COM_GEOCONTENT_DETAILS' ); ?></legend>
            <table class="admintable">

                <tr>
                    <td width="110" class="key">
                        <label for="title">
                            <?php echo JText::_( 'COM_GEOCONTENT_TITLE' ); ?><span class="star">&nbsp;*</span>
                        </label>
                    </td>
                    <td>
                        <input style="width:300px" length="100" class="inputbox required" type="text" name="contentname" id="contentname" value="<?php echo $this->contentname; ?>" />
                    </td>
                </tr>
                <tr><?php if ($canDo->get('geocontent.custom_url')) { ?>
                    <?php if ($canDo->get('geocontent.unlinked')) { ?>
                    <td width="110" class="key">
                        <label for="url">
                            <?php echo JText::_( 'COM_GEOCONTENT_URL_OPTIONAL' ); ?>:
                        </label>
                    </td>
                    <td>
                        <input style="width:300px" length="100" class="inputbox" type="text" name="url" id="url" value="<?php echo $this->url; ?>" />
                    </td>
                    <?php } else { ?>
                    <td width="110" class="key">
                        <label for="url">
                            <?php echo JText::_( 'COM_GEOCONTENT_URL' ); ?><span class="star">&nbsp;*</span>
                        </label>
                    </td>
                    <td>
                        <input style="width:300px" length="100" class="inputbox required" type="text" name="url" id="url" value="<?php echo $this->url; ?>" />
                    </td>
                    <?php } ?>
                </tr><?php } ?>
                <tr>
                    <td width="110" class="key">
                        <label for="content">
                            <?php echo JText::_( 'COM_GEOCONTENT_BALLOON_CONTENT' ); ?>:
                        </label>
                    </td>
                    <td>
                        <?php echo $this->editor->display( 'content',  $this->content, '100%;', '550', '75', '20', array('pagebreak', 'readmore') ) ; ?>
                    </td>
                </tr>
            </table>
            </fieldset>
        </div>
        <div class="clr"></div>
            <input type="hidden" name="task" value="olwidgetform" />
            <input type="hidden" name="contentid" value="<?php echo $this->contentid; ?>" />
            <input type="hidden" name="layerid" value="<?php echo $this->layerid; ?>" />
            <input type="hidden" name="id" value="<?php echo $this->id; ?>" />
            <input type="hidden" name="cid[]" value="<?php echo $this->id; ?>" />
            <input type="hidden" name="map_lngstart" value="<?php echo $this->map_lngstart; ?>" />
            <input type="hidden" name="map_latstart" value="<?php echo $this->map_latstart; ?>" />
            <?php echo JHTML::_( 'form.token' ); ?>
        </form>
