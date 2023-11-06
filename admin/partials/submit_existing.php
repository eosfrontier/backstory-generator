
<?php $characters = $api->get_all_active_characters_no_backstory(); ?>
<form method="POST">
	<select name="character" onchange="this.form.submit()">
		<option value="">Choose a character</option>
		<?php
		foreach ($characters as $char) {
			if (isset($_POST['character']))	{
				$selected = $_POST['character'] == $char['characterID'] ? 'selected' : '';
				echo '<option value="' . $char['characterID'] . '" '. $selected .'  >' . $char['character_name'] . '</option>';
			}
			else echo '<option value="' . $char['characterID'] . '"  >' . $char['character_name'] . '</option>';
		}
		?>

	</select>
</form>

<?php
if (isset($_POST['character'])) {
	$backstory = $text->get_backstory($_POST['character']);
	?>
	<div class="backstory">
		<h2>Backstory -
			<?php echo $character->get_character_name($_POST['character']); ?>
		</h2>
		<div id="backstory-editor" style="display: block;">
		<form method="post">
		<textarea name="backstory-content" id="backstory-textarea">
			<?php echo $backstory->content; ?>
		</textarea>
		<input type="hidden" name="type" value="backstory" />
		<input type="hidden" name="status" value="approved" />
		<input type="hidden" name="method" value="sl_backend" />
		<input type="hidden" name="id" value="<?php echo $_POST['character']; ?>" />
		<button class="submit-backstory button button--primary">Submit Backstory</button>
	</form>
		</div>
	</div>
	<?php
}
?>