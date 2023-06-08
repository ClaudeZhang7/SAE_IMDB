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

<title>Films | Artive</title>

<div class="container-fluid vh-100 v-100 p-0 m-0 d-flex flex-column align-items-center justify-content-start" style="background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(255,255,255,0) 100%)">
    <div style="margin-top: 150px;">
        <h1 class="text-white">Tous les films</h1>
    </div>
    <div class="d-flex flex-row flex-wrap justify-content-center align-items-center" style="margin-top: 50px;">
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

<?php require_once 'view_end.php'; ?>