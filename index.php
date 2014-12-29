<?php

require_once("DAO/DAOfactory.php");
require_once("MVC/MVC.php");
require_once("Slim/Slim.php");
require_once("helper.php");

Slim\Slim::registerAutoloader();

$app = new Slim\Slim(array('debug' => true));

$app->map('/v1/:resource(/:id)(/:related_resource)',
	function($resource, $id=NULL, $related_resource=NULL) use ($app) {

	// A list of the resources available
	// This list is used to stop a user from
	// requesting a resource that is unavailable
	$resources_array = array("lecturers", "students",
							"tasks", "nationalities",
							"courses", "questionnaires");


	//An array of sorted params that can be used by the appropriate
	//parts of the application
	$sorted_params = array("id"=>$id,
							"query"=>null,
							"params"=>null,
							"conditions"=>null,
							"related"=>null);

	// If the user specifies a related resource create the factory
	// for that resource instead
	if($related_resource !==NULL){
		$sorted_params["related"] = $resource;
		$resource = $related_resource;
	}


	if(in_array($resource, $resources_array)){

		// Format the type to be unpluralised so
		// the factory can get the correct model
		// e.g. convert lecturers to Lecturer
		$resource = \helper\singularify($resource);
		$factory = new MVCFactory($resource);

	} else{
		$app->redirect('/error');
	}


	$model = $factory->createModel();
	$view = $factory->createView($model, $resource);
	$params = $app->request->params();

	foreach ($params as $key => $value) {
		$params[$key] = addslashes(htmlentities($value));
	}


	// Check if the request contains a valid datatype field
	$dataType = \helper\getDatatype($params, $view);

	$sorted_params["params"] = $params;

	try{
		$action = \helper\clean_request($app->request->getMethod(), $sorted_params);
	} catch(Exception $e){
		$app->redirect('/error');
	}


	$controller = $factory->createController($model, $action, $sorted_params);

	header("Content-Type: application/$dataType");
	echo $view->output("$dataType");
	exit;

})->via('GET', 'POST', 'PUT', 'DELETE');

//If the user isn't using the API redirect to the homepage
$app->get("(/)", function(){
	header("Location: ". HOMEPAGE_LOCATION);
	die();
});

$app->run();

?>
