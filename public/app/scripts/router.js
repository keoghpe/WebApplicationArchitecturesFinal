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
        var taskCollection = new App.Collections.Tasks;

        if($('.appContent').is(':empty')){
            this.test();
        }

        taskCollection.fetch().then(function(){
            var tasksView = new App.Views.Tasks({ collection : taskCollection });
            $(".testContent").empty();
            $(".testContent").append(tasksView.render().el);
        });
    },

    lecturers: function(){
        var lecturerCollection = new App.Collections.Lecturers;

        if($('.appContent').is(':empty')){
            this.test();
        }

        lecturerCollection.fetch().then(function(){
            var lecturersView = new App.Views.Lecturers({ collection : lecturerCollection });
            $(".testContent").empty();
            $(".testContent").append(lecturersView.render().el);
        });
    },

    students: function(){
        var studentCollection = new App.Collections.Students;

        if($('.appContent').is(':empty')){
            this.test();
        }

        studentCollection.fetch().then(function(){
            var studentsView = new App.Views.Students({ collection : studentCollection });
            $(".testContent").empty();
            $(".testContent").append(studentsView.render().el);
        });
    },

    nationalities: function(){
        var nationalitiesCollection = new App.Collections.Nationalities;

        if($('.appContent').is(':empty')){
            this.test();
        }

        nationalitiesCollection.fetch().then(function(){
            var nationalitiesView = new App.Views.Nationalities({ collection : nationalitiesCollection });
            $(".testContent").empty();
            $(".testContent").append(nationalitiesView.render().el);
        });
    },

    courses: function(){
        var courseCollection = new App.Collections.Courses;

        if($('.appContent').is(':empty')){
            this.test();
        }

        courseCollection.fetch().then(function(){
            var coursesView = new App.Views.Courses({ collection : courseCollection });
            $(".testContent").empty();
            $(".testContent").append(coursesView.render().el);
        });
    },

    default: function(other){
        console.log("You tried to tune into" + other);
    }
});
