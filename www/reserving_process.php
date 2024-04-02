<?php

session_start();

require 'database.php';

if (!isset($_SESSION['gebruiker_id'])) {
    header("location: inloggen.php?error=You're not logged in yet");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    // echo "verkeerde request method gebruikt";
    include '405.php';
    exit;
}

// Check if all fields are filled in
if (empty($_POST['datum']) || empty($_POST['tijd']) || empty($_POST['personen']) || empty($_POST['telefoonnummer'])) {
    header("location: reserving.php?error= Please fill all fields!");
    exit;
}

$datum = $_POST['datum'];
$tijd = $_POST['tijd'];
$personen = $_POST['personen'];
$telefoonnummer = $_POST['telefoonnummer'];


// Check if reserving already exists
$sql = "SELECT * FROM reserving WHERE tijd = :tijd";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':tijd', $tijd);
$stmt->execute();
$existingReserving = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existingReserving) {
    header("location: reserving.php?error= This time is already full!");
    exit;
}


// Insert the address record
$sql = "INSERT INTO reserving (gebruiker_id, datum, tijd, aantal_personen, telefoonnummer) VALUES (:gebruiker_id, :datum, :tijd, :personen, :telefoonnummer)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":gebruiker_id", $_SESSION['gebruiker_id']);
$stmt->bindParam(":datum", $datum);
$stmt->bindParam(":tijd", $tijd);
$stmt->bindParam(":personen", $personen);
$stmt->bindParam(":telefoonnummer", $telefoonnummer);
if ($stmt->execute()) {
    header("location: reserving.php?true=Reservation made!");
    exit;
} else {
    header("location: reserving.php?error=Reservation couldn't be made!");
    exit;
}
