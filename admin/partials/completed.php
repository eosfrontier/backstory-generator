<?php

$backstories = $text->get_all_backstory();

foreach ($backstories as $backstory) {
	if ($backstory->backstory_status === 'approved') {
		?>
		<div class="overview-block">
			<h4 class="mouse_hover">
				<?php echo $backstory->name; ?> -
				<?php echo $backstory->faction; ?>
			</h4>
			<div class="admin_concept_edit">
				<h5>Backstory text</h5>
				<?php echo $backstory->content; ?>
				<?php if ($backstory->backstory_changes) { ?>
					<h5>Backstory changes</h5>
					<?php echo $backstory->backstory_changes; ?>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}