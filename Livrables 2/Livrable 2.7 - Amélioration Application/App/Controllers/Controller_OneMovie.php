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

        $api = Api::getApi();
        $dataApi = $api->get_data_by_id($id);

        if (isset($dataApi["Plot"])) {
            if ($dataApi["Plot"] == "N/A") {
                $dataApi["Plot"] = "No description found";
            }
            $item["Plot"] = $dataApi["Plot"];
        } else {
            $item["Plot"] = "No description found";
        }
        
        $algo = Algo::getAlgo('http://localhost:5000');
        $dataApi["Poster"] = $algo->getMoviePoster($id);

        $data = array_replace($data[0], $dataApi);

        return $this->render("one_movie", $data);
    }
}
?>
