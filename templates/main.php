<!DOCTYPE html>
<html lang="de">
<head>
    <title>Kitten Webshop</title>
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
<section class="container" id="content">
    <div class="row">
        <?php foreach($products as $product):?>
            <div class="col">
                <?php include 'card.php' ?>
            </div>
        <?php endforeach;?>
    </div>
</section>
<script src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>