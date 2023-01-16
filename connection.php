<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "datatable";
$port = "3306";

try {
    $connector = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
    //echo "Conexão estabelecida!";
} catch (PDOException $err) {

}