<?php
/**
*
* @package      COM_GEOCONTENT
* @copyright    Copyright (C) 2011 Alessandro Pasotti http://www.itopen.it
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
    <script type="text/javascript">
        function updateBounds(){}

        window.addEvent('domready',function(){

            var iFrame = new iFrameFormRequest('jform',{
                onRequest: function(){
                    //console.log('request started');
                },
                onComplete: function(response){
                    //console.log(response);
                    // Item deleted
                    if(!$('geodata').value && !$('gpx').value) {
                        geocontentid = '';
                    }
                    // Get the geocontentid
                    var m = response.match(/#(\d+)/);
                    if(m){
                        geocontentid = m[1];
                    }
                    response = JSON.decode(response);
                    alert(response.msg);
                    $('gpx').value = '';
                    if(response.status == 'ok'){
                        parent.SqueezeBox.close();
                    }
                }
            });

        });


        function save_feature_list(){
            if($('geodata').value || $('gpx').value) {
                try {
                    var edit_layer = olmap.getLayersByClass('olwidget.EditableLayer')[0];
                    if(edit_layer.features.length){
                        var extent = edit_layer.getDataExtent().transform(olmap.projection, olmap.displayProjection);
                    } else {
                        var extent = {
                            top: 0,
                            bottom: 0,
                            left: 0,
                            right: 0
                        };
                    }

                    $('minlat').value = extent.bottom;
                    $('minlon').value = extent.left;
                    $('maxlat').value = extent.top;
                    $('maxlon').value = extent.right;
                    $('jform').fireEvent('submit');



                } catch(e) {
                    alert('<?php echo JText::_('COM_GEOCONTENT_NEW_ITEM_ERROR'); ?>' + '\\n' + '\\n' + e.message);
                    return false;
                }
            } else {
                alert('<?php echo JText::_('COM_GEOCONTENT_ERROR_EMPTY_GEODATA'); ?>');
                return false;
            }
            return true;
        }
    </script>
    <form action="<?php echo $this->saveurl; ?>" method="post" enctype="multipart/form-data" id="jform" name="jform">
        <div style=""><label for="gpx"><?php echo JText::_('COM_GEOCONTENT_LOAD_GPX_TRACK'); ?></label><div style="font-style:italic"><?php echo JText::_('COM_GEOCONTENT_LOAD_GPX_TRACK_DESC'); ?></div><input type="file" id="gpx" name="gpx" value="" /></div>
        <!--<div style="margin:0.5em 0px"></div>-->
        <div style=""><?php echo $this->olmap_field; ?></div>
        <div>
            <div style="padding: 1em"><button onclick="return save_feature_list()"><?php echo JText::_('COM_GEOCONTENT_SAVE'); ?></button></div>
            <input type="hidden" name="contentid" id="contentid" value="<?php echo $this->contentid; ?>" />
            <input type="hidden" name="layerid" id="layerid" value="<?php echo $this->layerid; ?>" />
            <input type="hidden" name="minlat" id="minlat" value="" />
            <input type="hidden" name="maxlat" id="maxlat" value="" />
            <input type="hidden" name="minlon" id="minlon" value="" />
            <input type="hidden" name="maxlon" id="maxlon" value="" />
            <input type="hidden" name="view" id="view" value="editor" />
            <input type="hidden" name="task" id="task" value="save" />
            <input type="hidden" name="id" id="id" value="<?php echo $this->id; ?>" />
            <textarea id="content" name="content" style="display:none"><?php echo $this->content; ?></textarea>
            <input id="contentname"  name="contentname" type="hidden" value="<?php echo $this->contentname; ?>" />
            <input id="url" name="url" type="hidden" value="<?php echo $this->url; ?>" />
            <input id="fe" name="fe" type="hidden" value="1" />
            <?php echo JHTML::_( 'form.token' ); ?>
        </div>
    </form>
