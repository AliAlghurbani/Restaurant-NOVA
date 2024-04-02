<?php
session_start();

require 'database.php';
$sql = " SELECT * FROM gebruiker ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$all_users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<main class="table">
    <section class="table__body">
        <table>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['true'])) { ?>
                <p class="true"><?php echo $_GET['true']; ?></p>
            <?php } ?>
            <thead>
                <tr>
                    <th> Id </th>
                    <th> Voornaam </th>
                    <th> Achternaam </th>
                    <th> Email </th>
                    <th> Role </th>
                    <th> Acties </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_users as $user) : ?>
                    <tr>
                        <td><?php echo $user['gebruiker_id'] ?></td>
                        <td><?php echo $user['voornaam'] ?></td>
                        <td><?php echo $user['achternaam'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['rol'] ?></td>
                        <td>
                            <a href="users_detail.php?gebruiker_id=<?php echo $user['gebruiker_id'] ?>">Bekijk</a>
                            <a href="users_edit.php?gebruiker_id=<?php echo $user['gebruiker_id'] ?>">Wijzig</a>
                            <a href="users_delete.php?gebruiker_id=<?php echo $user['gebruiker_id'] ?>">Verwijder</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
</main>

<?php include 'footer.php'; ?>