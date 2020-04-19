<?php
/**
 *index.php
 *
 *Main File
 *
 *@version		1.0 2020
 *@package		hcloud
 *@copyright	Copyright (c) 2020 hcloud
 *@license		GNU General Public License
 *@since		Since Release 1.0
 *@author		David Kelvin Biketi
 */

//Require https
if ($_SERVER['HTTPS'] != "on") {
	$url = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	header("Location: $url");
	exit;
}

require 'includes/init/init.php';

$logged_in = Person::isLoggedIn();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Medicine">
		<meta name="keywords" content="doctor, treatment, illness">
		<meta name="author" content="David Kelvin Biketi">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="images/general/flogo2.png">
		<title>H-cloud</title>
		
		<link rel="stylesheet" media="all" type="text/css" href="css/main.css">
		<script  src="js/canvas.js"></script>
	</head>
	<body>
		<div id="home-container">
			<div id="home">
				<div id="background">
					<div class="background-theme">
						<img alt="" src="images/general/adult-blur-clean-foam.jpg">
					</div>
					<div class="background-theme">
						<img alt="" src="images/general/Surgical-Masks.jpg">
					</div>
					<div class="background-theme">
						<img alt="" src="images/general/depositphotos_63774055-stock-video-flu-symptoms.jpg">
					</div>
				</div>
				<div class="contents">
					<div class="home-contents contents-size">
						<div id="header-container">
							<div id="header">
								<h1>H-cloud <img alt="" src="images/general/flogo2.png"></h1>
							</div>
							<div id="nav">
								<ul class="mainnav">
									<li><a href="index.php">Home</a>
									<li><a href="index.php#section-4">About us</a>
									<li><a href="index.php#section-5">Contact us</a>
									<li><a href="index.php?content=usercontainer&userContent=accounts">Accounts</a>
									<li><a href="index.php?content=usercontainer&userContent=diagnoses">Diagnoses</a>
									<li><a href="index.php?content=usercontainer&userContent=facilities">Facilities</a>
									<li><a href="index.php?content=usercontainer&userContent=exposures">Exposures</a>
									<li><a href="index.php?content=usercontainer&userContent=treatments">Treatments</a>
									<?php //echo setSpMenu(); /*Menu::setLoggedOutMenu();*/ 
									if ($logged_in) :
									?>
									<li><a href="index.php?content=usercontainer&userContent=request">My mobicure</a>
									<?php endif; ?>
								</ul>
							</div>
						</div>
						<div id="homepage-text-container">
							<div id="homepage-text">
								<div class="homepage-theme-text">
									<p>Wash your hands regularly.
									<p class=small-text>Keep safe from viruses!!
								</div>
								<div class="homepage-theme-text">
									<p>Put on masks in public areas. 
									<p class=small-text>Prevent infections from tiny droplets!!
								</div>
								<div class="homepage-theme-text">
									<p>Isolate and get a medical check up.
									<p class=small-text>Whenever you show symptoms!!
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="arrows-container">
				<a href="#section-2">
					<div class="arrows">
						<div class="arrow down-arrow"></div>
					</div>
				</a>
			</div>
		</div>
		<div class = "section-container" id="section-2">
			<div class="section">
				<div class="background">
					<div class="background-theme">
						<img alt="" src="images/general/AB-Test.jpg">
					</div>
				</div>
				<div class="contents">
					<div class="section-contents contents-size">
						<div class="section-header-container">
							<div class="header">
								<div class="title">
									<h1>Secure accessible and efficient!!</h1>
								</div>
								<div class="name">
									<img alt="" src="images/general/greenleafnobg.png">
								</div>
							</div>
						</div>
						<div class="section-text-container">
							<div class="section-text">
								<p>This is a health data repository where persons health information is stores and accessed from any
								medical facility in the system for consistency, security and efficient services. This will always 
								the necessary prior information to any health services offered to persons.
								<p>For contagious infections such as the current COVID-19 pandemic, exposed persons records will 
								provide tracking for testing and monitoring the subjects.
								<p>Welcome!!
							</div>
							<div class="section-image">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="arrows-container">
				<a href="#section-3">
					<div class="arrows">
						<div class="arrow down-arrow"></div>
					</div>
				</a>
			</div>
		</div>
		<div class = "section-container" id="section-3">
			<div class="section">
				<div class="background">
					<div class="background-theme">
						<img alt="" src="images/general/medicine-wallpapers_292085343.jpg">
					</div>
				</div>
				<div class="contents">
					<div class="section-contents contents-size">
						<div class="section-header-container">
							<div class="header">
								<div class="title">
									<h1>Get Started!!</h1>
								</div>
								<div class="name">
									<img alt="" src="images/general/greenleafnobg.png">
								</div>
							</div>
						</div>
						<div class="section-text-container">
							<div class="section-text">
								<p>You can check your personal medical records and keep track of medications as well as get 
								and review the necessary medical information and consult health care professionals who can 
								as well follow up persons' health.
								<p>With hcloud, monitoring and care is made easier
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="arrows-container">
				<a href="#section-4">
					<div class="arrows">
						<div class="arrow down-arrow"></div>
					</div>
				</a>
			</div>
		</div>
		<div class = "section-container" id="section-4">
			<div class="section">
				<div class="background">
					<div class="background-theme">
						<img alt="" src="images/general/13969.jpg">
					</div>
				</div>
				<div class="contents">
					<div class="section-contents contents-size">
						<div class="section-header-container">
							<div class="header">
								<div class="title">
									<h1></h1>
								</div>
								<div class="name">
									<img alt="" src="images/general/greenleafnobg.png">
								</div>
							</div>
						</div>
						<div class="section-text-container">
							<div class="section-text">
								<p>hcloud brings together all the medical facilites into one major virtual 
								medical facility with information being easily shared across the facilities while making it 
								easier for persons to be serviced by health practitioners in the most subtle way.
								<p>hcloud is a project by David and Emma.
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="arrows-container">
				<a href="#section-5">
					<div class="arrows">
						<div class="arrow down-arrow"></div>
					</div>
				</a>
			</div>
		</div>
		<div class = "section-container" id="section-5">
			<div class="section">
				<div class="background">
					<div class="background-theme">
						<img alt="" src="images/general/erythrocyte_plasma_blood_composition_18334_1920x1080.jpg">
					</div>
				</div>
				<div class="contents">
					<div class="section-contents contents-size">
						<div class="section-header-container">
							<div class="header">
								<div class="title">
									<h1></h1>
								</div>
								<div class="name">
									<img alt="" src="images/general/greenleafnobg.png">
								</div>
							</div>
						</div>
						<div class="section-text-container">
							<div class="section-text">
								<p>hcloud.
								<p>Address, 3218-00200.
								<p>Telephone, 0725737217
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="user-container">
			<?php 
			if (isset($_GET['content'])) {
				loadContent('content', 'usercontainer');
			}
			?>
		</div>
		<div id="clearfooter"></div>
		<footer>
    		<div id="footercopyright">
	    		<p>&#169 <?php echo date('Y'); ?>. All Rights Reserved.
	    		<p class="maker">hcloud.
    		</div>
		</footer>
		</div>
		<script type="text/javascript">

		
			// Listen to the onload event, then create a game world
			window.onload = function () {
				var gameWorld = new GameWorld('canvas');
			}	


			// Background
			var myIndex = 0;
			var myTextIndex = 0;
			homeTheme();	
			
			function homeTheme() {
			    var i;
			    var j;
			    var xdiv = document.getElementById("background");
			    var x = xdiv.getElementsByClassName("background-theme");
			    //var x = document.getElementsByClassName("multibackgroundthemeset");
			    var ydiv = document.getElementById("homepage-text");
			    var y = ydiv.getElementsByClassName("homepage-theme-text");
			    var xnum = x.length;
			    var ynum = y.length;
			    //if (ynum > 1) { //(xnum > 1) {
			    if (xnum > 1) {
				    for (i = 0; i < x.length; i++) {
				       x[i].style.opacity = "0";
				    }
				    myIndex++;
				    if (myIndex > x.length) {myIndex = 1}    
				    x[myIndex-1].style.opacity = "1";
			    } else {
			    	x[0].style.opacity = "1";
			    }
			    
				if (ynum > 1) {
				    for (j = 0; j < y.length; j++) {
				       y[j].style.display = "none";
					   y[j].style.left = "100%";  
					}
				    myTextIndex++;
				    if (myTextIndex > y.length) {myTextIndex = 1}
				    y[myTextIndex-1].style.display = "block";
				    setTimeout(function() {y[myTextIndex-1].style.left = "0"; }, 100);  
				} else {
					y[0].style.display = "block";
					y[0].style.left = "0";
				}
				
				setTimeout(homeTheme, 5000); // Change image every 5 seconds
			}
		</script>
	</body>
</html>