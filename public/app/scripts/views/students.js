App.Views.Students = Backbone.View.extend({
    //tagName: 'table',

    render: function () {
        //this.collection.each(this.addOne,this); //pass this as the context to the annonfunc

        // var source = $('#studentsTemplate').html();
        // var template = Handlebars.compile(source);
        var html = template('studentsTemplate')(this.collection.toJSON());

        this.$el.html(html);

        return this;
    },

    addOne: function(student){
        var studentView = new App.Views.Student({model: student});

        this.$el.append(studentView.render().el);
    }
});
