<?php
require_once 'view_begin.php';
$first = $data;
$genre = $first['genres'];
$genre = str_replace(["{", "}"], '', $genre);
$genre = explode(",", $genre);
?>

<title><?php echo $first['primarytitle'] ?> | Artive</title>

<div class="container-fluid‡ p-0 m-0 py-3" style="
    <?php
    echo "background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(255,255,255,0) 100%), url(
    " . $first['Poster'] . "
    ); background-size: cover; background-repeat: no-repeat; background-position: top; width: 100%; min-height: 100vh;"
    ?> ">
    <div class="d-flex align-items-start justify-content-start" style="width: 100%;">

        <div class="row mx-5" style="margin-top: 150px;">
            <div class="text-white">
                <h1 class="display-3 text-uppercase fw-bold" id="titre">
                    <?php echo $first['primarytitle']; ?>
                </h1>

                <div class="my-5">
                    <h5 class="text-uppercase fw-bold mt-3">Description du film :</h5>
                    <p class="fw-bold" style="width: 50%;">
                        <?php echo $first["Plot"]; ?>
                    </p>
                </div>

                <div class="my-5">
                    <h5 class="text-uppercase fw-bold mt-3">Réalisateurs du film :</h5>
                    <p class="fw-bold" style="width: 50%;">
                        <?php
                        if (isset($first['directors'])) {
                            foreach ($first['directors'] as $actor) {
                                echo "<span class='fw-bold me-3'>" . $actor[0]["primaryname"] . "</span>";
                            }
                        } else {
                            echo "<span class='fw-bold'>Aucun réalisateur renseigné</span>";
                        }
                        ?>
                    </p>
                </div>

                <div class="my-5">
                    <h5 class="text-uppercase fw-bold mt-3">Acteurs du film :</h5>
                    <p class="fw-bold" style="width: 50%;">
                        <?php
                        if (isset($first['characters'])) {
                            foreach ($first['characters'] as $actor) {
                                echo "<span class='fw-bold me-3'>" . $actor["primaryname"] . "</span>";
                            }
                        } else {
                            echo "<span class='fw-bold'>Aucun acteur renseigné</span>";
                        }
                        ?>
                    </p>
                </div>

                <div class="my-5">
                    <h5 class="text-uppercase fw-bold mt-3">Genre du film :</h5>
                    <p class="fw-bold" style="width: 50%;">
                        <?php foreach ($genre as $g) : ?>
                            <button type="button" class="btn btn-outline-light btn-sm"><?php echo $g; ?></button>
                        <?php endforeach; ?>
                    </p>
                </div>

                <div class="my-5">
                    <h5 class="text-uppercase fw-bold mt-3">Date de sortie du film :</h5>
                    <p class="fw-bold" style="width: 50%;">
                        <?php echo $first['startyear']; ?>
                    </p>
                </div>

                <div class="my-5">
                    <h5 class="text-uppercase fw-bold mt-3">Durée du film :</h5>
                    <p class="fw-bold" style="width: 50%;">
                        <?php
                        if (isset($first['runtimeminutes'])) {
                            echo $first['runtimeminutes'] . " minutes";
                        } else {
                            echo "Aucune durée renseignée";
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'view_end.php'; ?>