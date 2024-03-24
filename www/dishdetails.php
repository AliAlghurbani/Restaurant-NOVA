<?php
require 'database.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM product WHERE product_id = :product_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":product_id", $product_id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>


<?php
include 'header.php';
?>


<main class="main2">

    <div class="top">
        <div class="topdetails">
            <div class="productnaam">
                <h1><?php echo $product['product_naam'] ?> </h1>
                <p><?php echo $product['beschrijving'] ?></p>
            </div>
            <div class="extradetails">
                <div class="inkoop">
                    <p> Innkoopprijs </p>
                    <h1>&euro;<?php echo number_format($product['inkoopprijs'] / 100, 2, ',', ''); ?></h1>
                    <span class="material-symbols-outlined"> payments </span>
                </div>
                <div class="verkoop">
                    <p> Verkoopprijs </p>
                    <h1>&euro;<?php echo number_format($product['verkoopprijs'] / 100, 2, ',', ''); ?></h1>
                    <span class="material-symbols-outlined">monetization_on</span>
                </div>
                <div class="serves">
                    <p> Aantal voorrad </p>
                    <h1><?php echo $product['aantal_vorrad'] ?></h1>
                    <span class="material-symbols-outlined"> group </span>
                </div>
            </div>
        </div>
        <img id="image1" src="<?php echo $product['afbeelding'] ?>" alt="picture">
    </div>

    <?php
    include 'footer.php';
    ?>

    </body>

    </html>