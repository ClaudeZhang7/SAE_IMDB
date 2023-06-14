<style>
    @media (max-width: 576px) {

        /* Extra small devices (portrait phones, less than 576px) */
        .card {
            min-width: 150px;
            margin-right: 10px;
            /* adjust as needed */
        }

        .name {
            font-size: 13px;
        }

        .des {
            font-size: 10px;
        }
    }

    @media (min-width: 577px) and (max-width: 768px) {

        /* Small devices (landscape phones, 577px and up) */
        .card {
            min-width: 180px;
        }

        .name {
            font-size: 14px;
        }

        .des {
            font-size: 12px;
        }
    }

    @media (min-width: 769px) and (max-width: 992px) {

        /* Medium devices (tablets, 769px and up) */
        .card {
            min-width: 200px;
        }

        .name {
            font-size: 15px;
        }

        .des {
            font-size: 13px;
        }
    }

    @media (min-width: 993px) {

        /* Large devices (desktops, 993px and up) */
        .card {
            min-width: 250px;
        }

        .name {
            font-size: 16px;
        }

        .des {
            font-size: 14px;
        }
    }

    .movies-list {
        width: 90vw;
        height: 100%;
        position: relative;
        margin: 10px 0 20px;
        padding: 15px 0px 10px 0px;
    }

    .card-container {
        position: relative;
        width: 90%;
        padding-left: 10px;
        height: 100%;
        display: flex;
        margin: 0 auto;
        align-items: center;
        overflow-x: auto;
        overflow-y: visible;
        scroll-behavior: smooth;
    }

    .card-container::-webkit-scrollbar {
        display: none;
    }

    .card {
        position: relative;
        min-width: 200px;
        height: 100%;
        border-radius: 10px;
        overflow: hidden;
        margin-right: 20px;
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
        /* transform: scale(1.1); */
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
        margin-top: 50%;
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

    .pre-btn,
    .nxt-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 5%;
        height: 100%;
        z-index: 2;
        border: none;
        cursor: pointer;
        outline: none;
        border-radius: 50%;
    }

    .pre-btn {
        left: 0;
        background: white;
        width: 30px;
        height: 30px;
    }

    .nxt-btn {
        right: 0;
        background: white;
        width: 30px;
        height: 30px;
    }

    .pre-btn img,
    .nxt-btn img {
        width: 15px;
        height: 20px;
        opacity: 0;
    }

    .pre-btn:hover img,
    .nxt-btn:hover img {
        opacity: 1;
    }
</style>

<body>
    <div class="movies-list">
        <button class="pre-btn text-black">
            < </button>
                <button class="nxt-btn text-black">
                    >
                </button>
                <div class="card-container">
                    <?php foreach ($data as $val) : ?>
                        <div class="card">
                            <img src=<?php
                                        echo $val['Poster']
                                        ?> class="card-img" alt="">
                            <div class="card-body">
                                <h2 class="name">
                                    <?php echo $val['primarytitle'] ?>
                                </h2>
                                <h6 class="des" style="height: 50px; overflow: hidden;">
                                    Description :
                                    <?php echo substr($val['Plot'], 0, 50) . "..." ?>
                                </h6>
                                <button class="watchlist-btn" onclick="window.location.href = 'index.php?controller=OneMovie&id=<?php echo $val['tconst'] ?>'">
                                    Voir
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
    </div>
</body>