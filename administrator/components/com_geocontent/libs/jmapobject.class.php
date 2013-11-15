<?php
/**
* Mapserver adapter for KML mapserver library
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

require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_geocontent'.DS.'helpers'.DS.'geocontent.php');
require_once(JPATH_ROOT.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');



class JMapObject {

    var $layers;

    function __construct($contentid){

        $this->layers = GeoContentHelper::getVisibleLayers($contentid);

        if(!$this->layers){
            die('No visible layers (or layers are filtered)');
        }
        $this->numlayers = count($this->layers);
        $this->contentid = $contentid;
        // Fake extent
        $this->extent = null;
    }

    function &getLayer($num){
        if(!$this->layers[$num]){
            die('No layer with this index ('.$num.')');
        }
        $l = new JWGLayerObject($this->layers[$num]);
        return $l;
    }

    function &getLayerById($id){
        if(!array_key_exists($id, $this->layers)){
            die('No layer with this id ('.$id.')');
        }
        return $this->getLayer($id);
    }

    function &getLayerByName($name){
        foreach($this->layers as $k => $v){
            if($v->name == $name){
                return $this->getLayer($k);
            }
        }
        die('No layer with this name ('.$name.')');
    }
}

class JWGLayerObject {

    function JWGLayerObject(&$data){
        foreach($data as $k => $v){
            $this->$k = $v;
        }

        $this->items = GeoContentHelper::getVisibleItems($this->id);
        // Add content item route
        foreach($this->items as $k => $item){
            $this->items[$k]->link = GeoContentHelper::getItemURL($item);
            $item->content = $item->content ? $item->content : '<p>' . $item->contentname . '</p>';
            $item->contentname = $item->contentname ? $item->contentname : GeoContentHelper::getOriginalName($item->contentid);
        }
        $this->numshapes = count($this->items);
        $this->shpcounter = 0;
        $this->numclasses = 1;
        $this->numstyles = 1;
        $this->RESULT_FIELDS = 'contentname'; // namecol
        $this->DESCRIPTION_TEMPLATE = '%content%<p><a class="gc_readmore" href="%link%">'. GeoContentHelper::getReadMore() .'</a></p>';
        $this->BALLOON_TEMPLATE = '<h1>$[name]</h1>$[description]';
        $this->KML_ADD_POINT = GeoContentHelper::getParm('kml_add_point');
   }

    function getMetaData($m){
        if(property_exists($this, $m)){
            return $this->$m;
        }
        return null;
    }

    function getClass(){
        return $this;
    }

    function getStyle(){
        // aabbggrr
        return array(
            'color'             => $this->rgba2abgr($this->linergba)
            ,'outlinecolor'     => $this->rgba2abgr($this->linergba)
            ,'width'            => $this->linewidth
            ,'icon_width'       => $this->iconsize
            ,'backgroundcolor'  => $this->rgba2abgr($this->polyrgba)
            ,'icon'             => GeoContentHelper::getIconURL($this->icon)
        );
    }

    function rgba2abgr($rgba){
        $abgr = substr($rgba,6,2) . substr($rgba,4,2) . substr($rgba,2,2) . substr($rgba,0,2);
        return $abgr;
    }

    function getExpression(){
        return '/.*/';
    }

    function set($k, $v){
        $this->$k = $v;
    }

    function get($k){
        return $this->$k;
    }

    function open(){
        return true;
    }

    function getItems(){
        $i = GeoContentHelper::getTableFields('#__geocontent_item');
        return array_keys($i['#__geocontent_item']);
    }

    /**
    * Stub
    */
    function whichShapes($extent){
        return true;
    }

    function nextShape(){
        if($this->shpcounter < $this->numshapes) {
            $keys = array_keys($this->items);
            return new JWGShape($this->items[$keys[$this->shpcounter++]]);
        }
        return false;
    }

    function close(){}
}

class JWGShape {

    function __construct(&$shape){
        foreach($shape as $k => $v){
            $this->$k = $v;
            $this->values[$k] = $v;
        }
        $this->extended_data = array('id');
    }

    function toWkt(){
       return (preg_replace('/[^[\-A-z0-9,.\(\)) ]/', '', $this->geodata));
    }
}