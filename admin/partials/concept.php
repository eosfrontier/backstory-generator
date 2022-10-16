<?php

use Eos\Backstory_generator\Text\Text;

	$text     = new Text();
	$concepts = $text->get_all_concept();

	dump( $concepts );
