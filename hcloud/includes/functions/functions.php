<?php
/**
 * loadContent
 * Load the Content
 * @param $default
 */

//require_once 'includes/resources/resources.php';

function loadContent($where, $default='') {
	// Get the content from the url
	// Sanitize it for security reasons
	$content = filter_input(INPUT_GET, $where, FILTER_SANITIZE_STRING);
	$default = filter_var($default, FILTER_SANITIZE_STRING);
	// If there wasn't anything on the url, then use the default
	$content = (empty($content)) ? $default : $content;
	// If you found have content, then get it and pass it back
	if ($content) {
		// sanitize the data to prevent hacking.
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
		
		$html = "";
		$file = 'content/usercontent/'.$content.'.php';
		
		if (file_exists($file)) {
			$html = include $file;
		}
		
		$file = 'content/usercontent/forms/'.$content.'.php';
		if (file_exists($file)) {
			$html = include $file;
		}
		return $html;
	}
	
}

function setMessage() {
	// Initialize message coming in
	$message = '';
	if (isset($_SESSION['message'])) {
		$message = htmlentities($_SESSION['message']);
		unset($_SESSION['message']);
	}
	
	return $message;
}

function maintPerson() {
	$results = '';
	if (isset($_POST['save']) AND $_POST['save'] == 'Save') {
		// check the token
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']) {
					$results = array('','Sorry, go back and try again. There was a security issue.','');
					$badToken = true;
				} else {
					$badToken = false;
					unset($_SESSION['token']);
					// Put the sanitized variables in an associative array
					// Use the FILTER_FLAG_NO_ENCODE_QUOTES to allow names like O'Connor
					$item  = array (  'id' => (int) $_POST['id'],
							'first_name' => filter_input(INPUT_POST,'first_name', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
							'last_name'  => filter_input(INPUT_POST,'last_name', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
							'gender'  => filter_input(INPUT_POST,'gender', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
							'bloodgroup'   => filter_input(INPUT_POST,'position', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
							'email'      => filter_input(INPUT_POST,'email', FILTER_SANITIZE_STRING),
							'phone'      => filter_input(INPUT_POST,'phone', FILTER_SANITIZE_STRING),
							'user_name'  => filter_input(INPUT_POST,'user_name', FILTER_SANITIZE_STRING),
							'access'     => filter_input(INPUT_POST,'access', FILTER_SANITIZE_STRING)
					);
					
					// Set up a Person record object based on the posts
					$person = new Person($item);
					if ($person->getId()) {
						$results = $person->editRecord();
					} else {
						$results = $person->addRecord();
					}
				}
	}
	return $results;
}

function deletePerson() {
	$results = '';
	if (isset($_POST['delete']) AND $_POST['delete'] == 'Delete') {
		// check the token
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']) {
					$results = array('','Sorry, go back and try again. There was a security issue.', '');
					$badToken = true;
				} else {
					$badToken = false;
					unset($_SESSION['token']);
					
					// Delete the Facility record from the table
					$results = Person::deleteRecord((int) $_POST['id']);
				}
	}
	return $results;
}

function maintFacility() {
	$results = '';
	if (isset($_POST['save']) AND $_POST['save'] == 'Save') {
		// check the token
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']) {
					$results = array('','Sorry, go back and try again. There was a security issue.','');
					$badToken = true;
				} else {
					$badToken = false;
					unset($_SESSION['token']);
					// Put the sanitized variables in an associative array
					// Use the FILTER_FLAG_NO_ENCODE_QUOTES to allow names like O'Connor
					$item  = array (  'id' => (int) $_POST['id'],
							'name' => filter_input(INPUT_POST,'name', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
							'description'  => filter_input(INPUT_POST,'description', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
							'level'  => filter_input(INPUT_POST,'level', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
							'user_name'  => filter_input(INPUT_POST,'user_name', FILTER_SANITIZE_STRING)
					);
					
					// Set up a Person record object based on the posts
					$facility = new Facility($item);
					if ($facility->getId()) {
						$results = $facility->editRecord();
					} else {
						$results = $facility->addRecord();
					}
				}
	}
	return $results;
}

function deleteFacility() {
	$results = '';
	if (isset($_POST['delete']) AND $_POST['delete'] == 'Delete') {
		// check the token
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']) {
					$results = array('','Sorry, go back and try again. There was a security issue.', '');
					$badToken = true;
				} else {
					$badToken = false;
					unset($_SESSION['token']);
					
					// Delete the Facility record from the table
					$results = Facility::deleteRecord((int) $_POST['id']);
				}
	}
	return $results;
}

function maintDiagnosis() {
	$results = '';
	if (isset($_POST['save']) AND $_POST['save'] == 'Save') {
		// check the token
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']) {
					$results = array('','Sorry, go back and try again. There was a security issue.', '');
					$badToken = true;
				} else {
					$badToken = false;
					unset($_SESSION['token']);
					// Put the sanitized variables in an associative array
					// Use the FILTER_FLAG_NO_ENCODE_QUOTES to allow names like O'Connor
					$item  = array (  'id' => (int) $_POST['id'],
							'person_id'   => (int) $_POST['person_id'],
							'diagnosis' => filter_input(INPUT_POST,'diagnosis', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
							'datetime'  => filter_input(INPUT_POST,'datetime', FILTER_SANITIZE_STRING),
							'treatment_id'   => (int) $_POST['treatment_id']
					);
					
					// Set up a Diagnosis item object based on the posts
					$diagnosis = new Diagnosis($item);
					if ($diagnosis->getId()) {
						$results = $diagnosis->editRecord();
					} else {
						$results = $diagnosis->addRecord();
					}
				}
	}
	return $results;
}

function deleteDiagnosis() {
	$results = '';
	if (isset($_POST['delete']) AND $_POST['delete'] == 'Delete') {
		// check the token
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']) {
					$results = array('','Sorry, go back and try again. There was a security issue.', '');
					$badToken = true;
				} else {
					$badToken = false;
					unset($_SESSION['token']);
					
					// Delete the Diagnosis item from the table
					$results = Diagnosis::deleteRecord((int) $_POST['id']);
				}
	}
	return $results;
}

function maintExposure() {
	$results = '';
	if (isset($_POST['save']) AND $_POST['save'] == 'Save') {
		// check the token
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']) {
					$results = array('','Sorry, go back and try again. There was a security issue.', '');
					$badToken = true;
				} else {
					$badToken = false;
					unset($_SESSION['token']);
					// Put the sanitized variables in an associative array
					// Use the FILTER_FLAG_NO_ENCODE_QUOTES to allow names like O'Connor
					$item  = array (  'id' => (int) $_POST['id'],
							'person_id'   => (int) $_POST['person_id'],
							'exposed_person_id'   => (int) $_POST['exposed_person_id'],
							'title' => filter_input(INPUT_POST,'title', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
							'link'  => filter_input(INPUT_POST,'link', FILTER_SANITIZE_STRING),
							'orderby'   => (int) $_POST['orderby'],
							'datetime'      => filter_input(INPUT_POST,'datetime', FILTER_SANITIZE_STRING),
					);
					
					// Set up a Exposure item object based on the posts
					$exposure = new Exposure($item);
					if ($exposure->getId()) {
						$results = $exposure->editRecord();
					} else {
						$results = $exposure->addRecord();
					}
				}
	}
	return $results;
}

function deleteExposure() {
	$results = '';
	if (isset($_POST['delete']) AND $_POST['delete'] == 'Delete') {
		// check the token
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']) {
					$results = array('','Sorry, go back and try again. There was a security issue.', '');
					$badToken = true;
				} else {
					$badToken = false;
					unset($_SESSION['token']);
					
					// Delete the Exposure item from the table
					$results = Exposure::deleteRecord((int) $_POST['id']);
				}
	}
	return $results;
}

function maintTreatment() {
	$results = '';
	if (isset($_POST['save']) AND $_POST['save'] == 'Save') {
		// check the token
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']) {
					$results = array('','Sorry, go back and try again. There was a security issue.', '');
					$badToken = true;
				} else {
					$badToken = false;
					unset($_SESSION['token']);
					// Put the sanitized variables in an associative array
					// Use the FILTER_FLAG_NO_ENCODE_QUOTES to allow names like O'Connor
					$item  = array (  'id' => (int) $_POST['id'],
							'person_id'   => (int) $_POST['person_id'],
							'treatment' => filter_input(INPUT_POST,'treatment', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
							'datetime'      => filter_input(INPUT_POST,'datetime', FILTER_SANITIZE_STRING),
							'location' => filter_input(INPUT_POST,'location', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
							'facility'   => (int) $_POST['facility']
					);
					
					// Set up a Treatment item object based on the posts
					$treatment = new Treatment($item);
					if ($treatment->getId()) {
						$results = $treatment->editRecord();
					} else {
						$results = $treatment->addRecord();
					}
				}
	}
	return $results;
}

function deleteTreatment() {
	$results = '';
	if (isset($_POST['delete']) AND $_POST['delete'] == 'Delete') {
		// check the token
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']) {
					$results = array('','Sorry, go back and try again. There was a security issue.', '');
					$badToken = true;
				} else {
					$badToken = false;
					unset($_SESSION['token']);
					
					// Delete the Treatment item from the table
					$results = Treatment::deleteRecord((int) $_POST['id']);
				}
	}
	return $results;
}