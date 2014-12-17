App.Views.Lecturers = Backbone.View.extend({
    //tagName: 'table',

    render: function () {
        //this.collection.each(this.addOne,this); //pass this as the context to the annonfunc

        //var source = $('#lecturersTemplate').html();
        //var template = Handlebars.compile(source);
        var html = template('lecturersTemplate')(this.collection.toJSON());

        this.$el.html(html);

        return this;
    },

    addOne: function(lecturer){
        var lecturerView = new App.Views.Lecturer({model: lecturer});

        this.$el.append(lecturerView.render().el);
    }
});
