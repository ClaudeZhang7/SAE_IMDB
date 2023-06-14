<?php require "view_begin.php"; ?>

<title>ApnaTV.com | Resultat du rapprochement</title>

<div class="container d-flex flex-column align-items-center justify-content-center v-100 vh-100 text-white text-center mx-5">
    <h3>Resultat :</h3>
    <h5 class="my-5">
        <?php echo $output ?>
    </h5>
    <p class="lead">
        <a class="btn btn-outline-light btn-lg" href="index.php?controller=Home" role="button">Retour</a>
    </p>
</div>

<?php require "view_end.php"; ?>