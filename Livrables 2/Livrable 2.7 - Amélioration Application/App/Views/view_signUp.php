<?php require "view_begin.php"; ?>

<title>Formulaire d'inscription</title>
<div class="container" style="margin-top: 100px; color: white;">
    <h1 class="my-4">Formulaire d'inscription</h1>
    <form action="?controller=Connexion&action=signUp" method="post">
        <div class="form-group my-4">
            <label for="nom" class="my-2">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group my-4">
            <label for="prenom" class="my-2">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="form-group my-4">
            <label for="email" class="my-2">Adresse e-mail :</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group my-4">
            <label for="motdepasse" class="my-2">Mot de passe :</label>
            <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
        </div>
        <div class="form-group my-4">
            <label for="motdepasse2" class="my-2">Confirmer le mot de passe :</label>
            <input type="password" class="form-control" id="motdepasse2" name="motdepasse2" required>
        </div>
        <button type="submit" class="btn btn-outline-light my-5">S'inscrire</button>
    </form>
</div>

<?php require "view_end.php"; ?>
