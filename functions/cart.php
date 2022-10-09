<?php

function addProductToCart (int $userId, int $productId){

    $sql = "INSERT INTO cart 
        SET user_id = :userId, product_id = :productId, quantity = 1
        ON DUPLICATE KEY UPDATE quantity = quantity + 1";
    $statement = getDB()->prepare($sql);

    $statement->execute(
        [
        ':userId' => $userId,
        ':productId' => $productId
        ]
    );
}

function countProductsInCart (int $userId): int{

    $sql = "SELECT COUNT(id) FROM cart WHERE user_id =".$userId;
    $cartResults = getDB()->query($sql);

    if($cartResults === false){
        return 0;
    }

    $cartItems = $cartResults->fetchColumn();

    return $cartItems;
}

function getCartItemsForUserId(int $userId): array{

    $sql = "SELECT product_id,  title, description, price
        FROM cart 
        JOIN products ON(cart.product_id = products.id)
        WHERE user_id =".$userId;
    $cartResults = getDB()->query($sql);

    if($cartResults === false){
        return [];
    }
    $found = [];

    while ($products = $cartResults->fetch()){
        $found[] = $products;
    }

    return $found;
}

function getCartSumForUserId(int $userId): int{

    $sql = "SELECT SUM(price * cart.quantity)
        FROM cart 
        JOIN products ON(cart.product_id = products.id)
        WHERE user_id =".$userId;
    $cartResults = getDB()->query($sql);
    if($cartResults === false){
        return 0;
    }

    return (int)$cartResults->fetchColumn();
}

function moveCartProductsToAnotherUser(int $sourceUserId, int $targetUserId){

    $sql = "UPDATE shop.cart 
            SET user_id = :targetUserId 
            WHERE user_id = :sourceUserId";
    $statement = getDB()->prepare($sql);

    if(false === $statement){
        return 0;
    }

    $statement->execute(
        [
        ':sourceUserId' => $sourceUserId,
        ':targetUserId' => $targetUserId
        ]
    );
}