<?php
/**
 * @var string $baseUrl
 * @var array $cartItems
 * @var int $countCartItems
 * @var int $cartSum
 */
?>

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
<header class="bg-light pt-5 pb-5 mb-4">
    <div class="container">
        <h1>Willkommen im Kitten Webshop</h1>
    </div>
</header>
<section class="container" id="cartItems">
    <div class="row">
        <h2>Warenkorb</h2>
    </div>
    <div class="row cartItemHeader">
        <div class="col-12 text-end">
            Preis
        </div>
    </div>
    <?php foreach($cartItems as $cartItem):?>
    <div class="row cartItem">
        <?php include __DIR__.'/cartItem.php' ?>
    </div>
    <?php endforeach;?>
    <div class="row">
        <div class="col-12 text-end">
            Gesamtpreis (<?= $countCartItems ?> Artikel): <span class="price"><?= number_format($cartSum/100,2,","," ") ?> €</span>
        </div>
    </div>
    <div class="row">
        <a href="index.php/checkout" class="btn btn-primary col-12">Zur Kasse gehen</a>
    </div>
</section>
<script src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>
