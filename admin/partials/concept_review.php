<?php

use Eos\Backstory_generator\Text\Text;

$text = new Text();
?>
<div class="factionblurb fct_<?php echo $awaiting->faction; ?> overview-block" style="display: none;">
	<h4 class="mouse_hover">
		<?php echo $awaiting->name; ?> -
		<?php echo $awaiting->faction; ?>
	</h4>
	<div class="admin_concept_edit">
		<h5> Date Concept Updated: <?php echo $awaiting->concept_updated_date; ?></br>
			Updated By: <?php echo $awaiting->concept_updated_by; ?> </h5>
		<?php
		if ($IS_SL) {
			echo '<div class="content-block">';
			echo $awaiting->content;
			echo '</div>';
		}
		?>
		<div>
			<!-- Request Changes flow -->
			<?php
			if ($IS_SL) {
				echo '<button class="concept_change-request-button button button--secondary" id="concept-changes-button-' . $awaiting->characterID . '">Request changes</button>';
			} ?>
			<div class="concept-changes-form" id="concept-changes-<?php echo $awaiting->characterID; ?>">
				<form name="concept_changes" method="post">
					<textarea name="concept_changes" id="concept_changes-form-<?php echo $awaiting->characterID; ?>">
						<?php echo $awaiting->concept_changes; ?>
					</textarea>
					<input type="hidden" name="type" value="concept" />
					<input type="hidden" name="status" value="changes_requested" />
					<input type="hidden" name="id" value="<?php echo $awaiting->characterID; ?>" />
					<button class="button button--primary">Send change request</button>
				</form>
			</div>
			<!-- Approval flow -->
			<?php
			if ($IS_SL) {
				echo '<button class="concept_approve-button button button--primary" id="concept-approve-button-' . $awaiting->characterID . '">Approve</button>';
			} ?>
			<div class="concept-approve-form" id="concept-approve-<?php echo $awaiting->characterID; ?>">
				<h3>Add a comment for the player to your approval (Optional): </h3>
				<form name="concept_comment" method="post">
					<textarea name="concept_comment" id="concept_comment-form-<?php echo $awaiting->characterID; ?>">
						<?php echo $awaiting->concept_comment; ?>
					</textarea>
					<input type="hidden" name="type" value="concept" />
					<input type="hidden" name="status" value="approved" />
					<input type="hidden" name="id" value="<?php echo $awaiting->characterID; ?>" />
					<button class="button button--primary">Submit Comment and Approve</button>
				</form>
			</div>
		</div>
	</div>
</div>