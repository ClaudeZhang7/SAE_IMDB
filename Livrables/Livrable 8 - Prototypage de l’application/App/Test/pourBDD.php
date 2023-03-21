<?php
$host = "localhost";
$driver = "pgsql";
$dbname = "postgres";
$user = "saeroot";
$password = "root";
$port = "8080";
$dsn = "$driver:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

$db = new PDO($dsn);

$chaine="";


switch ($_GET['typeRequeteSQL']) {
    case 1:
        $chaine = "select primaryTitle from VUE_FOR_RECHERCHE WHERE (primaryTitle LIKE '%".$_GET['inputUser']."%' OR originalTitle LIKE '%".$_GET['inputUser']."%' and category ='".$_GET['category']."') limit 100;";
        break;
    case 2:
        $chaine = "select distinct primaryTitle from VUE_FOR_RECHERCHE where primaryName LIKE '%".$_GET['primaryName']."%' limit 100;";
        break;
    case 3:
        $chaine = "select distinct primaryName from VUE_FOR_RECHERCHE where primaryTitle LIKE '%".$_GET['inputUser']."%' OR originalTitle LIKE '%".$_GET['inputUser']."%' limit 100;";
        break;
    default:
        echo('error');
        break;
}

//$requete = str_replace("|", " ", $_GET['requeteSQL']); //$requete = "SELECT * FROM title_basics LIMIT 10";


$stmt = $db->prepare($chaine);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


/*
$data = $db
    ->query($chaine)
    ->fetchAll(PDO::FETCH_ASSOC);
*/


echo "<ul>";
foreach ($data as $row) {
    echo "<li>";
    foreach ($row as $key => $value) {
        echo $value;
    }
    echo "</li>";
}
echo "</ul>";
?>