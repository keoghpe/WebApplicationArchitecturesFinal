App.Collections.Lecturers = Backbone.Collection.extend({
    model: App.Models.Task,

    url:'WebAppArchitectures/index.php/v1/lecturers'
});

App.Collections.Students = Backbone.Collection.extend({
    model: App.Models.Task,

    url:'WebAppArchitectures/index.php/v1/students'
});

App.Collections.Tasks = Backbone.Collection.extend({
    model: App.Models.Task,

    url:'WebAppArchitectures/index.php/v1/tasks'
});

App.Collections.Courses = Backbone.Collection.extend({
    model: App.Models.Course,

    url:'WebAppArchitectures/index.php/v1/courses'
});

App.Collections.Nationalities = Backbone.Collection.extend({
    model: App.Models.Nationality,

    url:'WebAppArchitectures/index.php/v1/nationalities'
});
