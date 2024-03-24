<?php

require 'database.php';

$sql = "SELECT * FROM product 
JOIN categorie ON product.categorie_id = categorie.categorie_id 
JOIN menugang ON product.menu_id = menugang.menu_id;
";
$stmt = $conn->prepare($sql);
$stmt->execute();
$all_dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['search_submit'])) {
    if (!empty($_GET['search'])) {
        require 'database.php';
        $zoekterm = $_GET['search'];
        $stmt = $conn->prepare("SELECT * FROM product 
    JOIN categorie ON product.categorie_id = categorie.categorie_id 
    JOIN menugang ON product.menu_id = menugang.menu_id WHERE product_naam LIKE CONCAT('%', :zoekterm, '%')");
        $stmt->bindParam(":zoekterm", $zoekterm);
        $stmt->execute();
        $all_dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['filter_option'])) {
    $filterOption = $_GET['filter_option'];
    $sql = "SELECT * FROM product 
    JOIN categorie ON product.categorie_id = categorie.categorie_id 
    JOIN menugang ON product.menu_id = menugang.menu_id";

    switch ($filterOption) {
        case "hoofdgerecht":
        case "bijgerecht":
        case "drank":
        case "brood":
        case "dessert":
            $sql .= " WHERE menugang.naam = :naam";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":naam", $filterOption);
            break;
        case "vegan":
            $sql .= " WHERE is_vega = 1";
            $stmt = $conn->prepare($sql);
            break;
        case "gerecht":
            $sql .= " WHERE categorie.categorie = :category";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":category", $filterOption);
            break;
        default:
            // Handle default case if needed
            break;
    }

    $stmt->execute();
    $all_dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <form action="" method="get" class="filter">
                <select id="filter_option" name="filter_option" class="dropdownMenu" style="margin-top: 4.5vh;">
                    <option value="hoofdgerecht" <?php if (isset($_GET['filter_option']) && $_GET['filter_option'] == 'hoofdgerecht') echo 'selected="selected"'; ?>> Hoofdgerecht </option>
                    <option value="bijgerecht" <?php if (isset($_GET['filter_option']) && $_GET['filter_option'] == 'bijgerecht') echo 'selected="selected"'; ?>> Bijgerecht </option>
                    <option value="drank" <?php if (isset($_GET['filter_option']) && $_GET['filter_option'] == 'drank') echo 'selected="selected"'; ?>> Drank </option>
                    <option value="brood" <?php if (isset($_GET['filter_option']) && $_GET['filter_option'] == 'brood') echo 'selected="selected"'; ?>> Brood </option>
                    <option value="dessert" <?php if (isset($_GET['filter_option']) && $_GET['filter_option'] == 'dessert') echo 'selected="selected"'; ?>> Dessert </option>
                    <option value="vegan" <?php if (isset($_GET['filter_option']) && $_GET['filter_option'] == 'vegan') echo 'selected="selected"'; ?>> Vegan </option>
                    <option value="gerecht" <?php if (isset($_GET['filter_option']) && $_GET['filter_option'] == 'gerecht') echo 'selected="selected"'; ?>> Gerecht </option>
                </select>
                <button class="FSbtn" type="submit"><span class="material-symbols-outlined">sort</span></button>
            </form>

            <form action="" method="get" class="search">
                <input class="searchInput" type="text" name="search" id="search" placeholder="Search your dish here">
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