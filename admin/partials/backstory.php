<?php

if (isset($_POST['type']) && $_POST['type'] === 'backstory') {
	$status->update_status($_POST['id'], $_POST['status'], $_POST['type'], $jid);
	if ($_POST['status'] === 'approved') {
		$status->update_status($_POST['id'], 'approved', 'backstory', $jid);
	}
}

$backstories = $text->get_all_backstory();

$backstory_requested = [];
$awaiting_review = [];
$being_edited = [];
$backstory_changes = [];

foreach ($backstories as $backstory) {
	if ($current_event === 'Yes' && !hasId($current_event_characters, $backstory->characterID)) {
		continue;
	}
	if (isset($_GET['faction']) && $_GET['faction'] != '' && $backstory->faction != $_GET['faction']) {
		continue;
	} else {
		if ($backstory->backstory_status === 'requested') {
			$concept = $text->get_concept($backstory->characterID);
			if ($concept->status_name == 'approved') {
				$backstory_requested[] = $concept;
			}
		}

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

if (!empty($requested)) {
	?>
	<div class="status-block">
		<h3 class="mouse_hover">Requested (click to expand)</h3>
		<div class="admin_concept_edit">
			<h5>These characters have an approved concept. They have been requested to provide a backstory submission.</br>
				Here you can review their approved CONCEPT.</h5>
			<?php
			$key_values = array_column($requested, 'name');
			array_multisort($key_values, SORT_ASC, $requested);

			foreach ($backstory_requested as $request) {
				include './partials/backstory_requested.php';
			}
			?>
		</div>
	</div>
	<hr />
	<?php
}

if (!empty($awaiting_review)) {
	?>
	<div class="status-block">
		<h3 class="mouse_hover">Awaiting review (click to expand)</h3>
		<div class="admin_concept_edit">
			<?php
			$key_values = array_column($awaiting_review, 'name');
			array_multisort($key_values, SORT_ASC, $awaiting_review);

			foreach ($awaiting_review as $awaiting) {
				include './partials/backstory_review.php';
			}
			?>
		</div>
	</div>
	<hr />
	<?php
}
if (!empty($being_edited)) {
	?>
	<div class="status-block">
		<h3 class="mouse_hover">Being Edited (click to expand)</h3>
		<div class="admin_concept_edit">
			<?php
			$key_values = array_column($being_edited, 'name');
			array_multisort($key_values, SORT_ASC, $being_edited);

			foreach ($being_edited as $edited) {
				include './partials/backstory_edited.php';
			}
			?>
		</div>
	</div>
	<?php
	if(!empty($backstory_changes)){
		echo '<hr />';
	}
}

if (!empty($backstory_changes)) {
	?>
	<div class="status-block">
		<h3 class="mouse_hover">Backstory changes requested (click to expand)</h3>
		<div class="admin_concept_edit">
			<?php
			$key_values = array_column($backstory_changes, 'name');
			array_multisort($key_values, SORT_ASC, $backstory_changes);

			foreach ($backstory_changes as $backstory_change) {
				include './partials/backstory_change_requested.php';
			}
			?>
		</div>
	</div>
	<?php
}
?>