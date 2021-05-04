<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $model = isset($_POST['model']) ? $_POST['model'] : '';
        $engine_power = isset($_POST['engine_power']) ? $_POST['engine_power'] : 0;
        $fuel = isset($_POST['fuel']) ? $_POST['fuel'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : 0;
        $color = isset($_POST['color']) ? $_POST['color'] : '';
        $age = isset($_POST['age']) ? $_POST['age'] : 0;
        $history = isset($_POST['history']) ? $_POST['history'] : '';

        $stmt = $pdo->prepare('UPDATE cars SET 
                id = ?, 
                model = ?, 
                engine_power = ?, 
                fuel = ?, 
                price = ?, 
                color = ?, 
                age = ?, 
                history = ? WHERE id = ?');
        $stmt->execute([$id, $model, $engine_power, $fuel, $price, $color, $age, $history, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM cars WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$car) {
        exit('Car doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Browse');?>

<div class="content update">
    <h2>Update Car #<?=$car['id']?></h2>
    <form action="update.php?id=<?=$car['id']?>" method="post">
        <label for="id">ID</label>
        <label for="model">Model</label>
        <input type="text" name="id" placeholder="1" value="<?=$car['id']?>" id="id">
        <input type="text" name="model" placeholder="Ford Mondeo" value="<?=$car['model']?>" id="model">
        <label for="engine_power">Engine Power</label>
        <label for="fuel">Fuel</label>
        <input type="text" name="engine_power" placeholder="120" value="<?=$car['engine_power']?>" id="engine_power">
        <input type="text" name="fuel" placeholder="Diesel" value="<?=$car['fuel']?>" id="fuel">
        <label for="price">Price</label>
        <label for="color">Color</label>
        <input type="text" name="price" placeholder="5000" value="<?=$car['price']?>" id="price">
        <input type="text" name="color" placeholder="White" value="<?=$car['color']?>" id="color">
        <label for="age">Age</label>
        <label for="history">History</label>
        <input type="text" name="age" placeholder="5" value="<?=$car['age']?>" id="age">
        <input type="text" name="history" placeholder="Changed electromotor 1 year ago" value="<?=$car['history']?>" id="history">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
