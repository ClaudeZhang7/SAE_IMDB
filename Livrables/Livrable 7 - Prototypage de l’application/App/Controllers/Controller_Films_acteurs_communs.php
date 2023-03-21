<?php
    class Controller_Films_acteurs_communs extends Controller
    {
        public function action_default()
        {
            $model = Model::getModel();
            $movies = $model->getAllMovies();
            $actors = $model->getAllActors();
    
            $this->render('Films_acteurs_communs', array(
                'movies' => $movies,
                'actors' => $actors
            ));
        }
    
        public function action_use_algo()
        {
            if (isset($_GET['actor1'], $_GET['actor2'])) {
                $model = Model::getModel();
                $data = $model->getCommonBetween2Actors($_GET['actor1'], $_GET['actor2']);

                if (empty($data)) {
                    $this->action_error(
                        'Erreur',
                        'Aucun film commun entre les deux acteurs.'
                    );
                }
                else {
                    $data = array_map(function ($item) {
                        return $item['primarytitle'];
                    }, $data);

                    $this->render('resultat_algo_2', array(
                        'data' => $data
                    ));
                }
            }
            elseif (isset($_GET['movie1'], $_GET['movie2'])) {
                $model = Model::getModel();
                $data = $model->getCommonBetween2Films($_GET['movie1'], $_GET['movie2']);

                if (empty($data)) {
                    $this->action_error(
                        'Erreur',
                        'Aucun acteur commun entre les deux films.'
                    );
                }
                else {
                    $data = array_map(function ($item) {
                        return $item['primaryname'];
                    }, $data);

                    $this->render('resultat_algo_2', array(
                        'data' => $data
                    ));
                }
            }
            else {
                $this->action_error(
                    'Erreur',
                    'Vous devez renseigner les paramètres actor1, actor2 ou movie1, movie2.'
                );
            }
        }
    }
?>