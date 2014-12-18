App.Views.Tasks = Backbone.View.extend({
    //tagName: 'table',

    render: function () {
        this.collection.each(this.addOne,this); //pass this as the context to the annonfunc

        var html = template('tasksTemplate')(this.collection.toJSON());

        this.$el.html(html);

        return this;
    },

    addOne: function(task){
        var taskView = new App.Views.Task({model: task});

        this.$el.append(taskView.render().el);
    }
});
