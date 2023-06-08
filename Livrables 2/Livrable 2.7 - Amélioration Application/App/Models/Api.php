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
                CURLOPT_TIMEOUT => 30,
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
    }
?>