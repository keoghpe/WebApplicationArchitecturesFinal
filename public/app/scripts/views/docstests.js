App.Views.Docstests = Backbone.View.extend({

    initialize: function(){

        this.appContent = $(".appContent");
        vent.on('docs:overview',this.docsOverview, this);
        vent.on('test:tasks',this.tasks, this);
        vent.on('test:lecturers',this.lecturers, this);
        vent.on('test:students',this.students, this);
        vent.on('test:nationalities',this.nationalities, this);
        vent.on('test:courses',this.courses, this);

    },

    render: function (templateId) {

        var source = $(templateId).html();
        var template = Handlebars.compile(source);
        var html = template();

        this.$el.html(html);

        return this;
    },

    docsOverview: function(){
        if(this.appContent.is(':empty')){
            vent.trigger('docs:home');
        }
        $(".docsContent").empty();
        $(".docsContent").append(this.render("#overviewTemplate").el);
    },

    tasks: function(){
        var taskCollection = new App.Collections.Tasks;

        if($('.appContent').is(':empty')){
            this.test();
        }

        var doctests = this;
        taskCollection.fetch().then(function(){
            var tasksView = new App.Views.Tasks({ collection : taskCollection });
            doctests.getTemplate(tasksView);
        });
    },

    lecturers: function(){
        var lecturerCollection = new App.Collections.Lecturers;

        if($('.appContent').is(':empty')){
            this.test();
        }
        var doctests = this;
        lecturerCollection.fetch().then(function(){
            var lecturersView = new App.Views.Lecturers({ collection : lecturerCollection });
            doctests.getTemplate(lecturersView);
        });
    },

    students: function(){
        var studentCollection = new App.Collections.Students;

        if($('.appContent').is(':empty')){
            this.test();
        }
        var doctests = this;
        studentCollection.fetch().then(function(){
            var studentsView = new App.Views.Students({ collection : studentCollection });
            doctests.getTemplate(studentsView);
        });
    },

    nationalities: function(){
        var nationalitiesCollection = new App.Collections.Nationalities;

        if($('.appContent').is(':empty')){
            this.test();
        }
        var doctests = this;
        nationalitiesCollection.fetch().then(function(){
            var nationalitiesView = new App.Views.Nationalities({ collection : nationalitiesCollection });
            doctests.getTemplate(nationalitiesView);
        });
    },

    courses: function(){
        var courseCollection = new App.Collections.Courses;

        if($('.appContent').is(':empty')){
            this.test();
        }
        var doctests = this;
        courseCollection.fetch().then(function(){
            var coursesView = new App.Views.Courses({ collection : courseCollection });
            doctests.getTemplate(coursesView);
        });
    },

    test: function(){
        $(".testContent").empty();
        $(".testContent").append(this.render("#testTemplate").el);
    },

    getTemplate: function(view){
        console.log("derp");
        $(".testContent").empty();
        $(".testContent").append(view.render().el);
    }

});
