<div class="concept">
	<h2>Concept</h2>
	<div class="concept-text">
		<?php echo $concept->content; ?>
		<button class="edit-concept-button">
			Edit backstory
		</button>
	</div>
	<div id="concept-editor">
		<form method="post">
			<textarea name="concept-content" id="concept-textarea"><?php echo $concept->content; ?></textarea>
			<button>Save</button>
		</form>
		<button class="view-button">View text</button>
	</div>
</div>
