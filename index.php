<?php
// Declare the interface 'iTemplate'

require_once("DAO/DAOfactory.php");
require_once("DAO/abstractDAO.php");
require_once("DAO/lecturerDAO.php");
require_once("DAO/taskDAO.php");
require_once("DAO/courseDAO.php");
require_once("DAO/nationalityDAO.php");
require_once("DAO/questionnaireDAO.php");
require_once("DAO/studentDAO.php");

require_once("Model.php");
require_once("View.php");
require_once("Controller.php");

require_once("MVC/abstractMVC.php");
require_once("MVC/courseMVC.php");
require_once("MVC/lecturerMVC.php");
require_once("MVC/nationalityMVC.php");
require_once("MVC/questionnaireMVC.php");
require_once("MVC/studentMVC.php");
require_once("MVC/taskMVC.php");


require_once 'Slim/Slim.php';

Slim\Slim::registerAutoloader();

$app = new Slim\Slim(array('debug' => true));

$app->map('/v1/:resource(/:id)(/:related_resource)', function($resource, $id=NULL, $related_resource=NULL) use ($app) {

	$datatype="json";
	$factory;

	switch ($resource) {
		case "lecturers":
			$factory = new LecturerMVCFactory();
			break;
		case "students":
			$factory = new StudentMVCFactory();
			break;
		case "tasks":
			$factory = new TaskMVCFactory();
			break;
		case "nationalities":
			$factory = new NationalityMVCFactory();
			break;
		case "courses":
			$factory = new CourseMVCFactory();
			break;
		case "questionnaires":
			$factory = new QuestionnaireMVCFactory();
			break;
		default:
			$app->redirect('/error');
			break;
		}

	$model = $factory->createModel();

	$method = clean_request($app->request->getMethod());
	$params = $app->request->params();
	$controller = $factory->createController($model, $method, $params);
	$view = $factory->createView($model);

	header("Content-Type: application/$datatype");
	echo $view->output("$datatype");
	exit;

})->via('GET', 'POST', 'PUT', 'DELETE');

$app->run();

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
