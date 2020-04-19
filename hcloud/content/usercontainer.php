<?php 
// Initialize message coming in
$message = setMessage();
?>
<div id ="user-contents" class="contents-size">
	<div id="user-contents-canvas">
		<canvas width="2160" height="4320" id="canvas">
			</canvas>
	</div>
	<div class="user-contents-contents">
		<div class="user-contents-content">
			<div class="user-content">
				<div class="user-header-container user-content-width">
					<div class="user-header">
						<div class="user-title">
							<h1>H-cloud</h1>
						</div>
						<div class="user-name">
							<img alt="" src="images/general/flogo2.png">
						</div>
					</div>
					<div class="user-nav">
						<ul class="mainnav">
							<?php //echo setMenu(); /*Menu::setLoggedInMenu();*/ ?>
						</ul>
					</div>
					<div class="user-message">
							<?php echo $message ?>
					</div>
				</div>
				<div class="user-info-container">
					<div class="user-info">
						<?php loadUserContent('userContent', 'login') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>