<?php

use Eos\Backstory_generator\Text\Text;

$text = new Text();
?>
<div class="overview-block">
	<h4 class="mouse_hover"><?php echo $awaiting->name; ?> - <?php echo $awaiting->faction; ?></h4>
	<div class="admin_concept_edit">
		<?php echo $awaiting->content; ?>
		<div>
			<button class="concept_change-request-button button button--secondary" id="concept-changes-button-<?php echo $awaiting->characterID; ?>">Request changes</button>
			<div class="concept-changes-form" id="concept-changes-<?php echo $awaiting->characterID; ?>">
				<form method="post">
					<textarea name="backstory_changes" id="concept_changes-form-<?php echo $awaiting->characterID; ?>">
						<?php echo $awaiting->backstory_changes; ?>
					</textarea><br />
					<input type="hidden" name="type" value="backstory-changes" />
					<input type="hidden" name="status" value="changes_requested" />
					<input type="hidden" name="id" value="<?php echo $awaiting->characterID; ?>" />
					<button class="button button--primary">Send change request</button>
				</form>
			</div>
			<form class="approve_form_concept" method="POST" id="concept-approve-<?php echo $awaiting->characterID; ?>">
				<input type="hidden" name="type" value="backstory" />
				<input type="hidden" name="id" value="<?php echo $awaiting->characterID; ?>" />
				<input type="hidden" name="status" value="approved" />
				<button class="submit-backstory button button--primary">Approve</button>
			</form>
		</div>
	</div>
</div>
