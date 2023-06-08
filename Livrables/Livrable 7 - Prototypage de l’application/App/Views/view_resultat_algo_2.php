<?php require "view_begin.php"; ?>

<title>Artive.com | Resultat de films, acteurs en commun</title>

<div class="container d-flex flex-column align-items-center justify-content-center v-100 text-white text-center mx-5" style="margin-top: 60px;">
    <h3>Resultat :</h3>
    <h5 class="my-5">
        <?php
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                echo $key . ". " . $value . "<br>";
            }
        } else {
            echo $data;
        }
        ?>
    </h5>
    <p class="lead">
        <a class="btn btn-outline-light btn-lg" href="index.php?controller=Home" role="button">Retour</a>
    </p>
</div>

<?php require "view_end.php"; ?>