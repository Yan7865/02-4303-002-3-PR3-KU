<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "hfh-pr";

$mysqli = new mysqli($server, $user, $password, $database);

$id = $mysqli->real_escape_string($_POST['id']);
$sql = "SELECT * FROM projekt WHERE id = '$id'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode([]);
}

$mysqli->close();
?>
