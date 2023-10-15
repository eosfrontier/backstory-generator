<div class="concept">
	<h2>Concept</h2>
	<h3><span>Status</span>:
		<?php echo $concept->status_description; ?>
	</h3>
	<div class="concept-text">
		<h4>Concept:</h4>
		<?php
		echo $concept->content;
		if ($concept->concept_changes && $concept->status_name !== 'approved') {
			?>
			<h4>Requested changes</h4>
			<?php
			echo $concept->concept_changes;
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
			<!-- <input type="hidden" name="id" value="<?php echo $awaiting->characterID; ?>"> -->
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
				<textarea name="concept-content" id="concept-textarea"><?php echo $concept->content; ?></textarea>
				<button class="button button--primary">Save</button>
			</form>
		</div>
	<?php } ?>
</div>