<?php

$backstories = $text->get_all_backstory();

foreach ( $backstories as $backstory ) {
	if ( $current_event == 'Yes' && ! hasId( $current_event_characters, $backstory->characterID ) ) {
		continue;
	}
	if ( isset( $_GET['faction'] ) && $_GET['faction'] != '' && $backstory->faction != $_GET['faction'] ) {
		continue;
	} else {
		if ( $backstory->backstory_status === 'approved' ) {
			?>
			<div class="overview-block">
				<h4 class="mouse_hover">
					<?php echo $backstory->name; ?> -
					<?php echo $backstory->faction; ?>
				</h4>
				<div class="admin_concept_edit">
					<?php
					echo '<h5>Date Backstory Approved: '. $backstory->backstory_approval_date . '</br>
					Backstory Approved By: ' . $backstory->backstory_approved_by . '</h5>';
					if ( $IS_SL ) {
						echo '<h4>Backstory text</h4>';
						echo '<div class="content-block">';
						echo $backstory->content;
						echo '</div>';
					}
					?>
					<?php if ( $backstory->backstory_changes ) { ?>
						<h5>Backstory changes</h5>
						<?php echo $backstory->backstory_changes; ?>
					<?php } ?>
				</div>
			</div>
			<?php
		}
	}
}
