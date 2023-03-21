<?php
class Controller_Rapprochement_de_Film extends Controller
{
    public function action_default()
    {
        $model = Model::getModel();
        $movies = $model->getAllMovies();
        $actors = $model->getAllActors();

        $this->render('rapprochement_de_Film', array(
            'movies' => $movies,
            'actors' => $actors
        ));
    }

    public function action_use_algo()
    {
        if (isset($_POST['movie1'], $_POST['movie2']) || isset($_POST['actor1'], $_POST['actor2'])) {
            $file = "./Test/bfs.py";

            if (file_exists($file)) {
                if (isset($_POST['movie1']) && isset($_POST['movie2'])) {
                    $command = "python3 " . $file . " " . $_POST['movie1'] . " " . $_POST['movie2'];
                } else if (isset($_POST['actor1']) && isset($_POST['actor2'])) {
                    $command = "python3 " . $file . " " . $_POST['actor1'] . " " . $_POST['actor2'];
                }
                $output = shell_exec($command);
                $this->render('resultat_algo_3', array(
                    'output' => $output
                ));
            } else {
                echo "File not found";
            }
        }
    }
}
