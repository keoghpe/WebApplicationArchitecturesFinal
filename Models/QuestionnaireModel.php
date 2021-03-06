<?php

class QuestionnaireModel extends Model {

    protected $types = array(
        "id"=>"integer",
        "student_number"=>"hex",
        "task_number"=>"integer",
        "MWL_total"=>"integer",
        "RSME"=>"integer",
        "time_1"=>"time",
        "NASA_mental"=>"integer",
        "NASA_physical"=>"integer",
        "NASA_temporal"=>"integer",
        "NASA_performance"=>"integer",
        "NASA_frustration"=>"integer",
        "NASA_effort"=>"integer",
        "NASA_temporal_or_frustration"=>"integer",
        "NASA_performance_or_mental"=>"integer",
        "NASA_mental_or_physical"=>"integer",
        "NASA_frustration_or_performance"=>"integer",
        "NASA_temporal_or_effort"=>"integer",
        "NASA_physical_or_frustration"=>"integer",
        "NASA_performance_or_temporal"=>"integer",
        "NASA_mental_or_effort"=>"integer",
        "NASA_physical_or_temporal"=>"integer",
        "NASA_frustration_or_effort"=>"integer",
        "NASA_physical_or_performance"=>"integer",
        "NASA_temporal_or_mental"=>"integer",
        "NASA_effort_or_physical"=>"integer",
        "NASA_frustration_or_mental"=>"integer",
        "NASA_performance_or_effort"=>"integer",
        "WP_solving_deciding"=>"integer",
        "WP_response_selection"=>"integer",
        "WP_task_space"=>"integer",
        "WP_verbal_material"=>"integer",
        "WP_visual_resources"=>"integer",
        "WP_auditory_resources"=>"integer",
        "WP_manual_response"=>"integer",
        "WP_speech_response"=>"integer",
        "AT_mental"=>"integer",
        "AT_parallelism"=>"integer",
        "AT_temporal"=>"integer",
        "AT_manual"=>"integer",
        "AT_visual"=>"integer",
        "AT_solving_deciding"=>"integer",
        "AT_frustration"=>"integer",
        "AT_context_bias"=>"integer",
        "AT_task_space"=>"integer",
        "AT_motivation"=>"integer",
        "AT_verbal_material"=>"integer",
        "AT_skill"=>"integer",
        "AT_auditory_resources"=>"integer",
        "AT_physical_demand"=>"integer",
        "AT_speech_response"=>"integer",
        "AT_past_knowledge"=>"integer",
        "AT_arousal"=>"integer",
        "AT_performance"=>"integer",
        "AT_response_selection"=>"integer",
        "time_2"=>"time",
        "intrusiveness"=>"integer",
        "not_valid"=>"integer"
    );
}

?>
