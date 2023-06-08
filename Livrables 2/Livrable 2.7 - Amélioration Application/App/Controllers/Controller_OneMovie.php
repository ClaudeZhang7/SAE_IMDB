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
        } else {
            $dataApi["Plot"] = "No description found";
        }

        // if the poster is not found, use the default poster
        if (isset($dataApi["Poster"])) {
            if ($dataApi["Poster"] == "N/A") {
                $dataApi["Poster"] = "https://img.freepik.com/vecteurs-libre/oops-erreur-404-illustration-concept-robot-casse_114360-1932.jpg?w=2000";
            }
        } else {
            $dataApi["Poster"] = "https://img.freepik.com/vecteurs-libre/oops-erreur-404-illustration-concept-robot-casse_114360-1932.jpg?w=2000";
        }

        // You can use array_replace here so that any other fields from $data will not be overwritten by fields from $dataApi that happen to have the same key.
        $data = array_replace($data[0], $dataApi);

        return $this->render("one_movie", $data);
    }
}
?>
