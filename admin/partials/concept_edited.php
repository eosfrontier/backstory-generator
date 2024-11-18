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
		<h5> Date Concept Updated: <?php echo $edited->concept_updated_date; ?></br>
			Updated By: <?php echo $edited->concept_updated_by; ?> </h5>
		<?php
		if ($IS_SL) {
			echo '<div class="content-block">';
			echo $edited->content;
			echo '</div>';
			?>
			<h5> Last Reminder Sent:
				<font <?php
				$daysSinceReminder = time() - strtotime($edited->last_reminder_sent);
				if ($daysSinceReminder < 7 * 86400) {
					echo 'color="red"';
				}
				echo ">";
				echo $edited->last_reminder_sent; ?> 	<?php if ($daysSinceReminder < 7 * 86400) {
						   echo '(within last 7 days)';
					   }
					   ?> </font>
			</h5>
			<form name="concept_changes_remind" method="POST" class="approve_form_concept"
				id="concept-changes-remind-<?php echo $edited->characterID; ?>">
				<input type="hidden" name="type" value="concept_not_submitted_remind" />
				<input type="hidden" name="email_trigger" value="true" />
				<input type="hidden" name="concept_changes" value="true" />
				<input type="hidden" name="id" value="<?php echo $edited->characterID; ?>" />
				<input type="hidden" name="tab" value="<?php echo $tab; ?>" />
				<input type="hidden" name="status" value="being_edited" />
				<button class="submit-backstory button button--primary">Remind Player to Submit Concept</button>
			</form>
			<?php
		}
		if ($edited->concept_changes) {
			echo '<h5>Date Concept Changes Requested: ' . $edited->concept_changes_requested_date . '</br>
				Concept Changes Requested By: ' . $edited->concept_changes_requested_by . '</h5>';
			if ($IS_SL) {
				echo '<h5>Concept changes</br>';
				echo $edited->concept_changes;
			}
		}

		?>
	</div>
</div>