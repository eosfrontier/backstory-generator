<?php
$id = 42;

require './includes/include.php';

use Eos\Backstory_generator\Character\Character;
use Eos\Backstory_generator\Status\Status;
use Eos\Backstory_generator\Text\Text;

$text      = new Text();
$character = new Character();
$status    = new Status();

if ( isset( $_POST['content'] ) ) {
	$content['content'] = $_POST['content'];

	$save = $text->save_backstory( $id, $content );
}

$backstory   = $text->get_backstory( $id );
$status_name = str_replace( '_', ' ', $backstory->status_name );
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link rel="stylesheet" href="/assets/css/style.css" />
<script src="/vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
	selector: '#mytextarea',
	menubar: false
});
</script>
</head>
<body>
<header>
	<h1><?php echo $character->get_character_name( 42 ); ?> - backstory</h1>
	Backstory status - <span><?php echo $status_name; ?></span>
</header>
<main>
	<div class="text">
		<div class="text-container">
			<?php echo $backstory->content; ?>
		</div>
		<button class="edit-button">
			Edit backstory
		</button>
	</div>
	<div id="backstory-editor">
		<form method="post">
			<textarea name="content" id="mytextarea"><?php echo $backstory->content; ?></textarea>
			<button>Save</button>
		</form>
		<button class="view-button">View text</button>
	</div>
</main>
<footer>
	  Hier komt de footer
</footer>
<script>
	document.addEventListener("DOMContentLoaded", function(){

		var editButton = document.querySelector(".edit-button");
		editButton.addEventListener("click", function(){
			var text = document.querySelector('.text');
			var editor = document.querySelector('#backstory-editor');

			text.style.display = "none";
			editor.style.display = "block";
		});

		var viewButton = document.querySelector(".view-button");
		viewButton.addEventListener("click", function(){
			var text = document.querySelector('.text');
			var textContainer = document.getElementsByClassName('text-container');
			var editor = document.querySelector('#backstory-editor');
			var content = tinymce.activeEditor.getContent();

			text.style.display = "block";
			editor.style.display = "none";
		});

		window.onbeforeunload = function(){
			if (tinymce.activeEditor.isDirty()) {
				return "Leaving this page will reset the wizard";
			}
		}

	});
</script>
</body>
</html>
