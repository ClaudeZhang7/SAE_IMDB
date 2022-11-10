<?php

    class ModelApi{
        private $fetch;
        private $data;

        public function __construct($url)
        {
            $this->fetch = curl_init($url);
            curl_setopt($this->fetch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($this->fetch, CURLOPT_RETURNTRANSFER, true);
            $this->data = curl_exec($this->fetch);
            $this->data = json_decode($this->data, true);
            curl_close($this->fetch);
        }

        public function get_data(){
            if($this->data !== false){
                return $this->data;
            } 
            else {
                return var_dump(curl_error($this->fetch));
            }
        }
    }
?>