<?php
    function arraySqlToArrayPhp(String $arraySql)
    {
        $ArrayPhp = explode(",", str_replace(['{', '}'], '', $arraySql));
        return $ArrayPhp;
    }
?>