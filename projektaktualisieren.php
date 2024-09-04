<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "hfh-pr";

$mysqli = new mysqli($server, $user, $password, $database);

$id = $mysqli->real_escape_string($_POST['id']);
$name = $mysqli->real_escape_string($_POST['name']);
$startdatum = $mysqli->real_escape_string($_POST['startdatum']);
$enddatum = $mysqli->real_escape_string($_POST['enddatum']);
$verantwortlich = $mysqli->real_escape_string($_POST['verantwortlich']);
$beschreibung = $mysqli->real_escape_string($_POST['beschreibung']);

$sql = "UPDATE projekt 
        SET name = '$name', startdatum = '$startdatum', enddatum = '$enddatum', verantwortlich = '$verantwortlich', beschreibung = '$beschreibung'
        WHERE id = '$id'";

if ($mysqli->query($sql) === TRUE) {
    echo "Erfolgreich aktualisiert";
} else {
    echo "Fehler: " . $mysqli->error;
}

$mysqli->close();
?>
