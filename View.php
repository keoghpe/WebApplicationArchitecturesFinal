<?php

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


?>
