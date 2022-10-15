<?php

function addProductToCart (int $userId, int $productId, int $quantity = 1){

    $sql = "INSERT INTO cart 
        SET user_id = :userId, product_id = :productId, quantity = :quantity
        ON DUPLICATE KEY UPDATE quantity = quantity + :quantity";
    $statement = getDB()->prepare($sql);

    $statement->execute(
        [
        ':userId' => $userId,
        ':productId' => $productId,
        ':quantity' => $quantity
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

function getCartItemsForUserId (int $userId): array{

    $sql = "SELECT product_id,  title, description, price, quantity
        FROM cart 
        JOIN products ON(cart.product_id = products.id)
        WHERE user_id = :userId";

    $statement = getDB()->prepare($sql);

    if(false === $statement){
        return [];
    }
    $data = [
        ':userId' => $userId
    ];
    $statement->execute($data);

    $found = [];
    while ($row = $statement->fetch()){
        $found[] = $row;
    }

    return $found;
}

function getCartSumForUserId (int $userId): int{

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

function deleteProductInCartForUserId (int $userId, int $productId): int {

    $sql = "DELETE FROM cart
            WHERE user_id = :userId
            AND product_id = :productId";

    $statement = getDB()->prepare($sql);
    if(false === $statement){
        return 0;
    }
    return $statement->execute(
        [
            ':userId' => $userId,
            ':productId' => $productId
        ]
    );
}

function moveCartProductsToAnotherUser (int $sourceUserId, int $targetUserId): int{

    $oldCartItems = getCartItemsForUserId($sourceUserId);

    if(count($oldCartItems) === 0) {
        return 0;
    }
    $movedProducts = 0;

    foreach($oldCartItems as $oldCartItem){
        addProductToCart($targetUserId, (int)$oldCartItem['product_id'], (int)$oldCartItem['quantity']);
        $movedProducts += deleteProductInCartForUserId($sourceUserId, (int)$oldCartItem['product_id']);
    }

    return $movedProducts;
}