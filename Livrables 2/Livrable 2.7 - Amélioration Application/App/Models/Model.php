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
        $this->bd->query("SET names 'utf8'");
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
        $sql = "SELECT * FROM title_basics WHERE startyear >= 2019 AND 'Adventure' = ANY(genres)
        ORDER BY tconst LIMIT 10";
        $req = $this->bd->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM title_basics Where tconst = 'tt2488496'";
        $req = $this->bd->prepare($sql);
        $req->execute();

        $data[0] = $req->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    // get all movies the data from the table title_basics
    public function getAllMovies()
    {
        $sql = "SELECT * FROM title_basics WHERE startyear >= 2019 ORDER BY tconst limit 100";
        $req = $this->bd->prepare($sql);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    // get all actors the data from the table name_basics
    public function getAllActors()
    {
        $sql = "SELECT * FROM name_basics limit 100";
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

        // get the movie ratings
        $sql = "SELECT note FROM note WHERE tconst = :id";
        $req = $this->bd->prepare($sql);
        $req->execute(array(
            "id" => $id
        ));

        $note = $req->fetch(PDO::FETCH_ASSOC);
        if ($note) {
            $data[0]["note"] = $note["note"];
        } else {
            $data[0]["note"] = null;
        }

        return $data;
    }


    public function getSearchFilm($name = "", $date = "", $genre = "", $sort = "")
    {
        $sql = "SELECT * FROM title_basics WHERE 1=1";
        $params = array();

        if (!empty($name)) {
            $sql .= " AND (primarytitle ILIKE :name OR originaltitle ILIKE :name)";
            $params['name'] = "%$name%";
        }
        if (!empty($date)) {
            $sql .= " AND startyear >= :date";
            $params['date'] = $date;
        }
        if (!empty($genre)) {
            $sql .= " AND :genre = ANY(genres)";
            $params['genre'] = $genre;
        }
        if (!empty($sort)) {
            if ($sort === "date") {
                $sql .= " ORDER BY startyear ASC";
            } elseif ($sort === "alpha") {
                $sql .= " ORDER BY primarytitle ASC";
            }
        }
        $sql .= " LIMIT 30";

        try {
            $req = $this->bd->prepare($sql);
            $req->execute($params);
        } catch (PDOException $e) {
            // Handle error
        }

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSearchActor($name = "", $sort = "")
    {
        $sql = "SELECT * FROM name_basics WHERE 1=1";
        $params = array();

        if (!empty($name)) {
            $sql .= " AND primaryname ILIKE :name";
            $params['name'] = "%$name%";
        }
        if (!empty($sort)) {
            if ($sort === "alpha") {
                $sql .= " ORDER BY primaryname ASC";
            }
        }
        $sql .= " LIMIT 30";

        try {
            $req = $this->bd->prepare($sql);
            $req->execute($params);
        } catch (PDOException $e) {
            // Handle error
        }

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }


    // get all genres plucked from the table title_basics
    public function getGenres()
    {
        $sql = "SELECT genres FROM title_basics limit 1000";
        $req = $this->bd->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        $data = array_map(function ($item) {
            $genres = $item["genres"];

            if (empty($genres)) {
                return [];
            }

            $genres = explode(",", str_replace(["{", "}"], "", $genres));
            return $genres;
        }, $data);

        $data = array_reduce($data, function ($carry, $item) {
            return array_merge($carry, $item);
        }, []);

        $data = array_unique($data);

        return $data;
    }

    // get all years plucked from the table title_basics
    public function getYearsFilm()
    {
        $sql = "SELECT DISTINCT startyear FROM title_basics ORDER BY startyear DESC";
        $req = $this->bd->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        $data = array_map(function ($item) {
            if (!empty($item["startyear"])) {
                return $item["startyear"];
            }
        }, $data);

        return $data;
    }

    // get all years plucked from the table name_basics
    public function getYearsActor()
    {
        $sql = "SELECT DISTINCT birthyear FROM name_basics ORDER BY birthyear DESC";
        $req = $this->bd->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        $data = array_map(function ($item) {
            if (!empty($item["birthyear"])) {
                return $item["birthyear"];
            }
        }, $data);

        return $data;
    }

    public function getCommonBetween2Actors($name1, $name2)
    {

        $sql = "SELECT DISTINCT primarytitle, primaryname FROM VUE_FOR_RECHERCHE WHERE primaryname LIKE :name1";

        $params = array(':name1' => $name1);

        $req = $this->bd->prepare($sql);
        $req->execute($params);

        $data =  $req->fetchAll(PDO::FETCH_ASSOC);

        $data = array_map(function ($item) use ($name2) {
            $sql = "SELECT DISTINCT primarytitle, primaryname FROM VUE_FOR_RECHERCHE WHERE primaryname LIKE :name2 AND primarytitle = :title";
            $req = $this->bd->prepare($sql);
            $req->execute(array(
                "name2" => '%' . $name2 . '%',
                "title" => $item["primarytitle"]
            ));

            return $req->fetch(PDO::FETCH_ASSOC);
        }, $data);

        $data = array_filter($data, function ($item) {
            return !empty($item);
        });

        return $data;
    }

    public function getCommonBetween2Films($title1, $title2)
    {
        $sql = "SELECT DISTINCT primarytitle, primaryname FROM VUE_FOR_RECHERCHE WHERE primarytitle LIKE :title1";

        $params = array(':title1' => $title1);

        $req = $this->bd->prepare($sql);
        $req->execute($params);

        $data =  $req->fetchAll(PDO::FETCH_ASSOC);

        $data = array_map(function ($item) use ($title2) {
            $sql = "SELECT DISTINCT primarytitle, primaryname FROM VUE_FOR_RECHERCHE WHERE primarytitle LIKE :title2 AND primaryname = :name";
            $req = $this->bd->prepare($sql);
            $req->execute(array(
                "title2" => '%' . $title2 . '%',
                "name" => $item["primaryname"]
            ));

            return $req->fetch(PDO::FETCH_ASSOC);
        }, $data);

        $data = array_filter($data, function ($item) {
            return !empty($item);
        });

        return $data;
    }

    public function createUser($nom, $prenom, $mail, $mdp)
    {
        if (empty($nom) || empty($prenom) || empty($mail) || empty($mdp)) {
            throw new Exception("Un des champs est vide");
        }

        $exist_user = $this->getUser($mail, $mdp);

        if (!empty($exist_user)) {
            throw new Exception("L'utilisateur existe déjà");
        }

        $sql = "INSERT INTO utilisateur (nom, prenom, mail, mdp) VALUES (:nom, :prenom, :mail, :mdp)";
        $req = $this->bd->prepare($sql);

        try {
            $user = $req->execute(array(
                "prenom" => $prenom,
                "nom" => $nom,
                "mail" => $mail,
                "mdp" => $mdp
            ));

            if (!$user) {
                throw new Exception("Erreur lors de la création de l'utilisateur");
            }

            return [
                "id" => $this->bd->lastInsertId(),
                "prenom" => $prenom,
                "nom" => $nom,
                "mail" => $mail,
                "mdp" => $mdp
            ];
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la création de l'utilisateur");
        }
    }

    public function getUser($mail, $mdp)
    {
        if (empty($mail) || empty($mdp)) {
            throw new Exception("Un des champs est vide");
        }

        $sql = "SELECT * FROM utilisateur WHERE mail = :mail AND mdp = :mdp";
        $req = $this->bd->prepare($sql);

        try {
            $user =  $req->execute(array(
                "mail" => $mail,
                "mdp" => $mdp
            ));

            if (!$user) {
                throw new Exception("Erreur lors de la récupération de l'utilisateur");
            } else {
                return [
                    "id" => $this->bd->lastInsertId(),
                    "prenom" => $user["prenom"],
                    "nom" => $user["nom"],
                    "mail" => $mail,
                    "mdp" => $mdp
                ];
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de l'utilisateur");
        }

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM utilisateur WHERE id = :id";
        $req = $this->bd->prepare($sql);

        try {
            $req->execute(array(
                "id" => $id
            ));
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression de l'utilisateur");
        }
    }

    public function addNoteToMovie(int $note, string $tconst)
    {
        $sql = "Select * from note where tconst = :tconst";
        $req = $this->bd->prepare($sql);
        $req->execute(array(
            "tconst" => $tconst
        ));

        $data = $req->fetch(PDO::FETCH_ASSOC);

        if (empty($data)) {
            $sql = "INSERT INTO note (tconst, note, nombre_votant) VALUES (:tconst, :note, 1)";
            $req = $this->bd->prepare($sql);
            $req->execute(array(
                "tconst" => $tconst,
                "note" => $note
            ));
        } else {
            $note = ($data["note"] * $data["nombre_votant"] + $note) / ($data["nombre_votant"] + 1);
            $nombre_votant = $data["nombre_votant"] + 1;

            $sql = "UPDATE note SET note = :note, nombre_votant = :nombre_votant WHERE tconst = :tconst";
            $req = $this->bd->prepare($sql);
            $req->execute(array(
                "tconst" => $tconst,
                "note" => $note,
                "nombre_votant" => $nombre_votant
            ));
        }
    }
}
