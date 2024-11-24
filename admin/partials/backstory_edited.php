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
			<h4 class="mouse_hover">Concept</h4>
				<div class="admin_concept_edit">
					<h5 class="mouse_hover">Concept Text</h5>
						<div class="admin_concept_edit">
							<div class="content-block">';
							<?php echo $edited->concept_content; ?>
							</div>
						</div>
					<?php if (isset($edited->concept_comment) && $edited->concept_comment != '') { ?>
					<h5 class="mouse_hover">Concept approval comment:</h5>
					<div class="admin_concept_edit">
						<div class="content-block">
						<?php echo $edited->concept_comment; ?>
						</div>
					</div>
				</div>
				<?php } ?>
				<h4 class="mouse_hover">Backstory:</h4>
				<div class="admin_concept_edit">
					<div class="content-block">
					<?php echo $edited->content; ?>
					</div>
				</div>
				</div>
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
						<input type="hidden" name="type" value="backstory_not_submitted_remind" />
						<input type="hidden" name="email_trigger" value="true" />
						<input type="hidden" name="concept_changes" value="true" />
						<input type="hidden" name="id" value="<?php echo $edited->characterID; ?>" />
						<input type="hidden" name="tab" value="<?php echo $tab; ?>" />
						<input type="hidden" name="status" value="being_edited" />
						<button class="submit-backstory button button--primary">Remind Player to Submit Backstory</button>
					</form>
					<?php
		}
		if ($edited->backstory_changes) {
			echo '<h5>Date Backstory Changes Requested: ' . $edited->backstory_changes_requested_date . '</br>
		Backstory Changes Requested By: ' . $edited->backstory_changes_requested_by . '</h5>';
			if ($IS_SL) {
				echo '<h5>Backstory changes</h5>
				<div class="content-block">';
				echo $edited->backstory_changes;
				echo '</div>';
			}
		}
		?>
			</div>
		</div>