<?php
$url = $_SERVER['REQUEST_URI'];
$indexPHPPositionInUrl = strpos($url,'index.php');
$baseUrl = $url;
if(false !== $indexPHPPositionInUrl){
    $baseUrl = substr($url, 0, $indexPHPPositionInUrl);
}

if(substr($baseUrl, -1) !== '/'){
    $baseUrl .='/';
}

$route =  null;
$_SESSION['redirectTarget'] = $baseUrl.'index.php';

if(false !== $indexPHPPositionInUrl){

    $route = substr($url, $indexPHPPositionInUrl);
    $route = str_replace('index.php','', $route);
}

$userId = getCurrentUserId();
setcookie('userId', $userId, strtotime('+30 days'),$baseUrl);
$countCartItems = countProductsInCart($userId);

if(!$route){

    $products = getAllProducts();
    require __DIR__.'/templates/main.php';
    exit();
}

if(strpos($route,'/cart/add/') !== false){

    $routeParts = explode('/',$route);
    $productId = (int) $routeParts[3];
    addProductToCart($userId, $productId);
    header("Location: ".$baseUrl."index.php");
    exit();
}

if(strpos($route,'/cart') !== false){

    $cartItems = getCartItemsForUserId($userId);
    $cartSum = getCartSumForUserId($userId);
    require __DIR__.'/templates/cartPage.php';
    exit();
}

if(strpos($route, '/login') !== false){

    $isPost = strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
    $username = "";
    $password = "";
    $errors = [];
    $hasErrors = false;

    if($isPost){

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password');

        if(false === (bool)$username){
            $errors[] = "Benutzername ist leer.";
        }
        if(false === (bool)$password){
            $errors[] = "Passwort ist leer.";
        }
        $userData = getUserDataForUsername($username);

        if((bool)$username && 0 === count($userData)){
            $errors[] = "Benutzername existiert nicht.";
        }

        if((bool)$password &&
        isset($userData['password']) &&
        false === password_verify($password, $userData['password'])){
            $errors[] = "Passwort falsch.";
        }

        if(0 === count($errors)){
            $_SESSION['userId'] = (int)$userData['id'];
            moveCartProductsToAnotherUser($_COOKIE['userId'], (int)$userData['id']);
            setcookie('userId', $userId, strtotime('+30 days'),$baseUrl);

            header("Location: ".$_SESSION['redirectTarget']);
            exit();
        }
    }
    $hasErrors = count($errors) > 0;

    require __DIR__.'/templates/login.php';
    exit();
}

if(strpos($route, '/checkout') !== false) {

    if (!isLoggedIn()) {
        $_SESSION['redirectTarget'] = $baseUrl.'index.php/checkout';
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }

    exit();
}

if(strpos($route, '/logout') !== false) {

    session_regenerate_id(true);
    session_destroy();
    header("Location: ".$_SESSION['redirectTarget']);
    exit;
}

$_SESSION['redirectTarget'] = $baseUrl.'index.php/'.$route;
