<?php include 'header.php'; ?>

<main class="regismain">
    <div class="regiscontainer">
        <form class="regisform" method="post" action="inloggen_process.php">
            <ul class="inloggensul">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <?php if (isset($_GET['true'])) { ?>
                    <p class="true"><?php echo $_GET['true']; ?></p>
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
                    <button name="submit">Inloggen</button>
                </li>
            </ul>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>