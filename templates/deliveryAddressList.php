<?php
/**
 * @var array $deliveryAddresses
 */
?>

<div class="row pb-5">
    <?php foreach ($deliveryAddresses as $deliveryAddress): ?>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <strong class="recipient"><?= $deliveryAddress['recipient'] ?></strong>
                    <p class="street">
                        <?= $deliveryAddress['street'] ?> <?= $deliveryAddress['streetNumber'] ?>
                    </p>
                    <p class="city">
                        <?= $deliveryAddress['zipCode'] ?> <?= $deliveryAddress['city'] ?>
                    </p>
                </div>
                <div class="card-footer">
                    <a class="card-link" href="index.php/selectDeliveryAddress/<?= $deliveryAddress['id'] ?>">Wählen</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
