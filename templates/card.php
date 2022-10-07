<div class="card">
    <div class="card-title"><?= $row['title'] ?></div>
    <img src="https://placekitten.com/286/180?image=<?= $row['id'] ?>" class="card-img-top" alt="Produktbild">
    <div class="card-body">
        <p><?= $row['description'] ?></p>
        <hr>
        <?= $row['price'] ?>
    </div>
    <div class="card-footer">
        <a href="" class="btn btn-primary btn-sm">Details</a>
        <a href="index.php/cart/add/<?= $row['id'] ?>" class="btn btn-success btn-sm">In den Warenkorb</a>
    </div>
</div>
