App.Router = Backbone.Router.extend({
    routes: {
        '': 'index',
        //'*other':'default',
        'docs':'docs',
        'docs/overview':'docsOverview',
        'docs/:endpoint':'endpoint',
        'test/tasks':'tasks',
        'test/lecturers':'lecturers',
        'test/students':'students',
        'test':'test'
    },

    index: function(){
        var docsView = new App.Views.Docs();
        $(".appContent").empty();
        $(".appContent").append(docsView.render("index").el);
    },

    test: function(){
        var docsView = new App.Views.Docs();
        $(".appContent").empty();
        $(".appContent").append(docsView.render("test").el);
    },

    docs: function(){
        var docsView = new App.Views.Docs();
        $(".appContent").empty();
        $(".appContent").append(docsView.render("docs").el);
        if($('.docsContent').is(':empty')){
            this.docsOverview();
        }
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
        var docsView = new App.Views.Docs();
        if($('.appContent').is(':empty')){
            this.docs();
        }
        $(".docsContent").empty();
        $(".docsContent").append(docsView.render("overview").el);
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

    default: function(other){
        console.log("You tried to tune into" + other);
    }
});
