<?php

class Controller_Home extends Controller
{
    public function action_default()
    {
        if (!isset($_SESSION['user'])) {
            $this->render('welcome');
            return;
        }

        $model = Model::getModel();
        $data = $model->getLastMovies();

        $api = Api::getApi();
        $dataApi = $api->getApi();

        $algo = Algo::getAlgo('http://localhost:5000');
        // add data of api to data
        $data = array_map(function ($item) use ($dataApi, $algo) {
            $data_of_api = $dataApi->get_data_by_id($item["tconst"]);

            if (isset($data_of_api["Plot"])) {
                if ($data_of_api["Plot"] == "N/A") {
                    $data_of_api["Plot"] = "No description found";
                }
                $item["Plot"] = $data_of_api["Plot"];
            } else {
                $item["Plot"] = "No description found";
            }

            $poster = $algo->getMoviePoster($item["tconst"]);

            if ($poster == "https://img.freepik.com/vecteurs-libre/oops-erreur-404-illustration-concept-robot-casse_114360-1932.jpg?w=1380&t=st=1686588171~exp=1686588771~hmac=a8c2c6bd457d4c4193f1f98c3d7cf32dca5e7b117a9f77ff35cdbacdcaf89524") {
                return null;
            }

            $item["Poster"] = $poster;

            return $item;
        }, $data);

        $data = array_filter($data);

        // render the view with the data and api
        $this->render("Home", $data);
    }
}