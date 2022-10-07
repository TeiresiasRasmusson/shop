<?php
$url = $_SERVER['REQUEST_URI'];
$indexPHPPositionInUrl = strpos($url,'index.php');
$baseUrl = substr($url, 0, $indexPHPPositionInUrl);

$route =  0;

if(false !== $indexPHPPositionInUrl){

    $route = substr($url, $indexPHPPositionInUrl);
    $route = str_replace('index.php','', $route);
}

$userId = getCurrentUserId();
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