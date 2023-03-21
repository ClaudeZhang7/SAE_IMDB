<?php
class Algorithme_films_acteurs_communs{
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
}