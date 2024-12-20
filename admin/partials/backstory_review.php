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
		<h5> Date Updated: <?php echo $awaiting->backstory_updated_date; ?></br>
			Updated By: <?php echo $awaiting->backstory_updated_by; ?> </h5>
		<?php
		if ($IS_SL) {
			?>
			<div class="overview-block">
				<h4 class="mouse_hover">Concept Text</h4>
				<div class="admin_concept_edit">
					<?php
					echo '<div class="content-block">';
					echo $awaiting->concept_content;
					echo '</div></div></div>';
					echo '<h4>Backstory Text</h4>';
					echo '<div class="content-block">';
					echo $awaiting->content;
					echo '</div>';
		}
		?>
				<div>
					<?php if ($IS_SL) { ?>
						<button class="concept_change-request-button button button--secondary"
							id="concept-changes-button-<?php echo $awaiting->characterID; ?>">Request changes</button>
					<?php } ?>
					<div class="concept-changes-form" id="concept-changes-<?php echo $awaiting->characterID; ?>">
						<form method="post">
							<textarea name="backstory_changes"
								id="concept_changes-form-<?php echo $awaiting->characterID; ?>">
						<?php echo $awaiting->backstory_changes; ?>
					</textarea><br />
							<input type="hidden" name="type" value="backstory" />
							<input type="hidden" name="status" value="changes_requested" />
							<input type="hidden" name="id" value="<?php echo $awaiting->characterID; ?>" />
							<input type="hidden" name="tab" value="<?php echo $_REQUEST['tab']; ?>" />
							<button class="button button--primary">Send change request</button>
						</form>
					</div>
					<form name="backstory_approve" class="approve_form_concept" method="POST"
						id="concept-approve-<?php echo $awaiting->characterID; ?>">
						<input type="hidden" name="type" value="backstory" />
						<input type="hidden" name="id" value="<?php echo $awaiting->characterID; ?>" />
						<input type="hidden" name="status" value="approved" />
						<input type="hidden" name="tab" value="<?php echo $_REQUEST['tab']; ?>" />
						<?php if ($IS_SL) { ?>
							<button class="submit-backstory button button--primary">Approve</button>
						<?php } ?>
					</form>
				</div>
			</div>
		</div>