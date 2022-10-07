<?php

function getDB(){

    static $db;
    if ($db instanceof PDO){
        return $db;
    }
    require_once CONFIG_DIR.'/database.php';
    $dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s",DB_HOST, DB_DATABASE, DB_CHARSET);
    $db = new PDO($dsn,DB_USERNAME,DB_PASSWORD);
    return $db;
}

function printDBErrorMessage (){

    $errorMessage = getDB()->errorInfo();
    if(isset($errorMessage[2])){
        return $errorMessage[2];
    }
    return '';
}
