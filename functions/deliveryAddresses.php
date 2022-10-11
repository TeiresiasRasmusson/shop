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