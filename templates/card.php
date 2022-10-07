<div class="card">
    <div class="card-title"><?= $product['title'] ?></div>
    <img src="https://placekitten.com/286/180?image=<?= $product['id'] ?>" class="card-img-top" alt="Produktbild">
    <div class="card-body">
        <p><?= $product['description'] ?></p>
        <hr>
        <?= $product['price'] ?>
    </div>
    <div class="card-footer">
        <a href="" class="btn btn-primary btn-sm">Details</a>
        <a href="index.php/cart/add/<?= $product['id'] ?>" class="btn btn-success btn-sm">In den Warenkorb</a>
    </div>
</div>
