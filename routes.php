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

    $isPost = isPost();
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
    $recipient = "";
    $street = "";
    $streetNumber = "";
    $city = "";
    $zipCode = "";
    $recipientIsValid = true;
    $streetIsValid = true;
    $streetNumberIsValid = true;
    $cityIsValid = true;
    $zipCodeIsValid = true;
    $errors = [];
    $hasErrors = count($errors) > 0;
    require __DIR__ . '/templates/selectDeliveryAddress.php';
    exit();
}

if(strpos($route, '/logout') !== false) {

    session_regenerate_id(true);
    session_destroy();
    header("Location: ".$_SESSION['redirectTarget']);
    exit();
}

if(strpos($route, '/deliveryAddress/add') !== false){
    if(false === isLoggedIn()){
        $_SESSION['redirectTarget'] = $baseUrl.'index.php/deliveryAddress/add';
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    $recipient = "";
    $street = "";
    $streetNumber = "";
    $city = "";
    $zipCode = "";
    $recipientIsValid = true;
    $streetIsValid = true;
    $streetNumberIsValid = true;
    $cityIsValid = true;
    $zipCodeIsValid = true;
    $isPost = isPost();
    $errors = [];

    if($isPost){
        $recipient = filter_input(INPUT_POST, 'recipient', FILTER_SANITIZE_SPECIAL_CHARS);
        $recipient = trim($recipient);
        $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_SPECIAL_CHARS);
        $street = trim($street);
        $streetNumber = filter_input(INPUT_POST, 'streetNumber', FILTER_SANITIZE_SPECIAL_CHARS);
        $streetNumber = trim($streetNumber);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
        $city = trim($city);
        $zipCode = filter_input(INPUT_POST, 'zipCode', FILTER_SANITIZE_SPECIAL_CHARS);
        $zipCode = trim($zipCode);

        if(false === (bool)$recipient){
            $errors[] = "Bitte Empfänger eintragen.";
            $recipientIsValid = false;
        }
        if(false === (bool)$street){
            $errors[] = "Bitte Straße eintragen.";
            $streetIsValid = false;
        }
        if(false === (bool)$streetNumber){
            $errors[] = "Bitte Hausnummer eintragen.";
            $streetNumberIsValid = false;
        }
        if(false === (bool)$city){
            $errors[] = "Bitte Stadt eintragen.";
            $cityIsValid = false;
        }
        if(false === (bool)$zipCode){
            $errors[] = "Bitte PLZ eintragen.";
            $zipCodeIsValid = false;
        }
        if(count($errors) === 0) {

            $deliveryAddressId = saveDeliveryAddressForUser($userId, $recipient, $street, $streetNumber, $city, $zipCode);
            if($deliveryAddressId > 0){
                $_SESSION['deliveryAddressId'] = $deliveryAddressId;
                header("Location: ".$baseUrl."index.php/selectPayment");
                exit();
            }
            $errors[] = "Fehler beim Speichern der Lieferadresse.";
        }
    }
    $hasErrors = count($errors) > 0;

    require __DIR__.'/templates/selectDeliveryAddress.php';
    exit();
}

$_SESSION['redirectTarget'] = $baseUrl.'index.php/'.$route;
