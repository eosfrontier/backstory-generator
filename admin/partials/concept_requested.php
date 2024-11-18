<?php

use Eos\Backstory_generator\Text\Text;

$text = new Text();
?>
<div class="factionblurb fct_<?php echo $empty_concept->faction; ?> overview-block" style="display: none;">
	<h4 class="mouse_hover">
		<?php echo $empty_concept->name; ?> -
		<?php echo $empty_concept->faction; ?>
	</h4>
	<div class="admin_concept_edit">
		<h5> Last Reminder Sent: 
			<font <?php 
		$daysSinceReminder = time() - strtotime($empty_concept->last_reminder_sent);
		if ($daysSinceReminder < 7*86400){
			echo 'color="red"';
		}
		echo ">";
		echo $empty_concept->last_reminder_sent; ?>
		<?php if ($daysSinceReminder < 7*86400){
			echo '(within last 7 days)';
		}
		?>
		</font></br></h5> 
			<!-- Updated By: <?php echo $empty_concept->concept_updated_by; ?> -->
		<?php
		if ($IS_SL) {
			?>
			<form name="concept_changes_remind" method="POST" class="approve_form_concept"
					id="concept-changes-remind-<?php echo $empty_concept->characterID; ?>">
					<input type="hidden" name="type" value="concept_not_started_remind" />
					<input type="hidden" name="email_trigger" value="true" />
					<input type="hidden" name="concept_changes" value="true" />
					<input type="hidden" name="id" value="<?php echo $empty_concept->characterID; ?>" />
					<input type="hidden" name="tab" value="<?php echo $tab; ?>" />
					<input type="hidden" name="status" value="requested" />
					<button class="submit-backstory button button--primary">Remind Player to Submit Concept</button>
				</form>
			<?php
		}
		if ($empty_concept->concept_changes) {
			echo '<h5>Date Concept Changes Requested: ' . $empty_concept->concept_changes_requested_date . '</br>
				Concept Changes Requested By: ' . $empty_concept->concept_changes_requested_by . '</h5>';
			if ($IS_SL) {
				echo '<h5>Concept changes</br>';
				echo $empty_concept->concept_changes;
			}
		}

		?>
	</div>
</div>