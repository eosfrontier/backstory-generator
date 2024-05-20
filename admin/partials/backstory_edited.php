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
		echo '<h5>Date Last Updated: '. $edited->backstory_updated_date . '</br>
		Last Updated By: ' . $edited->backstory_updated_by . '</h5>';
		if ($IS_SL) {
			echo '<h5>Backstory text</br>
			<div class="content-block">';
			echo $edited->content;
			echo '</div>';
		}
			if ($edited->backstory_changes) {
				echo '<h5>Date Backstory Changes Requested: '. $edited->backstory_changes_requested_date . '</br>
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