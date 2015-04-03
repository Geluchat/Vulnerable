<?php
try {
    $host  = "localhost";
    $base  = "VER";
    $login = "root";
    $passe = "";
    
    $pdo = new PDO("mysql: $host; port=3306; dbname=$base", $login, $passe);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e) {
    echo "Impossible d'accéder à la base de données MySQL : " . $e->getMessage();
    die();
}