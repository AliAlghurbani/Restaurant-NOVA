<?php

session_start();

// if (!isset($_SESSION['isIngelogd'])) {
//     header("location: inloggen.php");
//     exit;
// }

?>

<?php
include 'header.php';
?>


<div class="dashbody">
    <h1 class="dashheader"> <?php echo "Fáilte! Hello  " . $_SESSION['voornaam']; ?> </h1>
    <a href="index.php" class="dashButton"> HOME PAGE </a>
    <a href="logout.php" class="dashButton"> LOGOUT </a>
</div>
</body>



</html>

<?php
include 'footer.php';
?>