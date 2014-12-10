<?php

class QuestionnaireDAO extends DAO
{

    protected $table_name = "questionnaire";
    protected $table_id = "id";
    protected $foreign_key = "student_number";
    protected $join_table_name = "students";
    protected $join_table_id = "student_number";

    public function search($params){
        return "search Questionnaire";
    }
    public function update($params){
        return "update Questionnaire";
    }
    public function delete($params){
        return "delete Questionnaire";
    }
}

?>
