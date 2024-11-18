<?php

if (isset($_POST['type']) && $_POST['type'] === 'concept') {
	$status->update_status($_POST['id'], $_POST['status'], $_POST['type'], $jid);
}


$concepts = $text->get_all_concept();

$awaiting_review = [];
$being_edited = [];
$concept_changes = [];


foreach ($concepts as $concept) {
	if ($current_event == 'Yes' && !hasId($current_event_characters, $concept->characterID)) {
		continue;
	}
	if (isset($_GET['faction']) && $_GET['faction'] != '' && $concept->faction != $_GET['faction']) {
		continue;
	} else {
		if ($concept->status_name === 'requested') {
			$requested[] = $concept;
		}
		if ($concept->status_name === 'being_edited') {
			$being_edited[] = $concept;
		}

		if ($concept->status_name === 'awaiting_review') {
			$awaiting_review[] = $concept;
		}

		if ($concept->status_name === 'changes_requested') {
			$concept_changes[] = $concept;
		}
	}
}

if (!empty($requested)) {
	?>
	<h3>Requested</h3>
	<h4>These players have not started editing their concept first draft.</h4>
		<?php
		$key_values = array_column($requested, 'name');
		array_multisort($key_values, SORT_ASC, $requested);

		foreach ($requested as $empty_concept) {
			include './partials/concept_requested.php';
		}
		?>
	<hr />
	<?php
}

if (!empty($awaiting_review)) {
	?>
	<h3 class="mouse_hover">Awaiting review</h3>
	<?php
	$key_values = array_column($awaiting_review, 'name');
	array_multisort($key_values, SORT_ASC, $awaiting_review);

	foreach ($awaiting_review as $awaiting) {
		include './partials/concept_review.php';
	}
	echo '<hr />';
}
if (!empty($being_edited)) {
	?>
	<h3>Being edited</h3>
	<?php
	$key_values = array_column($being_edited, 'name');
	array_multisort($key_values, SORT_ASC, $being_edited);

	foreach ($being_edited as $edited) {
		include './partials/concept_edited.php';
	}
	echo '<hr />';
}

if (!empty($concept_changes)) {
	?>
	<h3>Concept changes requested</h3>
	<?php
	$key_values = array_column($concept_changes, 'name');
	array_multisort($key_values, SORT_ASC, $concept_changes);

	foreach ($concept_changes as $edited) {
		include './partials/concept_change_requested.php';
	}
}
