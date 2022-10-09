<?php
/**
 * @var bool $hasErrors
 * @var array $errors
 * @var string $username
 * @var string $password
 */

require_once __DIR__.'/header.php'; ?>

<section class="container" id="loginForm">
    <?php if($hasErrors):?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $errorMessage): ?>
            <?= $errorMessage ?><br>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <form action="index.php/login" method="POST">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Login</h2>
            </div>
            <div class="card-body">
                <div class="form">
                    <div class="mb-3">
                        <label for="username" class="form-label">Benutzername</label>
                        <input type="text" value="<?= $username ?>" name="username" id="username" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Passwort</label>
                        <input type="password" value="<?= $password ?>" name="password" id="password" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Login</button>
            </div>
        </div>
    </form>
</section>

<?php require_once __DIR__.'/footer.php'; ?>