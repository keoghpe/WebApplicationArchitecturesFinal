App.Views.Nationalities = Backbone.View.extend({

    render: function () {

        var html = template('nationalitiesTemplate')(this.collection.toJSON());

        this.$el.html(html);

        return this;
    }
});
