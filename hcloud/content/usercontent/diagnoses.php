<?php
/**
 * diagnoses.php
 *
 * Content for diagnoses page
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

$items = Diagnosis::getRecords();
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
		<p>Person's Diagnosis
	</div>
	<div class="user-content-page-text">
		<div class="my-account-figure">
			signs and symptoms
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
		        <p>Diagnosis: <?php echo htmlspecialchars($item->getDiagnosis()); ?><br />
		        Date: <?php echo htmlspecialchars($item->getDatetime()); ?><br />
		      </li>
		    <?php endforeach; ?>
		</ul>
	</div>
</div>