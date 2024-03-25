<?php

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            require 'database.php';

            $stmt = $conn->prepare("SELECT * FROM users WHERE email= :email ");
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            if (empty($email)) {
                header("location: inloggen.php?error=Email is required");
                exit();
            } else if (empty($password)) {
                header("location: inloggen.php?error=Password is required");
                exit();
            }

            //als de email bestaat dan is het resultaat groter dan 0
            if ($stmt->rowCount() > 0) {

                //resultaat gevonden? Dan maken we een user-array $dbuser
                // set the resulting array to associative
                $dbuser = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($dbuser['password'] == $passwordForm) {

                    session_start();
                    $_SESSION['user_id']    = $dbuser['id'];
                    $_SESSION['email']      = $dbuser['email'];
                    $_SESSION['voornaam']  = $dbuser['voornaam'];
                    $_SESSION['achternaam']   = $dbuser['achternaam'];
                    $_SESSION['rol']       = $dbuser['rol'];

                    header("Location: dashboard.php");
                    exit;
                } else {
                    header("location: inloggen.php?error=Incorrect email or password ");
                    exit();
                }
            } else {
                header("location: inloggen.php?error=Incorrect email or password ");
                exit();
            }
        }
    }
}
