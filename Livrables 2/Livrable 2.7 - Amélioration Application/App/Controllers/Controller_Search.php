<?php
class Controller_Search extends Controller
{
    public function action_default()
    {
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
        } else {
            $name = "";
        }

        if (isset($_GET['date'])) {
            $date = $_GET['date'];
        } else {
            $date = "";
        }

        if (isset($_GET['genre'])) {
            $genre = $_GET['genre'];
        } else {
            $genre = "";
        }

        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else {
            $sort = "";
        }

        $model = Model::getModel();
        $data = $model->getSearchFilm($name, $date, $genre, $sort);
        $genreAll = $model->getGenres();
        $dateAll = $model->getYearsFilm();

        $api = Api::getApi();
        $dataApi = $api->getApi();

        // add data of api to data
        $data = array_map(function ($item) use ($dataApi) {
            $data_of_api = $dataApi->get_data_by_id($item["tconst"]);

            if (isset($data_of_api["Plot"])) {
                if ($data_of_api["Plot"] == "N/A") {
                    $data_of_api["Plot"] = "No description found";
                }

                $item["Plot"] = $data_of_api["Plot"];
            } else {
                $item["Plot"] = "No description found";
            }

            // if the poster is not found, use the default poster
            if (isset($data_of_api["Poster"])) {
                if ($data_of_api["Poster"] == "N/A") {
                    $data_of_api["Poster"] = "https://img.freepik.com/vecteurs-libre/oops-erreur-404-illustration-concept-robot-casse_114360-1932.jpg?w=2000";
                }
                $item["Poster"] = $data_of_api["Poster"];
            } else {
                $item["Poster"] = "https://img.freepik.com/vecteurs-libre/oops-erreur-404-illustration-concept-robot-casse_114360-1932.jpg?w=2000";
            }

            return $item;
        }, $data);

        return $this->render("search", [
            "data" => $data,
            "nameFilm" => $name,
            "dates" => $dateAll,
            "genres" => $genreAll
        ]);
    }

    public function action_actor()
    {
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
        } else {
            $name = "";
        }

        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else {
            $sort = "";
        }

        $model = Model::getModel();
        $data = $model->getSearchActor($name, $sort);
        $genreAll = $model->getGenres();
        $dateAll = $model->getYearsActor();

        $api = Api::getApi();
        $dataApi = $api->getApi();

        // add data of api to data
        $data = array_map(function ($item) use ($dataApi) {
            $data_of_api = $dataApi->get_data_by_id($item["nconst"]);

            if (isset($data_of_api["Plot"])) {
                if ($data_of_api["Plot"] == "N/A") {
                    $data_of_api["Plot"] = "No description found";
                }

                $item["Plot"] = $data_of_api["Plot"];
            } else {
                $item["Plot"] = "No description found";
            }

            // if the poster is not found, use the default poster
            if (isset($data_of_api["Poster"])) {
                if ($data_of_api["Poster"] == "N/A") {
                    $data_of_api["Poster"] = "https://bitslog.files.wordpress.com/2013/01/unknown-person1.gif";
                }
                $item["Poster"] = $data_of_api["Poster"];
            } else {
                $item["Poster"] = "https://bitslog.files.wordpress.com/2013/01/unknown-person1.gif";
            }

            return $item;
        }, $data);

        return $this->render("search", [
            "data" => $data,
            "nameActor" => $name,
            "dates" => $dateAll,
            "genres" => $genreAll
        ]);
    }
}
