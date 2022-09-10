<div class="concept">
	<h2>Concept</h2>
	<h3>Status: <?php echo $concept->status_description; ?></h3>
	<div class="concept-text">
		<?php
		echo $concept->content;
		if ( $concept->status_name !== 'approved' ) {
			?>
		<button class="edit-concept-button">
			Edit Concept
		</button>
		<?php } ?>
	</div>
	<?php
	if ( $concept->status_name !== 'approved' ) {
		?>
	<div id="concept-editor">
		<form method="post">
			<textarea name="concept-content" id="concept-textarea"><?php echo $concept->content; ?></textarea>
			<button>Save</button>
		</form>
		<button class="view-button">View text</button>
	</div>
	<?php } ?>
</div>
