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
