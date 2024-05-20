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
		<?php
		if ( $IS_SL ) {
			echo '<h5>Concept text</h5>';
			echo $edited->content;
			if ( $edited->concept_changes ) {
				echo '<h5>Concept changes</h5>';
				echo $edited->concept_changes;
			}
		}
		?>
	</div>
</div>
