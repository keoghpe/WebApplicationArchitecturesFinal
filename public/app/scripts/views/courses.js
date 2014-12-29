App.Views.Courses = Backbone.View.extend({

    render: function () {

        var html = template('coursesTemplate')(this.collection.toJSON());

        this.$el.html(html);

        return this;
    }
});
