<?php

class QuestionnaireDAO extends DAO
{

    protected $table_name = "questionnaire";
    protected $table_id = "id";
    protected $foreign_key = "student_number";
    protected $join_table_name = "students";
    protected $join_table_id = "student_number";

}

?>
