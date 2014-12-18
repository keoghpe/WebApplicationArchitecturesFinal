/*jshint unused: false, undef:false */

'use strict';

(function () {

    window.App = window.App || {
        Models: {},
        Collections: {},
        Views: {},
        Router: {}
    };

    window.template = function (id) {
        return Handlebars.compile($('#' + id).html());
    }

    window.details = {
        lecturers: {title: "Lecturers", description: "Some stuff"},
        courses: {title: "Courses", description: "Some stuff"},
        nationalities: {title: "Nationalities", description: "Some stuff"},
        questionnaires: {title: "Questionnaires", description: "Some stuff"},
        students: {title: "Students", description: "Some stuff"},
        tasks: {title: "Tasks", description: "Some stuff"}    
    };

})();
