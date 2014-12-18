App.Views.Details = Backbone.View.extend({

    template: template('detailsTemplate'),

    render: function(){

        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});
