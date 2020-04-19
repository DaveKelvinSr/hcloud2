<?php
/**
 *functions.php
 *
 *@version		1.0 2019-04-04
 *@package		medicure
 *@copyright	Copyright (c) 2020 medicure
 *@license		GNU General Public License
 *@since		Since Release 1.0
 *@author		David Kelvin Biketi
 */

/**
 * loadContent
 * Load the Content
 * @param default
 */

function loadContent($where, $default='') {
	
	$content = '';
	//Get the content from the URL
	$content = filter_input(INPUT_GET, $where, FILTER_SANITIZE_STRING);
	$default = filter_var($default, FILTER_SANITIZE_STRING);
	//Set up the login as the default
	$content = (empty($content)) ? $default : $content;
	if ($content) {
		//Sanitize the data to prevent hacking
		$html = include 'content/'.$content.'.php';
		return $html;
	}
	
}

/**
 * loadContent
 * Load the Content
 * @param default
 */

function loadUserContent($where, $default='') {
	
	$content = '';
	//Get the content from the URL
	$content = filter_input(INPUT_GET, $where, FILTER_SANITIZE_STRING);
	$default = filter_var($default, FILTER_SANITIZE_STRING);
	//Set up the login as the default
	$content = (empty($content)) ? $default : $content;
	if ($content) {
		//Sanitize the data to prevent hacking
		$html = include 'content/usercontent/'.$content.'.php';
		return $html;
	}
	
}