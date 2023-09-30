<?php
require './includes/include.php';

$id = $logged_in_char->characterID;

var_dump( $logged_in_char );

use Eos\Backstory_generator\Character\Character;
use Eos\Backstory_generator\Status\Status;
use Eos\Backstory_generator\Text\Text;

$text      = new Text();
$character = new Character();
$status    = new Status();

if ( isset( $_POST['concept-content'] ) ) {
	$content['content'] = $_POST['concept-content'];

	$text->save_concept( $id, $content );
}

if ( isset( $_POST['backstory-content'] ) ) {
	$content['content'] = $_POST['backstory-content'];

	$text->save_backstory( $id, $content );
}

if ( isset( $_POST['status'] ) && isset( $_POST['type'] ) ) {
	$saved = $status->update_status( $id, $_POST['status'], $_POST['type'] );
	header( 'Refresh:0' );
}

$backstory = $text->get_backstory( $id );
$concept   = $text->get_concept( $id );
?>
<!DOCTYPE html>
<html>
<head>
<title>Concept/Backstory editor - <?php echo $character->get_character_name( $id ); ?></title>
<link rel="stylesheet" href="./assets/css/style.css" />
<script src="./vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
<header>
	<h1><?php echo $character->get_character_name( $id ); ?></h1><br />
	<a href="/eoschargen/index.php?viewChar=<?php echo $id; ?>">Return to Chargen</a>
</header>
<main>
	<?php
	if ( $concept !== 'None found.' && $concept->status_name !== 'requested' ) {
		require './partials/concept.php';

		if ( $concept->status_name === 'approved' ) {
			require './partials/backstory.php';
		}
	}
	else {
		require './partials/new_concept.php';
	}
	?>
</main>
<footer>
</footer>
<script src="./assets/js/include.js"></script>
</body>
</html>
