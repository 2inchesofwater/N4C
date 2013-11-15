<?php
/**
 * @version		1.4.4
 * @package		Joomla
 * @subpackage	Event Booking
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2010 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */
// no direct access
defined( '_JEXEC' ) or die ;

$bubbleText = "<ul class=\"bubble\">";
$bubbleText .= "<li class=\"location_name\"><h4>";
$bubbleText .= addslashes($this->location->name);
$bubbleText .= "</h4></li>";
$bubbleText .= "<li class=\"address\">".addslashes($this->location->address.', '.$this->location->city.', '.$this->location->state.', '.$this->location->zip.', '.$this->location->country)."</li>";
$getDirectionLink = 'http://maps.google.com/maps?f=d&daddr='.$this->location->lat.','.$this->location->long.'('.addslashes($this->location->address.', '.$this->location->city.', '.$this->location->state.', '.$this->location->zip.', '.$this->location->country).')' ; 	
$bubbleText .= "<li class=\"address getdirection\"><a href=\"".$getDirectionLink."\" target=\"_blank\">".JText::_('EB_GET_DIRECTION')."</li>";	
$bubbleText .= "</ul>" ;
$height = (int) $this->config->map_height ;
if (!$height) {
	$height = 600 ;
}
$height += 20 ;
$zoomLevel = (int) $this->config->zoom_level ;
if (!$zoomLevel) {
	$zoomLevel = 8 ;
}
?>
<div id="map_canvas" style="height:<?php echo $height; ?>px; width:100%;"></div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  function initialize() {
    var myLatlng = new google.maps.LatLng(<?php echo $this->location->lat ?>, <?php echo $this->location->long; ?>);
    var myOptions = {
      zoom: <?php echo $zoomLevel; ?>,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    var contentString = '<?php echo $bubbleText ; ?>' ;
    var infowindow = new google.maps.InfoWindow({
  	    content: contentString ,
    	maxWidth : 255 	
  	});
    var marker = new google.maps.Marker({
  	    position: myLatlng,
  	    map: map,
  	    title:"<?php echo $this->location->name ; ?>"
  	});  	
    google.maps.event.addListener(marker, 'click', function() {
  	  infowindow.open(map,marker);
  	});	
    infowindow.open(map,marker);
 }    	
 initialize();
</script>