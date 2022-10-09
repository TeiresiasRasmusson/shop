<form method="POST" action="index.php/deliveryAddress/add">
    <div class="card">
        <div class="card-header">
            Neue Adresse eingeben
        </div>
        <div class="card-body">
            <?php if($hasErrors): ?>
                <ul class="alert alert-danger pl-5">
                    <?php foreach ($errors as $errorMassage): ?>
                        <li><?= $errorMassage ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="mb-2">
                <label for="recipient">Empfänger</label>
                <input name="recipient" value="<?= escape($recipient) ?>" class="form-control<?= $recipientIsValid ?'':' is-invalid'?>" id="recipient">
            </div>
            <div class="mb-2">
                <label for="street">Straße</label>
                <input name="street" value="<?= escape($street) ?>"" class="form-control<?= $streetIsValid ?'':' is-invalid'?>" id="street">
            </div>
            <div class="mb-2">
                <label for="streetNumber">Hausnummer</label>
                <input name="streetNumber" value="<?= escape($streetNumber) ?>"" class="form-control<?= $streetNumberIsValid ?'':' is-invalid'?>" id="streetNumber">
            </div>
            <div class="mb-2">
                <label for="city">Stadt</label>
                <input name="city" value="<?= escape($city) ?>"" class="form-control<?= $cityIsValid ?'':' is-invalid'?>" id="city">
            </div>
            <div class="mb-2">
                <label for="zipCode">PLZ</label>
                <input name="zipCode" value="<?= escape($zipCode) ?>"" class="form-control<?= $zipCodeIsValid ?'':' is-invalid'?>" id="zipCode">
            </div>

        </div>
        <div class="card-footer">
            <button class="btn btn-success">Speichern</button>
        </div>
    </div>
</form>