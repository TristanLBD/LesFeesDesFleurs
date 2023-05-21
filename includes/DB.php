<?php
    // $host = "localhost";
    // $db = "id16105814_lesfeesdesfleurs";
    // $user = "id16105814_root";
    // $pw ="dpBuAsY0o8!#8y";


    $host = "127.0.0.1";
    $db = "lesfeesdesfleurs";
    $user = "root";
    $pw ="";
    // connection à la base de données avec test si il y a une erreur
    try {
        $db = new PDO("mysql:host =$host;dbname=$db;charset=utf8",$user,$pw);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

?>