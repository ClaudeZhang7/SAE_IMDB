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
}
