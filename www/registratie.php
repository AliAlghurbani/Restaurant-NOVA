<?php include 'header.php'; ?>


<main class="regismain">
    <div class="regiscontainer">
        <form class="regisform" method="post" action="registeratie_process.php">
            <ul class="regisul">
                <li>
                    <label for="voornaam">Voornaam</label>
                    <input type="text" id="voornaam" name="voornaam" placeholder="voornaam">
                </li>
                <li>
                    <label for="achternaam">Achternaam</label>
                    <input type="text" id="achternaam" name="achternaam" placeholder="achternaam">
                </li>
                <li>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="email">
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" placeholder="password">
                </li>
                <li>
                    <label for="plaats">Plaats</label>
                    <input type="text" id="plaats" name="plaats" placeholder="plaats">
                </li>
                <li>
                    <label for="postcode">Postcode</label>
                    <input type="text" id="postcode" name="postcode" placeholder="postcode">
                </li>
                <li>
                    <label for="straatnaam">Straatnaam</label>
                    <input type="text" id="straatnaam" name="straatnaam" placeholder="straatnaam">
                </li>
                <li>
                    <label for="huisnummer">Huisnummer</label>
                    <input type="text" id="huisnummer" name="huisnummer" placeholder="huisnummer">
                </li>
                <li>
                    <label for="rol">Rol</label>
                    <select class="roledm" id="rol" name="rol">
                        <option value="">Selecteer Rol</option>
                        <option value="manager">Manager</option>
                        <option value="medewerker">Medewerker</option>
                        <option value="klant">Klant</option>
                    </select>
                </li>
                <li>
                    <button type="submit"> RIGESTER </button>
                </li>
            </ul>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>

</html>