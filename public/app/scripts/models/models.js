App.Models.Details = Backbone.Model.extend({
    defaults: {
        title: 'Something',
        description: 'Something else',
    }
});

App.Models.Lecturer = Backbone.Model.extend({
    defaults: {
        id: 0,
        name: 'Dude',
    },

    urlRoot:'WebAppArchitectures/index.php/v1/lecturers',

    validate: function(attrs){
        if(!$.trim(attrs.name)){
            return 'Name cannot be blank';
        }

    }
});

App.Models.Student = Backbone.Model.extend({
    defaults: {
        student_number: 'ffffffffffffffffffffffffffff',
        age: 18,
        id_nationality: 0
    },

    urlRoot:'WebAppArchitectures/index.php/v1/students',

    validate: function(attrs){

    },

    do: function() {
        console.log('Doing ' + this.get('description'));
    }
});

App.Models.Task = Backbone.Model.extend({
    defaults: {
        task_id: 0,
        description: 'thing',
        date: '2014-04-27',
        duration_mins: 180,
        daytime: '3pm-6pm',
        course_id: 1
    },

    urlRoot:'WebAppArchitectures/index.php/v1/tasks',

    validate: function(attrs){
        if(!$.trim(attrs.description)){
            return 'Description cannot be blank';
        }

        if(attrs.duration < 0){
            return 'Duration cannot be negative';
        }
    },

    do: function() {
        console.log('Doing ' + this.get('description'));
    }
});

App.Models.Nationality = Backbone.Model.extend({
    defaults: {
        id:0,
        description:"anonymous"
    },

    urlRoot:'WebAppArchitectures/index.php/v1/nationalities',

    validate: function(attrs){

    }
});

App.Models.Course = Backbone.Model.extend({
    defaults: {
        id_course:1,
        description:"Web Application Architectures",
        lecturer_id:1
    },

    urlRoot:'WebAppArchitectures/index.php/v1/courses',

    validate: function(attrs){

    }
});
