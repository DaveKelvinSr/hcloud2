<?php
/**
 *init.php
 *
 *@version		1.0 2020
 *@package		hcloud
 *@copyright	Copyright (c) 2020 hcloud
 *@license		GNU General Public License
 *@since		Since Release 1.0
 *@author		David Kelvin Biketi
 */

//Include the required files
require_once 'includes/functions.php';

/**
 * Auto load the class files
 * @param string $class_name
 */
function __autoload($class_name) {
	try {
		$class_file = 'includes/classes/' . strtolower($class_name) . '.php';
		if (is_file($class_file)) {
			require_once $class_file;
		} else {
			throw new Exception("Unable to load class $class_name in file $class_file.");
		}
	} catch (Exception $e) {
		echo 'Eception caught: ', $e->getMessage(), "\n";
	}
}