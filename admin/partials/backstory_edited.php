<?php

use Eos\Backstory_generator\Text\Text;

$text = new Text();
?>
<div class="overview-block">
	<h4 class="mouse_hover">
		<?php echo $edited->name; ?> -
		<?php echo $edited->faction; ?>
	</h4>
	<div class="admin_concept_edit">
		<?php if ($IS_SL) {
			echo '<h5>Backstory text</h5>';
			echo $edited->content;
			if ($edited->backstory_changes) {
				echo '<h5>Backstory changes</h5>';
				echo $edited->backstory_changes;
			}
		} ?>
	</div>
</div>