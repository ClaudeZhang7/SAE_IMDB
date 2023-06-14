<?php
class Controller_Profil extends Controller
{
    public function action_default()
    {
        $data = $_SESSION['user'] ?? [];

        $this->render("profil", $data);
    }
}
