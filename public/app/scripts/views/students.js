App.Views.Students = Backbone.View.extend({

    render: function () {

        var html = template('studentsTemplate')(this.collection.toJSON());

        this.$el.html(html);

        return this;
    },

    addOne: function(student){
        var studentView = new App.Views.Student({model: student});

        this.$el.append(studentView.render().el);
    }
});
