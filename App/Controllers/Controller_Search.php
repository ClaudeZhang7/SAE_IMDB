<?php
class Controller_Search extends Controller
{
    public function action_default()
    {
        if (isset($_GET['name'], $_GET['date'], $_GET['genre'])) {
            $name = $_GET['name'];
            $date = $_GET['date'];
            $genre = $_GET['genre'];
        } else {
            $name = "";
            $date = "";
            $genre = "";
        }

        $model = Model::getModel();
        $data = $model->getSearch($name, $date, $genre);
        $genreAll = $model->getGenres();
        $dateAll = $model->getYears();

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
            "name" => $name,
            "dates" => $dateAll,
            "genres" => $genreAll
        ]);
    }
}
