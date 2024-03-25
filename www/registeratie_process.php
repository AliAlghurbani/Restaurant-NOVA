<?php

session_start();

require 'database.php';


// if (!isset($_SESSION['user_id'])) {
//     echo "You are not logged in, please login. ";
//     echo "<a href='login.php'>Login here</a>";
//     exit;
// }

// if ($_SESSION['role'] != 'admin') {
//     echo "You are not allowed to view this page, please login as admin";
//     exit;
// }

//check method
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "You are not allowed to view this page";
    exit;
}

// Check if all fields are filled in
if (empty($_POST['voornaam']) || empty($_POST['achternaam']) || empty($_POST['email']) || empty($_POST['rol']) || empty($_POST['plaats']) || empty($_POST['postcode']) || empty($_POST['straatnaam']) || empty($_POST['huisnummer'])) {
    echo "Please fill in all fields";
    exit;
}

$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$voornaam = $_POST['voornaam'];
$achternaam = $_POST['achternaam'];
$rol = $_POST['rol'];
$plaats = $_POST['plaats'];
$postcode = $_POST['postcode'];
$straat = $_POST['straatnaam'];
$huisnummer = $_POST['huisnummer'];


// Check if email already exists
$sql = "SELECT * FROM gebruiker WHERE email = :email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();
$existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existingUser) {
    // User already exists, redirect back with message
    $_SESSION['message'] = "Gebruiker met dit e-mailadres bestaat al. Kies alstublieft een ander e-mailadres.";
    header("Location: registratie.php");
    exit;
}





// Insert the address record
$sql = "INSERT INTO adres (plaats, postcode, straatnaam, huisnummer) VALUES (:plaats, :postcode, :straatnaam, :huisnummer)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":plaats", $plaats);
$stmt->bindParam(":postcode", $postcode);
$stmt->bindParam(":straatnaam", $straat);
$stmt->bindParam(":huisnummer", $huisnummer);
if ($stmt->execute()) {
    $adres_id = $conn->lastInsertId();

    // Insert the user record
    $sql = "INSERT INTO gebruiker (voornaam, achternaam, email, password, rol, adres_id) VALUES (:voornaam, :achternaam, :email, :password, :rol, :adres_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':voornaam', $voornaam);
    $stmt->bindParam(':achternaam', $achternaam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':rol', $rol);
    $stmt->bindParam(':adres_id', $adres_id);

    if ($stmt->execute()) {
        header("Location: inloggen.php");
        exit;
    } else {
        echo "Error updating user with address ID.";
        exit;
    }
} else {
    echo "Error inserting address.";
    exit;
}
