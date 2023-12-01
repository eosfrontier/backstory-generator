<?php

use Eos\Backstory_generator\Text\Text;

$text = new Text();
?>
<div class="overview-block">
	<h4 class="mouse_hover">
		<?php echo $request->name; ?> -
		<?php echo $request->faction; ?>
	</h4>
	<div class="admin_concept_edit">
		<?php if ($IS_SL) {
			echo $request->content;
		} ?>
	</div>
</div>