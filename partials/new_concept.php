<div class="concept">
	<h2>Concept -  <?php echo $character->get_character_name($id); ?></h2>
	<p>Please submit your character concept; a fundamental idea or description that outlines the key aspects of your proposed in-game persona, offering a concise idea of who the character is, their goals, and their distinguishing traits. This should not exceed 1-2 paragraphs. Once the SLs have approved your basic concept, you will then be asked to submit your character's full backstory. </p>
	<h3><span>Status</span>: New concept</h3>	<div id="concept-editor_new">
		<form method="post">
			<textarea name="concept-content" id="concept-textarea_new"></textarea>
			<input type="hidden" name="type" value="concept" />
			<button class="button button--secondary" name="status" type="submit" value="being_edited">Save Draft</button>
			<button class="button button--primary" name="status" type="submit" value="awaiting_review">Submit to SLs for Approval</button>
		</form>
	</div>
</div>