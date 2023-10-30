<?php
require getcwd() . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

require_once '../includes/SSO.php';

if ( !in_array("32", $jgroups, true) && !in_array("30", $jgroups, true)) {
	//die("Sorry, you don't have access here. Naughty person.");
	header('Status: 303 Moved Temporarily', false, 303);
    header('Location: ../');
}

use Eos\Backstory_generator\Character\Character;
use Eos\Backstory_generator\Text\Text;
use Eos\Backstory_generator\Status\Status;
use Eos\Backstory_generator\Api\Get;
use Eos\Backstory_generator\Email\Send_Email;

$character = new Character();
$text = new Text();
$status = new Status();
$api = new Get();

##########################
# Begin messaging section
##########################
require_once './partials/messaging.php';


?>
<!DOCTYPE html>
<html>

<head>

	<title>Admin - Concept/Backstory editor</title>
	<link rel="stylesheet" href="../assets/css/style.css" />
	<script src="../vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>
</head>

<body>
	<header>
		<div class="logo cell">
			<img class="responsive" src="../assets/img/outpost-icc-pm.png" alt="logo" title="ICC logo" />
			<h1>
				Admin - Concept/Backstory editor
			</h1>
	</header>
	<main>
		<div class="tabs-overview">
			<div class="tab-list">
				<button data-tab="concept" class="active">Concept</button>
				<button data-tab="backstory">Backstory</button>
				<button data-tab="completed">Completed</button>
			</div>
			<div class="tabs">
				<div data-tab="concept" class="tab active">
					<h2>Concept</h2>
					<?php require './partials/concepts.php'; ?>
				</div>
				<div data-tab="backstory" class="tab">
					<h2>Backstory</h2>
					<?php require './partials/backstory.php'; ?>
				</div>
				<div data-tab="completed" class="tab">
					<h2>Completed</h2>
					<?php require './partials/completed.php'; ?>
				</div>
			</div>
		</div>
	</main>
	<footer>
	</footer>
	<script src="../assets/js/admin.js"></script>
</body>

</html>