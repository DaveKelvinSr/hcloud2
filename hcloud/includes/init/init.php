<?php
/**
 * init.php
 *
 * Initialization file
 *
 *@version		1.0 2020
 *@package		hcloud
 *@copyright	Copyright (c) 2020 hcloud
 *@license		GNU General Public License
 *@since		Since Release 1.0
 *@author		David Kelvin Biketi
 */

/**
 * Auto load the class files (Before session start)
 * @param string $class_name
 */
spl_autoload_register(function ($class_name) {
	try {
		$class_file = 'includes/classes/' . strtolower($class_name) . '.php';
		if (is_file($class_file)) {
			require_once $class_file;
		} else {
			throw new Exception("Unable to load class $class_name in file $class_file.");
		}
	} catch (Exception $e) {
		echo 'Exception caught: ',  $e->getMessage(), "\n";
	}
});

session_start(); // starts new or resumes existing session
define('MAGIC_QUOTES_ACTIVE', get_magic_quotes_gpc()); 
define('SITE_KEY', 
  'd0d48339c3b82db413b3be8fbc5d7ea1c1fd3e2792605d3cbfda1HEM54!!'); 
// include required files
require_once 'includes/data/data.php';

// Initialize message coming in
$message = '';
$message = setMessage();

   // Process based on the task. Default to display
  $task = filter_input(INPUT_POST,'task', FILTER_SANITIZE_STRING);
  switch ($task) {
  	
  	case 'signin' :
  		// process the maint
  		$results = maintContact();
  		$message .= $results['message'];
  		// If there is redirect information
  		// redirect to that page
  		if ($results['page'] == 'accountmaint') {
  			// pass on new messages
  			if ($results['message']) {
  				$_SESSION['message'] = $results['message'];
  			}
  			$id = $results['id'];
  			header("Location: index.php?content=usercontainer&userContent=signin");
  			exit;
  		}
  		break;

    case 'login' :
    // process the login
    $results = userLogin();
    $message .= $results['message'];
    // If there is redirect information
    // redirect to that page
    // pass on new messages
      if ($results['page'] == 'login') {
      // pass on new messages
      if ($results['message']) {
        $_SESSION['message'] = $results['message'];
      }
      header("Location: index.php?content=usercontainer&userContent=login");
      exit;
    }
    break;
    
    case 'logout' :
    // process the login
    $results = userLogout();
    $message .= $results['message'];
    // If there is redirect information
    // redirect to that page
    // pass on new messages
    if ($results['page'] == 'logout') {
      // pass on new messages
    if ($results['message']) {
      	$_SESSION['message'] = $results['message'];
      }
      header("Location: index.php?content=usercontainer&userContent=logout");
      exit;
    }
    break;
    
    case 'facilitysignin' :
    	// process the maint
    	$results = maintContact();
    	$message .= $results['message'];
    	// If there is redirect information
    	// redirect to that page
    	if ($results['page'] == 'accountmaint') {
    		// pass on new messages
    		if ($results['message']) {
    			$_SESSION['message'] = $results['message'];
    		}
    		$id = $results['id'];
    		header("Location: index.php?content=usercontainer&userContent=signin");
    		exit;
    	}
    	break;
    	
    case 'facilitylogin' :
    	// process the login
    	$results = userLogin();
    	$message .= $results['message'];
    	// If there is redirect information
    	// redirect to that page
    	// pass on new messages
    	if ($results['page'] == 'login') {
    		// pass on new messages
    		if ($results['message']) {
    			$_SESSION['message'] = $results['message'];
    		}
    		header("Location: index.php?content=usercontainer&userContent=login");
    		exit;
    	}
    	break;
    	
    case 'facilitylogout' :
    	// process the login
    	$results = userLogout();
    	$message .= $results['message'];
    	// If there is redirect information
    	// redirect to that page
    	// pass on new messages
    	if ($results['page'] == 'logout') {
    		// pass on new messages
    		if ($results['message']) {
    			$_SESSION['message'] = $results['message'];
    		}
    		header("Location: index.php?content=usercontainer&userContent=logout");
    		exit;
    	}
    	break;
    
    case 'account.maint' :
    // process the maint
    $results = maintAccount();
    $message .= $results['message'];
    // If there is redirect information
    // redirect to that page
    if ($results['page'] == 'accountmaint') {
      // pass on new messages
    if ($results['message']) {
    	$_SESSION['message'] = $results['message'];
      }
      $id = $results['id'];
      header("Location: index.php?content=usercontainer&userContent=accountmaint&id=$id");
      exit;
    }
    break;
    
    case 'account.delete' :
    // process the delete
    $results = deleteAccount();
    $message .= $results['message'];
    // If there is redirect information
    // redirect to that page
    if ($results['page'] == 'accountdelete') {
      // pass on new messages
    if ($results['message']) {
      	$_SESSION['message'] = $results['message'];
    }
      $id = $results['id'];
      header("Location: index.php?content=usercontainer&userContent=accountdelete&id=$id");
      exit;
    }
    break;

    case 'facility.maint' :
    // process the maint
    $results = maintMenu();
    $message .= $results['message'];
    // If there is redirect information
    // redirect to that page
    if ($results['page'] == 'menumaint') {
      // pass on new messages
    if ($results['message']) {
    	$_SESSION['message'] = $results['message'];
    }
      $id = $results['id'];
      header("Location: index.php?content=usercontainer&userContent=menumaint&id=$id");
      exit;
    }
    break;
    
    case 'facility.delete' :
    // process the delete
    $results = deleteMenu();
    $message .= $results['message'];
    // If there is redirect information
    // redirect to that page
    if ($results['page'] == 'menudelete') {
      // pass on new messages
    if ($results['message']) {
    	$_SESSION['message'] = $results['message'];
    }
      $id = $results['id'];
      header("Location: index.php?content=usercontainer&userContent=menudelete&id=$id");
      exit;
    }
    break;
    
    case 'diagnosis.maint' :
    	// process the maint
    	$results = maintMenu();
    	$message .= $results['message'];
    	// If there is redirect information
    	// redirect to that page
    	if ($results['page'] == 'menumaint') {
    		// pass on new messages
    		if ($results['message']) {
    			$_SESSION['message'] = $results['message'];
    		}
    		$id = $results['id'];
    		header("Location: index.php?content=usercontainer&userContent=menumaint&id=$id");
    		exit;
    	}
    	break;
    	
    case 'diagnosis.delete' :
    	// process the delete
    	$results = deleteMenu();
    	$message .= $results['message'];
    	// If there is redirect information
    	// redirect to that page
    	if ($results['page'] == 'menudelete') {
    		// pass on new messages
    		if ($results['message']) {
    			$_SESSION['message'] = $results['message'];
    		}
    		$id = $results['id'];
    		header("Location: index.php?content=usercontainer&userContent=menudelete&id=$id");
    		exit;
    	}
    	break;
    	
    case 'exposure.maint' :
    	// process the maint
    	$results = maintMenu();
    	$message .= $results['message'];
    	// If there is redirect information
    	// redirect to that page
    	if ($results['page'] == 'menumaint') {
    		// pass on new messages
    		if ($results['message']) {
    			$_SESSION['message'] = $results['message'];
    		}
    		$id = $results['id'];
    		header("Location: index.php?content=usercontainer&userContent=menumaint&id=$id");
    		exit;
    	}
    	break;
    	
    case 'exposure.delete' :
    	// process the delete
    	$results = deleteMenu();
    	$message .= $results['message'];
    	// If there is redirect information
    	// redirect to that page
    	if ($results['page'] == 'menudelete') {
    		// pass on new messages
    		if ($results['message']) {
    			$_SESSION['message'] = $results['message'];
    		}
    		$id = $results['id'];
    		header("Location: index.php?content=usercontainer&userContent=menudelete&id=$id");
    		exit;
    	}
    	break;
    	
    case 'treatment.maint' :
    	// process the maint
    	$results = maintMenu();
    	$message .= $results['message'];
    	// If there is redirect information
    	// redirect to that page
    	if ($results['page'] == 'menumaint') {
    		// pass on new messages
    		if ($results['message']) {
    			$_SESSION['message'] = $results['message'];
    		}
    		$id = $results['id'];
    		header("Location: index.php?content=usercontainer&userContent=menumaint&id=$id");
    		exit;
    	}
    	break;
    	
    case 'treatment.delete' :
    	// process the delete
    	$results = deleteMenu();
    	$message .= $results['message'];
    	// If there is redirect information
    	// redirect to that page
    	if ($results['page'] == 'menudelete') {
    		// pass on new messages
    		if ($results['message']) {
    			$_SESSION['message'] = $results['message'];
    		}
    		$id = $results['id'];
    		header("Location: index.php?content=usercontainer&userContent=menudelete&id=$id");
    		exit;
    	}
    	break;
    
    
    
  } 
  
  $_SESSION['message'] = $message;