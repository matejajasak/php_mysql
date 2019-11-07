<?php

function escape($string){
    return htmlentities($string);
}

function dd($array){
    echo '<pre>';
    if (is_array($array)) {
        print_r($array);
    }else{
        var_dump($array);
    }
    echo '</pre>';
    die();
}

?>