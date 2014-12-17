App.Collections.Students = Backbone.Collection.extend({
    model: App.Models.Task,

    url:'WebAppArchitectures/index.php/v1/students'
});
