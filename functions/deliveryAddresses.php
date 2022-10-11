<?php

function saveDeliveryAddressForUser (int $userId, string $recipient, string $street, string $streetNumber, string $city, string $zipCode) :int {

    $sql = "INSERT INTO delivery_addresses
    SET user_id = :userId,
    recipient = :recipient,
    street = :street,
    streetNumber = :streetNumber,
    city = :city,
    zipCode = :zipCode";

    $statement = getDB()->prepare($sql);

    if(false === $statement){
        return 0;
    }

    $statement->execute([
        ':userId' => $userId,
        ':recipient' => $recipient,
        ':street' => &$street,
        ':streetNumber' => $streetNumber,
        ':city' => $city,
        ':zipCode' => $zipCode
    ]);

    return (int)getDB()->lastInsertId();
}

function getDeliveryAddressesForUser(int $userId): array {

    $sql = "SELECT id, recipient, street, streetNumber, city, zipCode
            FROM delivery_addresses 
            WHERE user_id = :userId";

    $statement = getDB()->prepare($sql);
    if(false === $statement){
        return [];
    }

    $addresses = [];

    $statement->execute(
        [
            ':userId' => $userId
        ]
    );

    while($row = $statement->fetch()){
        $addresses[] = $row;
    }

    return $addresses;
}

function deliveryAddressBelongToUser (int $deliveryAddressId, int $userId): bool {

    $sql = "SELECT id
            FROM delivery_addresses 
            WHERE user_id = :userId AND id = :deliveryAddressId";

    $statement = getDB()->prepare($sql);
    if(false === $statement){
        return false;
    }

    $statement->execute(
        [
            ':userId' => $userId,
            ':deliveryAddressId' => $deliveryAddressId
        ]
    );

    return (bool)$statement->rowCount();
}