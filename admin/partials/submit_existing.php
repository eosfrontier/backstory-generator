<?php $characters = $api->get_all_active_characters_no_backstory(); ?>

<form method="POST">
	<select name="character" onchange="this.form.submit()">
		<option value="">Choose a character</option>
		<?php

		foreach ( $characters as $char ) {
			if ( $current_event === 'Yes' && ! hasId( $current_event_characters, $char['characterID'] ) ) {
				continue;
			}
			if ( isset( $_GET['faction'] ) && $_GET['faction'] != '' && $char['faction'] != $_GET['faction'] ) {
				continue; // skips the character if the faction filter is chosen and the character is not a member of that faction
			}
			if ( isset( $_POST['character'] ) ) {
				$selected = $_POST['character'] == $char['characterID'] ? 'selected' : '';
				echo '<option ' . $char['characterID'] . '" ' . $selected . '  >' . $char['character_name'] . '</option>';
			} else {
				echo '<option class="factionblurb factionselector fct_'.$char['faction'].'" style="display: none;" value="' . $char['characterID'] . '"  >' . $char['character_name'] . '</option>';
			}
		}
		?>
		<input type="hidden" name="tab" value="<?php echo $tab; ?>"/>
		<input type="hidden" name="current_event" value="<?php echo $current_event; ?>"/>
	</select>
</form>

<?php
if ( isset( $_POST['character'] ) ) {
	$backstory = $text->get_backstory( $_POST['character'] );
	?>
	<div class="backstory">
		<h2>Backstory -
			<?php echo $character->get_character_name( $_POST['character'] ); ?>
		</h2>
		<div id="backstory-editor" style="display: block;">
			<form method="post">
				<textarea name="backstory-content" id="existing-backstory-textarea">
					<?php
					if ( isset( $backstory->content ) ) {
						echo $backstory->content;
					}
					?>
				</textarea>
				<input type="hidden" name="type" value="backstory"/>
				<input type="hidden" name="status" value="approved"/>
				<input type="hidden" name="method" value="sl_backend"/>
				<input type="hidden" name="current_event" value="<?php echo $current_event; ?>"/>
				<input type="hidden" name="id" value="<?php echo $_POST['character']; ?>"/>
				<button class="submit-backstory button button--primary">Submit Backstory</button>
			</form>
		</div>
	</div>
	<?php
}
?>
