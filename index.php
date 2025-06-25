<?php
require_once 'functions.php';
$balance = getBalance();
$services = getServices();

if (isset($_POST['order'])) {
    $result = placeOrder($_POST['service'], $_POST['link'], $_POST['quantity']);
}
if (isset($_POST['status'])) {
    $status = checkOrder($_POST['order_id']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hamid SMM Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Hamid SMM Panel</h1>

<h2>💰 Current Balance:</h2>
<p><?= $balance['balance'] ?? 'Error' ?> <?= $balance['currency'] ?? '' ?></p>

<h2>📋 Place Order</h2>
<form method="post">
    <select name="service">
        <?php foreach ($services as $srv): ?>
            <option value="<?= $srv['service'] ?>"><?= $srv['name'] ?> (Min: <?= $srv['min'] ?> / Max: <?= $srv['max'] ?>)</option>
        <?php endforeach; ?>
    </select><br>
    <input type="text" name="link" placeholder="Link"><br>
    <input type="number" name="quantity" placeholder="Quantity"><br>
    <button type="submit" name="order">Place Order</button>
</form>
<?php if (!empty($result)): ?>
    <p>Order ID: <?= $result['order'] ?? 'Error placing order' ?></p>
<?php endif; ?>

<h2>🔍 Check Order Status</h2>
<form method="post">
    <input type="number" name="order_id" placeholder="Order ID"><br>
    <button type="submit" name="status">Check Status</button>
</form>
<?php if (!empty($status)): ?>
    <p>Status: <?= $status['status'] ?></p>
<?php endif; ?>
</body>
</html>