<?php

require_once("DAO/DAOfactory.php");
require_once("MVC/MVC.php");
require_once("Slim/Slim.php");

Slim\Slim::registerAutoloader();

$app = new Slim\Slim(array('debug' => true));

$app->map('/v1/:resource(/:id)(/:related_resource/)',
	function($resource, $id=NULL, $related_resource=NULL) use ($app) {

	$factory;
	$resources_array = array("lecturers", "students",
							"tasks", "nationalities",
							"courses", "questionnaires");

	$actions_params = array("id"=>$id,
							"query"=>null,
							"params"=>null,
							"conditions"=>null,
							"related"=>null);


	if(in_array($resource, $resources_array)){

		// Format the type to be unpluralised so
		// the factory can get the correct model
		// e.g. convert lecturers to Lecturer
		$resource = substr(ucfirst($resource),0,-1);
		$factory = new MVCFactory($resource);

	} else{
		$app->redirect('/error');
	}




	$model = $factory->createModel();
	$view = $factory->createView($model, $resource);

	// Check if the request contains a valid datatype field

	$params = $app->request->params();

	$dataType = getDatatype($params, $view);

	$actions_params["params"] = $params;

	try{
		$action = clean_request($app->request->getMethod(), $actions_params);

	} catch(Exception $e){
		$app->redirect('/error');
	}


	$controller = $factory->createController($model, $action, $actions_params);

	header("Content-Type: application/$dataType");
	echo $view->output("$dataType");
	exit;

})->via('GET', 'POST', 'PUT', 'DELETE');


$app->get("/", function(){
	header("Location: ". HOMEPAGE_LOCATION);
	die();
});

$app->run();

/**
 * The purpose of this function is to decouple the
 * routing logic in the controller from REST and HTTP.
 */

function clean_request($req_type, &$actions_params){

	echo $actions_params["id"];
	//$clean_method = "get";

	if($actions_params["params"] !== null && array_key_exists("limit", $actions_params["params"])){
		$actions_params["conditions"]["limit"] = $actions_params["params"]["limit"];
		unset($actions_params["params"]["limit"]);
	}

	if($actions_params["params"] !== null && array_key_exists("offset", $actions_params["params"])){
		$actions_params["conditions"]["offset"] = $actions_params["params"]["offset"];
		unset($actions_params["params"]["offset"]);
	}


	//
	// if($req_type === "GET"){
	// 	if(array_key_exists("query", $actions_params["params"])){
	// 		$actions_params["query"] = urldecode($actions_params["params"]["query"]);
	// 		unset($actions_params["params"]["query"]);
	// 		$clean_method = "search";
	// 	} else {
	// 		$clean_method = "get";
	// 	}
	// }

	switch ($req_type) {
		case 'GET':

			if($actions_params["params"] !== null && array_key_exists("query", $actions_params["params"])){
				$actions_params["query"] = urldecode($actions_params["params"]["query"]);
				unset($actions_params["params"]["query"]);
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

function getDatatype(&$params, $view){

	if(array_key_exists("datatype",$params)
	&& in_array(strtolower($params["datatype"]),
	$view->getAvailableDatatypes())){

		$datatype = strtolower($params["datatype"]);
		unset($params["datatype"]);

	} else{

		$datatype="json";

	}

	return $datatype;
}

?>
