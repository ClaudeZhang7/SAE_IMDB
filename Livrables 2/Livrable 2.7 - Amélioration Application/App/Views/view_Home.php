<?php
require_once 'view_begin.php';
$first = $data[0];
$genre = $first['genres'];
$genre = str_replace(["{", "}"], '', $genre);
$genre = explode(",", $genre);
?>

<title>ApnaTV.com | Page d'accueil</title>

<style>
    @media only screen and (max-width: 600px) {

        /* styles pour les écrans de moins de 600px (téléphones) */
        .description-width {
            width: 100%;
        }
    }

    @media only screen and (min-width: 600px) and (max-width: 1200px) {

        /* styles pour les écrans entre 600px et 1200px (tablettes) */
        .description-width {
            width: 75%;
        }
    }

    @media only screen and (min-width: 1200px) {

        /* styles pour les écrans de plus de 1200px (ordinateurs de bureau, télévisions) */
        .description-width {
            width: 50%;
        }
    }
</style>

<style>
    @media only screen and (max-width: 600px) {
        /* styles pour les écrans de moins de 600px (téléphones) */
        .description-width {
            width: 100%;
        }
        #titre {
            font-size: 1.5em; /* adjust as needed */
        }
    }

    @media only screen and (min-width: 600px) and (max-width: 1200px) {
        /* styles pour les écrans entre 600px et 1200px (tablettes) */
        .description-width {
            width: 75%;
        }
        #titre {
            font-size: 2em; /* adjust as needed */
        }
    }

    @media only screen and (min-width: 1200px) {
        /* styles pour les écrans de plus de 1200px (ordinateurs de bureau, télévisions) */
        .description-width {
            width: 50%;
        }
        #titre {
            font-size: 2.5em; /* adjust as needed */
        }
    }
</style>


<div class="container-fluid vh-100 p-0 m-0" style="
    <?php
    echo "background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(255,255,255,0) 100%), url('https://lumiere-a.akamaihd.net/v1/images/image_24641330.jpeg?region=0,101,2160,1215&width=2048'
    ); background-size: cover; background-repeat: no-repeat; background-position: top; width: 100%;"
    ?> ">
    <div class="d-flex align-items-start justify-content-start" style="width: 100%;">

        <div class="row mx-5" style="margin-top: 150px;">
            <div class="text-white">
                <h1 class="display-3 text-uppercase fw-bold" id="titre">
                    <?php echo $first['primarytitle']; ?>
                </h1>
                <h5 class="text-uppercase fw-bold mt-3" id="description">Description du film :</h5>
                <p class="fw-bold description-width" id="description">
                    <?php echo $first["Plot"]; ?>
                </p>
                <div class="my-5">

                    <h5 class="text-uppercase fw-bold mt-3" id="description">Genre du film :</h5>
                    <p class="fw-bold description-width" id="description">
                        <?php foreach ($genre as $g) : ?>
                            <button type="button" class="btn btn-outline-light btn-sm"><?php echo $g; ?></button>
                        <?php endforeach; ?>
                    </p>
                    <a href=<?php
                            echo "index.php?controller=OneMovie&id=" . $first['tconst'];
                            ?> class="btn btn-outline-light mt-3">
                        Voir le film
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class=" d-flex align-items-start justify-content-start" style="width: 100%;">
        <div class="mx-5 my-5" style="width: 100%;">
            <div class="text-white">
                <h5 class="text-uppercase fw-bold mt-3" id="description">Les Derniers Films :</h5>

                <div style="background: radial-gradient(circle, rgba(207,207,207,0.2) 0%, rgba(241,241,241,0.2) 100%); width: 100%; height: 300px; border-radius: 20px; margin-top: 20px; border: 1px solid rgba(255,255,255,0.5); -webkit-backdrop-filter: blur(10px);
  backdrop-filter: blur(10px);">
                    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%;">
                        <?php
                        require_once 'Content/Components/Carrousel.php';
                        $dataFilm = $data
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'view_end.php'; ?>