<?php
require getcwd() . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
require '../../eos-charactergenerator/db.php';
use Eos\Backstory_generator\Email\Send_Email;

$mail = new Send_Email();

$sql = "SELECT faction.characterID as characterID, r.first_name as oc_fn, tussenvoegsel.field_value as oc_tv, r.last_name as oc_ln, r.register_date, 
r.email as email, faction.character_name as ic_name, soort_inschrijving.field_value as type, faction.faction as faction
    from joomla.jml_eb_registrants r
    left join joomla.jml_eb_field_values charname on (charname.registrant_id = r.id and charname.field_id = 21 )
    left join joomla.ecc_characters faction ON (faction.characterID = substring_index(charname.field_value,' - ',-1))
    left join joomla.jml_eb_field_values tussenvoegsel on (tussenvoegsel.registrant_id = r.id and tussenvoegsel.field_id = 16)
    left join joomla.jml_eb_field_values soort_inschrijving on (soort_inschrijving.registrant_id = r.id and soort_inschrijving.field_id = 14)
    left join joomla.jml_eb_field_values new_player on (new_player.registrant_id = r.id and new_player.field_id = 54)
    where soort_inschrijving.field_value = 'Speler' AND r.event_id = $EVENTID and 
	((r.published = 1 AND (r.payment_method = 'os_ideal' OR r.payment_method = 'os_paypal' OR r.payment_method = 'os_bancontact')) OR
    (r.published in (0,1) AND r.payment_method = 'os_offline')) AND new_player.field_value = 'Yes'";
$res = $UPLINK->query($sql);
$sqle = "SELECT title, event_date FROM jml_eb_events WHERE id = $EVENTID";
$rese = $UPLINK->query($sqle);
$fetche = mysqli_fetch_assoc($rese);
$threeWeeksBefore = date('Y-m-d', (strtotime($fetche['event_date']) - 1814400));

while ($row = mysqli_fetch_array($res)) {
    $sql2 = "SELECT * FROM ecc_backstory WHERE characterID = '" . $row['characterID'] . "'";
    $res2 = $UPLINK->query($sql2);
    $row_count2 = mysqli_num_rows($res2);
    if ($row_count2 < 1) {
        $email = $row['email'];
        $subject = "Character concept needed for " . utf8_decode($row['ic_name']);
        $body = "Dear " . utf8_encode($row['oc_fn']) . " " . utf8_encode($row['oc_tv']) . " " . utf8_encode($row['oc_ln']) . ",
		<br /><br />
		Thank you for registering for <strong>" . $fetche['title'] . "</strong> with a new character, <strong>" . utf8_encode($row['ic_name']) . "</strong>.<br /> 
		Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/'>the backstory editor</a> to submit your character concept to the SL Team.
		<br />
        IMPORTANT NOTE: To ensure that the SL Team has enough time for successful integration of your character into the setting, you must submit your initial concept ASAP, so that you will have time to submit your backstory no later than the deadline: $threeWeeksBefore.<br />
		<br />
		Kind regards,
		<br />
		The Spelleider Team<br />
        Eos: Frontier
        <br />";
        $mail->send_email_to_player($email, $subject, $body);
        $sqlinsert = "INSERT INTO ecc_backstory (`characterID`) VALUES ('" . $row['characterID'] . "')";
        $resinsert = $UPLINK->query($sqlinsert);
        echo "Mail sent to $email for character " . utf8_encode($row['ic_name']) . ".<br />";
    }
}
