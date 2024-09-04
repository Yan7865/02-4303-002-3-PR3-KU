
<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "hfh-pr";

$mysqli = new mysqli($server, $user, $password, $database);


if ($_SERVER["REQUEST_METHOD"] == "POST") { // Wurde das Formular abgesendet? Methode "post"

    $projektid = $mysqli->real_escape_string($_POST['projektideingabe']);
    $projektname = $mysqli->real_escape_string($_POST['projektnameeingabe']);
    $startdatum = $mysqli->real_escape_string($_POST['starteingabe']);
    $enddatum = $mysqli->real_escape_string($_POST['endeeingabe']);
    $verantwortlich = isset($_POST['projektverantwortlicheingabe']) ? $mysqli->real_escape_string($_POST['projektverantwortlicheingabe']) : NULL;
    $beschreibung = isset($_POST['beschreibungeingabe']) ? $mysqli->real_escape_string($_POST['beschreibungeingabe']) : NULL;
	//Abruf der Formulardaten. Die unteren drei müssen überprüft werden, ob sie befüllt sind, da sie keine Pflichtfelder des Formulars sind.

    $sql = "INSERT INTO projekt (id, name, startdatum, enddatum, verantwortlich, beschreibung)
            VALUES ('$projektid', '$projektname', '$startdatum', '$enddatum', '$verantwortlich', '$beschreibung')";

    // Ausführen der SQL-Abfrage
    if ($mysqli->query($sql) === TRUE) {
        echo "<script>
        alert('Projekt wurde erfolgreich gespeichert.');
        window.location.href = 'projektliste.php';
		</script>";
    } else {
        echo "Fehler: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>
