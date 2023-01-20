<?php
    //commande à effectuer dans le terminal
    // ssh -i /Users/samueldorismond/Downloads/ssh-key-2022-12-07-2\ 2.key -L 8080:localhost:5432 ubuntu@141.145.205.113
    // nc localhost 8080 (dans un autre terminal)

    require_once __DIR__ . "/../Function/ArraySqlToArrayPhp.php";
    require_once __DIR__ . "/../Function/Api.php";
    require_once __DIR__ . "/../credentials.php";

    $conn = new PDO($dsn, $user, $password);

    if ($conn) {
        echo "<h3>Connecté à $dbname avec succès !</h3>";
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM title_basics LIMIT 5";
        $stmt = $conn->query($sql);
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($element as $key => $value) {
            get_poster_by_id($value["tconst"]);
            
        }
    } else {
        echo "<h3>Impossible de se connecter à $dbname</h3>";
    }
?>