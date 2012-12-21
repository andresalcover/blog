<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
function utf8_strlen($string) {
	return strlen(utf8_decode($string));
}
