<?php
$id = 42;

require './includes/include.php';

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
}

$backstory = $text->get_backstory( $id );
$concept   = $text->get_concept( $id );

?>
<!DOCTYPE html>
<html>
<head>
<title>Concept/background editor - <?php echo $character->get_character_name( 42 ); ?></title>
<link rel="stylesheet" href="/assets/css/style.css" />
<script src="/vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
<header>
	<h1><?php echo $character->get_character_name( 42 ); ?></h1>
</header>
<main>
	<?php
	require './partials/concept.php';

	if ( $concept->status_name === 'approved' ) {
		require './partials/backstory.php';
	}

	?>
</main>
<footer>
</footer>
<script src="/assets/js/include.js"></script>
</body>
</html>
