<?php namespace helper;

function pluaralise(){
    echo "derp";
}

function singularify($resource){
    $resource = substr(ucfirst($resource),0,-1);
    if($resource === "Nationalitie"){
        $resource = "Nationality";
    }

    return $resource;
}

function array_and_key_exist($array, $key){
    return $array !== null && array_key_exists($key, $array);
}

function assign_and_unset($key, &$from, &$to){
    if(\helper\array_and_key_exist($from, $key)){
        $to[$key] = $from[$key];
        unset($from[$key]);
    }
}



?>
