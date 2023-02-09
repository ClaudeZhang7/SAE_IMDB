<?php 
    $host = "localhost";
    $driver = "pgsql";
    $dbname = "postgres";
    $login = "saeroot";
    $mdp = "root";
    $port = "8080";
    $dsn = "$driver:host=$host;port=$port;dbname=$dbname";
?>

<!-- 
    si il y a une erreur de connexion, 
    utiliser la commande suivante pour vérifier le port d'écoute de la base de données 

    chmod 600 App/Security/key.key

    ssh -i key.key -L 8080:localhost:5432 ubuntu@141.145.205.113

    nc localhost 8080
-->