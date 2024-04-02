<?php
session_start();

require 'database.php';

$voornaam = $_POST['voornaam'];
$achternaam = $_POST['achternaam'];
$email = $_POST['email'];
$postcode = $_POST['postcode'];
$plaats = $_POST['plaats'];
$straatnaam = $_POST['straatnaam'];
$huisnummer = $_POST['huisnummer'];
$gebruiker_id = $_SESSION['gebruiker_id'];

$sql = "UPDATE gebruiker
JOIN adres ON gebruiker.adres_id = adres.adres_id
SET voornaam = :voornaam,
achternaam = :achternaam,
email = :email,
plaats = :plaats,
postcode = :postcode,
straatnaam = :straatnaam,
huisnummer = :huisnummer
WHERE gebruiker_id = :gebruiker_id";


$stmt = $conn->prepare($sql);
$stmt->bindParam(":voornaam", $voornaam);
$stmt->bindParam(":achternaam", $achternaam);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":plaats", $plaats);
$stmt->bindParam(":postcode", $postcode);
$stmt->bindParam(":straatnaam", $straatnaam);
$stmt->bindParam(":huisnummer", $huisnummer);
$stmt->bindParam(":gebruiker_id", $gebruiker_id);

if ($stmt->execute()) {
    header("location: profile_main.php?true=Your profile has been updated!");
    exit;
}
