	<h2>Backstory</h2>
	<div class="text">
		<div class="text-container">
			<?php echo $backstory->content; ?>
		</div>
		<button class="edit-backstory-button">
			Edit backstory
		</button>
	</div>
	<div id="backstory-editor">
		<form method="post">
			<textarea name="backstory-content" id="backstory-textarea"><?php echo $backstory->content; ?></textarea>
			<button>Save</button>
		</form>
		<button class="view-button">View text</button>
	</div>
