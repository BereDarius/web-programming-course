<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM cars WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$car) {
        exit('Car doesn\'t exist with that ID!');
    }

    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM cars WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have removed the car!';
        } else {
            header('Location: browse.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Remove')?>

<div class="content delete">
    <h2>Remove car #<?=$car['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Are you sure you want to remove car #<?=$car['id']?></p>
    <div class="yesno">
        <a href="remove.php?id=<?=$car['id']?>&confirm=yes">Yes</a>
        <a href="remove.php?id=<?=$car['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>

