<?php namespace helper;

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

/**
* The purpose of this function is to decouple the
* routing logic in the controller from REST and HTTP.
* The function takes a HTTP request type and parameters from the request
* and parses these to return an action. This action may be either:
* get, search, insert, update or delete. The function will stop a user
* from inserting when they have set a value for id as per the API design.
*/

function clean_request($req_type, &$actions_params){

    //Get references for cleaner code
    $params =& $actions_params["params"];
    $conditions =& $actions_params["conditions"];
    $query =& $actions_params["query"];

    \helper\assign_and_unset("offset",$params,$conditions);
    \helper\assign_and_unset("limit",$params,$conditions);
    \helper\assign_and_unset("fields",$params,$conditions);

    switch ($req_type) {
        case 'GET':
        if(\helper\array_and_key_exist($params, "query")){
            $query = urldecode($params["query"]);
            unset($params["query"]);
            $clean_method = "search";
        } else {
            $clean_method = "get";
        }
        break;
        case 'POST':
        if($actions_params["id"] !== null)
        throw new Exception("Can't insert with id");
        $clean_method = "insert";
        break;
        case 'PUT':
        $clean_method = "update";
        break;
        case 'DELETE':
        $clean_method = "delete";
        break;
        default:
        $clean_method = "get";
        break;
    }

    return $clean_method;

}

// Check if the request contains a datatype that the view can return
// If the view can't return it or no datatype is set return JSON
function getDatatype(&$params, $view){

    if(array_key_exists("datatype",$params)
    && in_array(strtolower($params["datatype"]), $view->getAvailableDatatypes())){

        $datatype = strtolower($params["datatype"]);
        unset($params["datatype"]);

    } else{

        if(isset($params["datatype"])){
            unset($params["datatype"]);
        }
        $datatype="json";

    }

    return $datatype;
}


?>
