<?php
/**
* GPX parser
*
* Transform GPX into WKT
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

class gpx2wkt {

    function gpx2wkt($data){
        $this->parser = new gpx_get_mbr($data);
    }

    function getWKT(){
        $current = null;
        $pointlist = $this->parser->get_points();
        if(!$pointlist){
            return '';
        }
        foreach($pointlist as $type => $collection){
            foreach($collection as $points){
                if($points){
                    $wkt[] = $this->mkFeature($points, $type);
                }
            }
        }
        if(count($wkt) > 1){
            $wkt = "GEOMETRYCOLLECTION(" . join(',', $wkt) . ")";
        } else {
            $wkt = $wkt[0];
        }
        return preg_replace('/[^[\-A-z0-9,.\(\))]/', ' ', $wkt);
    }

    function mkFeature(&$points, &$type){
        foreach($points as $p){
            $_p[] = "$p[0] $p[1]";
        }
        $points =& $_p;
        if($type == 'trk' || $type == 'trkseg' || $type == 'rte'){
           return (count($points) > 1 ? 'LINESTRING(' : 'POINT(') . join(',', $points) . ')';
        }
        return (count($points) > 1 ? 'MULTIPOINT(' : 'POINT(') . join(',', $points) . ')';
    }

    function getMBR(){
        $mbr = $this->parser->get_mbr();
        return array($mbr[0][0], $mbr[0][1], $mbr[1][0],$mbr[1][1]);
    }

}

// GPX parser
class gpx_get_mbr {
    var $maxx = -10e6;
    var $maxy = -10e6;
    var $minx = 10e6;
    var $miny = 10e6;
    var $points;
    var $parser;
    var $pointer;
    var $oldtag;
    var $result;

    function gpx_get_mbr($data) {
        $points = array();
        $this->result = array();
        $this->parser = xml_parser_create();
        xml_set_object($this->parser, $this);
        xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, false);
        xml_set_element_handler($this->parser, "tag_open", "tag_close");
        xml_set_character_data_handler($this->parser, "cdata");
        xml_parse($this->parser, $data);
    }


    function tag_open($parser, $tag, $attributes) {
        if($tag == 'trkpt' || $tag == 'rtept' || $tag == 'wpt'){
            $this->points[] = array(trim($attributes['lon']), trim($attributes['lat']), $tag);
            $this->maxx = max( $this->maxx, $attributes['lat']);
            $this->maxy = max( $this->maxy, $attributes['lon']);
            $this->minx = min( $this->minx, $attributes['lat']);
            $this->miny = min( $this->miny, $attributes['lon']);
        }
    }

    function cdata($parser, $cdata) {}

    function tag_close($parser, $tag) {
        if( $tag == 'trk' || $tag == 'trkseg' || $tag == 'rte' || $tag == 'wpt'){
            $this->result[$tag][] = $this->points;
            $this->points = array();
        }
    }

    /**
    * Return a 2D array with MBR
    */
    function get_mbr(){
        return array(array($this->minx, $this->miny), array($this->maxx, $this->maxy));
    }

    /**
    * Return the point array
    */
    function get_points(){
        return $this->result;
    }

}

?>