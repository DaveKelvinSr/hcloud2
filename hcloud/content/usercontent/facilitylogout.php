<div class="logout-contents user-content-width">
	<form action="index.php" method="post" name="maint" class="maint">
		<fieldset class="maintform">
			<legend>Log out</legend>
			<p>You want to logout <?php echo isset($_SESSION['first_name']) ? ', ' . $_SESSION['first_name'] : ''; ?>?
			
			<?php 
			// create token
			$salt = 'SomeSalt';
			$token = sha1(mt_rand(1,1000000) . $salt);
			$_SESSION['token'] = $token;
			?>
			<input type="hidden" name="task" id="task" value="logout" />
			<input type="hidden" name="token" value="<?php echo $token; ?>" />
			<p><input type="submit" name="logout" value="Logout" class="submit" />
			<p class="cancelcont"><a class="cancel" href="index.php?content=usercontainer&userContent=request"></a>
		</fieldset>
	</form>
</div>