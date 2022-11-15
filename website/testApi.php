<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>test du block amazon prime</title>
</head>
<body>
    <section>
        <h3>Films</h3>
        <div class="wrap">
            <?php
                require_once './Function/Api.php';
                $data_id = get_poster_by_id("tt0000001");
                echo $data_id;
                $data_name = get_poster_by_name("Titanic");
                echo $data_name;
            ?>
        </div>
    </section>
    <section>
        <h3>Series</h3>
        <div class="wrap">
            <?php
                require_once './Function/Api.php';
                $data_id2 = get_poster_by_id("tt0000020");
                echo $data_id2;
                $data_name2 = get_poster_by_name("Titanic");
                echo $data_name2;
            ?>
        </div>
    </section>
</body>
</html>