<?php
class Controller_OneMovie extends Controller
{
    public function action_default()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if (!$id) {
            // handle the case where no id is provided
            return $this->render("error", array("message" => "No movie id provided"));
        }

        $model = Model::getModel();
        $data = $model->getOneMovie($id);

        $tconsts = array_column($data, 'tconst');

        $api = Api::getApi();
        $dataApi = $api->get_data_by_ids($tconsts);

        // add data of api to data
        $data = array_map(function ($item) use ($dataApi) {
            $tconst = $item['tconst'];

            if (array_key_exists($tconst, $dataApi)) {
                $data_of_api = $dataApi[$tconst];

                if (array_key_exists("Plot", $data_of_api)) {
                    if ($data_of_api["Plot"] == "N/A") {
                        $data_of_api["Plot"] = "No description found";
                    }

                    $item["Plot"] = $data_of_api["Plot"];
                } else {
                    $item["Plot"] = "No description found";
                }

                // if the poster is not found, use the default poster
                if (array_key_exists("Poster", $data_of_api)) {
                    if ($data_of_api["Poster"] == "N/A") {
                        $data_of_api["Poster"] = "https://img.freepik.com/vecteurs-libre/oops-erreur-404-illustration-concept-robot-casse_114360-1932.jpg?w=2000";
                    }
                    $item["Poster"] = $data_of_api["Poster"];
                } else {
                    $item["Poster"] = "https://img.freepik.com/vecteurs-libre/oops-erreur-404-illustration-concept-robot-casse_114360-1932.jpg?w=2000";
                }
            } else {
                // handle the case where the API does not return any data for the tconst
                $item["Plot"] = "No description found";
                $item["Poster"] = "https://img.freepik.com/vecteurs-libre/oops-erreur-404-illustration-concept-robot-casse_114360-1932.jpg?w=2000";
            }

            return $item;
        }, $data);

        return $this->render("one_movie", $data);
    }
}
?>