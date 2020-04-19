<div class="user-content-width">
	<form action="index.php?content=usercontainer&userContent=request" method="post" name="maint" class="maint">
		<fieldset class="maintform">
			<legend>Log in</legend>
			<p><input type="text" name="user_name" id="user_name" class="required" placeholder="User name" />
			<p><input type="password" name="password" id="password" class="required" placeholder="Password" />
			
			<?php 
			// create token
			$salt = 'SomeSalt';
			$token = sha1(mt_rand(1,1000000) . $salt);
			$_SESSION['token'] = $token;
			?>
			<input type="hidden" name="task" id="task" value="login" />
			<input type="hidden" name="token" value="<?php echo $token; ?>" />
			<p><input type="submit" name="login" value="Login" class="submit" />
			<p class="cancelcont"><a class="cancel" href="index.php">Cancel, return to home</a>
			<p class="cancelcont"><a class="cancel" href="index.php?content=usercontainer&userContent=signin">I don't have an account!!</a>
		</fieldset>
	</form>
</div>