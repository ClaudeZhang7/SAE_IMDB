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
        <?php
        require './ModelApi.php';

        $url = 'http://localhost:5001';
        $testApi = new ModelApi($url);
        $myData = $testApi->get_data();
        
        echo "<div class='block'>" .
                "<img src=" . $myData["poster"] . "/>" .
            "<div>" .
                "<h1>" .
                $myData["title"]
                . "</h1>" .
                "<h3>" .
                    $myData["year"]
                . "</h3>" . 
                "<p>" .
                    $myData["description"]
                . "</p>"
            . "</div>"
        . "</div>";
        ?>
    </section>
</body>
</html>