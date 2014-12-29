App.Router = Backbone.Router.extend({
    routes: {
        '': 'index',
        'docs':'docs',
        'docs/overview':'docsOverview',
        'docs/:endpoint':'endpoint',
        'test/tasks':'tasks',
        'test/lecturers':'lecturers',
        'test/students':'students',
        'test/nationalities':'nationalities',
        'test/courses':'courses',
        'test':'test'
    },

    index: function(){
        vent.trigger('index');
    },

    test: function(){
        vent.trigger('test');
    },

    docs: function(){
        vent.trigger('docs:home');
    },

    endpoint: function(name){

        var endpoint = new App.Models.Details(window.details[name]);

        if($('.appContent').is(':empty')){
            this.docs();
        }

        var detailsView = new App.Views.Details({model:endpoint});
        $(".docsContent").empty();
        $(".docsContent").append(detailsView.render().el);
    },

    docsOverview: function(){
        vent.trigger('docs:overview');
    },

    tasks: function(){
        vent.trigger('test:tasks');
    },

    lecturers: function(){
        vent.trigger('test:lecturers');
    },

    students: function(){
        vent.trigger('test:students');
    },

    nationalities: function(){
        vent.trigger('test:nationalities');
    },

    courses: function(){
        vent.trigger('test:courses');
    },

    default: function(other){
        console.log("You tried to tune into" + other);
    }
});
