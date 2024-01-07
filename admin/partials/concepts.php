<?php

if ( isset( $_POST['type'] ) && $_POST['type'] === 'concept' ) {
	$status->update_status( $_POST['id'], $_POST['status'], $_POST['type'], $jid );
	if ( $_POST['status'] === 'approved' ) {
		$status->update_status( $_POST['id'], 'approved', 'concept', $jid );
	}
}

$concepts = $text->get_all_concept();

$awaiting_review = [];
$being_edited    = [];
$concept_changes = [];


foreach ( $concepts as $concept ) {
	if ( $current_event == 'Yes' && ! hasId( $current_event_characters, $concept->characterID ) ) {
		continue;
	}
	if ( isset( $_GET['faction'] ) && $_GET['faction'] != '' && $concept->faction != $_GET['faction'] ) {
		continue;
	} else {
		if ( $concept->status_name === 'being_edited' ) {
			$being_edited[] = $concept;
		}

		if ( $concept->status_name === 'awaiting_review' ) {
			$awaiting_review[] = $concept;
		}

		if ( $concept->status_name === 'changes_requested' ) {
			$concept_changes[] = $concept;
		}
	}
}

?>
<h3>Awaiting review</h3>
<?php
if ( ! empty( $awaiting_review ) ) {
	$key_values = array_column( $awaiting_review, 'name' );
	array_multisort( $key_values, SORT_ASC, $awaiting_review );

	foreach ( $awaiting_review as $awaiting ) {
		include './partials/concept_review.php';
	}
}
?>
<hr />
<h3>Being edited</h3>
<?php
if ( ! empty( $being_edited ) ) {
	$key_values = array_column( $being_edited, 'name' );
	array_multisort( $key_values, SORT_ASC, $being_edited );

	foreach ( $being_edited as $edited ) {
		include './partials/concept_edited.php';
	}
}
?>
<hr />
<h3>Concept changes requested</h3>
<?php
if ( ! empty( $concept_changes ) ) {
	$key_values = array_column( $concept_changes, 'name' );
	array_multisort( $key_values, SORT_ASC, $concept_changes );

	foreach ( $concept_changes as $edited ) {
		include './partials/concept_edited.php';
	}
}
?>
