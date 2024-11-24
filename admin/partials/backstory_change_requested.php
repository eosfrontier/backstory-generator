<b?php

use Eos\Backstory_generator\Text\Text;

$text = new Text();
?>
<div class="factionblurb fct_<?php echo $backstory_change->faction; ?> overview-block" style="display: none;">
	<h4 class="mouse_hover">
		<?php echo $backstory_change->name; ?> -
		<?php echo $backstory_change->faction; ?>
	</h4>
	<div class="admin_concept_edit">
		<?php
		echo '<h5>Date Last Updated: ' . $backstory_change->backstory_updated_date . '</br>
		Last Updated By: ' . $backstory_change->backstory_updated_by . '</h5>';
		if ($IS_SL) {
			?>
			<div class="overview-block">
				<h4 class="mouse_hover">Concept</h4>
				<div class="admin_concept_edit">
					<h5 class="mouse_hover">Concept Text</h5>
					<div class="admin_concept_edit">
						<div class="content-block">
							<?php echo $backstory_change->concept_content; ?>
						</div>
					</div>
				</div>
				<?php if (isset($backstory_change->concept_comment) && $backstory_change->concept_comment != '') { ?>
				<h5 class="mouse_hover">Concept approval comment:</h5>
				<div class="admin_concept_edit">
					<div class="content-block">
					<?php echo $backstory_change->concept_comment; ?>
					</div>
				</div>
					<?php } ?>
			<h4 class="mouse_hover">Backstory</h4>
			<div class="admin_concept_edit">
				<h5 class="mouse_hover">Backstory text</h5>
					<div class="admin_concept_edit">
						<div class="content-block">
							<?php echo $backstory_change->content; ?>
						</div>
					</div>
		<?php if ($backstory_change->backstory_changes) { ?>
			<h5 class="mouse_hover">Backstory changes</h5>
			<div class="admin_concept_edit">
				<h6>Date Backstory Changes Requested: 
					<?php echo $backstory_change->backstory_changes_requested_date; ?> </br>
				Backstory Changes Requested By: <?php echo $backstory_change->backstory_changes_requested_by; ?> </h6>
				<?php if ($IS_SL) { ?>
					<div class="content-block">';
					<?php echo $backstory_change->backstory_changes ?>
					</div>
				</div>
					<?php } ?>
					<h5> Last Reminder Sent:
						<font <?php $daysSinceReminder = time() - strtotime($backstory_change->last_reminder_sent);
						if ($daysSinceReminder < 7 * 86400) {
							echo 'color="red"';
						}
						echo ">";
						echo $backstory_change->last_reminder_sent; ?> 		<?php if ($daysSinceReminder < 7 * 86400) {
										echo '(within last 7 days)';
									}
									?> </font> </br>
					<?php if ($IS_SL) { ?>
						<form name="concept_remind" method="POST" class="approve_form_concept"
							id="concept-remind-<?php echo $backstory_change->characterID; ?>">
							<input type="hidden" name="type" value="backstory_changes_remind" />
							<input type="hidden" name="backstory_changes" value="true" />
							<input type="hidden" name="id" value="<?php echo $backstory_change->characterID; ?>" />
							<input type="hidden" name="tab" value="<?php echo $tab; ?>" />
							<input type="hidden" name="status" value="approved" />
							<button class="submit-backstory button button--primary">Remind Player to Make Backstory Changes</button>
						</form>
						</h5>
						<?php } 
			} 
		}?>
		</div>
		</div>
		</div>
		</div>
</div>