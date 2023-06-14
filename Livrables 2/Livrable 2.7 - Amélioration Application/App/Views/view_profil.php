<?php
require_once 'view_begin.php';
?>

<title>Mon profil</title>
<div class="container" style="margin-top: 100px;">
    <h1 class="my-4 text-white">Mon profil</h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="card bg-dark text-white mt-4 border border-light">
                <div class="card-body">
                    <h3 class="my-4">Mes informations</h3>
                    <ul>
                        <li>Nom : <?= $data['nom'] ?></li>
                        <li>Prénom : <?= $data['prenom'] ?></li>
                        <li>Adresse e-mail : <?= $data['email'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'view_end.php';
?>
