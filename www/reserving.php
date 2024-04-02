<?php
session_start();
if (!isset($_SESSION['gebruiker_id'])) {
    header("location: inloggen.php?error=You're not logged in yet");
    exit;
}
?>

<?php include 'header.php'; ?>

<main class="regismain">
    <div class="regiscontainer">
        <form class="regisform" method="post" action="reserving_process.php">
            <ul class="regisul">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <?php if (isset($_GET['true'])) { ?>
                    <p class="true"><?php echo $_GET['true']; ?></p>
                <?php } ?>
                <li>
                    <label for="datum">Datum</label>
                    <input type="date" id="datum" name="datum" placeholder="Datum">
                </li>
                <li>
                    <label for="tijd">Tijd</label>
                    <input type="time" id="tijd" name="tijd" placeholder="tijd">
                </li>
                <li>
                    <label for="personen">Aantal personen</label>
                    <input type="number" id="personen" name="personen" placeholder="personen" min="1" max="8">
                </li>
                <li>
                    <label for="telefoonnummer">Telefoonnummer</label>
                    <input type="text" id="telefoonnummer" name="telefoonnummer" placeholder="telefoonnummer">
                </li>
                <li>
                    <button type="submit"> RIGESTER </button>
                </li>
            </ul>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>