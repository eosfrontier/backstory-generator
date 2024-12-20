<div class="concept">
	<h2>Concept - <?php echo $character->get_character_name($id); ?></h2>
	<h3><span>Status</span>:
		<?php echo $concept->status_description; ?>
	</h3>
	<div class="concept-text">
		<?php
		if ($concept->status_name !== 'approved') {
			echo "Please submit your character concept; a fundamental idea or description that outlines the key aspects of your
						proposed in-game persona, offering a concise idea of who the character is, their goals, and their
						distinguishing traits. This should not exceed 1-2 paragraphs. Once the SLs have approved your basic concept,
						you will then be asked to submit your character's full backstory.";
		}
		?>
		<h4>Concept:</h4>
		<?php
		echo '<div class="content-block">';
		echo $concept->content;
		echo '</div>';
		if (isset($concept->concept_comment) && $concept->concept_comment != '') {
			echo '<h4>Concept approval comment:</h4>';
			echo '<div class="content-block">';
			echo $concept->concept_comment;
			echo '</div>';
		}
		if ($concept->concept_changes && $concept->status_name !== 'approved') {
			?>
			<h4>Requested changes:</h4>
			<?php
			echo '<div class="content-block">';
			echo $concept->concept_changes;
			echo '</div>';
		}
		$edit_status = [
			'requested',
			'being_edited',
			'changes_requested',
		];

		if (in_array($concept->status_name, $edit_status, true)) {
			?>
			<button class="edit-concept-button button button--secondary">
				Edit Concept
			</button>
		<?php } ?>
	</div>
	<?php if (in_array($concept->status_name, $edit_status, true)) { ?>
		<form method="POST">
			<input type="hidden" name="type" value="concept" />
			<input type="hidden" name="status" value="awaiting_review" />
			<button class="submit-backstory button button--primary">Submit Concept</button>
		</form>
	<?php } ?>
	<?php if ($concept->status_name === 'awaiting_review') { ?>
		<form method="POST">
			<input type="hidden" name="type" value="concept" />
			<input type="hidden" name="status" value="being_edited" />
			<button class="submit-backstory button button--primary">Go back to editing</button>
		</form>
	<?php } ?>
	<?php
	if ($concept->status_name !== 'approved') {
		?>
		<div id="concept-editor">
			<form method="post">
				<textarea name="concept-content" id="concept-textarea">
							<?php echo $concept->content; ?>
						</textarea>
				<input type="hidden" name="type" value="concept" />
				<input type="hidden" name="status" value="being_edited" />
				<button class="button button--primary">Save Draft</button>
			</form>
		</div>
	<?php } ?>
</div>