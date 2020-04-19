<?php
/**
 *table.php
 *
 *Table Class File
 *
 *
 *@version		1.0 2020
 *@package		hcloud
 *@copyright	Copyright (c) 2020 hcloud
 *@license		GNU General Public License
 *@since		Since Release 1.0
 *@author		David Kelvin Biketi
 */

/**
 * Table class
 *
 * @package  table
 */
class Table
{
  /**
   * ID
   * @var int
   */
  protected $id;

  /**
   * Initialize the class with data from database
   * @param array
   */
  public function __construct($input = false) {
    if (is_array($input)) {
      foreach ($input as $key => $val) {
      // Note the $key instead of key. 
      // This will give the value in $key instead of 'key' itself
      $this->$key = $val;
      }
    }
  }

  /**
   * Return ID
   * @return int
   */
  public function getId() {
  return $this->id;
  }  
  
}
