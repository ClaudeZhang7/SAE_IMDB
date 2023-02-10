<?php

class Model
{
    /**
     * Attribut contenant l'instance PDO
     */
    private $bd;

    /**
     * Attribut statique qui contiendra l'unique instance de Model
     */
    private static $instance = null;

    /**
     * Constructeur : effectue la connexion à la base de données.
     */
    private function __construct()
    {
        if (file_exists("../App/Security/credentials.php")) {
            include "../App/Security/credentials.php";
        } else {
            die("Error 404: not found!");
        }

        $this->bd = new PDO($dsn, $login, $mdp);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET nameS 'utf8'");
    }

    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // get 10 last movies the data from the table title_basics
    public function getLastMovies()
    {
        $sql = "SELECT * FROM title_basics limit 10";
        $req = $this->bd->prepare($sql);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }    

    // get all movies the data from the table title_basics
    public function getAllMovies()
    {
        $sql = "SELECT * FROM title_basics limit 32";
        $req = $this->bd->prepare($sql);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    // get one movie the data from the table title_basics with characters and directors
    public function getOneMovie($id)
    {
        $sql = "SELECT * FROM title_basics WHERE tconst = :id";
        $req = $this->bd->prepare($sql);
        $req->execute(array(
            "id" => $id
        ));

        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT primaryname FROM title_principals INNER JOIN name_basics ON title_principals.nconst = name_basics.nconst WHERE tconst = :id and category = 'actor'";
        $req = $this->bd->prepare($sql);
        $req->execute(array(
            "id" => $id
        ));

        $data[0]["characters"] = $req->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM title_crew WHERE tconst = :id";
        $req = $this->bd->prepare($sql);
        $req->execute(array(
            "id" => $id
        ));

        $data[0]["directors"] = $req->fetchAll(PDO::FETCH_ASSOC);

        // get the directors names from the table name_basics with the nconst
        $data[0]["directors"] = array_map(function ($item) {
            $directors = $item["directors"];
            $directors = explode(",", str_replace(["{", "}"], "", $directors));

            $directors = array_map(function ($item) {
                $sql = "SELECT primaryname FROM name_basics WHERE nconst = :id";
                $req = $this->bd->prepare($sql);
                $req->execute(array(
                    "id" => $item
                ));

                return $req->fetch(PDO::FETCH_ASSOC);
            }, $directors);
            return $directors;
        }, $data[0]["directors"]);

        return $data;
    }
}
