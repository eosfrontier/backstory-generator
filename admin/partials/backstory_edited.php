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
		<h5>Backstory text</h5>
		<?php echo $edited->content; ?>
		<?php if ($edited->backstory_changes) { ?>
			<h5>Backstory changes</h5>
			<?php echo $edited->backstory_changes; ?>
		<?php } ?>
	</div>
</div>