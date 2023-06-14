<?php
class Controller_AllMovies extends Controller
{

    public function action_default()
    {
        $model = Model::getModel();
        $data = $model->getAllMovies();

        // get all tconst from data
        $tconsts = array_column($data, 'tconst');

        $api = Api::getApi();
        $dataApi = $api->get_data_by_ids($tconsts);

        $algo = Algo::getAlgo('http://localhost:5000');
        $posters = $algo->getMoviesPoster($tconsts);

        // add data of api to data
        $data = array_map(function ($item) use ($dataApi, $posters) {
            $tconst = $item['tconst'];
            $data_of_api = $dataApi[$tconst] ?? null;

            if (isset($data_of_api["Plot"])) {
                if ($data_of_api["Plot"] == "N/A") {
                    $data_of_api["Plot"] = "No description found";
                }
                $item["Plot"] = $data_of_api["Plot"];
            } else {
                $item["Plot"] = "No description found";
            }

            $poster = $posters[$tconst];

            if ($poster == "https://img.freepik.com/vecteurs-libre/oops-erreur-404-illustration-concept-robot-casse_114360-1932.jpg?w=1380&t=st=1686588171~exp=1686588771~hmac=a8c2c6bd457d4c4193f1f98c3d7cf32dca5e7b117a9f77ff35cdbacdcaf89524") {
                return null;
            }

            $item["Poster"] = $poster;

            return $item;
        }, $data);

        $data = array_filter($data);

        return $this->render("all_movies", $data);
    }
}
