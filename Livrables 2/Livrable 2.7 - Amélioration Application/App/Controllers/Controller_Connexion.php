<?php
class Controller_Connexion extends Controller
{
    public function action_default()
    {
        $this->render('signUp');
    }

    public function action_signInForm()
    {
        $this->render('signIn');
    }

    public function action_signUp()
    {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $motdepasse = $_POST['motdepasse'];
        $motdepasse2 = $_POST['motdepasse2'];

        if ($motdepasse == $motdepasse2) {
            $model = Model::getModel();
            
            try{
                $user = $model->createUser($nom, $prenom, $email, $motdepasse);
            } catch (Exception $e) {
                $this->action_error($e->getMessage());
            }

            if ($user == null || $user == false) {
                $this->action_error("L'email est déjà utilisé");
            }

            $_SESSION['user'] = [
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'motdepasse' => $motdepasse
            ];

            header('Location: /');
        } else {
            $this->action_error("Les mots de passe ne correspondent pas");
        }
    }

    public function action_signIn()
    {
        $email = $_POST['email'];
        $motdepasse = $_POST['motdepasse'];

        if ($email == "samueldorismond@gmail.com" && $motdepasse == "test") {
            $_SESSION['user'] = [
                'nom' => "Dorismond",
                'prenom' => "Samuel",
                'email' => $email,
                'motdepasse' => $motdepasse
            ];
            header('Location: /');
            
        } else {
            $this->action_error("L'email ou le mot de passe est incorrect");
        }
    }

    public function action_signOut()
    {
        session_destroy();
        header('Location: /');
    }
}
