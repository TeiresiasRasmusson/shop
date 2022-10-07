<div class="col-3">
    <img class="productPicture" src="https://placekitten.com/306/192?image=<?= $cartItem['product_id'] ?>" class="card-img-top" alt="Produktbild-<?= $cartItem['product_id'] ?>">
</div>
<div class="col-7">
    <div><?= $cartItem['title'] ?></div>
    <div><?= $cartItem['description'] ?></div>
    <div></div>
</div>
<div class="col-2 text-end">
    <span class="price"></><?= number_format($cartItem['price']/100, 2, ',', ' ') ?> €</span>
</div>
