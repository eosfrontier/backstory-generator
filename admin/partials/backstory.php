<?php

if (isset($_POST['type']) && $_POST['type'] === 'backstory') {
	$status->update_status($_POST['id'], $_POST['status'], $_POST['type']);
	if ($_POST['status'] === 'approved') {
		$status->update_status($_POST['id'], 'approved', 'backstory', $jid);
	}
}

$backstorys = $text->get_all_backstory();

$awaiting_review = [];
$being_edited = [];
$backstory_changes = [];

foreach ($backstorys as $backstory) {
	if ( $current_event == "Yes" && !hasId($current_event_characters, $backstory->characterID) ) {
		continue;
	}
	if (isset($_GET['faction']) && $_GET['faction'] != "" && $backstory->faction != $_GET['faction']) {
		continue;
	} else {
		if ($backstory->backstory_status === 'being_edited') {
			$being_edited[] = $backstory;
		}

		if ($backstory->backstory_status === 'awaiting_review') {
			$awaiting_review[] = $backstory;
		}

		if ($backstory->backstory_status === 'changes_requested') {
			$backstory_changes[] = $backstory;
		}
	}
}

?>
<h3>Awaiting review</h3>
<?php
if (!empty($awaiting_review)) {
	$key_values = array_column($awaiting_review, 'name');
	array_multisort($key_values, SORT_ASC, $awaiting_review);

	foreach ($awaiting_review as $awaiting) {
		include './partials/backstory_review.php';
	}
}
?>
<hr />
<h3>Being edited</h3>
<?php
if (!empty($being_edited)) {
	$key_values = array_column($being_edited, 'name');
	array_multisort($key_values, SORT_ASC, $being_edited);

	foreach ($being_edited as $edited) {
		include './partials/backstory_edited.php';
	}
}
?>
<hr />
<h3>Backstory changes requested</h3>
<?php
if (!empty($backstory_changes)) {
	$key_values = array_column($backstory_changes, 'name');
	array_multisort($key_values, SORT_ASC, $backstory_changes);

	foreach ($backstory_changes as $edited) {
		include './partials/backstory_edited.php';
	}
}
?>
