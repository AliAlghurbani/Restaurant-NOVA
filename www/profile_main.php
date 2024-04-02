<?php
session_start();

if (!isset($_SESSION['gebruiker_id'])) {
    header("location: inloggen.php?error=You are not logged in! ");
    exit();
}

require 'database.php';

$gebruiker_id = $_SESSION['gebruiker_id'];

$sql = "SELECT * FROM gebruiker 
JOIN adres ON gebruiker.adres_id = adres.adres_id
WHERE gebruiker.gebruiker_id = :gebruiker_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":gebruiker_id", $gebruiker_id);
if ($stmt->execute()) {
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        header("location: inloggen.php?error=This user does not exist! ");
        exit();
    }
}

include 'header.php';
?>


<main class="regismain">
    <div class="regiscontainer">
        <form class="regisform" method="post" action="">
            <ul class="regisul">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <?php if (isset($_GET['true'])) { ?>
                    <p class="true"><?php echo $_GET['true']; ?></p>
                <?php } ?>
                <li>
                    <label for="voornaam">Voornaam</label>
                    <input type="text" id="voornaam" name="voornaam" value="<?php echo $user['voornaam'] ?>" readonly>
                </li>
                <li>
                    <label for="achternaam">Achternaam</label>
                    <input type="text" id="achternaam" name="achternaam" value="<?php echo $user['achternaam'] ?>" readonly>
                </li>
                <li>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="<?php echo $user['email'] ?>" readonly>
                </li>
                <li>
                    <label for="plaats">Plaats</label>
                    <input type="text" id="plaats" name="plaats" value="<?php echo $user['plaats'] ?>" readonly>
                </li>
                <li>
                    <label for="postcode">Postcode</label>
                    <input type="text" id="postcode" name="postcode" value="<?php echo $user['postcode'] ?>" readonly>
                </li>
                <li>
                    <label for="straatnaam">Straatnaam</label>
                    <input type="text" id="straatnaam" name="straatnaam" value="<?php echo $user['straatnaam'] ?>" readonly>
                </li>
                <li>
                    <label for="huisnummer">Huisnummer</label>
                    <input type="text" id="huisnummer" name="huisnummer" value="<?php echo $user['huisnummer'] ?>" readonly>
                </li>
                <div>
                    <a href="profile.php" class="inloggenButton"> Edit account! </a>
                    <a href="delete_account.php" class="uitloggenButton"> Delete ACCOUNT! </a>
                </div>

            </ul>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>