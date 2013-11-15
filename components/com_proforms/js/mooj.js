// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// @license: Mad4Media Javascipt License - copyright Mad4Media - Fahrettin Kutyol - All rights reserved    ++
// (re-) publishing or forking for any purpose of commercial or non-commercial use is not allowed.		   ++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

var originalImageSRC=undefined;function m4jReloadCaptcha(){var _1=dojo.byId("m4jCIM");if(originalImageSRC==undefined){originalImageSRC=_1.src;}var _2="&add"+Math.random(10,100)+"="+Math.random(10000,999999999);_1.src=originalImageSRC+_2;return false;};function _byName(_3){var n=document.getElementsByName(_3)[0];return ((n!==undefined)&&dojo.isObject(n))?n:null;};