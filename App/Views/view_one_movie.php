<?php
require_once 'view_begin.php';
$first = $data[0];
$genre = $first['genres'];
$genre = str_replace(["{", "}"], '', $genre);
$genre = explode(",", $genre);
?>

<div class="container-fluid‡ p-0 m-0 my-3" style="
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

                <h5 class="text-uppercase fw-bold mt-3" id="description">Description du film :</h5>
                <p class="fw-bold" id="description" style="width: 50%;">
                    <?php echo $first["Plot"]; ?>
                </p>

                <h5 class="text-uppercase fw-bold mt-3" id="description">Réalisateurs du film :</h5>
                <p class="fw-bold" id="description" style="width: 50%;">
                    <?php
                    if (isset($first['directors'])) {
                        foreach ($first['directors'] as $actor) {
                            echo "<p class='fw-bold'>" . $actor[0]["primaryname"] . "</p>";
                        }
                    } else {
                        echo "<p class='fw-bold'>Aucun réalisateur renseigné</p>";
                    }
                    ?>
                </p>

                <h5 class="text-uppercase fw-bold mt-3" id="description">Acteurs du film :</h5>
                <p class="fw-bold" id="description" style="width: 50%;">
                    <?php
                    if (isset($first['characters'])) {
                        foreach ($first['characters'] as $actor) {
                            echo "<p class='fw-bold'>" . $actor["primaryname"] . "</p>";
                        }
                    } else {
                        echo "<p class='fw-bold'>Aucun acteur renseigné</p>";
                    }
                    ?>
                </p>

                <h5 class="text-uppercase fw-bold mt-3" id="description">Genre du film :</h5>
                <p class="fw-bold" id="description" style="width: 50%;">
                    <?php foreach ($genre as $g) : ?>
                        <button type="button" class="btn btn-outline-light btn-sm"><?php echo $g; ?></button>
                    <?php endforeach; ?>
                </p>

                <h5 class="text-uppercase fw-bold mt-3" id="description">Date de sortie du film :</h5>
                <p class="fw-bold" id="description" style="width: 50%;">
                    <?php echo $first['startyear']; ?>
                </p>

                <h5 class="text-uppercase fw-bold mt-3" id="description">Durée du film :</h5>
                <p class="fw-bold" id="description" style="width: 50%;">
                    <?php echo $first['runtimeminutes']; ?> minutes
                </p>
            </div>
        </div>
    </div>

    <?php require_once 'view_end.php'; ?>