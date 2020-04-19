<?php
/**
 * exposuremaint.php
 *
 * Maintain the exposure table
 *
 *@version		1.0 2020
 *@package		hcloud
 *@copyright	Copyright (c) 2020 hcloud
 *@license		GNU General Public License
 *@since		Since Release 1.0
 *@author		David Kelvin Biketi
 */
$accessLevel = true;//Person::accessLevel();
if ($accessLevel != 'Admin') :
echo 'Sorry, no access allowed to this page';
else :
$id = 0;
if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];
}
// Is this an existing item or a new one?
if ($id) {
	// Get the existing information for an existing item
	$item = Person::getRecord($id);
} else {
	// Set up for a new item
	$item = new Person;
}
// set up the access dropdown,
// setting up the selected option for existing records
$access_dropdown = $item->getAccess_DropDown();
?>

<div class="user-content-width">
	<div class="user-content-page-header">
		<p>Account maintenance
	</div>
	
	<form action="index.php?content=usercontainer&userContent=accounts" method="post" name="maint" class="maint">
	
	  <fieldset class="maintform">
		<legend><?php echo ($id) ? htmlspecialchars(setContent($item, 'first_name')) : 'Add a contact'; ?></legend>

	      <p><label for="first_name" class="required">First Name</label><br />
	        <input type="text" name="first_name" id="first_name" class="required" 
	        value="<?php echo htmlspecialchars($item->getFirst_name()); ?>" />
	      <p><label for="last_name" class="required">Last Name</label><br />
	        <input type="text" name="last_name" id="last_name" class="required" 
	        value="<?php echo htmlspecialchars($item->getLast_name()); ?>" />
	      <p><label for="bloodgroup">Bloodgroup</label><br />
	        <input type="text" name="bloodgroup" id="bloodgroup" class="required" 
	        value="<?php echo htmlspecialchars($item->getBloodgroup()); ?>" />
	      <p><label for="email" >Email</label><br />
	        <input type="text" name="email" id="email" 
	        value="<?php echo htmlspecialchars($item->getEmail()); ?>" />
	      <p><label for="phone" >Phone</label><br />
	        <input type="text" name="phone" id="phone" 
	        value="<?php echo htmlspecialchars($item->getPhone()); ?>" />
	      <p><label for="user_name" class="required">User Name</label><br />
	        <input type="text" name="user_name" id="user_name"  
	        value="<?php echo htmlspecialchars($item->getUser_name()); ?>" />
	      <p><label for="password1" >New Password</label><br />
	        <input type="password" name="password1" id="password1" autocomplete="off" />
	      <p><label for="password2" >Confirm Password</label><br />
	        <input type="password" name="password2" id="password2" autocomplete="off" />
	      <p><?php echo $access_dropdown; ?>
	
	    <?php 
	    // create token
	    $salt = 'SomeSalt';
	    $token = sha1(mt_rand(1,1000000) . $salt); 
	    $_SESSION['token'] = $token;
	    ?>
	    <input type="hidden" name="id" id="id" value="<?php echo $item->getId(); ?>" />
	    <input type="hidden" name="task" id="task" value="account.maint" />
	    <input type='hidden' name='token' value='<?php echo $token; ?>'/>
	    <p><input type="submit" name="save" value="Save" class="submit"/>
	    <p class="cancelcont"><a class="cancel" href="index.php?content=usercontainer&userContent=accounts">Cancel</a>
	    
	  </fieldset>
	</form>
</div>
<?php endif; 