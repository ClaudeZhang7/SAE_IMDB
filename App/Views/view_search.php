<?php
require_once 'view_begin.php';
?>

<style>
    .card {
        width: 200px;
        height: 300px;
        transition: .5s;
    }

    .card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card:hover {
        display: block;
        z-index: 10;
        cursor: pointer;
        transform: scale(1.1);
        border: 4px solid #467AFF;
    }

    .card:hover .card-body {
        opacity: 1;
    }

    .card-body {
        opacity: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2;
        background: linear-gradient(to bottom, rgba(4, 8, 15, 0), #192133 90%);
        padding: 10px;
        transition: 0.5s;
    }

    .name {
        color: #fff;
        font-size: 15px;
        font-weight: 500;
        text-transform: capitalize;
        margin-top: 40%;
    }

    .des {
        color: #fff;
        opacity: 0.8;
        margin: 5px 0;
        font-weight: 500;
        font-size: 12px;
    }

    .watchlist-btn {
        position: relative;
        width: 100%;
        text-transform: capitalize;
        background: none;
        border: none;
        font-weight: 500;
        text-align: right;
        color: rgba(255, 255, 255, 0.5);
        margin: 5px 0;
        cursor: pointer;
        text-align: center;
        padding: 10px 5px;
        border-radius: 5px;
    }

    .watchlist-btn:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.1);
    }
</style>

<title>Recherche Film | Artive</title>

<div class="container-fluid p-0 m-0 px-5 d-flex flex-row align-items-start justify-content-between" style="background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(255,255,255,0) 100%)">
    <div class="px-3" style="margin-top: 150px; width: 500px;">
        <p class="text-white">Recherchez votre Film / Serie :</p>
        <form action="index.php?controller=Search" method="post">
            <input type="text" class="form-control mb-3" name="search" placeholder="Rechercher un film ou une serie">

            <p class="text-white mt-3">Filtrez votre recherche :</p>

            <label for="type" class="form-label text-white">Genre :</label>
            <select class="form-select mb-3" name="genre">
                <?php
                foreach ($genres as $genre) {
                    if ($genre != null) {
                        echo '<option value="' . $genre . '">' . $genre . '</option>';
                    }
                }
                ?>
            </select>

            <label for="annee" class="form-label text-white">Année :</label>
            <select class="form-select mb-3" name="date">
                <?php
                foreach ($dates as $date) {
                    if ($date != null) {
                        echo '<option value="' . $date . '">' . $date . '</option>';
                    }
                }
                ?>
            </select>
        </form>
    </div>
    <div class="d-flex flex-column align-items-start justify-content-start" style="margin-top: 150px; width: 100%; height: 100%; border-radius: 10px; min-width: 500px">
        <h3 class="text-white ps-5">Resultats de votre recherche :</h3>

        <div class="d-flex flex-row flex-wrap justify-content-center align-items-center mt-2">
            <?php foreach ($data as $val) : ?>
                <div class="card m-3">
                    <img src=<?php
                                echo $val['Poster']
                                ?> class="card-img" alt="">
                    <div class="card-body">
                        <h2 class="name">
                            <?php echo $val['primarytitle'] ?>
                        </h2>
                        <h6 class="des" style="height: 95px; overflow: hidden;">
                            Description : <br><br>
                            <?php echo $val['Plot'] ?>
                        </h6>
                        <button class="watchlist-btn" onclick="window.location.href = 'index.php?controller=OneMovie&id=<?php echo $val['tconst'] ?>'">
                            Voir
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once 'view_end.php'; ?>