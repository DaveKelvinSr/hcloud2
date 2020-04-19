<?php
/**
 * diagnosisdelete.php
 *
 * Delete the Diagnosis 
 * 
 *@version		1.0 2020
 *@package		hcloud
 *@copyright	Copyright (c) 2020 hcloud
 *@license		GNU General Public License
 *@since		Since Release 1.0
 *@author		David Kelvin Biketi
 */
$accessLevel = Person::accessLevel();
if ($accessLevel == 'Admin') :
echo 'Sorry, no access allowed to this page';
else :

$id = (int) $_GET['id'];
// Get the existing information for an existing item
$item = Person::getRecord($id); //var_dump($item);
?>
<div class="user-content-width">
	<div class="user-content-page-header">
		<p>Delete an account
	</div>
	<form action="index.php?content=usercontainer&userContent=accounts" method="post" name="maint" class="maint">
	
	  <fieldset class="maintform">
	    <legend><?php echo $id;?></legend>
	    <ul>
		      <p><strong>First Name:</strong>
		        <?php echo htmlspecialchars($item->getFirst_name()); ?></li>
		      <p><strong>Last Name:</strong> 
		        <?php echo htmlspecialchars($item->getLast_name()); ?></li>
		      <p><strong>Position:</strong> 
		        <?php echo htmlspecialchars($item->getBloodgroup()); ?></li>
		      <p><strong>Email:</strong>
		        <?php echo htmlspecialchars($item->getEmail()); ?></li>
		      <p><strong>Phone:</strong>
		        <?php echo htmlspecialchars($item->getPhone()); ?></li>
	    </ul>
	
	    <?php 
	    // create token
	    $salt = 'SomeSalt';
	    $token = sha1(mt_rand(1,1000000) . $salt); 
	    $_SESSION['token'] = $token;
	    ?>
	    <input type="hidden" name="id" id="id" value="<?php echo $item->getId(); ?>" />
	    <input type="hidden" name="task" id="task" value="account.delete" />
	    <input type='hidden' name='token' value='<?php echo $token; ?>'/>
	    <p><input type="submit" name="delete" value="Delete" class="submit"/>
	    <p class="cancelcont"><a class="cancel" href="index.php?content=usercontainer&userContent=accounts">Cancel</a>
	  </fieldset>
	</form>
</div>
<?php endif; 