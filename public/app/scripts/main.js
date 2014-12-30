/*jshint unused: false, undef:false */

'use strict';

(function () {

    window.App = window.App || {
        Models: {},
        Collections: {},
        Views: {},
        Router: {}
    };

    window.App.baseurl = "../../";//"WebAppArchitectures/";

    window.template = function (id) {
        return Handlebars.compile($('#' + id).html());
    }


    var longstring = '{"id":"1",\n"student_number":"4c21efd175de0cbc672f73b01d9e3e007ef4824c",\n';
    longstring += '"task_number":"1",\n"MWL_total":"10",\n"RSME":"70",\n"time_1":"11:50:05",\n"NASA_mental":"13",\n';
    longstring += '"NASA_physical":"10",\n"NASA_temporal":"11",\n"NASA_performance":"7",\n"NASA_frustration":"11",\n';
    longstring += '"NASA_effort":"11",\n"NASA_temporal_or_frustration":"1",\n"NASA_performance_or_mental":"2",\n';
    longstring += '"NASA_mental_or_physical":"1",\n"NASA_frustration_or_performance":"2",\n"NASA_temporal_or_effort":"2",\n';
    longstring += '"NASA_physical_or_frustration":"2",\n"NASA_performance_or_temporal":"1",\n"NASA_mental_or_effort":"2",\n';
    longstring += '"NASA_physical_or_temporal":"1",\n"NASA_frustration_or_effort":"2",\n"NASA_physical_or_performance":"2",\n';
    longstring += '"NASA_temporal_or_mental":"2",\n"NASA_effort_or_physical":"1",\n"NASA_frustration_or_mental":"2",\n';
    longstring += '"NASA_performance_or_effort":"2",\n"WP_solving_deciding":null,\n"WP_response_selection":null,\n"WP_task_space":null,\n';
    longstring += '"WP_verbal_material":null,\n"WP_visual_resources":null,\n"WP_auditory_resources":null,\n"WP_manual_response":null,\n';
    longstring += '"WP_speech_response":null,\n"AT_mental":null,\n"AT_parallelism":null,\n"AT_temporal":null,\n"AT_manual":null,\n';
    longstring += '"AT_visual":null ,\n"AT_solving_deciding":null ,\n"AT_frustration":null,\n"AT_context_bias":null,\n';
    longstring += '"AT_task_space":null,\n"AT_motivation":null,\n"AT_verbal_material":null,\n"AT_skill":null,\n';
    longstring += '"AT_auditory_resources":null,\n"AT_physical_demand":null,\n"AT_speech_response":null,\n"AT_past_knowledge":null,\n';
    longstring += '"AT_arousal":null,\n"AT_performance":null,\n"AT_response_selection":null,\n"time_2":"11:53:10",\n"intrusiveness":"11",\n';
    longstring += '"not_valid":"0"}';

    window.details = {
        lecturers: {
            title: "Lecturers",
            description: "Some stuff",
            url: "/v1/lecturers",
            output: '{\n"id":"1",\n"name":"Luca Longo"\n}',
            related: ["/v1/lecturers/1/courses"]},
        courses: {
            title: "Courses",
            description: "Some stuff",
            url: "/v1/courses",
            output: '{"id_course":"1",\n"description":"Web Application Architectures",\n"lecturer_id":"1"}',
            related: ["/v1/courses/1/tasks"]
            },
        nationalities: {
            title: "Nationalities",
            description: "Some stuff",
            url: "/v1/nationalities",
            output: '{\n"id":"1",\n"description":"Australia"\n}',
            related: ["/v1/nationalies/1/students"]
            },
        questionnaires: {
            title: "Questionnaires",
            description: "Some stuff",
            url: "/v1/questionnaires",
            output: longstring},
        students: {
            title: "Students",
            description: "Some stuff",
            url: "/v1/students",
            output: '{"student_number":"00ad36b687fdcd2c99c49038826b07bc76c441ff",\n"age":"30",\n"id_nationality":"8"}'},
        tasks: {
            title: "Tasks",
            description: "Some stuff",
            url: "/v1/tasks",
            output: '{"task_id":"1",\n"description":"Luca - intro + cgi (lecture) - 45 minutes - 1st year master students - traditional lecture with some question",\n"date":"2014-01-27",\n"duration_mins":"41",\n"daytime":"11-12",\n"course_id":"1"}'}
    };

    window.vent = _.extend({}, Backbone.Events);


})();
