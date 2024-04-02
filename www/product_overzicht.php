<?php
session_start();

require 'database.php';
$sql = " SELECT * FROM product 
JOIN categorie ON product.categorie_id = categorie.categorie_id 
JOIN menugang ON product.menu_id = menugang.menu_id ";
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

<?php include 'header.php'; ?>

<main class="table">
    <section class="table__body">
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

            <a href="menugangcreate.php" class="inloggenButton">CREATE A MENU COURSE! </a>

        </div>
        <table>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['true'])) { ?>
                <p class="true"><?php echo $_GET['true']; ?></p>
            <?php } ?>
            <thead>
                <tr>
                    <th> Product Id </th>
                    <th> Product naam </th>
                    <th> Inkoopprijs </th>
                    <th> Verkoopprijs </th>
                    <th> Aantal voorrad </th>
                    <th> Menugang </th>
                    <th> Categorie </th>
                    <th> Acties </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_dishes as $dish) : ?>
                    <tr>
                        <td><?php echo $dish['product_id'] ?></td>
                        <td><?php echo $dish['product_naam'] ?></td>
                        <td><?php echo $dish['inkoopprijs'] ?></td>
                        <td><?php echo $dish['verkoopprijs'] ?></td>
                        <td><?php echo $dish['aantal_vorrad'] ?></td>
                        <td><?php echo $dish['naam'] ?></td>
                        <td><?php echo $dish['categorie'] ?></td>
                        <td>
                            <a href="dishdetails.php?product_id=<?php echo $dish['product_id'] ?>">Bekijk</a>
                            <a href="users_edit.php?product_id=<?php echo $dish['product_id'] ?>">Wijzig</a>
                            <a href="users_delete.php?product_id=<?php echo $dish['product_id'] ?>">Verwijder</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
</main>

<?php include 'footer.php'; ?>