<?php 

// set up the access dropdown,
// setting up the selected option for existing records
//$access_dropdown = Person::getAccess_DropDown();
?>

<div class="user-content-width">
	<form action="" method="post" name="maint" class="maint">
		<fieldset class="maintform">
			<legend>Sign in</legend>
			<p><input type="text" name="first_name" id="first_name" class="required" placeholder="First name" />
			<p><input type="text" name="last_name" id="last_name" class="required" placeholder="Last name" />
			<p><input type="text" name="email" id="email" class="required" placeholder="Email" />
			<p><input type="text" name="phone" id="phone" class="required" placeholder="phone" />
			<p><input type="text" name="user_name" id="user_name" class="required" placeholder="User name" />
			<p><input type="password" name="password1" id="password" class="required" placeholder="Enter your password" />
			<p><input type="password" name="password2" id="password" class="required" placeholder="Enter your password again" />
			<p><select name="access" id="access">
				<?php //echo $access_dropdown; ?></li>
			<?php 
			// create token
			$salt = 'SomeSalt';
			$token = sha1(mt_rand(1,1000000) . $salt);
			$_SESSION['token'] = $token;
			?>
   			<input type="hidden" name="id" id="id" value="" />
			<input type="hidden" name="task" id="task" value="signin" />
			<input type="hidden" name="token" value="<?php echo $token; ?>" />
			<p><input type="submit" name="save" value="Save" class="submit" />
			<p class="cancelcont"><a class="cancel" href="index.php">Cancel, return to home</a>
		</fieldset>
	</form>
</div>