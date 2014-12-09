<?php
// Declare the interface 'iTemplate'
abstract class MVCFactory
{
	private $DAO_Factory;
	protected $type;

	public function __construct(){
		$this->DAO_Factory = new DAO_Factory();
	}
    public function createView($model){
    	return new View($model);
    }
    public function createController($model, $action, $params){
    	return new Controller($model, $action, $params);
    }
	public function createModel(){
		$this->DAO_Factory->initDBResources();
		$DAO = $this->DAO_Factory->getDAO($this->type);
		return new Model($DAO);
	}
}

class DAO_Factory {

	public function initDBResources(){
		# code...
	}

	public function getDAO($type='')
	{
		switch ($type) {
			case 'Lecturer':
				return new LecturerDAO();
				break;
			case 'Course':
				return new CourseDAO();
				break;
			case 'Task':
				return new TaskDAO();
				break;
			case 'Student':
				return new StudentDAO();
				break;
			case 'Nationality':
				return new NationalityDAO();
				break;
			case 'Questionnaire':
				return new QuestionnaireDAO();
				break;
			default:
				echo "derp";
				break;
		}
	}
}

/**
* §
*/
abstract class DAO
{

	function __construct()
	{
	}
	abstract public function get($params);
	abstract public function search($params);
	abstract public function insert($params);
	abstract public function update($params);
	abstract public function delete($params);
}

class CourseDAO extends DAO
{

	function __construct()
	{
	}
	public function get($params){
		return ["Course Name" => "Physics", "Course Lecturer"=>"Clem Fandango"];
	}
	public function search($params){
		return "search Course";
	}
	public function insert($params){
		return "insert Course";
	}
	public function update($params){
		return "update Course";
	}
	public function delete($params){
		return "delete Course";
	}
}

class TaskDAO extends DAO
{

	function __construct()
	{
	}
	public function get($params=null){
		return "get Task";
	}
	public function search($params){
		return "search Task";
	}
	public function insert($params){
		return "insert Task";
	}
	public function update($params){
		return "update Task";
	}
	public function delete($params){
		return "delete Task";
	}
}

class LecturerDAO extends DAO
{

	function __construct()
	{
	}
	public function get($params=null){
		return "get Lecturer";
	}
	public function search($params){
		return "search Lecturer";
	}
	public function insert($params){
		return "insert Lecturer";
	}
	public function update($params){
		return "update Lecturer";
	}
	public function delete($params){
		return "delete Lecturer";
	}
}



class LecturerMVCFactory extends MVCFactory
{
	function __construct() {
		parent::__construct();
		$this->type = "Lecturer";
	}
}

class CourseMVCFactory extends MVCFactory
{
	function __construct() {
		parent::__construct();
		$this->type = "Course";
	}
}

class StudentMVCFactory extends MVCFactory
{
	function __construct() {
		parent::__construct();
		$this->type = "Student";
	}
}

class NationalityMVCFactory extends MVCFactory
{
	function __construct() {
		parent::__construct();
		$this->type = "Nationality";
	}
}

class QuestionnaireMVCFactory extends MVCFactory
{
	function __construct() {
		parent::__construct();
		$this->type = "Questionnaire";
	}
}

class TaskMVCFactory extends MVCFactory
{
	function __construct() {
		parent::__construct();
		$this->type = "Task";
	}
}

class View {

	private $model;
	function __construct($model){
		$this->model = $model;
	}

	public function output($type=null){
		if ($type==="csv") {
			return $this->toCSV($this->model->output());
		} else if($type==="xml"){
			return $this->toXML($this->model->output());
		} else {
			return json_encode($this->model->output());
		}
	}

	public function toCSV($anArray){
		$CSV = "";
		$line = "";
		if (!is_array($anArray[0])) {

			foreach ($anArray as $key => $value) {
				$CSV .= $key . ", ";
				$line .= $value . ", ";
			}

			return $CSV . "\n" . $line;
		} else {

			foreach ($anArray[0] as $key => $value) {
				$CSV .= $key . ", ";
			}
			$CSV .= "\n";

			for($i=0; $i < count($anArray); $i++) {
				foreach ($anArray[i] as $key => $value) {
					$CSV .= $value. ", ";
				}
				$CSV .= "\n";
			}

			return $CSV;
		}

	}

	public function toXML($anArray){

		$xml = new SimpleXMLElement('<response/>');
		array_walk_recursive($anArray, array($xml, 'addChild'));
		return $xml->asXML();
	}
}

class Model {
	private $DAO, $resultsList;

	function __construct($aDAO)
	{
		$this->DAO = $aDAO;
	}

	public function get($params=null){
		$this->resultsList = $this->DAO->get($params);
	}
	public function search($params){
		$this->resultsList = $this->DAO->search($params);
	}
	public function insert($params){
		$this->resultsList = $this->DAO->insert($params);
	}
	public function delete($params){
		$this->resultsList = $this->DAO->delete($params);
	}
	public function update($params){
		$this->resultsList = $this->DAO->update($params);
	}
	public function output(){
		return $this->resultsList;
	}
}

class Controller{
	private $model;

	public function __construct($model, $action, $parameters=NULL) {
		$this->model = $model;
		if ($action !== NULL) {
			switch ($action) {
				case "get":
					$this->model->get($parameters);
					break;
				case "search":
					$this->model->search($parameters);
					break;
				case "insert":
					$this->model->insert($parameters);
					break;
				case "update":
					$this->model->update($parameters);
					break;
				case "delete":
					$this->model->delete($parameters);
					break;
			}
		}
	}
}


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
