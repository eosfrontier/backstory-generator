<hr />
<h2>Backstory</h2>
<h3><span>Status</span> <?php echo $backstory->status_description; ?></h3>
<div class="text">
	<div class="text-container">
		<?php echo $backstory->content; ?>
	</div>
	<?php
		$edit_status = [
			'requested',
			'being_edited',
			'changes_requested',
		];

		if ( in_array( $backstory->status_name, $edit_status, true ) ) {
			?>
	<button class="edit-backstory-button button button--secondary">
		Edit backstory
	</button>
	<?php }; ?>
	<?php if ( $backstory->status_name === 'being_edited' ) { ?>
	<form method="POST">
		<input type="hidden" name="type" value="backstory" />
		<input type="hidden" name="status" value="awaiting_review" />
		<button class="submit-backstory button button--primary">Submit backstory</button>
	</form>
	<?php } ?>
	<?php if ( $backstory->status_name === 'awaiting_review' ) { ?>
	<form method="POST">
		<input type="hidden" name="type" value="backstory" />
		<input type="hidden" name="status" value="being_edited" />
		<button class="submit-backstory button button--primary">Go back to editing</button>
	</form>
	<?php } ?>
</div>
<div id="backstory-editor">
	<form method="post">
		<textarea name="backstory-content" id="backstory-textarea">
			<?php echo $backstory->content; ?>
		</textarea>
		<button>Save</button>
	</form>
</div>
