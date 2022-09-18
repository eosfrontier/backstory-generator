<h2>Backstory</h2>
<h3>Status: <?php echo $backstory->status_description; ?></h3>
<div class="text">
	<div class="text-container">
		<?php echo $backstory->content; ?>
	</div>
	<button class="edit-backstory-button">
		Edit backstory
	</button>
	<form method="POST">
		<input type="hidden" name="type" value="backstory" />
		<input type="hidden" name="status" value="awaiting_review" />
		<button class="submit-backstory">Submit backstory</button>
	</form>
</div>
<div id="backstory-editor">
	<form method="post">
		<textarea name="backstory-content" id="backstory-textarea">
			<?php echo $backstory->content; ?>
		</textarea>
		<button>Save</button>
	</form>
	<button class="view-button">View text</button>
</div>
