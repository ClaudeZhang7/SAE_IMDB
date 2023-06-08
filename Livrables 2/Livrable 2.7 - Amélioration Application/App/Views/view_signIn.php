<?php require "view_begin.php"; ?>

<title>Formulaire de connexion</title>
<div class="container" style="margin-top: 100px; color: white;">
    <h1 class="my-4">Formulaire de connexion</h1>
    <form action="?controller=Connexion&action=signIn" method="post">
        <div class="form-group my-4">
            <label for="email" class="my-2">Adresse e-mail :</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group my-4">
            <label for="motdepasse" class="my-2">Mot de passe :</label>
            <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
        </div>
        <button type="submit" class="btn btn-outline-light my-5">Se connecter</button>
    </form>
</div>

<?php require "view_end.php"; ?>
