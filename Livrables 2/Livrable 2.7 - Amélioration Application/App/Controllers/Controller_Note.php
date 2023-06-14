<?php

class Controller_Note extends Controller
{

    public function action_default()
    {
        $model = Model::getModel();

        $tconst = $_GET['tconst'];
        $note = $_POST['note'];

        $model->addNoteToMovie(intval($note), $tconst);

        header('Location: /index.php?controller=OneMovie&id=' . $tconst);
    }
}