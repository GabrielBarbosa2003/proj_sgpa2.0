<?php
session_start();
$host = "localhost";
$db = "id18022680_sgpa";
$user = "id18022680_sgpa_user";
$pass = "Sgpa@1234567";

try {
    $conn = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass);
} catch (PDOException $e) {
    echo "ERRO: ".$e->getMessage();
}