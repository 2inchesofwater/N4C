<?php // no direct access
defined('_JEXEC') or die('Restricted access');
?><script type="text/javascript">
/* <![CDATA[ */

    // addAddressToMap() is called when the geocoder returns an
    // answer.  It adds a marker to the map with an open info window
    // showing the nicely formatted version of the address and the country code.
    function addAddressToMap(response, status_code) {
      if (!response || status_code != 'OK') {
        alert("<?php echo addslashes($params->get('not_found_message')); ?>");
      } else {
        var place = response[0].formatted_address;
        var lng = response[0].geometry.location.lng();
        var lat = response[0].geometry.location.lat();
        var active_layer = [];
        $$('input[name="active_layer"]').each(function(e){
            if(e.checked){
                active_layer.push(e.value);
            }
        });
        // Now decide if a redirect is needed or we stay in the same page.
        var action = document.getElementById('gc_geocoding_form').action;
        if ( typeof(gc_map_catalog) == 'object' && gc_map_catalog.length && (!action || action ==  document.location.protocol + '//' + document.location.hostname + document.location.pathname))
        {
            // Iterate all maps
            gc_map_catalog.each(function(map){
                //map.hideAllLayers();
                active_layer.each(function(l){
                    map.toggleLayer(l, true);
                });
                map.setCenterZoom(lng, lat, <?php echo $params->get('gmap_zoomstart'); ?>);
            });
        } else {
            // Redirect
            window.location.href = '<?php echo $params->get('map_url'); ?>' + '?start_with_layers=list&active_layer=' + active_layer.join(',') + '&map_lngstart=' + lng + '&map_latstart=' + lat + '&map_zoomstart=<?php echo $params->get('gmap_zoomstart'); ?>' + '&gc_address=' + escape($('gc_address').value) ;
        }
      }
    }

    // showLocation() is called when you click on the Search button
    // in the form.  It geocodes the address entered into the form
    // and adds a marker to the map at that location.
    function gcGeoCoding (){
        address = document.getElementById('gc_address').value;
        if(!address){
            return false;
        }
        geocoder = new google.maps.Geocoder();
        var address = document.getElementById('gc_address').value;
        geocoder.geocode({address: address}, addAddressToMap);
        return false;
    }

    window.addEvent('load', function(){
        gcGeoCoding();
    });


/* ]]> */
</script>
<form id="gc_geocoding_form" action="<?php $params->get('map_url'); ?>" onsubmit="return gcGeoCoding()">
    <?php if('n' != $params->get('layers_list_mode')): ?>
        <input type="hidden" name="start_with_layers" id="start_with_layers" value="list" />
        <?php if ($params->get('show_layers_label')): ?>
        <label for="active_layer"><?php echo $params->get('layers_label'); ?></label><?php if($params->get('br_after_label') && 'ul' != $params->get('layers_list_mode')): ?><br /><?php endif; ?>
        <?php endif; ?>

        <?php if('ul' == $params->get('layers_list_mode')): ?>
        <ul id="geocontent_geocoding_list" class="sections<?php echo $params->get('moduleclass_sfx'); ?>">
            <?php foreach ($list as $item) : ?>
            <li>
                <input <?php if (in_array($item->id, $active_layer)) : ?>checked="checked"<?php endif; ?> type="checkbox" name="active_layer" id="active_layer" value="<?php echo $item->id; ?>"><?php echo $item->name;?></input>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>
            <?php foreach ($list as $item) : ?>
                <input <?php if (in_array($item->id, $active_layer)) : ?>checked="checked"<?php endif; ?> type="checkbox" name="active_layer" value="<?php echo $item->id; ?>"><?php echo $item->name;?></input>&nbsp;
            <?php endforeach; ?>
        <?php endif; ?>
        </p>
    <?php endif; ?>
    <div>
        <?php if ($params->get('show_address_label')): ?>
        <label for="gc_address"><?php echo $params->get('address_label'); ?></label><?php if($params->get('br_after_label')): ?><br /><?php endif; ?>
        <?php endif; ?>
        <input type="text" name="gc_address" id="gc_address" value="<?php echo $gc_address; ?>" size="<?php echo $params->get('address_size'); ?>" />
        <input type="submit" name="gc_submit" id="gc_submit" value="<?php  echo $params->get('search_label'); ?>"/>
    </div>
</form>