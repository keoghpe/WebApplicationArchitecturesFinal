window.App = window.App || {
    Models: {},
    Collections: {},
    Views: {},
    Router: {}
};

App.Views.Tasks = Backbone.View.extend({
    tagName: 'ul',

    render: function () {
        this.collection.each(this.addOne,this); //pass this as the context to the annonfunc

        return this;
    },

    addOne: function(task){
        var taskView = new App.Views.Task({model: task});

        this.$el.append(taskView.render().el);
    }
});
