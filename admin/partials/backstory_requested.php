<?php

use Eos\Backstory_generator\Text\Text;

$text = new Text();
?>
<div class="overview-block">
	<h4 class="mouse_hover">
		<?php echo $request->name; ?> -
		<?php echo $request->faction; ?>
	</h4>
	<div class="admin_concept_edit">
	<form name="concept_approve" class="approve_form_concept" method="POST"
				id="concept-approve-<?php echo $request->characterID; ?>">
				<input type="hidden" name="type" value="concept_remind" />
				<input type="hidden" name="id" value="<?php echo $request->characterID; ?>" />
				<input type="hidden" name="status" value="approved" />
				<input type="hidden" name="tab" value="<?php echo $tab; ?>" />
				<input type="hidden" name="faction" value="<?php echo $faction; ?>" />
				<?php
				if ( $IS_SL ) {
					echo '<button class="submit-backstory button button--primary">Send Reminder E-mail</button>';
				}
				?>
			</form>
		<?php
		if ( $IS_SL ) {
			echo $request->content;
		}
		?>
	</div>
</div>
