<?php
/**
 *facility.php
 *
 *Facility Class File
 *
 *@version		1.0 2020
 *@package		hcloud
 *@copyright	Copyright (c) 2020 hcloud
 *@license		GNU General Public License
 *@since		Since Release 1.0
 *@author		David Kelvin Biketi
 */

/**
 * Facility class
 *
 * @package  hcloud
 */
class Facility
{
  /**
   * ID
   * @var int
   */
  protected $id;
  
  /**
   * Name
   * @var string
   */
  protected $name;
  
  /**
   * Description
   * @var String
   */
  protected $description;
  
  /**
   * Level
   * @var String
   */
  protected $level;
  
  /**
   * User name
   * @var string
   */
  protected $user_name;
  
  /**
   * Password
   * @var String
   */
  protected $password;

  /**
   * Initialize the Contact with first name, last name, position
   * email, and phone
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
  
  /**
   * Return Name
   * @return string
   */
  public function getName() {
  return $this->name;
  }
  
  /**
   * Return Description
   * @return string
   */
  public function getDescription() {
  return $this->description;
  }
  
  /**
   * Return Level
   * @return string
   */
  public function getLevel() {
  	return $this->level;
  }
  
  /**
   * Return User Name
   * @return string
   */
  public function getUserName() {
  	return $this->user_name;
  }
  
  protected function _verifyInput() {
  $error = false; 
  if (!trim($this->name)) {
    $error = true;
  }
  if (!trim($this->user_name)) {
     $error = true;
  } elseif (strlen(trim($this->user_name)) < 6) {
     $error = true;
  } elseif (self::getFacilityIdByUser(trim($this->user_name))) {
    $error = true;
  } 
  
  $password1 = trim($_POST['password1']);
  if ($password1) {
    if ($password1 != trim($_POST['password2'])) {
      $error = true;
    } elseif (strlen($password1) < 6) {
        $error = true;
    }
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
      // prepare for the encrypted password
        $password = trim($_POST['password1']);
      
      // Get the Database connection
      $connection = Database::getConnection();
      
      // Prepare the data 
      $query = "INSERT INTO facilities (name, description, level) 
      VALUES ('" . Database::prep($this->name) . "',
       '" . Database::prep($this->description) . "',
       '" . Database::prep($this->level) . "')";
      // Run the MySQL statement 
      if ($connection->query($query)) { // this inserts the row
        // update with the user name and password now that you know the id
        $query = "UPDATE facilities 
        SET user_name = '" . Database::prep($this->user_name) . "', 
        password = '" . hash_hmac('sha512',
          $password . '!hi#HUde9' . mysqli_insert_id($connection), 
          SITE_KEY) ."'";
        if ($connection->query($query)) { // this updates the row
          $return = array('', 'Facility account is successfully set up.', '');   
          // add success message
          return $return;
        } else {
          // send fail message 
            $return = array('', 'User name/password not added to contact.', '');
            return $return;
        }

      } else {
      // send fail message and return to contactmaint
      $return = array('facilitymaint', 'Your account is not set up. Unable to create record.', '0');
      return $return;
      }
    } else {
      // send fail message and return to contactmaint
      $return = array('facilitymaint', 'Your account is not set up. Missing required information
       or problem with user name or password.', '0');
      return $return;
    }
  
  }
  
  public function editRecord() {
    // Verify the fields
    if ($this->_verifyInput()) {
      
      // Get the Database connection
      $connection = Database::getConnection();

      // Update with a password changed
      if (trim($_POST['password1'])) {
        // prepare the encrypted password
        $hash_password = hash_hmac('sha512', 
          trim($_POST['password1']) . '!hi#HUde9' . $this->id, 
          SITE_KEY);
        // Set up the prepared statement
        $query = 'UPDATE `facilities` SET name=?, description=?, 
          level=?, user_name=?, password=? WHERE id=?';
        $statement = $connection->prepare($query);
        // bind the parameters
        $statement->bind_param('sssssi',$this->name, $this->description, 
          $this->level, $this->user_name, $hash_password, $this->id);  
      } else {
        // update without a password changed
        // Set up the prepared statement
        $query = 'UPDATE `facilities` SET name=?, description=?,
          level=?, username=? WHERE id=?';
        $statement = $connection->prepare($query);
        // bind the parameters
        $statement->bind_param('ssssi',$this->name, $this->description, 
           $this->user_name, $this->id);
      }
      
      if ($statement) {
        $statement->execute();
        $statement->close();
        // add success message
        $return = array('', 'Facility account is successfully updated.', '');
        return $return;
      } else {
        $return = array('facilitymaint', 'Facility account is not updated. Unable to change record.', '');
        return $return;
      }

    } else {
      // send fail message and return to categorymaint
      $return = array('facilitymaint', 'Facility account is not updated. Missing required information 
        or problem with user name or password.', (int) $this->id);
      return $return;
    }
    
  }
  
  public static function getRecords() {
  	// clear the results
  	$items = array();
  	// Get the connection
  	$connection = Database::getConnection();
  	// Set up query
  	$query = 'SELECT *
      FROM `facilities` ORDER BY name';
  	// Run the query
  	$result_obj = '';
  	$result_obj = $connection->query($query);
  	// Loop through the results,
  	// passing them to a new version of this class,
  	// and making a regular array of the objects
  	try {
  		while($result = $result_obj->fetch_object('Facility')) {
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
    // Get the database connection
    $connection = Database::getConnection();
    // Set up the query
    $query = 'SELECT `id`,`name`,`description`,`level`,`username`
      FROM `facilities` WHERE id="'. (int) $id.'"';
    // Run the MySQL command   
    $result_obj = '';    
      try {
        $result_obj = $connection->query($query);
        if (!$result_obj) {
          throw new Exception($connection->error);
        } else {
          $item = $result_obj->fetch_object('Facility');
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

  public static function getFacilityIdByUser($user_name) {   
    // Get the database connection
    $connection = Database::getConnection();  
    // set up the query
    $id = '';
    $query = 'SELECT id FROM `facilities` 
      WHERE user_name="'. Database::prep($user_name) .'" 
      LIMIT 1';
    // Run the MySQL command   
    $result_obj = '';  
    // Run the MySQL command
    $result_obj = $connection->query($query); 
      while($result = $result_obj->fetch_array(MYSQLI_ASSOC)) {
        $id = $result['id'];
      }
    // if user name not found, return false
    if (!$id) { // if user name not found, return with error message
      return false;
    } else {
      return $id;
    }
  }
  
  
  public static function deleteRecord($id) {
      // Get the Database connection
      $connection = Database::getConnection();     
      // Set up query
      $query = 'DELETE FROM `facilities` WHERE id="'. (int) $id.'"';
      // Run the query
      if ($result = $connection->query($query)) {   
        $return = array('', 'Facility account successfully deleted.', '');
        return $return;
      } else {
        $return = array('facilitydelete', 'Unable to delete your account.', (int) $id);
        return $return;
      }
  }
  
  public function getFacility_DropDown() {
    // set up first option for selection if none selected
    $option_selected = '';
    if (!$this->access) {
      $option_selected = ' selected="selected"';
    }
    
    // Get the categories
    $items = array('Registered', 'Admin');

    $html  = array();
    
    $html[] = '<label for="access">Choose Access</label><br />';
    $html[] = '<select name="access" id="access">';
    
    foreach ($items as $i=>$item) { 
      // If the selected parameter equals the current category id then flag as selected
      if ($this->access == $item) {
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

  public static function logIn($item) {
    if (!$item['user_name'] || !$item['password']) {
      return array('login','Sorry, invalid User Name and/or Password.');
    }
    // Get the database connection
    $connection = Database::getConnection(); 
     
    // get the id for the user
    $id = self::getFacilityIdByUser($item['user_name']);
 
    if (!$id) { // if user name not found, return with error message
      return array('login','Sorry, invalid User Name and/or Password.','');
    } 
    
    $hash_password = hash_hmac('sha512', $item['password'] . '!hi#HUde9' . (int) $id, SITE_KEY);
  
    // Set up the query
    $query = 'SELECT id, name, description, level, user_name FROM `facilities` 
      WHERE user_name="'. $item['user_name'] .'" AND password = "' . $hash_password . '" 
      LIMIT 1';
    // Run the MySQL command   
    $result_obj = '';  
    // Run the MySQL command
    $result_obj = $connection->query($query);  
    try { 
      while ($result = $result_obj->fetch_array(MYSQLI_ASSOC)) {
        // pass back the results
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['first_name'] = $result['first_name'];
        $_SESSION['last_name'] = $result['last_name'];
        $_SESSION['user_name'] = $result['user_name'];
        $_SESSION['access'] = $result['access'];
        return array('',"Welcome, {$_SESSION['first_name']}", '');
       }
       return array('login','Sorry, invalid User Name and/or Password.','');
    }
    catch(Exception $e)
      {
        return false;
      }    
  }

  public static function logout() {  
    unset($_SESSION['user_id']);
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);
    unset($_SESSION['user_name']);
    unset($_SESSION['access']);  
  }    
  
  public static function isLoggedIn() {  
    if (isset($_SESSION['user_id'])) {
      return true;
    } else {
      return false;
    }
  }  

  public static function accessLevel() {  
    if (isset($_SESSION['access'])) {
      return $_SESSION['access'];
    } else {
      return false;
    }
  }
  
}
