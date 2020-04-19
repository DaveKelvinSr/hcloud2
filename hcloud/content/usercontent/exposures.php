<?php
/**
 * exposures.php
 *
 * Content for exposures page
 *
 *
 *@version		1.0 2020
 *@package		hcloud
 *@copyright	Copyright (c) 2020 hcloud
 *@license		GNU General Public License
 *@since		Since Release 1.0
 *@author		David Kelvin Biketi
 */
// Get the contact information

$items = Exposure::getRecords();
$accessLevel = Person::accessLevel();
?>
<div class="user-content-width">
	<div class="user-content-page-avatar-container">
		<div class="user-content-page-avatar">
			<img alt="" src="images/general/avatarmale.jpg">
		</div>
	</div>
	<div class="user-content-page-name-container">
		<p class="name">
	</div>
	<div class="user-content-page-header">
		<p>Potential Cases
	</div>
	<div class="user-content-page-text">
		<div class="my-account-figure">
			Exposed persons
		</div>
		<div class="add-button">
		    <?php if ($accessLevel == 'Admin') : ?>
		      <div class="button-container"><a class="button" href="index.php?content=usercontainer&userContent=accountmaint&id=0">Add</a></div>
		    <?php endif; ?>
		</div>
		<ul class="user-content-page-text-list">
		    <?php foreach ($items as $i=>$item) : ?>
		    <?php $item2 = Person::getRecord($item->getPersonId())?>
		    <?php $item3 = Person::getRecord($item->getExposedPersonId())?>
		      <li class="my-accounts-text-item">
		        <p>Confirmed case: <?php echo htmlspecialchars($item2->getFirst_name()). " ". htmlspecialchars($item2->getLast_name()); ?>
		        <?php if ($accessLevel == 'Admin') : ?>
		        <div class="button-container">
		          <a class="button" 
		            href="index.php?content=usercontainer&userContent=accountdelete&id=<?php echo setContent($item, 'id'); ?>">Delete</a>
		          <a class="button" 
		            href="index.php?content=usercontainer&userContent=accountmaint&id=<?php echo setContent($item, 'id'); ?>">Edit</a>
		         </div>
		        <?php endif; ?>
		        </h2>
		        <p>Exposed person: <?php echo htmlspecialchars($item3->getFirst_name()). " ". htmlspecialchars($item3->getLast_name()); ?>

		      </li>
		    <?php endforeach; ?>
		</ul>
	</div>
</div>