/*jshint unused: false, undef:false */

'use strict';

(function () {

    window.App = {
        Models: {},
        Collections: {},
        Views: {}
    };

    window.template = function (id) {
        return _.template($('#' + id).html());
    }


    App.Models.Task = Backbone.Model.extend({
        defaults: {
            id: 0,
            description: 'thing',
            date: '2014-04-27',
            duration: 180,
            daytime: '3pm-6pm',
            courseId: 1
        },

        validate: function(attrs){
            if(!$.trim(attrs.description)){
                return 'Description cannot be blank';
            }

            if(attrs.duration < 0){
                return 'Duration cannot be negative';
            }
        },

        do: function() {
            console.log('Doing ' + this.get('description'));
        }
    });

    App.Collections.Tasks = Backbone.Collection.extend({
        model: App.Models.Task
    });

    App.Views.Task = Backbone.View.extend({

        tagName: 'li',

        template: template('taskTemplate'),

        initialize: function(){
            this.model.on('change', this.render, this);
            this.model.on('destroy', this.remove, this);
        },

        events: {
            'click .edit': 'editTask',
            'click .delete': 'destroy'
        },

        editTask: function () {
            var newTaskDescription = prompt(
              'What would you like to change the text to?',
              this.model.get('description'));

            this.model.set('description', newTaskDescription);
        },

        destroy: function(){
            this.model.destroy();
        },

        remove: function(){
            this.$el.remove();
        },

        render: function () {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        }
        
    });

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

    var taskCollection = new App.Collections.Tasks([{description:'derp'},{description:'nerp'}]);

    var tasksView = new App.Views.Tasks({ collection : taskCollection });

    $(document.body).append(tasksView.render().el);

})();
