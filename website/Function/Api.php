<?php
    // Rechercher un film par son id
    function get_data_by_id($id){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.collectapi.com/imdb/imdbSearchById?movieId=" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "authorization: apikey 4r7cpq8EdbmpTqzIj42zow:4KXN6vJuH9AQbv2JvnEUI1",
              "content-type: application/json"
            ),
        ));

        $data = curl_exec($curl);
        $data = json_decode($data);
        curl_close($curl);

        if($data !== false){
            return $data;
        } 
        else {
            return var_dump(curl_error($curl));
        }
    }


    function get_data_by_name($name){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.collectapi.com/imdb/imdbSearchByName?query=" . $name,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "authorization: apikey 4r7cpq8EdbmpTqzIj42zow:4KXN6vJuH9AQbv2JvnEUI1",
              "content-type: application/json"
            ),
        ));

        $data = curl_exec($curl);
        $data = json_decode($data);
        curl_close($curl);

        if($data !== false){
            return $data;
        } 
        else {
            return var_dump(curl_error($curl));
        }
    }

    function get_poster_by_id($id){
        $data = get_data_by_id($id);
        $data_id = (array) $data;
        $array = (array) $data_id["result"];
        echo "<div class='block'><div class='image' style='background-image:
        linear-gradient(0deg, black 0%, rgba(0,0,0,0) 50%),
        url(" . $array["Poster"] . ")'></div><h3>" . $array["Title"] . "</h3></div>";
    }

    function get_poster_by_name($name){
        $data = get_data_by_name($name);
        $data_name = (array) $data;
        $array = (array) $data_name["result"][0];
        echo "<div class='block'><img src=" . $array["Poster"] . "/></div>";
    }

    function get_five_poster($id_debut){
        for ($i=$id_debut; $i < $id_debut+5; $i++) { 
            $id = "tt000000" . strval($i);
            get_poster_by_id($id);
        }
    }

    function get_many_poster($id_debut){
        for ($i=$id_debut; $i < $id_debut+50; $i++) { 
            $id = "tt000000" . strval($i);
            get_poster_by_id($id);
        }
    }
?>