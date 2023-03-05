<?php
class Algorithme_search
{
    private $bd;

    public function getSearchFilm($name = "", $date = "", $genre = "", $sort = "")
    {

        if (empty($name) && empty($date) && empty($genre) && empty($sort)) {
            $sql = "SELECT * FROM title_basics ORDER BY tconst limit 30";
            $req = $this->bd->prepare($sql);
            $req->execute();

            return $req->fetchAll(PDO::FETCH_ASSOC);
        }

        if (empty($name)) {
            $name = "";
        }

        if (empty($date)) {
            $date = 0;
        }

        if (empty($genre)) {
            $genre = "";
        }

        if (empty($sort)) {
            $sort = "";
        } elseif ($sort === "date") {
            $sort = "startyear";
        } elseif ($sort === "alpha") {
            $sort = "primarytitle";
        }

        $sql = "SELECT * FROM title_basics where 1=1";
        $params = array();
        if (!empty($name)) {
            $sql .= " AND primarytitle LIKE :name OR originaltitle LIKE :name";
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
            $sql .= " ORDER BY $sort";
        }
        $sql .= " limit 30";

        $req = $this->bd->prepare($sql);
        $req->execute($params);

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSearchActor($name = "", $sort = "")
    {
        if (empty($name) && empty($sort)) {
            $sql = "SELECT * FROM name_basics ORDER BY nconst limit 30";
            $req = $this->bd->prepare($sql);
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }

        if (empty($name)) {
            $name = "";
        }

        if (empty($sort)) {
            $sort = "";
        } elseif ($sort === "alpha") {
            $sort = "primaryname";
        }

        $sql = "SELECT * FROM name_basics where 1=1";
        $params = array();

        if (!empty($name)) {
            $sql .= " AND primaryname LIKE :name";
            $params['name'] = "%$name%";
        }

        if (!empty($sort)) {
            $sql .= " ORDER BY $sort";
        }

        $sql .= " limit 30";

        $req = $this->bd->prepare($sql);
        $req->execute($params);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    // get all genres plucked from the table title_basics
    public function getGenres()
    {
        $sql = "SELECT genres FROM title_basics limit 10000";
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
}
