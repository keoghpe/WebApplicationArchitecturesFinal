<?php
// Declare the interface 'iTemplate'
abstract class MVCFactory
{
	private $DAO_Fact;

	public function __construct(){
		$this->DAO_Factory = new DAO_Factory();
	}
    public function createView($model){
    	return new View($model);
    }
    public function createController($model, $action, $params){
    	return new Controller($model, $action, $params);
    }
    abstract public function createModel();
}

class DAO_Factory {
	public function initDBResources(){
		# code...
	}
	public function getLecturerDAO()
	{
		return new LecturerDAO();
	}
	public function getCourseDAO()
	{
		return new CourseDAO();
	}
	public function getTaskDAO()
	{
		return new TaskDAO();
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
	public function createModel(){
		$this->DAO_Factory->initDBResources();
		$DAO = $this->DAO_Factory->getLecturerDAO();
		return new Model($DAO);
	}
}

class CourseMVCFactory extends MVCFactory
{
	public function createModel(){
		$this->DAO_Factory->initDBResources();
		$DAO = $this->DAO_Factory->getCourseDAO();
		return new Model($DAO);
	}
}

class TaskMVCFactory extends MVCFactory
{
	public function createModel(){
		$this->DAO_Factory->initDBResources();
		$DAO = $this->DAO_Factory->getTaskDAO();
		return new Model($DAO);
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

$app->map('(/:datatype)/api/:table(/:method_id)', function($datatype="json", $table, $method_id=NULL) use ($app) {
	
	$factory;
	if ($table === "lecturer") {
		$factory = new LecturerMVCFactory();
	} else if ($table === "course") {
		$factory = new CourseMVCFactory();
	} else if ($table === "task"){
		$factory = new TaskMVCFactory();
	} else {
		$app->redirect('/error');
	}

	$model = $factory->createModel();

	$method = clean_request($app->request->getMethod(), $method_id);
	$params = $app->request->params();

	$controller = $factory->createController($model, $method_id, $params);
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