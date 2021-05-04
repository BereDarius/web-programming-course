<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $model = isset($_POST['model']) ? $_POST['model'] : '';
    $engine_power = isset($_POST['engine_power']) ? $_POST['engine_power'] : 0;
    $fuel = isset($_POST['fuel']) ? $_POST['fuel'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : 0;
    $color = isset($_POST['color']) ? $_POST['color'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : 0;
    $history = isset($_POST['history']) ? $_POST['history'] : '';

    $stmt = $pdo->prepare('INSERT INTO cars VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $model, $engine_power, $fuel, $price, $color, $age, $history]);

    $msg = 'Created successfully!';
}
?>

<?=template_header('Add')?>

<div class="content update">
    <h2>Add Car</h2>
    <form action="add.php" method="post">
        <label for="id">ID</label>
        <label for="model">Model</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="model" placeholder="Ford Mondeo" id="model">
        <label for="engine_power">Engine Power</label>
        <label for="fuel">Fuel</label>
        <input type="text" name="engine_power" placeholder="120" id="engine_power">
        <input type="text" name="fuel" placeholder="Diesel" id="fuel">
        <label for="price">Price</label>
        <label for="color">Color</label>
        <input type="text" name="price" placeholder="5000" id="price">
        <input type="text" name="color" placeholder="White" id="color">
        <label for="age">Age</label>
        <label for="history">History</label>
        <input type="text" name="age" placeholder="5" id="age">
        <input type="text" name="history" placeholder="Changed electromotor 1 year ago" id="history">
        <input type="submit" value="Add">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>