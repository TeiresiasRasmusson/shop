<!DOCTYPE html>
<html lang="de">
<head>
    <title>Kitten Webshop</title>
    <base href="<?= $baseUrl ?>">
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<?php include __DIR__.'/navbar.php'?>
<header class="bg-light pt-5 pb-5">
    <div class="container">
        <h1>Willkommen im Kitten Webshop</h1>
    </div>
</header>
<section class="container" id="cartItems">
    <?php foreach($cartItems as $cartItem):?>
    <div class="row">
        <?php include __DIR__.'/cartItem.php' ?>
    </div>
    <?php endforeach;?>
</section>
<script src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>
