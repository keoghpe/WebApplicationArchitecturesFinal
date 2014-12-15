<?php

require_once("DAO/DAOfactory.php");

require_once("View.php");
require_once("Controller.php");
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

	if(array_key_exists("datatype",$params)
			&& in_array(strtolower($params["datatype"]), $view->getAvailableDatatypes())){
		$datatype = strtolower($params["datatype"]);
		unset($params["datatype"]);
	} else{
		$datatype="json";
	}

	$method = clean_request($app->request->getMethod());

	$controller = $factory->createController($model, $method, $id, $params, $related_resource);

	header("Content-Type: application/$datatype");
	echo $view->output("$datatype");
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

function clean_request($req_type, $method=null){

	$clean_method;
	switch ($req_type) {
		case 'GET':
			$clean_method = "get";
			break;
		case 'POST':
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

	if ($method === null) {
		return $clean_method;
	} else {
		return $method;
	}

}

?>
