<?php
/**
 * treatments.php
 *
 * Content for treatments page
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

$items = Treatment::getRecords();
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
		<p>Treatments
	</div>
	<div class="user-content-page-text">
		<div class="my-account-figure">
			Treatment records
		</div>
		<div class="add-button">
		    <?php if ($accessLevel == 'Admin') : ?>
		      <div class="button-container"><a class="button" href="index.php?content=usercontainer&userContent=accountmaint&id=0">Add</a></div>
		    <?php endif; ?>
		</div>
		<ul class="user-content-page-text-list">
		    <?php foreach ($items as $i=>$item) : ?>
		    <?php $item2 = Person::getRecord($item->getPersonId())?>
		      <li class="my-accounts-text-item">
		        <p><?php echo htmlspecialchars($item2->getFirst_name()). " ". htmlspecialchars($item2->getLast_name()); ?>
		        <?php if ($accessLevel == 'Admin') : ?>
		        <div class="button-container">
		          <a class="button" 
		            href="index.php?content=usercontainer&userContent=accountdelete&id=<?php echo setContent($item, 'id'); ?>">Delete</a>
		          <a class="button" 
		            href="index.php?content=usercontainer&userContent=accountmaint&id=<?php echo setContent($item, 'id'); ?>">Edit</a>
		         </div>
		        <?php endif; ?>
		        </h2>
		        <p>Treatment: <?php echo htmlspecialchars($item->getTreatment()); ?><br />
		        Date: <?php echo htmlspecialchars($item->getDatetime()); ?><br />
		        Location: <?php echo htmlspecialchars($item->getLocation()); ?><br /></p>
		      </li>
		    <?php endforeach; ?>
		</ul>
	</div>
</div>