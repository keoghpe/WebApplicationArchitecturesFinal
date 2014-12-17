App.Router = Backbone.Router.extend({
    routes: {
        '': 'index',
        //'*other':'default',
        'docs':'docs',
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
