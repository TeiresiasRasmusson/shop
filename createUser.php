<?php
session_start();
error_reporting(-1);
ini_set('display_errors','On');

const CONFIG_DIR = __DIR__ . '/config';
require_once __DIR__.'/functions/database.php';

$username = "test";
$password = password_hash("test", PASSWORD_DEFAULT);

$sql = "INSERT INTO user SET
        username='".$username."',
        password='".$password."'";

$statement = getDB()->exec($sql);
if(!$statement){
    echo printDBErrorMessage();
}