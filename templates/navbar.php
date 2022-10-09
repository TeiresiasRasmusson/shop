<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">My shop</a>
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <?php if(isLoggedIn()): ?>
                    <a class="nav-link" href="index.php/logout">Logout</a>
                <?php endif; ?>
                <?php if(!isLoggedIn()): ?>
                    <a class="nav-link" href="index.php/login">Login</a>
                <?php endif; ?>

            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php/cart">Warenkorb (<?= $countCartItems ?>)</a>
            </li>
        </ul>
    </div>
</nav>