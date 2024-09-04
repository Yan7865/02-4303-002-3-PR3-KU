<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "hfh-pr";

$mysqli = new mysqli($server, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Verbindungsfehler: " . $mysqli->connect_error);
}

$startFilter = isset($_POST['startfilter']) ? $_POST['startfilter'] : '';
$endFilter = isset($_POST['endfilter']) ? $_POST['endfilter'] : '';

$sql = "SELECT * FROM projekt WHERE 1=1"; // WHERE 1=1 um danach mit AND Bedingungen hinzuzufügen. Bedingung muss hier immer erfüllt werden, damit kein Filter entstehen kann

if (!empty($startFilter)) {
    $sql .= " AND enddatum >= '$startFilter'";
}

if (!empty($endFilter)) {
    $sql .= " AND startdatum <= '$endFilter'";
}

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<div class=\"tablebody\">";
    echo "<div class=\"tableheader tablerow\">";

    $columnnames = array_keys($result->fetch_assoc());
    foreach ($columnnames as $columnname) {
        echo "<div class=\"tableheadercell tablecell\">" . htmlspecialchars($columnname) . "</div>";
    }

    echo "</div>";

    $result->data_seek(0);

    while ($row = $result->fetch_assoc()) {
        echo "<div class=\"tablerow\">";
        foreach ($row as $value) {
            echo "<div class=\"tablecell\">" . htmlspecialchars($value) . "</div>";
        }
        echo "<div class=\"tablecell\"><button class=\"eintragAktualiserButton\" onclick=\"editRow(" . $row['id'] . ")\">Bearbeiten</button></div></div>";
    }

    echo "</div>";
} else {
    echo "<p>Keine Ergebnisse gefunden.</p>";
}

$mysqli->close();
?>
