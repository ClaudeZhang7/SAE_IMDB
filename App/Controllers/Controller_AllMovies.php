<?php
    class Controller_AllMovies extends Controller {
        
        public function action_default() {
            $model = Model::getModel();
            $data = $model->getAllMovies();

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

            return $this->render("all_movies", $data);
        }
    }
