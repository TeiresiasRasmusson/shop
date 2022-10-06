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
<header class="bg-light p-5 rounded-lg m-3">
    <div class="container">
        <h1>Willkommen im Kitten Webshop</h1>
    </div>
</header>
<section class="container" id="content">
    <div class="row">
        <?php while ($row = $result->fetch()):?>
            <div class="col">
                <?php include 'card.php' ?>
            </div>
        <?php endwhile;?>
    </div>
</section>
<script src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>
