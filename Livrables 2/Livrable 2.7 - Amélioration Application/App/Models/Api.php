<?php
    class Api{

        private $api;
        private static $instance = null;

        private function __construct(){
            $this->api = "http://www.omdbapi.com/?apikey=12315667&i=";
        }

        public static function getApi(){
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function get_data_by_id($id){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->api . $id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 50,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/json"
                ),
            ));
    
            $data = curl_exec($curl);
            $data = json_decode($data);
            curl_close($curl);
    
            if ($data !== false) {
                // data to array
                $data = json_decode(json_encode($data), true);
                return $data;
            } else {
                return var_dump(curl_error($curl));
            }
        }

        public function get_data_by_ids($ids){
            // get data from api for each id with curl async
            $curl_arr = array();
            $master = curl_multi_init();
        
            foreach ($ids as $i => $id) {
                $curl_arr[$i] = curl_init();
                curl_setopt_array($curl_arr[$i], array(
                    CURLOPT_URL => $this->api . $id,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 50,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "content-type: application/json"
                    ),
                ));
                curl_multi_add_handle($master, $curl_arr[$i]);
            }
        
            do {
                curl_multi_exec($master, $running);
            } while ($running > 0);
        
            $data = array();
            foreach ($ids as $i => $id) {
                $response = curl_multi_getcontent($curl_arr[$i]);
                $data[$id] = json_decode($response, true); // decode json response to an array
            }
        
            foreach ($ids as $i => $id) {
                curl_multi_remove_handle($master, $curl_arr[$i]);
            }
        
            curl_multi_close($master);
        
            return $data;
        }
        
    }
?>