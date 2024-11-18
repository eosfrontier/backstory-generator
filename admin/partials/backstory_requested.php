<?php

use Eos\Backstory_generator\Text\Text;

$text = new Text();
?>
<div class="factionblurb fct_<?php echo $request->faction; ?> overview-block" style="display: none;">
	<h4 class="mouse_hover">
		<?php echo $request->name; ?> -
		<?php echo $request->faction; ?>
	</h4>
	<div class="admin_concept_edit">
		<h5> Date Approved: <?php echo $request->concept_approval_date; ?></br>
			Concept Approved By: <?php echo $request->concept_approved_by; ?> </h5>
		<?php
		if ($IS_SL) {
			echo '<h4>Approved Concept:</h4>
			<div class="content-block">';
			echo $request->content;
			echo '</div>';
			if (isset($request->concept_comment) && $request->concept_comment != '') {
				echo '<h4>Concept approval comment:</h4>';
				echo '<div class="content-block">';
				echo $request->concept_comment;
				echo '</div>';
			}
			?>
			<h5> Last Reminder Sent:
				<font <?php
				$daysSinceReminder = time() - strtotime($request->last_reminder_sent);
				if ($daysSinceReminder < 7 * 86400) {
					echo 'color="red"';
				}
				echo ">";
				echo $request->last_reminder_sent; ?> 	<?php if ($daysSinceReminder < 7 * 86400) {
						   echo '(within last 7 days)';
					   }
					   ?> </font>
			</h5>
			<form name="concept_remind" method="POST" class="approve_form_concept"
				id="concept-remind-<?php echo $request->characterID; ?>">
				<input type="hidden" name="type" value="concept_approved_remind" />
				<input type="hidden" name="email_trigger" value="true" />
				<input type="hidden" name="id" value="<?php echo $request->characterID; ?>" />
				<input type="hidden" name="tab" value="<?php echo $tab; ?>" />
				<input type="hidden" name="status" value="approved" />
				<button class="submit-backstory button button--primary">Remind Player to Submit Backstory</button>
			</form>
			<?php
		}
		?>
	</div>
</div>