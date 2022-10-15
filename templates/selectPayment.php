<?php require_once __DIR__.'/header.php' ?>

<section class="container" id="selectPaymentMethod">
    <form method="POST" action="index.php/selectPayment">
        <div class="form-check pb-2">
            <label class="form-check-label" for="paymentPaypal">
                PayPal
            </label>
            <input type="radio"class="form-check-input" name="paymentMethod" id="paypal" value="paypal">
        </div>
        <button type="submit" class="btn btn-primary">Weiter zu Bezahlung</button>
    </form>
</section>

<?php require_once __DIR__.'/footer.php' ?>
