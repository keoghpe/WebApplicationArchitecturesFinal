// var taskCollection = new App.Collections.Tasks([{description:'derp'},{description:'nerp'}]);
//
// var tasksView = new App.Views.Tasks({ collection : taskCollection });
// $(".header").append(tasksView.render().el);

new App.Router;
Backbone.history.start();


var taskCollection = new App.Collections.Tasks([{description:'derp'},{description:'nerp'}]);

var tasksView = new App.Views.Tasks({ collection : taskCollection });
$(".header").append(tasksView.render().el);
