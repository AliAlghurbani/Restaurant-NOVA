<?php include 'header.php'; ?>


<main class="regismain">
    <div class="regiscontainer">
        <form class="regisform" method="post" action="verwerk_regis.php">
            <ul class="regisul">
                <li class="regisli">
                    <label for="txtVoornaam">Voornaam</label><br>
                    <input type="text" id="txtVoornaam" name="txtVoornaam" placeholder="Voornaam" autofocus>
                </li>
                <li class="regisli">
                    <label for="txtAchternaam">Achternaam</label><br>
                    <input type="text" id="txtAchternaam" name="txtAchternaam" placeholder="Achternaam">
                </li>
                <li class="regisli">
                    <label for="txtPostcode">Postcode</label><br>
                    <input type="text" id="txtPostcode" name="txtPostcode" placeholder="Postcode">
                </li>
                <li class="regisli">
                    <label for="txtEmail">Email</label><br>
                    <input type="text" id="txtEmail" name="txtEmail" placeholder="Email" autofocus>
                </li>
                <li class="regisli">
                    <label for="txtPassword">Password</label><br>
                    <input type="text" id="txtPassword" name="txtPassword" placeholder="Password">
                </li>
                <li class="regisli">
                    <button type="submit"> RIGESTER </button>
                </li>
            </ul>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>

</html>