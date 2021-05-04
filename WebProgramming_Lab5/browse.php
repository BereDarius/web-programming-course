<?php
include 'functions.php';

$pdo = pdo_connect_mysql();
// Get page using GET request (URL param: page), if it does not exist default page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;

$stmt = $pdo->prepare('SELECT * FROM cars ORDER BY id LIMIT :current_page, :records_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

$num_cars = $pdo->query('SELECT COUNT(*) FROM cars')->fetchColumn();
?>

<?=template_header('Browse')?>

<div class="content read">
    <h2>Browse Cars</h2>
    <a href="add.php" class="create-contact">Add car</a>
    <table>
        <thead>
        <tr>
            <td>#</td>
            <td>Model</td>
            <td>Engine Power</td>
            <td>Fuel</td>
            <td>Price</td>
            <td>Color</td>
            <td>Age</td>
            <td>History</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car): ?>
            <tr>
                <td><?=$car['id']?></td>
                <td><?=$car['model']?></td>
                <td><?=$car['engine_power'] . " HP"?></td>
                <td><?=$car['fuel']?></td>
                <td><?="€" . $car['price']?></td>
                <td><?=$car['color']?></td>
                <td><?=$car['age'] . " years"?></td>
                <td><?=$car['history']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$car['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="remove.php?id=<?=$car['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1): ?>
        <a href="browse.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page*$records_per_page < $num_cars): ?>
        <a href="browse.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>
