<?php

class Algo {
    private $apiUrl;
    const TIMEOUT = 50;  // Timeout in seconds

    public function __construct($apiUrl){
        $this->apiUrl = $apiUrl;
    }

    public static function getAlgo($apiUrl){
        return new self($apiUrl);
    }

    public function getMoviePoster($tconst) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . "/" . urlencode($tconst));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::TIMEOUT);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::TIMEOUT);
        $output = curl_exec($ch);
        curl_close($ch); 
        return $output;
    }    

    public function getMoviesPoster($tconsts) {
        // get the movie posters for each tconst in the array asynchonously
        $multiCurl = array();
        $result = array();
        $mh = curl_multi_init();
        foreach ($tconsts as $i => $tconst) {
            $multiCurl[$i] = curl_init();
            curl_setopt($multiCurl[$i], CURLOPT_URL, $this->apiUrl . "/" . urlencode($tconst));
            curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($multiCurl[$i], CURLOPT_CONNECTTIMEOUT, self::TIMEOUT);
            curl_setopt($multiCurl[$i], CURLOPT_TIMEOUT, self::TIMEOUT);
            curl_multi_add_handle($mh, $multiCurl[$i]);
        }
        $index=null;
        do {
            curl_multi_exec($mh,$index);
        } while($index > 0);
        foreach($multiCurl as $k => $ch) {
            $result[$tconsts[$k]] = curl_multi_getcontent($ch);
            curl_multi_remove_handle($mh, $ch);
        }
        curl_multi_close($mh);
        return $result;
    }
}
