<?php

class View {

    private $model, $resource;
    function __construct($model, $resource){
        $this->resource = $resource;
        $this->model = $model;
    }

    public function getAvailableDatatypes(){
        return array("xml","json","csv");
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

        //If only one row returned
        if (!is_array($anArray[0])) {

            foreach ($anArray as $key => $value) {
                $CSV .= $key . ", ";
                $line .= $value . ", ";
            }
            $CSV = substr($CSV,0,-2);
            $line = substr($line,0,-2);
            return $CSV . "\n" . $line;
        } else {
            //if multiple rows get the column names
            foreach ($anArray[0] as $key => $value) {
                $CSV .= $key . ", ";
            }
            $CSV = substr($CSV,0,-2);
            $CSV .= "\n";

            for($i=0; $i < count($anArray); $i++) {
                foreach ($anArray[$i] as $key => $value) {
                    $CSV .= $value. ", ";
                }
                $CSV = substr($CSV,0,-2);
                $CSV .= "\n";
            }

            return $CSV;
        }

    }

    public function toXML($anArray){

        $response = new SimpleXMLElement("<?xml version=\"1.0\"?><response></response>");

        $this->array_to_xml($anArray,$response);

        return $response->asXML();
    }

    private function array_to_xml($anArray, &$response) {
        
        foreach($anArray as $key => $value) {
            if(is_array($value)) {
                if(!is_numeric($key)){
                    $subnode = $response->addChild("$key");
                    $this->array_to_xml($value, $subnode);
                }
                else{
                    $subnode = $response->addChild("$this->resource$key");
                    $this->array_to_xml($value, $subnode);
                }
            }
            else {
                $response->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}


?>
