<?php include 'header.php'; ?>

<main class="regismain">
    <div class="regiscontainer">
        <form class="regisform" method="post" action="inloggen-process.php">
            <ul class="inloggensul">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <li>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="email">
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" placeholder="password">
                </li>
                <li>
                    <a href="registratie.php" class="regislink"> I DON'T HAVE AN ACCOUNT!</a>
                </li>
                <li>
                    <button type="submit"> RIGESTER </button>
                </li>
            </ul>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>