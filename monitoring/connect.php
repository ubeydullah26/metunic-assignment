<?php

$host = 'localhost';
$user = 'metunic';
$pass = '123456';
$db = 'metunic';

try{
    $conn = new PDO("mysql:host=db;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}