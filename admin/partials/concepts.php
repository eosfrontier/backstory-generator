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
	<div class="status-block">
		<h3 class="mouse_hover">Requested (click to expand)</h3>
		<div class="admin_concept_edit">
			<?php
			$key_values = array_column($requested, 'name');
			array_multisort($key_values, SORT_ASC, $requested);

			foreach ($requested as $empty_concept) {
				include './partials/concept_requested.php';
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
				include './partials/concept_review.php';
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
		<h3 class="mouse_hover">Being edited (click to expand)</h3>
		<div class="admin_concept_edit">
			<?php
			$key_values = array_column($being_edited, 'name');
			array_multisort($key_values, SORT_ASC, $being_edited);

			foreach ($being_edited as $edited) {
				include './partials/concept_edited.php';
			}
			?>
		</div>
	</div>
	<hr />
	<?php
}

if (!empty($concept_changes)) {
	?>
	<div class="status-block">
		<h3 class="mouse_hover">Concept changes requested (click to expand)</h3>
		<div class="admin_concept_edit">
			<?php
			$key_values = array_column($concept_changes, 'name');
			array_multisort($key_values, SORT_ASC, $concept_changes);

			foreach ($concept_changes as $edited) {
				include './partials/concept_change_requested.php';
			}
			?>
		</div>
	</div>
	<?php
}
