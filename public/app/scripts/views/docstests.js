App.Views.Docstests = Backbone.View.extend({

    initialize: function(){

        this.testContent = $(".testContent");
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

        taskCollection.fetch().then(function(){
            var tasksView = new App.Views.Tasks({ collection : taskCollection });
            this.getTemplate(tasksView);
        });
    },

    lecturers: function(){
        var lecturerCollection = new App.Collections.Lecturers;

        if($('.appContent').is(':empty')){
            this.test();
        }

        lecturerCollection.fetch().then(function(){
            var lecturersView = new App.Views.Lecturers({ collection : lecturerCollection });
            this.getTemplate(lecturersView);
        });
    },

    students: function(){
        var studentCollection = new App.Collections.Students;

        if($('.appContent').is(':empty')){
            this.test();
        }

        studentCollection.fetch().then(function(){
            var studentsView = new App.Views.Students({ collection : studentCollection });
            this.getTemplate(studentsView);
        });
    },

    nationalities: function(){
        var nationalitiesCollection = new App.Collections.Nationalities;

        if($('.appContent').is(':empty')){
            this.test();
        }

        nationalitiesCollection.fetch().then(function(){
            var nationalitiesView = new App.Views.Nationalities({ collection : nationalitiesCollection });
            this.getTemplate(nationalitiesView);
        });
    },

    courses: function(){
        var courseCollection = new App.Collections.Courses;

        if($('.appContent').is(':empty')){
            this.test();
        }

        courseCollection.fetch().then(function(){
            var coursesView = new App.Views.Courses({ collection : courseCollection });
            this.getTemplate(coursesView);
        });
    },

    test: function(){
        this.testContent.empty();
        this.testContent.append(this.render("#testTemplate").el);
    },

    getTemplate: function(view){
        this.testContent.empty();
        this.testContent.append(view.render().el);
    }

});
