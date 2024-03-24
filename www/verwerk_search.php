<?php

require 'database.php';

if (isset($_GET['search_submit'])) {
    if (!empty($_GET['zoekveld'])) {
        require 'database.php';
        $zoekterm = $_GET['zoekveld'];
        $stmt = $conn->prepare("SELECT * FROM product 
        JOIN categorie ON product.categorie_id = categorie.categorie_id 
        JOIN menugang ON product.menu_id = menugang.menu_id WHERE name LIKE %:zoekterm% ");
        $stmt->bindParam(":zoekterm", $zoekterm);
        $stmt->execute();
        $all_dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>


<?php
require 'header.php';
?>

<main class="main1">

    <div class="titlecontainer">
        <h1 class="title"> DISHES </h1>
    </div>

    <body class="users-overzichtBody">

        <div class="filterandsearch">
            <form action="verwerk_filter.php" method="post" class="filter">
                <select id="filter_option" name="filter_option" class="dropdownMenu" style="margin-top: 4.5vh;">
                    <option value="A-Z"> A-Z </option>
                    <option value="Z-A"> Z-A </option>
                    <option value="Post codes"> Post codes </option>
                    <option value="Places"> Places </option>
                    <option value="Countries"> Countries </option>
                </select>
                <button class="FSbtn" type="submit"><span class="material-symbols-outlined">sort</span></button>
            </form>

            <form action="verwerk_search.php" method="post" class="search">
                <input class="searchInput" type="text" name="zoekveld" placeholder="Search your dish here">
                <button class="FSbtn" type="submit" name="search_submit"><span class="material-symbols-outlined">travel_explore</span></button>
            </form>
        </div>

        <div class="recepten">

            <?php foreach ($all_dishes as $dish) : ?>
                <div class="recept">
                    <a href="dishdetails.php?product_id=<?php echo $dish['product_id'] ?>">
                        <img class="receptImage" src="<?php echo $dish['afbeelding']; ?>" alt="dishfoto">
                        <div class="menunaam">
                            <p><?php echo $dish['naam'] ?></p>
                        </div>
                        <div class="receptDetails">
                            <h1><a href="#" class="receptdetailstitle"> <?php echo $dish['product_naam'] ?> </a></h1>
                            <div class="receptDetailsarticle">
                                <?php echo $dish['beschrijving'] ?>
                            </div>
                            <p>&euro;<?php echo number_format($dish['verkoopprijs'] / 100, 2, ',', ''); ?></p>
                            <p> READ MORE</p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
</main>


<?php
include 'footer.php';
?>

</body>

</html>