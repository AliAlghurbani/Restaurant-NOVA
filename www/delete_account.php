<?php

session_start();

if (!isset($_SESSION['gebruiker_id'])) {
    header("location: inloggen.php?error=Je bent niet ingelogd!");
    exit();
}

require 'database.php';

$gebruiker_id = $_SESSION['gebruiker_id'];

// Check if the user exists and fetch the associated address
$sql = "SELECT * FROM gebruiker 
        JOIN adres ON gebruiker.adres_id = adres.adres_id
        WHERE gebruiker.gebruiker_id = :gebruiker_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":gebruiker_id", $gebruiker_id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    // Fetch the user and address details
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $adres_id = $user['adres_id'];

    // Delete the user's reservations first
    $sql = "DELETE FROM reserving WHERE gebruiker_id = :gebruiker_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":gebruiker_id", $gebruiker_id);
    $stmt->execute();

    // Now delete the user
    $sql = "DELETE FROM gebruiker WHERE gebruiker_id = :gebruiker_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":gebruiker_id", $gebruiker_id);
    if ($stmt->execute()) {
        // Finally, delete the user's address
        $sql = "DELETE FROM adres WHERE adres_id = :adres_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":adres_id", $adres_id);
        $stmt->execute();

        // Redirect to appropriate page with success message
        header("location: inloggen.php?true=Your account is delted!!");
        exit;
    } else {
        header("location: profile_main.php?error=Er is een fout opgetreden bij het verwijderen van je account.");
        exit;
    }
} else {
    header("location: profile_main.php?error=Geen gebruiker gevonden met dit ID.");
    exit;
}
