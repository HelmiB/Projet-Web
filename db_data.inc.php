<?php

function db_connect()
{
    try{
        $db_connexion= new PDO('mysql:host=localhost;dbname=hopital', 'root', '');
    } catch (PDOException $e) {
        print"Erreur : " . $e->getMessage();
        die();
    }
    return $db_connexion ;
}

?>