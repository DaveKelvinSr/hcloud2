<?php
/**
 *exposure.php
 *
 *Exposure Class File
 *
 *@version		1.0 2020
 *@package		hcloud
 *@copyright	Copyright (c) 2020 hcloud
 *@license		GNU General Public License
 *@since		Since Release 1.0
 *@author		David Kelvin Biketi
 */

/**
 * Exposure class
 *
 * @package  hcloud
 */
class Exposure extends Table
{
  /**
   * Person Id
   * @var int
   */
  protected $person_id;
  
  /**
   * Exposed person Id
   * @var int
   */
  protected $exposed_person_id;
  
  /**
   * datetime
   * @var string
   */
  protected $datetime;
  
  /**
   * Return Person Id
   * @return int
   */
  public function getPersonId() {
  return $this->person_id;
  }
  
  /**
   * Return Exposed Person Id
   * @return int
   */
  public function getExposedPersonId() {
  return $this->exposed_person_id;
  }
  
  /**
   * Return Datetime
   * @return string
   */
  public function getDatetime() {
  return $this->datetime;
  }
  
    
  protected function _verifyInput() {
    $error = false; 
    if (!trim($this->person_id)) {
      $error = true;
    } 
    if (!trim($this->exposed_person_id)) {
      $error = true;
    }
  
    if ($error) {
      return false;
    } else {
      return true;
    }
  }

  public function addRecord() {
  
    // Verify the fields
    if ($this->_verifyInput()) {
   
      // Get the Database connection
      $connection = Database::getConnection();
      
      // Prepare the data 
      $query = "INSERT INTO exposures (person_id, exposed_person_id, datetime) 
      VALUES ('" . (int) $this->person_id .  "',
       '" . (int) $this->exposed_person_id .  "',
       '" . Database::prep($this->datetime) . "')";
      //var_dump($query);
      // Run the MySQL statement 
      if ($connection->query($query)) {
      $return = array('', 'Exposure record successfully added.', '');
    
      // add success message
      return $return;
      } else {
      // send fail message and return to contactmaint
      $return = array('exposuremaint', 'No Exposure record Added. Unable to create record.', '');
      return $return;
      }
    } else {
      // send fail message and return to maint
      $return = array('exposuremaint', 'No Exposure record Added. 
        Missing required information.', '');
      return $return;
    }
  
  }
  
  public function editRecord() {
    // Verify the fields
    if ($this->_verifyInput()) {
      
      // Get the Database connection
      $connection = Database::getConnection();

      // update without a password changed
      // Set up the prepared statement
      $query = 'UPDATE `exposures` SET person_id=?, exposed_person_id=?, datetime=? WHERE id=?';
      $statement = $connection->prepare($query);
      // bind the parameters
      $statement->bind_param('iisi',$this->person_id, $this->exposed_person_id, 
        $this->datetime, $this->id);
    
      if ($statement) {
        $statement->execute();
        $statement->close();
        // add success message
        $return = array('', 'Exposure record successfully updated.', '');
        return $return;
      } else {
        $return = array('exposuremaint', 'Exposure record not updated. 
          Unable to change record.', (int) $this->id);
        return $return;
      }

    } else {
      // send fail message and return to categorymaint
      $return = array('exposuremaint', 'Exposure record not updated. 
        Missing required information.', (int) $this->id);
      return $return;
    }
    
  }

  public static function deleteRecord($id) {
      // Get the Database connection
      $connection = Database::getConnection();     
      // Set up query
      $query = 'DELETE FROM `exposures` WHERE id="'. (int) $id.'"';
      // Run the query
      if ($result = $connection->query($query)) {   
        $return = array('', 'Exposure record successfully deleted.', '');
        return $return;
      } else {
        $return = array('exposuredelete', 'Unable to delete Exposure Record.', (int) $id);
        return $return;
      }
  }  
  
  public static function getRecords() {
    // clear the results
    $items = array();
    // Get the connection  
    $connection = Database::getConnection();
    // Set up query
    $query = 'SELECT * FROM `exposures` ORDER BY `datetime` DESC';
    // Run the query
    $result_obj = '';
    $result_obj = $connection->query($query);
    // Loop through the results, 
    // passing them to a new version of this class, 
    // and making a regular array of the objects
    try {  
      while($result = $result_obj->fetch_object('Exposure')) {
        $items[]= $result;
      }
      // pass back the results
      return($items);
    }
    
    catch(Exception $e) {
      return false;
    }  
  }  
  
  public static function getRecord($id) {
	// clear
	$item = '';
    // Get the database connection
    $connection = Database::getConnection();
    // Set up the query
    $query = 'SELECT * FROM `exposures` WHERE id="'. (int) $id.'"';
    // Run the MySQL command   
    $result_obj = '';    
      try {
        $result_obj = $connection->query($query);
        if (!$result_obj) {
          throw new Exception($connection->error);
        } else {
          $item = $result_obj->fetch_object('Exposure');
          if (!$item) {
            throw new Exception($connection->error);
          } else {
            // pass back the results
            return($item);
          }
        }
      }
      catch(Exception $e) {
        echo $e->getMessage();
      }
  } 
  
  public function getPerson_DropDown() {
    // set up first option for selection if none selected
    $option_selected = '';
    if (!$this->level) {
      $option_selected = ' selected="selected"';
    }
    
    // Get the levels
    $items = array('Public', 'Registered', 'Admin', 'LoggedIn', 'LoggedOut');

    $html  = array();
    
    $html[] = '<p><label for="level">Choose Menu Level</label>';
    $html[] = '<p><select name="level" id="level">';
    
    foreach ($items as $i=>$item) { 
      // If the selected parameter equals the current then flag as selected
      if ($this->level == $item) {
        $option_selected = ' selected="selected"';
      }
      // set up the option line
      $html[]  =  '<option value="' . $item . '"' . $option_selected . '>' . $item . '</option>';
      // clear out the selected option flag
      $option_selected = '';
    }
    
    $html[] = '</select>';
    return implode("\n", $html);      
      
  }
  
}
