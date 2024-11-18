<?php

use Eos\Backstory_generator\Text\Text;

$text = new Text();
?>
<div class="factionblurb fct_<?php echo $edited->faction; ?> overview-block" style="display: none;">
	<h4 class="mouse_hover">
		<?php echo $edited->name; ?> -
		<?php echo $edited->faction; ?>
	</h4>
	<div class="admin_concept_edit">
		<?php
		echo '<h5>Date Last Updated: ' . $edited->backstory_updated_date . '</br>
		Last Updated By: ' . $edited->backstory_updated_by . '</h5>';
		if ($IS_SL) {
			?>
			<div class="overview-block">
				<h4 class="mouse_hover">Concept Text</h4>
				<div class="admin_concept_edit">
					<?php
					echo '<div class="content-block">';
					echo $edited->concept_content;
					echo '</div></div></div>';
					echo '<h5>Backstory text</br>';
					echo '<div class="content-block">';
					echo $edited->content;
					echo '</div>';
		}
		if ($edited->backstory_changes) {
			echo '<h5>Date Backstory Changes Requested: ' . $edited->backstory_changes_requested_date . '</br>
		Backstory Changes Requested By: ' . $edited->backstory_changes_requested_by . '</h5>';
			if ($IS_SL) {
				echo '<h5>Backstory changes</h5>
				<div class="content-block">';
				echo $edited->backstory_changes;
				echo '</div>';
				?>
						<form name="concept_remind" method="POST" class="approve_form_concept"
							id="concept-remind-<?php echo $edited->characterID; ?>">
							<input type="hidden" name="type" value="backstory_changes_remind" />
							<input type="hidden" name="backstory_changes" value="true" />
							<input type="hidden" name="id" value="<?php echo $edited->characterID; ?>" />
							<input type="hidden" name="tab" value="<?php echo $tab; ?>" />
							<input type="hidden" name="status" value="approved" />
							<button class="submit-backstory button button--primary">Send Reminder E-mail</button>
						</form>
						<?php
			}
		}
		?>
			</div>
		</div>